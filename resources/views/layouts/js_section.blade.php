<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
<script src="{{ asset('assets/js/dashboard1.js') }}"></script>
{{-- <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> --}}
<script src="{{ asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script src="{{ asset('assets/plugins/ludo-jquery-treetable/jquery.treetable.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chartist-js/dist/chartist.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/d3/d3.min.js')}}"></script>
<script src="{{ asset('assets/plugins/c3-master/c3.min.js')}}"></script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1fNYmyPlWrN1HLgWY3K7-IcGafclJhso&libraries=places&callback=initAutocomplete">
</script>

<script>
    $(document).ready(function () {
        $(".select2").select2();
        var dateNow = new Date();
        $('#mdatepicker').bootstrapMaterialDatePicker({
            time: false,
            currentDate: dateNow,
        });
        $('#timePicker1').bootstrapMaterialDatePicker({
            date: false,
            shortTime: false,
            format: 'HH:mm'
        });
        $('#timePicker2').bootstrapMaterialDatePicker({
            date: false,
            shortTime: false,
            format: 'HH:mm'
        });
        $('#timePicker3').bootstrapMaterialDatePicker({
            date: false,
            shortTime: false,
            format: 'HH:mm'
        });
        $('.dropify').dropify();
        $("#treetable").treetable();

    });

    function insertModalInfo(data) {
        $('div.modal-body').text(data.info);
        $('#delete-user').each(function () {
            $(this).attr("href", data.url);
        });
    }

    function initAutocomplete() {

var location = {
    lat: -7.4142711,
    lng: 112.5304693
};

var map = new google.maps.Map(document.getElementById('mapGoogle'), {
    center: location,
    zoom: 12,
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
    console.log(places[0]);
    document.getElementById("langitude").value = places[0].geometry.location.lat();
    document.getElementById("longitude").value = places[0].geometry.location.lng();
    document.getElementById("lokasi").value = places[0].formatted_address;
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
