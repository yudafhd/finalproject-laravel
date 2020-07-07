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
            <div class="profile-username">@pinterusmedia</div>
            <div class="profile-status">Situs media, software aplikasi</div>
            <div class="profile-user-menu">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <!-- <img
                            style="width: 2rem;"
                            class="float-left"
                            src="{{
                                asset(
                                    'assets/images/icon/social-media-1/svg/034-instagram.svg'
                                )
                            }}"
                        /> -->
                        Whatsapp
                    </li>
                    <li class="list-group-item">
                        Youtube
                    </li>
                    <li class="list-group-item">
                        Instagram
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
