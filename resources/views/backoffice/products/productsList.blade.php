@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">PRODUCT</h3>
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
    <div class="col-12">
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
                <span>
                    Total Products 
                    <span class="label label-success label-rounded">{{count($products)}}</span>
                </span>
                <a href="{{Route('admin.product.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    create
                </a>
                @if(count($products) > 0)
                <div class="table-responsive m-t-10">
                    <table id="searchTable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->SKU }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{!! $product->description !!}</td>
                                <td>{{ number_format($product->price,2,',','.') }}</td>
                                <td>{{ $product->type }}</td>
                                <td>{{ $product->status }}</td>
                                <td style="text-align: center">
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{Route('admin.product.edit', $product->id)}}">Update</a>
                                                <form method="POST" action="{{Route('admin.product.destroy', $product->id)}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn"> Delete </button>
                                                </form>
                                                
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="table-responsive m-t-10">
                    belum ada
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
