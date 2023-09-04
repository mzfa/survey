@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
                
            </div>
            <!-- Page end  -->
        </div>
    </div>    
    {{ print_r($header) }}
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        Highcharts.chart('container', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'GRAFIK KEPUASAN PELANGGAN'
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    @foreach($data as $item)
                       [ "{{ $item[0] }}",{{ $item[1] }},false,true],
                    @endforeach
                ],
                showInLegend: true
            }]
        });
    </script>
@endpush