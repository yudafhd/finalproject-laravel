@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">E-Warong</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">E-Warong</li>
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
                    Total E-Warong 
                    <span class="label label-success label-rounded">{{count($rpks)}}</span>
                </span>
                @if (auth()->user()->access_type ==='superadmin')
                <a href="{{Route('ewarong.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    Buat
                </a>
                @endif


                @if(count($rpks) > 0)
                <div class="table-responsive m-t-10 p-b-30 p-t-30">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nama Kios</th>
                                <th>Pemilik</th>
                                <th>Telephone</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rpks as $rpk)
                            <tr>
                                <td>{{ $rpk->nama_kios }}</td>
                                <td>{{ $rpk->user->name }}</td>  
                                <td>{{ $rpk->telp }}</td>  
                                @if ($rpk->status == 'PENDING')
                                <td><span class="badge badge-info">{{ $rpk->status }}</span></td>  
                                @elseif($rpk->status == 'ACTIVE')
                                <td><span class="badge badge-success">{{ $rpk->status }}</span></td>  
                                @elseif ($rpk->status == 'DISABLED')
                                <td><span class="badge badge-secondary">{{ $rpk->status }}</span></td>
                                @else
                                <td><span class="badge badge-danger">{{ $rpk->status }}</span></td>
                                @endif
                                <td style="text-align: center">
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{Route('ewarong.edit', $rpk->id)}}">Update</a>
                                               
                                                @if (auth()->user()->access_type ==='superadmin')
                                                <form method="POST" action="{{Route('ewarong.destroy', $rpk->id)}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn"> Delete </button>
                                                </form>
                                                @if ($rpk->status =='PENDING')
                                                <form method="POST" action="{{Route('ewarong.verify', $rpk->id)}}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn"> Verifikasi </button>
                                                </form>
                                                @endif   
                                                @if ($rpk->status =='ACTIVE')
                                                <form method="POST" action="{{Route('ewarong.disable', $rpk->id)}}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn"> Disable </button>
                                                </form>
                                                @endif   
                                                @if ($rpk->status =='PENDING')
                                                <form method="POST" action="{{Route('ewarong.reject', $rpk->id)}}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn"> Reject </button>
                                                </form>
                                                @endif   
                                                @if ($rpk->status =='DISABLED')
                                                <form method="POST" action="{{Route('ewarong.actived', $rpk->id)}}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn"> Active </button>
                                                </form>
                                                @endif   
                                                @endif
                                             
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
                    belum ada
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
