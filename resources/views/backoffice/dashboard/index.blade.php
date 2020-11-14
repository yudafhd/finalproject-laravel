@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">DASHBOARD</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="card border-left-info h-100 ml-3">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-5">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Siswa</div>
                    <div class="h5 mb-0 text-gray-800">{{ count($siswa) }}</div>
                </div>
                <div class="col-auto">
                    <i class="mdi mdi-account-box fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-left-info h-100 ml-5">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-5">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Guru</div>
                    <div class="h5 mb-0 text-gray-800">{{ count($guru) }}</div>
                </div>
                <div class="col-auto">
                    <i class="mdi mdi-account-box fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-left-info h-100 ml-5">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-5">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Kelas</div>
                    <div class="h5 mb-0 text-gray-800">{{ count($kelas) }}</div>
                </div>
                <div class="col-auto">
                    <i class="mdi mdi-chair-school fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-left-info h-100 ml-5">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-5">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Mata Pelajaran</div>
                    <div class="h5 mb-0 text-gray-800">{{ count($subject) }}</div>
                </div>
                <div class="col-auto">
                    <i class="mdi mdi-book-open-variant fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart" width="10vw" height="10vh"></canvas>
                <script>
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Red', 'Blue','Yellow', 'Green', 'Grey'],
                        datasets: [{
                            label: 'Grafik absensi satu tahun',
                            data: [2,1,5,5,3,3,],
                            responsive: 'true',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
