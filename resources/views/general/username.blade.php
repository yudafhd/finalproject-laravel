@extends('general_layout.index')
@section('content')
<div class="row page-titles m-t-40">
    <div class="col-sm col-md text-center">
        <div class="wrapper-content">
            <div class="main" style="display: flex;width: 380px; margin-left: auto;margin-right: auto;">
                <div class="profile-image-section">
                    @if($photo)
                    <img class="img-fluid rounded-circle photo-section"
                        src="{{ Url('storage/user/profile/'. $photo) }}" />
                    @else
                    <img class="img-fluid rounded-circle photo-section" src="{{ asset('assets/images/user.svg') }}" />
                    @endif
                </div>
                <div class="information-section">
                    <div class="profile-username">{{ '@'.$username }}</div>
                    <div class="profile-status">{{ $tweet }}</div>
                </div>
            </div>


            <div class="profile-user-menu">
                <ul class="list-group list-group-flush">
                    @foreach ($links as $link )
                    <li class="list-group-item">
                        @if($link->type == 'youtube')
                        <i id="youtube" class="mdi mdi-youtube-play"></i>
                        @else
                        <i id="youtube" class="mdi mdi-{{ $link->type }}"></i>
                        @endif
                        @if ($link->type=='email')
                        <a href="{{ 'mailto:'.$link->url }}" class="text-white">
                            {{ $link->title }}
                        </a>
                        @else
                        <a href="{{ $link->url }}" class="text-white">
                            {{ $link->title }}
                        </a>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection