@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT JADWAL PELAJARAN</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Jadwal Pelajaran</li>
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
                <form method="POST" action="{{ Route('schedule.store') }}">
                    @csrf
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mata Pelajaran</label>
                                    <select class="selectize_custom" name="subject_id" required>
                                        @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kelas</label>
                                    <select class="selectize_custom" required name="kelas_id">
                                        @foreach ($kelas as $class)
                                        <option value="{{$class->id}}">{{$class->grade}} - {{$class->majors}} {{$class->number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Guru Pengajar</label>
                                    <select class="selectize_custom" required name="user_id">
                                        @foreach ($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Info Jam dan Tahun</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jam Mulai</label>
                                    <input type="text" class="form-control" name="start_at"
                                        id="timePicker1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jam Selesai</label>
                                    <input type="text" class="form-control" name="end_at"
                                    id="timePicker2" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Hari</label>
                                    <select class="selectize_custom" required name="day">
                                        <option value="senin">senin</option>
                                        <option value="selasa">selasa</option>
                                        <option value="rabu">rabu</option>
                                        <option value="kamis">kamis</option>
                                        <option value="jumat">jumat</option>
                                        <option value="sabtu">sabtu</option>
                                        <option value="minggu">minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Semester</label>
                                    <select class="selectize_custom"  name="semester" required>
                                        <option value="ganjil">ganjil</option>
                                        <option value="genap">genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tahun</label>
                                    <select class="selectize_custom"  name="year" required>
                                        <option value="{{date('Y')}}">{{date('Y')}}</option>
                                        <option value="{{date('Y', strtotime('+1 year'))}}">{{date('Y', strtotime('+1 year'))}}</option>
                                        <option value="{{date('Y', strtotime('+2 year'))}}">{{date('Y', strtotime('+2 year'))}}</option>
                                        <option value="{{date('Y', strtotime('+3year'))}}">{{date('Y', strtotime('+3 year'))}}</option>
                                    </select>
                                </div>
                            </div>
                        
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{url('/schedule')}}" class="btn btn-inverse">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
