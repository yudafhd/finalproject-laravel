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
                    <strong>{{$error_message}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form method="POST" action="{{ Route('absent.store') }}" id="testing">
                    @csrf
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Absent Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kelas</label>
                                    <select class="selectize_custom" id="kelas_select" name="kelas_id">
                                        <option value="">Pilih kelas</option>
                                        @foreach ($classes as $class)
                                        <option value="{{$class->id}}">{{$class->grade}} - {{ $class->majors }} {{
                                            $class->number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="display: none;" id="siswa_select_container">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="display: none;" id="tanggal_select_container">
                                    <label class="control-label">Tanggal Absent</label>
                                    <input type="text" placeholder="Pilih tanggal" class="form-control"
                                        name="date_absent" value="" id="mdatepicker" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Reason</label>
                                    <select class="selectize_custom" name="reason">
                                        <option value="absen">Absen</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="izin">Izin</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Penjelasan</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check" style="display: none; padding-left:0px;"
                                    id="pelajaran_select_container">

                                </div>
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

<script>
    $(document).ready(function () {
        $("#kelas_select").on('change', function () {
            $("#mdatepicker").val(null);
            $('#siswa_select_container').hide();
            $('#pelajaran_select_container').show();
            $('#pelajaran_select_container').html(' <span>Pilih jadwal</span> <br />');
            $('#siswa_select_container').html('<label class="control-label">Siswa</label><select class="selectize_custom_multiple" id="siswa_select" name="user_id[]"><option value="">Pilih Siswa</option></select>');
            $.ajax({
                type: "POST",
                url: "{{ $request->getSchemeAndHttpHost() }}/api/user/kelas",
                data: { kelas_id: this.value },
                success: function (data) {
                    data.data.forEach(element => {
                        console.log(element);
                        $('#siswa_select')
                            .append('<option value="' + element.id + '">' + element.name + '</option>');
                    });
                    $('#tanggal_select_container').show();
                    $('#siswa_select_container').show();
                    $('.selectize_custom_multiple').selectize({
                        maxItems: 100
                    });
                }
            });
        });

        $("#mdatepicker").on('change', function () {
            const selector = $('#pelajaran_select_container');
            selector.html(' <div style="margin-bottom:5px">Pilih jadwal</div>');
            $.ajax({
                type: "POST",
                url: "{{ $request->getSchemeAndHttpHost() }}/api/user/jadwal",
                data: { date: this.value, kelas_id: $("#kelas_select").val() },
                success: function (data) {
                    console.log(data);
                    if (data.data.length) {
                        data.data.forEach(element => {
                            selector.show();
                            selector
                                .append('<div class="schedule_checkbox"><input class="form-check-input" name="schedule_id[]" type="checkbox" value="' + element.id + '" id="defaultCheck' + element.id + '"><label class="form-check-label" for="defaultCheck' + element.id + '"><b>' + element.subject.name + '</b> - '
                                    + '<span class="badge badge-light">' + element.start_at + '</span> <span class="badge badge-light">' + element.end_at + '</span>' 
                                    + element.user.name + '</label></div><br />');
                        });
                    } else {
                        selector.append('<span>Jadwal tidak ditemukan</span>')
                    }
                }
            });
        });
    });
</script>
@endsection