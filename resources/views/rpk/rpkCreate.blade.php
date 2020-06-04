@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT OKP</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">OKP</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ Route('rpk.store') }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Personal</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Bidang</label>
                                    <input type="text" name="bidang" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nomer OKP</label>
                                    <input type="number" name="no_okp" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <input type="text" name="status" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Daftar</label>
                                    <input type="text" class="form-control" placeholder="2017-06-04"
                                        name="tanggal_daftar" id="mdatepicker2" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Profile</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Visi</label>
                                    <input type="text" name="visi" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Misi</label>
                                    <input type="text" name="misi" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Berdiri</label>
                                    <input type="text" class="form-control" placeholder="2017-06-04"
                                        name="tanggal_berdiri" id="mdatepicker" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pendiri</label>
                                    <input type="text" name="pendiri" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Latar Belakang</label>
                                    <textarea name="latar_belakang" class="form-control"></textarea>
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Okp Admin</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="email" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Level <small class="form-control-feedback"> user
                                            ini</small></label>
                                    <select class="form-control" name="level" custom-select">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password </label>
                                    <input type="text" name="password" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Maps</h3>
                        <hr>
                        <div class="row" style="margin-bottom:20px">
                            <div class="col-3">
                                <input type="text" placeholder="langitude" class="form-control" name="langitude"
                                    id="langitude">
                            </div>
                            <div class="col-3">

                                <input type="text" placeholder="longitude" class="form-control" name="longitude"
                                    id="longitude">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="pac-input" class="controls" type="text" placeholder="Cari Alamat">
                                <div id="mapGoogle" style="height: 500px;"></div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold; margin-top: 20px;">Foto</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="card">
                                    <div class="card-body" style="text-align: center !important;">
                                        <input type="file" name="foto" id="input-file-now" class="dropify" />
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-actions" style="margin-top:20px">
                        </div> <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/okp')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .dropify-wrapper .dropify-message p {
        text-align: center;
    }

</style>


<script>
    function initAutocomplete() {

        var kediri = {
            lat: -7.815742,
            lng: 112.062121
        };

        var map = new google.maps.Map(document.getElementById('mapGoogle'), {
            center: kediri,
            zoom: 19,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();
            document.getElementById("langitude").value = places[0].geometry.location.lat();
            document.getElementById("longitude").value = places[0].geometry.location.lng();
            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
</script>
@endsection
