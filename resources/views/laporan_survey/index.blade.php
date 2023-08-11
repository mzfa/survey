@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Laporan Survey &nbsp;</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" name="tanggal_awal" @isset($tanggal_awal) value="{{ $tanggal_awal }}" @endisset class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" name="tanggal_akhir" @isset($tanggal_akhir) value="{{ $tanggal_akhir }}" @endisset class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Jenis Survey</label>
                                        <select name="jenis_survey_id" class="form-control select2" >
                                            <option value="All" @isset($jenis_survey_id) @if($jenis_survey_id == "All") selected @endif @endif>All</option>
                                            @foreach($jenis_survey as $item)
                                                <option value="{{ $item->jenis_survey_id }}"  @isset($jenis_survey_id) @if($jenis_survey_id == $item->jenis_survey_id) selected @endif @endif>{{ $item->nama_jenis_survey }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kategori Survey</label>
                                        <select name="kategori_survey_id" class="form-control select2" >
                                            <option value="All" @isset($kategori_survey_id) @if($kategori_survey_id == "All") selected @endif @endif>All</option>
                                            @foreach($kategori_survey as $item)
                                                <option value="{{ $item->kategori_survey_id }}" @isset($kategori_survey_id) @if($kategori_survey_id == $item->kategori_survey_id) selected @endif @endif>{{ $item->nama_kategori_survey }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @if(!empty($data_detail))
                        @php
                            $jenis_survey_id = ($jenis_survey_id) ? $jenis_survey_id : 0;
                            $kategori_survey_id = ($kategori_survey_id) ? $kategori_survey_id : 0;
                        @endphp
                        <a target="_blank" href="{{ url('laporan_survey/export_excel/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$jenis_survey_id.'/'.$kategori_survey_id) }}" class="btn btn-primary">Excel</a>
                        <a target="_blank" href="{{ url('laporan_survey/chart/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$jenis_survey_id.'/'.$kategori_survey_id) }}" class="btn btn-primary">Chart</a>
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
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
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    </script>
@endpush
