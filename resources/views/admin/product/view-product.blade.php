@extends('admin.master')
@section('title', 'Admin-product')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($trashData))
                product/recycle_bin
            @else
               product/view
            @endif
        </span>
    </nav>
@endsection
@section('body')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mr-auto">
                @if (isset($trashData))
                    Recycle Bin
                @else
                    View Data
                @endif
            </h3>

            <div class="">
                <a href="{{ route('product.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"
                        aria-hidden="true"></i> Add</a>

                <a href="{{ @$trashData ? route('product.view') : route('product.recycle_bin') }}"
                    class="btn btn-outline-danger btn-sm">
                    @if (@$trashData)
                        <i class="fa fa-users " aria-hidden="true"></i> View
                    @else
                        <i class="fa fa-recycle" aria-hidden="true"></i> Recycle Bin
                    @endif
                </a>
            </div>

        </div>
        <div class="card-body">
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">Sl</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-15p">Cat Name</th>
                                <th class="wd-15p">SubCat Name</th>
                                <th class="wd-10p">Qty</th>
                                <th class="wd-12p">Regular Price</th>
                                <th class="wd-12p">Seller Price</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$trashData ? $trashData : @$viewData as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->subCategory->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->regular_price}}</td>
                                <td>{{$product->special_price}}</td>
                                <td> 
                                    <span class="badge badge-success">{{ $product->status == 1 ? 'Active' : 'Deactive' }}</span>
                                    @if ($product->status == 1 )
                                           <a href="{{route('product.deactive',$product->slug)}}" class="btn btn btn-outline-danger btn-sm"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                       @else
                                           <a href="{{route('product.active',$product->slug)}}" class="btn btn-outline-success btn-sm"><i class="fa fa-arrow-up" aria-hidden="true"></i> </a>
                                       @endif 
                                </td>

                                    <td>
                                        <a href="{{route('product.details',$product->slug)}}" class="btn btn-success btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{ @$trashData ? route('product.restore', $product->slug) : route('product.edit',$product->slug) }}"
                                            class="btn btn-warning btn-sm">
                                            @if (@$trashData)
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Restore
                                            @else
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            @endif
                                        </a>

                                        {{-- @if (App\Models\Product::where('product_id', $product->id)->count() < 1) --}}
                                        <a href="{{ @$trashData ? route('product.delete',$product->slug) : route('product.delete_trash',$product->slug) }}"
                                            class="btn btn-outline-danger btn-sm">
                                            @if (@$trashData)
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Delete
                                            @else
                                                <i class="fa fa-trash" aria-hidden="true"></i> trash
                                            @endif
                                        </a>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div>
    </div>
@endsection
@stack('datatable')
