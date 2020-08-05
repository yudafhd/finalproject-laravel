@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">CREATE PRODUCT</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Product</li>
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
                <form method="POST" action="{{ Route('admin.product.store') }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">SKU</label>
                                    <input type="text" name="SKU" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" name="code" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="select-beast" name="type" >
                                        <option value="subscription" {{ old('type') == 'day' ? 'selected' : ''}}>subscription</option>
                                        <option value="theme" {{ old('type') == 'month' ? 'selected' : ''}}>theme</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Theme</label>
                                    <select class="select-beast" name="theme_id">
                                    <option value="0">No theme</option>
                                    @foreach ( $themes as $theme )
                                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select  class="select-beast" name="status">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>active</option>
                                        <option value="disabled" {{ old('status') == 'disabled' ? 'selected' : '' }}>disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Period number</label>
                                    <input type="number" name="subscription_period_number" value="{{  old('subscription_period_number') }}"  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Periode date</label>
                                    <select  class="select-beast" name="subscription_period_date">
                                        <option value="day" {{ old('subscription_period_date') == 'day' ? 'selected' : '' }}>Day</option>
                                        <option value="month"  {{ old('subscription_period_date') == 'month' ? 'selected' : '' }}>Month</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <textarea class="textarea_editor" name="description" class="form-control"
                                        style="width: 100%; height: 500px"
                                        placeholder="Enter description ...">
                                        {{ 
                                             old('description')
                                         }}</textarea>
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