<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
<script src="{{ asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script
    src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script src="{{ asset('assets/plugins/ludo-jquery-treetable/jquery.treetable.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/plugins/d3/d3.min.js')}}"></script>
<script src="{{ asset('assets/plugins/c3-master/c3.min.js')}}"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://selectize.github.io/selectize.js/js/selectize.js"></script>
<script src="{{ asset('assets/plugins/html5-editor/wysihtml5-0.3.0.js')}}"></script>
<script src="{{ asset('assets/plugins/html5-editor/bootstrap-wysihtml5.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
        var dateNow = new Date();
        $('#mdatepicker').bootstrapMaterialDatePicker({
            time: false,
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
        $('#userTable').DataTable();
        $('#searchTable').DataTable();
        $('.searchTable').DataTable();
        $('.textarea_editor').wysihtml5();
        $('.selectize_custom').selectize();
        new Chartist.Line('.ct-chart', {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            series: [
                [30, 10, 22, 8, 10, 8],
            ]
        }, {
            fullWidth: true,
        });
    });

    function insertModalInfo(data) {
        $('div.modal-body').text(data.info);
        $('#delete-user').each(function () {
            $(this).attr("href", data.url);
        });
    }
</script>