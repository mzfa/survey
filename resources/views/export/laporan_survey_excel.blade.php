<html>
    <head>
        <title>Export Excel</title>
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Kunjungan</th>
                    <th>Jenis Rawat</th>
                    <th>Di Isi Pada</th>
                    @if(!empty($data_detail[0][0]))
                    @foreach($data_detail[0][0] as $item2)
                    {{-- <td>{{ $item2->nama_kategori_survey }}</td> --}}
                    <td>{{ $item2->pertanyaan }}</td>
                    @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($data_detail as $item)
                    <tr>
                        {{-- <th>{{ $item['no'] }}</th>
                        <td>{{ $item['nama_pasien'] }}</td>
                        <td>{{ $item['kunjungan'] }}</td>
                        <td>{{ $item['jenis_rawat'] }}</td>
                        <td>{{ $item['di_isi'] }}</th> --}}
                        <th>{{ $item['no'] }}</th>
                        <td>{{ stripslashes($item['nama_pasien']) }}</td>
                        <td>{{ $item['kunjungan'] }}</td>
                        <td>{{ $item['jenis_rawat'] }}</td>
                        <td>{{ $item['di_isi'] }}</td>
                        @foreach($item[0] as $item2)
                        <td>{{ $item2->jawaban }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>