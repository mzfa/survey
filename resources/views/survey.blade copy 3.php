@extends('layouts.tamplate')

@section('content')
    <div class="mt-3">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="d-flex justify-content-between">
                            <img width="25%" src="{{ asset('assets/img/rsup.png') }}">
                            <img width="20%" src="{{ asset('assets/img/kgm.png') }}">
                            <img width="35%" src="{{ asset('assets/img/ihc.png') }}">
                        </div>
                    </div>
                    {{-- <h5>SURVEY PELANGGAN</h5> --}}
                    <p>
                        "Selam sehat dan salam sejahtera untuk pasien RSU Pekerja yang kami cintai Kami berterimakasih atas kepercayaannya untuk memilih RSU Pekerja sebagai tempat terbaik dan teman terpercaya dalam proses penyembuhan. Kami harap Bapak dan Ibu dapat turut serta mengisi survey kepuasan dibawah ini."
                    </p>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="">
                            @php
                                $no = 1;
                            @endphp
                            @foreach($list_pertanyaan as $item)
                                <input type="hidden" value="{{ $item->pertanyaan_id }}" name="pertanyaan_id[]">
                                <h5 class="mt-3 mb-3">{{ $no++ }}. &nbsp; {{ $item->pertanyaan }}</h5>
                                @if($item->jenis_pertanyaan == 1)
                                <div class="form-group">
                                    <input type="text" class="form-control">
                                </div>
                                @elseif($item->jenis_pertanyaan == 2)
                                <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                    <input type="checkbox" checked="" value="1" name="task" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label mb-1" for="customCheck2">Mengindetifikasi Task</label>
                                </div>
                                @elseif($item->jenis_pertanyaan == 3)
                                <div class="form-group">
                                    <label for="">Judul</label>
                                    <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                                @elseif($item->jenis_pertanyaan == 4)
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
                                <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                    <input type="radio" id="customRadio-1" name="customRadio-10" class="custom-control-input bg-primary">
                                    <label class="custom-control-label" for="customRadio-1"> Primary </label>
                                </div>
                                <div class="custom-control custom-radio custom-radio-color-checked custom-control-inline">
                                    <input type="radio" id="customRadio-2" name="customRadio-10" class="custom-control-input bg-primary">
                                    <label class="custom-control-label" for="customRadio-2"> primary </label>
                                </div>
                                @elseif($item->jenis_pertanyaan == 5)
                                <div class="form-group">
                                    <label for="formControlRange">Range input</label>
                                    <input type="range" class="form-control-range" id="formControlRange">
                                </div>
                                @endif
                                <hr>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn btn-warning btn-block">Kembali</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary btn-block">Selanjutnya</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush