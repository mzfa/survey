<html>
    <head>
        <title>Export Excel</title>
    </head>

    <body>
        <table>
            {{-- <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Kunjungan</th>
                    <th>Jenis Rawat</th>
                    <th>Di Isi Pada</th>
                    @if(!empty($data_detail[0][0]))
                    
                    @endif
                </tr>
            </thead>  --}}
            <tbody>
                {{-- {{ dd($data_detail) }} --}}
                @foreach($data_detail as $item)
                    <tr>
                        {{-- @endforeach --}}
                        @foreach($item as $item2)
                            @if(isset($item2->jawaban))
                                {{-- <td>{{ $item2->jawaban }}</td> --}}
                                <td>{{ $item2->jawaban }}</td>
                            @else
                                @foreach($item2 as $item3)
                                <td>{{ $item3 }}</td>
                                {{-- <td>{{ $item3 }}</td> --}}
                                @endforeach
                            @endif
                            {{-- @if(isset($item2['jawaban1']))
                            {!! var_dump($item2['jawaban1']) !!}
                            @else
                            @endif --}}
                            {{-- <br> --}}
                        @endforeach
                        {{-- <th>{{ $item['no'] }}</th>
                        <td>{{ $item['nama_pasien'] }}</td>
                        <td>{{ $item['kunjungan'] }}</td>
                        <td>{{ $item['jenis_rawat'] }}</td>
                        <td>{{ $item['di_isi'] }}</th> --}}
                        {{-- <th>{{ $item['no'] }}</th>
                        <td>{{ stripslashes($item['nama_pasien']) }}</td>
                        <td>{{ $item['kunjungan'] }}</td>
                        <td>{{ $item['jenis_rawat'] }}</td>
                        <td>{{ $item['di_isi'] }}</td>
                        @foreach($item[0] as $item2) --}}
                            {{-- @if (isset($item2->jawaban))
                                {!! $item2->jawaban !!}
                            @elseif(isset($item2))
                                {!! $item2->jawaban !!}
                            @endif --}}
                            {{-- @if(!empty($item2)) --}}
                                {{-- <td>
                                    @php 
                                        (isset($item2->jawaban)) ? $item2->jawaban : $item2['jawaban'];
                                    @endphp
                                </td> --}}
                                {{-- @if(isset($item2['jawaban']))
                                <td>{{ $item2['jawaban'] }}</td>
                                @else
                                <td>{!! $item2->jawaban !!}</td>
                                @endif --}}
                            {{-- @endif --}}
                            {{-- @endforeach --}}
                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>