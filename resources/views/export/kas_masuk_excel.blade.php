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
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;   
                @endphp
                @foreach($data_detail as $item)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $item['nama_pasien'] }}</td>
                        <td>{{ $item['kunjungan'] }}</td>
                        <td>{{ $item['jenis_rawat'] }}</td>
                        <td>{{ $item['di_isi'] }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>