@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">CREATE THEME</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Theme</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('alert-success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session('alert-error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('alert-error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form method="POST" action="{{ Route('admin.link.update', $link->id) }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" name="title" value="{{ $link->title }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="select-beast" name="type">
                                        <option value="email" {{ $link->type == 'email' ? 'selected' : ''}}>
                                            Email</option>
                                        <option value="youtube" {{ $link->type == 'youtube' ? 'selected' : ''}}>
                                            Youtube</option>
                                        <option value="whatsapp" {{ $link->type == 'whatsapp' ? 'selected' : ''}}>
                                            Whatsapp</option>
                                        <option value="other" {{ $link->type == 'other' ? 'selected' : ''}}>
                                            Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">User</label>
                                    <select class="select-beast" name="user_id">
                                        @foreach ($users as $user )
                                            <option value="{{ $user->id }}" {{ $link->user_id == $user->id ? 'selected' : ''}}>
                                            {{ $user->name }} - {{ '@'.$user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Url</label>
                                    <input type="text" name="url" value="{{ $link->url }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href='{{ Route('admin.product.index') }}'
                            class="btn btn-inverse text-white m-l-10">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection