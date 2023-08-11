@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            Charts can be styled using CSS, such as this example overriding
                            the default styles for a pie chart. This can be done without the
                            use of Javascript, allowing designers and developers to better
                            collaborate on chart design.
                        </p>
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
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: [
                @foreach($header as $item)
                    "{{ $item }}",
                @endforeach
            ],
            datasets: [{
              label: '# of Votes',
              data: [
                @foreach($data_detail as $item)
                    "{{ $item }}",
                @endforeach
              ],
              borderWidth: 1,
              viewBox: true,
            }]
          },
        //   options: {
        //     scales: {
        //       y: {
        //         beginAtZero: true
        //       }
        //     }
        //   }
        });

        Highcharts.chart('container', {
            chart: {
                styledMode: true
            },
            title: {
                text: 'Mobile vendor market share, 2021'
            },
            // xAxis: {
            //     categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            // },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    @foreach($data as $item)
                       [ "{{ $item[0] }}",{{ $item[1] }},false,true],
                    @endforeach
                    // ['Samsung', 27.79, true, true],
                    // ['Apple', 27.34, false],
                    // ['Xiaomi', 10.87, false],
                    // ['Huawei', 8.48, false],
                    // ['Oppo', 5.38, false],
                    // ['Vivo', 4.17, false],
                    // ['Realme', 2.57, false],
                    // ['Unknown', 2.45, false],
                    // ['Motorola', 2.22, false],
                    // ['LG', 1.53, false],
                    // ['Other', 7.2, false]
                ],
                showInLegend: true
            }]
        });
      </script>
    
@endpush