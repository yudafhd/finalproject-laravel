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
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="{{ asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script src="{{ asset('assets/plugins/ludo-jquery-treetable/jquery.treetable.js') }}"></script>
<script>
    $(document).ready(function () {
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

        // $('#mdate').bootstrapMaterialDatePicker({
        //     weekStart: 0,
        //     time: false
        // }).on('change', function (e, date) {
        //     $('#result_booking').append("<p>LOADING...</p>");
        //     $.get(" http://localhost:8000/api/listbooking/" + date.format('YYYY-MM-DD'), function (
        //         data) {
        //         $('#result_booking').html('');
        //         $('#result_booking').append(
        //             `Ada <strong>${data.length}</strong> booking tanggal ini <br /><br />`)
        //         data.forEach(function (item) {
        //             console.log(item)
        //             $('#result_booking').append(
        //                 `<p>Tanggal Booking: ${item.booking_date}, Jam Mulai:  ${item.start_time_at}, Customer: ${item.customer.id_customer} - ${item.customer.name}</p>`
        //             );
        //         })

        //     });
        // });

        $("#treetable").treetable();
    });

    function insertModalInfo(data) {
        $('div.modal-body').text(data.info);
        $('#delete-user').each(function () {
            $(this).attr("href", data.url);
        });
    }

</script>
