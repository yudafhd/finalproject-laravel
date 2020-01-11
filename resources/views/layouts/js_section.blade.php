<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3-master/c3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard1.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('assets/plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-print/jQuery.print.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#myTable').DataTable();
        $('.textarea_editor').wysihtml5();
        $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false }).on('change', function(e, date) {
            $('#result_booking').append( "<p>LOADING...</p>" );
$.get( " http://localhost:8000/api/listbooking/"+date.format('YYYY-MM-DD'), function( data ) {
    $('#result_booking').html('');
    $('#result_booking').append(`Ada <strong>${data.length}</strong> booking tanggal ini <br /><br />`)
    data.forEach(function(item){
        console.log(item)
        $('#result_booking').append( `<p>Tanggal Booking: ${item.booking_date}, Jam Mulai:  ${item.start_time_at}, Customer: ${item.customer.id_customer} - ${item.customer.name}</p>` );
    })
    
});
        });
        $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
        $(".select2").select2();
        $('.printMe').click(function(){
        $("#outPrint").print({
            noPrintSelector :".no-print"
        });
        });
        });
</script>