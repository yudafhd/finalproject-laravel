@extends('layout_general.index_general') @section('content')
<div class="row page-titles m-t-40" style="margin-bottom: 20vh">
    <div class="link-when-mobile text-center m-b-20 d-sm-none text-center" style="width: 100vw">
        <a target="_blank"
            href="{{ Route("username", "pinterus") }}">{{ Route("username", "pinterus") }}</a>
    </div>
    <div class="col-sm col-md">
        <div class="theme-section-free m-b-20">
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #46A6E2 0%, #46A6E2 40%, #D267C4 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" 
                {{ !$theme_id ? 'checked': '' }}
                >
                <label class="form-check-label" for="inlineRadio1">default</label>
            </div>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #FDE13F 0%, #FDE13F 40%, #FA818C 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                <label class="form-check-label" for="inlineRadio2">default 2</label>
            </div>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #2EED8F 0%, #2EED8F 40%, #447CBD 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option1">
                <label class="form-check-label" for="inlineRadio3">default 3</label>
            </div>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #AFA7CD 0%, #AFA7CD 40%, #D854C4 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option1">
                <label class="form-check-label" for="inlineRadio4">default 4</label>
            </div>
        </div>
        <div class="theme-section-free m-b-20">
            <p style="font-size: 14px; text-align:center">
                Gunakan tema ini secara gratis dengan menjadi<br> member donasi kak :)
            </p>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #46A6E2 0%, #46A6E2 40%, #D267C4 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" 
                >
                <label class="form-check-label" for="inlineRadio1">default</label>
            </div>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #FDE13F 0%, #FDE13F 40%, #FA818C 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                <label class="form-check-label" for="inlineRadio2">default 2</label>
            </div>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #2EED8F 0%, #2EED8F 40%, #447CBD 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option1">
                <label class="form-check-label" for="inlineRadio3">default 3</label>
            </div>
            <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, #AFA7CD 0%, #AFA7CD 40%, #D854C4 100%);margin:10px"></div>
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option1">
                <label class="form-check-label" for="inlineRadio4">default 4</label>
            </div>
        </div>
        <button type="submit" class="btn btn-instagram m-t-5 m-b-10 text-white" style="width: 100%;"><i
            class="mdi mdi-content-save"></i> Simpan</button>
    </div>
    <div class="col-sm col-md text-center d-none d-sm-block">
        <span>
            <a target="_blank"
                href="{{ Route("username", "pinterus") }}">{{ Route("username", "pinterus") }}</a>
        </span>
        <div class=" mr-auto ml-auto m-t-20 rounded-top p-10" style="width: 25vw; height:70vh; color:#ffffff; 
            background-repeat: no-repeat;
            background-size: 25vw;
            background-image:url('{{ asset('assets/images/phonebg.png') }}');">
            <img width="70px" src="{{ asset('assets/images/user.svg') }}"
                style="margin-top: 10vh" />
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
    $(document).ready(function () {});

</script>

@endsection
