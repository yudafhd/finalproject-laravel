@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT ABSENSI</h3>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if ($error_message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$error_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                <form method="POST" action="{{ Route('absent.update', $absents->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Absent Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Siswa</label>
                                    <select class="form-control" name="user_id" custom-select">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}"
                                            {{$absents->user_id == $user->id ? 'selected' : ''}}
                                            >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jadwal</label>
                                    <select class="form-control" name="schedule_id" custom-select">
                                        @foreach ($schedules as $schedule)
                                        <option value="{{$schedule->id}}"
                                            {{$absents->schedule_id == $schedule->id ? 'selected' : ''}}
                                            >
                                            {{$schedule->kelas->grade}}
                                            {{$schedule->kelas->majors}}
                                            {{$schedule->kelas->number}}
                                            -
                                            {{$schedule->subject->name}}
                                            -
                                            {{$schedule->user->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Absent</label>
                                <input type="text" class="form-control" name="date_absent" value="{{$absents->date_absent}}" id="mdatepicker" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Reason</label>
                                    <select class="form-control" name="reason">
                                        <option value="absen" {{$absents->reason == 'absen' ? 'selected' : ''}}>Absen</option>
                                        <option value="izin" {{$absents->reason == 'izin' ? 'selected' : ''}}>Izin</option>
                                        <option value="lain" {{$absents->reason == 'lain' ? 'selected' : ''}}>Lain</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Penjelasan</label>
                                    <textarea name="description" class="form-control">{{$absents->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{url('/absent')}}" class="btn btn-inverse">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
