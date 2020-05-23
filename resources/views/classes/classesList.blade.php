@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">KELAS</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Kelas</li>
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
                @if ($alert_error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$alert_error}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                <span>
                    Total kelas 
                    <span class="label label-success label-rounded">{{count($classes)}}</span>
                </span>
                <a href="{{Route('classes.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    Buat
                </a>
                @if(count($classes) > 0)
                <div class="table-responsive m-t-10">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nama kelas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $classe)
                            <tr>
                                <td>{{ $classe->grade }} - {{ $classe->majors }} {{ $classe->number }}</td>
                                <td style="text-align: center">
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{Route('classes.edit', $classe->id)}}">Update</a>
                                                <form method="POST" action="{{Route('classes.destroy', $classe->id)}}">
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
