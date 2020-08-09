@extends('general_layout.index_general') @section('content')
<div class="row page-titles m-t-40" style="margin-bottom: 20vh">
    <div class="link-when-mobile text-center m-b-20 d-sm-none text-center" style="width: 100vw">
        <a target="_blank"
            href="{{ Route("username", "pinterus") }}">{{ Route("username", auth()->user()->username) }}</a>
    </div>
    <div class="col-sm col-md">
        <form id="general-info" method="POST" action="{{ Route('general.save.links') }}" enctype="multipart/form-data">
            @csrf
            <section class="add-upload-photo d-flex">
                @if(auth()->user()->general->photo)
                <img src="{{ Url('storage/user/profile/'.auth()->user()->general->photo) }}" class="img-circle m-r-20 m-b-10"
                    width="70" />
                @else
                <img width="70" src="{{ asset('assets/images/user.svg') }}" class="m-r-20 m-b-10" />
                @endif
                <div class="d-flex align-items-center">
                    <input type="file" name="foto" lass="form-control-file" id="exampleFormControlFile1" />
                </div>
            </section>
            <section class="add-status">
                <div class="form-group d-flex align-items-center m-t-20">
                    <input type="text" placeholder="tulis tweet anda" class="form-control" name="tweet"
                        value="{{ $tweet }}" />
                </div>
            </section>
            <section class="add-link">
                <div id="linklist" class="link-list m-20 text-center">
                    <div id="first-your-link" class="m-b-20 row" style="display: none">
                        <div class="col-md input-group ">
                            <div class="input-group-prepend">
                                <button id="dropdown-type-button" class="btn btn-outline-secondary dropdown-toggle"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i id="email" class="mdi mdi-gmail"></i> Email</a>
                                    <a class="dropdown-item" href="#"><i id="youtube" class="mdi mdi-youtube-play"></i>
                                        Youtube</a>
                                    <a class="dropdown-item" href="#"><i id="whatsapp" class="mdi mdi-whatsapp"></i>
                                        Whatsapp</a>
                                    <a class="dropdown-item" href="#"><i id="other" class="mdi mdi-link"></i>
                                        Lainnya</a>
                                </div>
                            </div>
                            <input type="hidden" name="link_id[]" />
                            <input type="text" name="titles[]" class="form-control" placeholder="Judul"
                                aria-label="Tautan">
                            <input type="hidden" id="social-links" name="social_links[]" value="other">
                            <input type="text" name="links[]" class="form-control" placeholder="link atau email anda"
                                aria-label="Tautan">
                            <div class="input-group-append">
                                <span id="close-link" class="input-group-text"><i class="mdi mdi-close"></i></span>
                            </div>
                        </div>
                    </div>

                    {{-- THIS IS FOR DATA ONLY --}}
                    @foreach($links as $key => $link)
                    <div id="first-your-link-data{{ $key }}" class="m-b-20 row">
                        <div class="col-md input-group ">
                            <div class="input-group-prepend">
                                <button id="dropdown-type-button{{ $key }}"
                                    class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($link->type == 'youtube')
                                    <i id="youtube" class="mdi mdi-youtube-play"></i>
                                    @elseif($link->type == 'other')
                                    <i id="{{ $link->type }}" class="mdi mdi-link"></i>
                                    @else
                                    <i id="{{ $link->type }}" class="mdi mdi-{{ $link->type }}"></i>
                                    @endif
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">
                                        <i id="email" class="mdi mdi-gmail"></i>
                                        Email</a>
                                    <a class="dropdown-item" href="#">
                                        <i id="youtube" class="mdi mdi-youtube-play"></i>
                                        Youtube</a>
                                    <a class="dropdown-item" href="#">
                                        <i id="whatsapp" class="mdi mdi-whatsapp"></i>
                                        Whatsapp</a>
                                    <a class="dropdown-item" href="#">
                                        <i id="other" class="mdi mdi-link"></i>
                                        Lainnya</a>
                                </div>
                            </div>
                            <input type="hidden" name="link_id[]" value="{{ $link->id }}" />
                            <input type="text" name="titles[]" class="form-control" placeholder="Judul"
                                value="{{ $link->title }}" aria-label="Tautan">
                            <input type="text" id="social-links" name="social_links[]" style="display: none"
                                value="{{ $link->type }}" value="other">
                            <input type="text" name="links[]" class="form-control" placeholder="https://"
                                value="{{ $link->url }}" aria-label="Tautan">
                            <div class="input-group-append">
                                <span id="close-link-data{{ $key }}" class="input-group-text"><i
                                        class="mdi mdi-close"></i></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a id="add-btn-link" class="btn btn-instagram text-white" style="width: 100%;"><i
                        class="mdi mdi-plus"></i> Tautan</a>
                <button type="submit" class="btn btn-instagram m-t-5 m-b-10 text-white" style="width: 100%;"><i
                        class="mdi mdi-content-save"></i> Simpan</button>
            </section>
        </form>

    </div>
    <div class="col-sm col-md text-center d-none d-sm-block">
        <span>
            <a target="_blank"
                href="{{ Route("username", auth()->user()->username) }}">{{ Route("username", auth()->user()->username) }}</a>
        </span>
        <div class="mr-auto ml-auto m-t-20 rounded-top p-10" style="
            width: 25vw; 
            height:70vh; 
            color:#ffffff; 
            background-repeat: no-repeat;
            background-size: 25vw;
            background-image:url('{{ asset('assets/images/phonebg.png') }}');">
            <img width="70px" src="{{ asset('assets/images/user.svg') }}" style="margin-top: 10vh" />
            <p class="username-front m-t-10">
                {{ '@'.$user->username }}
            </p>
            <p class="tweet m-b-0" style="padding:0 30px 0 30px;font-size:12px;word-wrap: break-all;">
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

        @if ($message)
            Swal.fire({
                icon: 'info',
                title: 'Error',
                html: '<div style="font-size: 16px;line-height: 25px;">{!! $message !!}</div>',
            });
        @endif

        let linktotal = {{ count($links) + 1
    }};
    $("#general-info").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Tunggu',
            text: 'Sedang memperbarui data kamu.',
            footer: '<a href="{{ Route('general') }}">tekan ini jika macet</a>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });
        setTimeout(function () { $('#general-info').off('submit').submit(); }, 0);
    });

    @foreach($links as $key => $link)
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
        if (linktotal <= 7) {
            linktotal = linktotal + 1;

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
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Batas maximal link adalah 7',
                text: 'Mohon maaf ya, server mimin masih kecil jadi belum bisa kasih banyak, tapi mimin janji bakal berkembang lagi :)',
            });
        }
    });
    });

</script>

@endsection