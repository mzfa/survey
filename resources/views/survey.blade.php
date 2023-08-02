@extends('layouts.tamplate')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row mb-3">
                <div class="text-center">
                    <img width="25%" src="{{ asset('assets/img/rsup.png') }}">
                    <img width="20%" src="{{ asset('assets/img/kgm.png') }}">
                    <img width="35%" src="{{ asset('assets/img/ihc.png') }}">
                </div>
            </div>
            <h5 class="text-center mb-3">Survey Kepuasan Pelanggan <br> RS UMUM & PEKERJA</h5>
        </div>
        <div class="tab-status row text-center" style="display: none">
            @php
                $no = 1;
            @endphp
            @foreach($list_pertanyaan as $item)
            <span class="col-1 tab @if($no == 1) active @endif">{{ $no++ }}</span>
            @endforeach
        </div>
        <form action="{{ url('action/'.$jenis_survey_id) }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div role="tab-list">
                @php
                    $no = 1;
                @endphp
                @foreach($list_pertanyaan as $item)
                    <div role="tabpanel" id="{{ $no }}" class="tabpanel @if($no !== 1) hidden @endif">
                        <input type="hidden" value="{{ $item->pertanyaan_id }}" name="pertanyaan_id[]">
                        <h5 class="mt-3 mb-3">{{ $no }}. &nbsp; {{ $item->pertanyaan }}</h5>
                        @if($item->jenis_pertanyaan == 1)
                        <div class="form-group">
                            <input type="text" class="form-control" name="jawaban{{ $no }}[]">
                            <em>{{ $item->keterangan }}</em>
                        </div>
                        @elseif($item->jenis_pertanyaan == 2)
                        @php
                            $keterangan = explode('|', $item->keterangan);
                        @endphp
                        @for($i = 0; $i < count($keterangan); $i++)
                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                            <input type="checkbox" value="{{ $keterangan[$i] }}" name="jawaban{{ $no }}[]" class="custom-control-input form-control" id="customCheck{{ $no.'-'.$i }}">
                            <label class="custom-control-label mb-1" for="customCheck{{ $no.'-'.$i }}">{{ $keterangan[$i] }}</label>
                        </div> <br>
                        @endfor
                        @elseif($item->jenis_pertanyaan == 3)
                        <div class="form-group">
                            <label for="">Judul</label>
                            <textarea name="jawaban{{ $no }}[]" id="" cols="30" rows="3" class="form-control"></textarea>
                            <em>{{ $item->keterangan }}</em>
                        </div>
                        @elseif($item->jenis_pertanyaan == 4)
                        <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                            <input type="radio" checked id="{{ $no }}-4" name="jawaban{{ $no }}[]" value="SB" class="custom-control-input bg-primary form-control">
                            <label class="custom-control-label" for="{{ $no }}-4">Sangat Baik</label>
                        </div><br>
                        <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                            <input type="radio" id="{{ $no }}-3" name="jawaban{{ $no }}[]" value="B" class="custom-control-input bg-primary form-control">
                            <label class="custom-control-label" for="{{ $no }}-3">Baik</label>
                        </div><br>
                        <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                            <input type="radio" id="{{ $no }}-2" name="jawaban{{ $no }}[]" value="C" class="custom-control-input bg-primary form-control">
                            <label class="custom-control-label" for="{{ $no }}-2">Cukup Baik</label>
                        </div><br>
                        <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                            <input type="radio" id="{{ $no }}-1" name="jawaban{{ $no }}[]" value="K" class="custom-control-input bg-primary form-control">
                            <label class="custom-control-label" for="{{ $no }}-1">Kurang Baik</label>
                        </div><br>
                        @elseif($item->jenis_pertanyaan == 5)
                        <div class="form-group">
                            <label for="formControlRange">Range input</label>
                            <input type="range" class="form-control-range form-control" id="formControlRange" name="jawaban{{ $no }}[]" min="0" value="0" max="10" step="1" list="ticks" >
                            <datalist id="ticks">
                                <option>0</option>
                                <option>2</option>
                                <option>4</option>
                                <option>6</option>
                                <option>8</option>
                                <option>10</option>
                            </datalist>
                            <em>{{ $item->keterangan }}</em>
                        </div>
                        @elseif($item->jenis_pertanyaan == 6)
                        @php
                            $keterangan = explode('|', $item->keterangan);
                        @endphp
                        @for($i = 0; $i < count($keterangan); $i++)
                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                            <input type="checkbox" value="{{ $keterangan[$i] }}" name="jawaban{{ $no }}[]" class="custom-control-input form-control" id="customCheck{{ $no.'-'.$i }}">
                            <label class="custom-control-label mb-1" for="customCheck{{ $no.'-'.$i }}">{{ $keterangan[$i] }}</label>
                        </div> <br>
                        @endfor
                        @endif
                    </div>
                    @php
                        $no++
                    @endphp
                @endforeach
            </div>
            <div class="pagination">
                <a class="btn hidden text-white" id="prev">Kembali</a>
                <a class="btn text-white" id="next">Selanjutnya</a>
                <button class="btn btn-submit hidden" type="submit" id="submit">Submit</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    const previousButton = document.querySelector('#prev')
const nextButton = document.querySelector('#next')
const submitButton = document.querySelector('#submit')
const tabTargets = document.querySelectorAll('.tab')
const tabPanels = document.querySelectorAll('.tabpanel')
const isEmpty = (str) => !str.trim().length
let currentStep = 0

// Validate first input on load
validateEntry()

// Next: Change UI relative to current step and account for button permissions
nextButton.addEventListener('click', (event) => {
  event.preventDefault()

  // Hide current tab
  tabPanels[currentStep].classList.add('hidden')
  tabTargets[currentStep].classList.remove('active')

  // Show next tab
  tabPanels[currentStep + 1].classList.remove('hidden')
  tabTargets[currentStep + 1].classList.add('active')
  currentStep += 1
  
  validateEntry()
  updateStatusDisplay()
})

// Previous: Change UI relative to current step and account for button permissions
previousButton.addEventListener('click', (event) => {
  event.preventDefault()

  // Hide current tab
  tabPanels[currentStep].classList.add('hidden')
  tabTargets[currentStep].classList.remove('active')

  // Show previous tab
  tabPanels[currentStep - 1].classList.remove('hidden')
  tabTargets[currentStep - 1].classList.add('active')
  currentStep -= 1

  nextButton.removeAttribute('disabled')
  updateStatusDisplay()
})


function updateStatusDisplay() {
  // If on the last step, hide the next button and show submit
  if (currentStep === tabTargets.length - 1) {
    nextButton.classList.add('hidden')
    previousButton.classList.remove('hidden')
    submitButton.classList.remove('hidden')
    validateEntry()

    // If it's the first step hide the previous button
  } else if (currentStep == 0) {
    nextButton.classList.remove('hidden')
    previousButton.classList.add('hidden')
    submitButton.classList.add('hidden')
    // In all other instances display both buttons
  } else {
    nextButton.classList.remove('hidden')
    previousButton.classList.remove('hidden')
    submitButton.classList.add('hidden')
  }
}

function validateEntry() {
  let input = tabPanels[currentStep].querySelector('.form-control')
  
  // Start but disabling continue button
  nextButton.setAttribute('disabled', true)
  submitButton.setAttribute('disabled', true)
  
  // Validate on initial function fire
  setButtonPermissions(input)
  
  // Validate on input
  input.addEventListener('input', () => setButtonPermissions(input))
  // Validate if bluring from input
  input.addEventListener('blur', () => setButtonPermissions(input))
}

function setButtonPermissions(input) {
// console.log(input.value)
  if (isEmpty(input.value)) {
    nextButton.setAttribute('disabled', true)
    submitButton.setAttribute('disabled', true)
  } else {
    nextButton.removeAttribute('disabled')
    submitButton.removeAttribute('disabled')
  }
}

</script>

@endpush