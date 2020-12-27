<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../assets/plugins/d3/d3.min.js"></script>
<script src="../assets/plugins/c3-master/c3.min.js"></script>
<script src="../assets/plugins/toast-master/js/jquery.toast.js"></script>
<script src="{{ asset('assets/js/dashboard1.js') }}"></script>
<script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="{{ asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API') }}&libraries=places&callback=initAutocomplete">
</script>
<style>
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        margin-top: 14px;
        padding: 5px;
        text-overflow: ellipsis;
        width: 400px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
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

    $(document).ready(function () {
        var dateNow = new Date();
        $('#mdatepicker').each(function () {
            $(this).bootstrapMaterialDatePicker({
                time: false,
                currentDate: dateNow,
            });
        });
        $('#mdatepicker2').each(function () {
            $(this).bootstrapMaterialDatePicker({
                time: false,
                currentDate: dateNow,
            });
        });
        $('#mdatepicker3').each(function () {
            $(this).bootstrapMaterialDatePicker({
                time: false,
                currentDate: dateNow,
            });
        });

        // Basic
        $('.dropify').dropify();
    });

    function insertModalInfo(data) {
        $('div.modal-body').text(data.info);
        $('#delete-user').each(function () {
            $(this).attr("href", data.url);
        });
    }

    
    $(document).ready(function() {
        $("[name=okp_id]").change(function() {
            let id = $(this).val();
            let jabatans = JSON.parse($("[name=jabatan]").attr("data-jabatan"));
            let jabatan = $("[name=jabatan]").find("option");
            console.log("id", id)
            console.log("jabatan", jabatan)
            if(jabatans.length > 0) {
                let opt = '';
                for(let i=0; i<jabatans.length; i++) {
                    if(jabatans[i].okp_id == id) {
                        let val = jabatans[i].nama;
                        let name = jabatans[i].nama;
                        let okp = jabatans[i].okp_id;
                        opt += '<option value='+val+' data-okp='+okp+'>'+name+'</option>';
                    }
                    $("[name=jabatan]").html(opt);
                }
            } else {
                $("[name=jabatan]").html("").trigger("change");
            }
        })
    })
</script>
