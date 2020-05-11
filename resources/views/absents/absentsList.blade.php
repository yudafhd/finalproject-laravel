@extends('layouts.index') @section('content')
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

                @if ($success_message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$success_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif

                <span>
                    Total Absensi hari ini 
                    <span class="label label-success label-rounded">{{count($absents)}}</span>
                </span>
                <a href="{{Route('absents.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-checkbox-marked-outline"></i>
                    Buat Absensi
                </a>
                @if(count($absents) > 0)
                <div class="table-responsive m-t-10">
                    <table id="myTable" class="table">
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
                                    {{ $absent->schedule->class->grade }}
                                    {{ $absent->schedule->class->majors }}
                                    {{ $absent->schedule->class->number }}
                                    
                                    -
                                    {{ $absent->schedule->subject->name }}
                                    -
                                    {{ $absent->schedule->user->name }}
                                </td>
                                <td>{{ $absent->reason }}</td>
                                <td>{{ $absent->date }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{Route('absents.edit', $absent->id)}}">Update</a>
                                                <form method="POST" action="{{Route('absents.destroy', $absent->id)}}">
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
                <div class="table-responsive m-t-10">
                    Absensi belum ada
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
