@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">ABSENSI</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Absensi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true">Home</a>
                        {{-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-import" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Import Data</a> --}}
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-download" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Download Laporan</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                     <div class="card">
                         <div class="card-body">
                            @if ($success_message)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{$success_message}}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            @endif
                            <span>
                                Total Absensi
                                <span class="label label-success label-rounded">{{count($absents)}}</span>
                            </span>
                            <a href="{{Route('absent.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                                <i class="mdi mdi-plus"></i>
                                Buat
                            </a>
                            @if(count($absents) > 0)
                            <div class="table-responsive m-t-10">
                                <table id="searchTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jadwal</th>
                                            <th>Alasan</th>
                                            <th>Tanggal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absents as $absent)
                                        <tr>
                                            <td>{{ $absent->user->name }}</td>
                                            <td>
                                                {{ $absent->schedule->kelas->grade }}
                                                {{ $absent->schedule->kelas->majors }}
                                                {{ $absent->schedule->kelas->number }}
                                                
                                                -
                                                {{ $absent->schedule->subject->name }}
                                                -
                                                {{ $absent->schedule->user->name }}
                                            </td>
                                            <td>{{ $absent->reason }}</td>
                                            <td>{{ $absent->date_absent }}</td>
                                            <td>
                                                <div class="dropdown" style="float: right">
                                                    <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{Route('absent.edit', $absent->id)}}">Update & Detail</a>
                                                            <form method="POST" action="{{Route('absent.destroy', $absent->id)}}">
                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" class="btn"> Delete </button>
                                                            </form>
                                                            
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="table-responsive m-20" style="text-align: center;">
                                Absent Belum Ada
                            </div>
                            @endif
                         </div>
                     </div>
                    </div>
                    
                    <div class="tab-pane fade" id="nav-download" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <form class="form" method="POST" action="{{ Route('absent.export') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label">Tanggal Awal</label>
                                    <input type="date" name="start_at" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tanggal Akhir</label>
                                    <input type="date" name="end_at" class="form-control" />
                                </div>
                               </div>
                                <button type="submit" class="btn btn-primary">Download</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
