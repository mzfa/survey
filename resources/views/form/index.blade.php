<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: #d4d4d4;
        }
    </style>
</head>

<body>
    <div class="container my-3">
        <div class="row mb-3">
            <div class="d-flex justify-content-between">
                <img width="25%" src="{{ asset('assets/img/rsup.png') }}">
                <img width="20%" src="{{ asset('assets/img/kgm.png') }}">
                <img width="35%" src="{{ asset('assets/img/ihc.png') }}">
            </div>
        </div>
        <hr>
        <p>
            Selam sehat dan salam sejahtera untuk pasien RSU Pekerja yang kami cintai Kami berterimakasih atas kepercayaannya untuk memilih RSU Pekerja sebagai tempat terbaik dan teman terpercaya dalam proses penyembuhan.
            Kami harap Bapak dan Ibu dapat turut serta mengisi survey kepuasan sebagai berikut :<br>
        </p>

        <form id="myForm" method="POST" action="{{ url('/action') }}">
            @csrf
            <div class="card">
                <div class="card-header bg-info text-white fw-bold">Dimensi Aksesibilitas</div>
                <div class="card-body">
                    <span>Skala Penilaian</span><br>
                    <span>1 : Sangat Tidak Puas</span><br>
                    <span>2 : Tidak Puas</span><br>
                    <span>3 : Kurang Puas</span><br>
                    <span>4 : Puas</span><br>
                    <span>5 : Sangat Puas</span><br>
                </div>
            </div>
            @php $no = 0; @endphp
            @foreach ($list_pertanyaan as $key => $pertanyaan)
                <div class="card mt-2">
                    @php
                        $no = $key + 1;
                        $jawaban = 'jawaban' . $no;
                        $pertanyaan_id = 'pertanyaan' . $no;
                    @endphp
                    <div class="card-body">
                        <p>{{ $pertanyaan->pertanyaan }}</p>
                        <input type="hidden" name="{{ $pertanyaan_id }}" value="{{ $pertanyaan->pertanyaan_id }}">
                        <div class="form-check form-check-inline mx-4">
                            <input class="form-check-input" value="1" type="radio" required name="{{ $jawaban }}" id="{{ $jawaban }}1">
                            <label class="form-check-label" for="{{ $jawaban }}1">1</label>
                        </div>
                        <div class="form-check form-check-inline mx-4">
                            <input class="form-check-input" value="2" type="radio" required name="{{ $jawaban }}" id="{{ $jawaban }}2">
                            <label class="form-check-label" for="{{ $jawaban }}2">2</label>
                        </div>
                        <div class="form-check form-check-inline mx-4">
                            <input class="form-check-input" value="3" type="radio" required name="{{ $jawaban }}" id="{{ $jawaban }}3">
                            <label class="form-check-label" for="{{ $jawaban }}3">3</label>
                        </div>
                        <div class="form-check form-check-inline mx-4">
                            <input class="form-check-input" value="4" type="radio" required name="{{ $jawaban }}" id="{{ $jawaban }}4">
                            <label class="form-check-label" for="{{ $jawaban }}4">4</label>
                        </div>
                        <div class="form-check form-check-inline mx-4">
                            <input class="form-check-input" checked value="5" type="radio" required name="{{ $jawaban }}" id="{{ $jawaban }}5">
                            <label class="form-check-label" for="{{ $jawaban }}5">5</label>
                        </div><br>
                    </div>
                </div>
                @endforeach
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Mohon Berikan Saran Anda </label>
                            <textarea name="saran" id="saran" cols="30" rows="3" class="form-control mt-2"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="saran_id" value="saran-{{ $urutan }}">
            <center class="mt-2">
                <button class="btn btn-primary btn-block w-100 btn-shadow" type="submit">KIRIM</button>
            </center>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function notif() {
            Swal.fire({
                position: 'top',
                icon: "success",
                title: "Terimakasih",
                text: "atas partisipasi Bapak dan Ibu dalam pengisian survey kepuasan kami. Kritik dan saran dari Bapak dan Ibu sangat berharga untuk kami demi memaksimalkan pelayanan kesehatan kami.",
                showConfirmButton: false,
                timer: 20000
            })
            document.getElementById("myForm").reset();
        }
    </script>
    @if (Session::has('success'))
        <script>
            setTimeout(notif, 1000);
        </script>
    @endif

</body>

</html>
