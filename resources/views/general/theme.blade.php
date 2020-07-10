@extends('layout_general.index_general') @section('content')
<div class="row page-titles m-t-40" style="margin-bottom: 20vh">
    <div class="link-when-mobile text-center m-b-20 d-sm-none text-center" style="width: 100vw">
        <a target="_blank"
            href="{{ Route("username", "pinterus") }}">{{ Route("username", "pinterus") }}</a>
    </div>
    <div class="col-sm col-md">
        Tema
    </div>
    <div class="col-sm col-md text-center d-none d-sm-block">
        <span>
            <a target="_blank"
                href="{{ Route("username", "pinterus") }}">{{ Route("username", "pinterus") }}</a>
        </span>
        <div class=" mr-auto ml-auto m-t-20 rounded-top p-10" 
            style="width: 25vw; height:70vh; color:#ffffff; 
            background-repeat: no-repeat;
            background-size: 25vw;
            background-image:url('{{ asset('assets/images/phonebg.png') }}');">
             <img width="70px" src="{{ asset('assets/images/user.svg') }}"  style="margin-top: 10vh" />
            <p class="username-front m-t-10">
                {{ '@'.$user->username }}               
            </p>
            <p class="tweet m-b-0" style="font-size:12px">
                {{ $tweet }}
            </p>
            <ul class="list-group list-group-flush" style="padding: 50px; padding-top:0px">
                @foreach($links as $link)
                    <li class="list-group-item p-15" style="
                    background:none;
                    font-size:12px">
                        @if($link->type == 'youtube')
                            <i id="youtube" class="mdi mdi-youtube-play"></i>
                        @else
                            <i id="youtube" class="mdi mdi-{{ $link->type }}"></i>
                        @endif
                        <a class="text-white">
                            {{ $link->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        @if($message) 
        Swal.fire({
            icon: 'info',
            title: 'Error',
            text: '{{ $message }}',
        });
        @endif

        let linktotal = {{ count($links) + 1 }};
        $("#general-info").submit(function(e){
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Tunggu',
            text: 'Sedang memperbarui data kamu.',
            footer: '<a href="{{ Route('general') }}">tekan ini jika macet</a>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey:false,
            allowEnterKey: false,
        });
        setTimeout(function() { $('#general-info').off('submit').submit();}, 3000);
        });

        @foreach($links as $key => $link )
            $('#close-link-data{{ $key }}').on('click', function () {
                $('#first-your-link-data{{ $key }}').remove();
            });

        $('#first-your-link-data{{ $key }}').find('.dropdown-item').each(function (index) {
                $(this).on("click", function () {
                    const element = '<i class="' + $(this).find('i').attr('class') +
                        '"></i>';
                    $(document).find("#dropdown-type-button{{ $key }}").html(element);
                    $(document).find('#first-your-link-data{{ $key }}').find('#social-links').val($(
                        this).find('i').attr('id'));
                })
            });
            @endforeach

        $("#add-btn-link").click(function () {
            console.log(linktotal);
            if(linktotal <= 5 ) {
                console.log('inside', linktotal);
            linktotal = linktotal+1;

            // defining DOM
            const el = $("#first-your-link").clone().css('display', 'block');
            // insert clone element
            $('#linklist').append(el);
            // delete element
            el.find('#close-link').on("click", function () {
                el.remove();
            });

            //each dropdown click
            el.find('.dropdown-item').each(function (index) {
                $(this).on("click", function () {
                    const element = '<i class="' + $(this).find('i').attr('class') +
                        '"></i>';
                    el.find("#dropdown-type-button").html(element);
                    el.find('#social-links').val($(this).find('i').attr('id'));
                })
            })
            }else{
                Swal.fire({
            icon: 'info',
            title: 'Batas maximal link adalah 5',
            text: 'Mohon maaf ya, server mimin masih kecil jadi belum bisa kasih banyak, tapi mimin janji bakal berkembang lagi :)',
        });
            }
        });
    });

</script>

@endsection
