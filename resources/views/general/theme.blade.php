@extends('general_layout.index_general') @section('content')
<div class="row page-titles m-t-40" style="margin-bottom: 20vh">
    <div class="link-when-mobile text-center m-b-20 d-sm-none text-center" style="width: 100vw">
        <a target="_blank"
            href="{{ Route("username", "pinterus") }}">{{ Route("username", auth()->user()->username) }}</a>
    </div>
    <div class="col-sm col-md">
    <form class="form-horizontal form-material" method="POST" action="{{ Route('general.theme.update') }}">
        @csrf
        <div class="theme-section-free m-b-20">
        @foreach($themes as $key => $theme)
        <div class="form-check form-check-inline">
                <div class="" style="width: 70px;height:70px; border-radius:20px;
                background-image: linear-gradient(to bottom, {{ $theme->cover_colour }});margin:10px"></div>
                <input class="form-check-input" type="radio" name="theme_id" id="inlineRadio1{{ $theme->id }}" value="{{ $theme->id }}" 
                {{ $theme->id == $theme_id ? 'checked': '' }}
                >
                <label class="form-check-label" for="inlineRadio1{{ $theme->id }}">{{ $theme->name }}</label>
            </div>
        @endforeach
        </div>
        <button type="submit" class="btn btn-instagram m-t-5 m-b-10 text-white" style="width: 100%;"><i
            class="mdi mdi-content-save"></i> Simpan</button>
    </form>
    </div>
    <div class="col-sm col-md text-center d-none d-sm-block">
        <span>
            <a target="_blank"
                href="{{ Route("username", "pinterus") }}">{{ Route("username", auth()->user()->username) }}</a>
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
