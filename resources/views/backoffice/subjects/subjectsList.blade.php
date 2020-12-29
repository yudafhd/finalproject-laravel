@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">MATA PELAJARAN</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Mata Pelajaran</li>
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
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-import" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Import Data</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-download" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Download Data</a>
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
                            @if ($error_message)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{$error_message}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <span>
                                Total mata pelajaran
                                <span class="label label-success label-rounded">{{count($subjects)}}</span>
                            </span>
                            <a href="{{Route('subject.create')}}"
                                class="btn btn-primary waves-effect waves-light m-b-10 float-right">
                                <i class="mdi mdi-plus"></i>
                                Buat
                            </a>
                            @if(count($subjects) > 0)
                            <div class="table-responsive m-t-10">
                                <table id="searchTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Mata Pelajran</th>
                                            <th>Code</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->code }}</td>
                                            <td style="text-align: center">
                                                <div class="dropdown" style="float: right">
                                                    <button
                                                        class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{Route('subject.edit', $subject->id)}}">Update &
                                                            Detail</a>
                                                        <form method="POST"
                                                            action="{{Route('subject.destroy', $subject->id)}}">
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
                                Mata Pelajaran Belum Ada
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-import" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-inline" method="POST" action="{{ Route('subject.import') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="file_excel" class="form-control-file" />
                                    <br /> <br />
                                    <small> Mohon mempersiapkan file seperti yang sudah ditentukan oleh operator / developer </small>
                                </div>
                                <button type="submit" class="btn btn-primary">Proses</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-download" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ Route('subject.export') }}" class="btn btn-primary">Download Excel</a>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>

@endsection