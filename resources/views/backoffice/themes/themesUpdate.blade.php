@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">UPDATE THEME</h3>
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
                <form method="POST" action="{{ Route('admin.theme.update', $theme->id) }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" value="{{ $theme->name }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" name="code" value="{{ $theme->code }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Cover Colour</label>
                                    <input type="text" name="cover_colour" value="{{ $theme->cover_colour }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                              <div class="form-group">
                                <label class="col-md-12">Cover Thumbnail</label>
                                <div class="col-md-12">
                                    <input type="file" name="cover_thumbnail"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="select-beast" name="theme_transaction" >
                                        <option value="free" {{ $theme->theme_transaction == 'free' ? 'selected' : ''}}>free</option>
                                        <option value="pay" {{ $theme->theme_transaction == 'pay' ? 'selected' : ''}}>pay</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select  class="select-beast" name="status">
                                        <option value="1" {{ $theme->status == 'active' ? 'selected' : '' }}>active</option>
                                        <option value="0" {{ $theme->status == 'disabled' ? 'selected' : '' }}>disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href='{{ Route('admin.theme.index') }}'
                            class="btn btn-inverse text-white m-l-10">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection