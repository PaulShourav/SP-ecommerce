@extends('admin.master')
@section('title','Admin-Product details')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active"> product-deatils </span>
    </nav>
@endsection
@section('body')
    <section class="container">
        <div class="card">
            <div class="card-header d-flex ">

                <h3 class="mr-auto">
                    Product Details
                </h3>

                <div class="">
                    <a href="{{ route('product.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"
                            aria-hidden="true"></i> Add</a>

                    <a href="{{ route('product.view') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-users "
                            aria-hidden="true"></i> View </a>
                </div>

            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="table table-light">
                        <tbody class=" table-light">
                            <tr>
                                <td width='30%' class="font-weight-bold">Product Name</td>
                                <td width='70%'>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Image</td>
                                <td width='70%'>
                                    <img src="{{ asset('uploads/product-image/' . $product->image) }}"
                                        style="height: 50px; width:50px" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Sub Image</td>
                                <td width='70%'>
                                    @foreach ($subImages as $subImage)
                                        <img src="{{ asset('uploads/product-image/sub-image/'.$subImage->sub_image) }}"
                                            style="height: 50px; width:50px" alt="">
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Category Name</td>
                                <td width='70%'>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">SubCat Name</td>
                                <td width='70%'>{{ $product->subCategory->name }}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Quantity</td>
                                <td width='70%'>{{ $product->quantity }}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Regular Price</td>
                                <td width='70%'>{{ $product->regular_price }}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Seller Price</td>
                                <td width='70%'>{{ $product->seller_price }}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Colors</td>
                                <td width='70%'>
                                    @foreach ($colors as $color)
                                        {{ $color->color->name }},
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Sizes</td>
                                <td width='70%'>
                                    @foreach ($sizes as $size)
                                        {{ $size->size->name }},
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Description</td>
                                <td width='70%'>{!! $product->description !!}</td>
                            </tr>
                            <tr>
                                <td width='30%' class="font-weight-bold">Additional Info</td>
                                <td width='70%'>{{ $product->additional_info }}</td>
                            </tr>
                            <tr>
                                <td width='40%'></td>
                                <td width='60%' class="text-right"> <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary " ><i class="fa fa-pencil-square" aria-hidden="true"></i>  Edit Product</a></td>
                                
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
