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

</script>
