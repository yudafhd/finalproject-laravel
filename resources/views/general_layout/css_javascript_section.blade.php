<!-- SECTION FOR CSS  -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
    rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="{{ asset('assets/plugins/floating-wpp/css/floating-wpp.min.css') }}" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" />
<link href="{{ asset('assets/css/colors/default.css') }}" id="theme" rel="stylesheet" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/custom.general.style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/theme') }}/{{ auth()->user() ? auth()->user()->general->theme->code : 'default' }}.css" rel="stylesheet" />

<!-- SECTION FOR JAVASCRIPT  -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
    integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENTKEY') }}"></script>
<script src="{{ asset('assets/plugins/floating-wpp/js/floating-wpp.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- SECTION FOR JAVASCRIPT CUSTOM  -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#lightSlider").lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            auto: true,
            speed: 300, //ms'
            slideMargin: 0,
            thumbItem: 9
        });
        $('#float-wa').floatingWhatsApp({
            phone: '6281357778874',
            popupMessage: 'Halo kak ^_^ ada yg bisa saya bantu?',
            showPopup: true,
            message: "Halo, saya dari Pinter.link",
            showPopup: true,
            showOnIE: false,
            position: 'right'
        });
        $('.dropdown-menu li a').on('click', function () {
            $('.dropdown-menu').scrollTop(0);
        })
    });
</script>