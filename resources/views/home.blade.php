@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Selamat Datang Di Aplikasi {{ env('APP_NAME') }}</h5>
                                <span class="badge badge-primary">Anda Login Sebagai {{ Auth::user()->username }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Projek</h5>
                                <span class="badge badge-primary">Monthly</span>
                            </div>
                            <h3><span class="counter">35000</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>User</h5>
                                <span class="badge badge-warning">Anual</span>
                            </div>
                            <h3><span class="counter">25100</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Task</h5>
                                <span class="badge badge-success">Today</span>
                            </div>
                            <h3><span class="counter">33000</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="top-block d-flex align-items-center justify-content-between">
                                <h5>Profit</h5>
                                <span class="badge badge-info">Weekly</span>
                            </div>
                            <h3>$<span class="counter">2500</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Page end  -->
        </div>
    </div>    
      
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
    
@endpush