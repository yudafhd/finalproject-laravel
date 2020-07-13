@extends('layout_general.index') 
@section('content')
<div class="row page-titles m-t-40">
    <div class="col-sm col-md text-center">
        <div class="wrapper-content">
            <div class="profile-image">
                <img
                    class="img-fluid rounded-circle"
                    src="{{ asset('assets/images/user.svg') }}"
                />
            </div>
            <div class="profile-username">{{ '@'.$username }}</div>
            <div class="profile-status">{{ $tweet }}</div>
            <div class="profile-user-menu">
                <ul class="list-group list-group-flush">
                    @foreach ($links as $link )
                    <li class="list-group-item">
                    @if($link->type == 'youtube')
                        <i id="youtube" class="mdi mdi-youtube-play"></i>
                    @else
                        <i id="youtube" class="mdi mdi-{{ $link->type }}"></i>
                    @endif 
                        @if ($link->type=='gmail')
                        <a href="{{ 'mailto://'.$link->url }}" class="text-white">
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
