@extends('admin.master')
@section('title', 'Admin-Banner')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($trashData))
                Recycle Bin
            @else
                View Data
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
                <a href="{{ route('banner.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"
                        aria-hidden="true"></i> Add</a>

                <a href="{{ @$trashData ? route('banner.view') : route('banner.recycle_bin') }}"
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
                                <th class="wd-12p">Short Title</th>
                                <th class="wd-25p">Long Title</th>
                                <th class="wd-20p">Image</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$trashData ? $trashData : @$viewData as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $banner->short_title }}</td>
                                    <td>{!!$banner->long_title !!}</td>
                                    <td>
                                        <img src="{{ asset('uploads/banner-image/' . $banner->image) ?? asset('admin-assets/img/no-image.png') }}"
                                            style="height: 100px; width:200px" alt="">
                                    </td>
                                    <td> 
                                        <span class="badge badge-success">{{ $banner->status == 1 ? 'Active' : 'Deactive' }}</span>
                                        @if ($banner->status == 1 )
                                               <a href="{{route('banner.deactive',$banner->id)}}" class="btn btn btn-outline-danger btn-sm"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                           @else
                                               <a href="{{route('banner.active',$banner->id)}}" class="btn btn-outline-success btn-sm"><i class="fa fa-arrow-up" aria-hidden="true"></i> </a>
                                           @endif 
                                    </td>
                                  

                                    <td>
                                        <a href="{{ @$trashData ? route('banner.restore', $banner->id) : route('banner.edit', $banner->id) }}"
                                            class="btn btn-warning btn-sm">
                                            @if (@$trashData)
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Restore
                                            @else
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            @endif
                                        </a>

                                        {{-- @if (App\Models\Product::where('banner_id', $banner->id)->count() < 1) --}}
                                        <a href="{{ @$trashData ? route('banner.delete', $banner->id) : route('banner.delete_trash', $banner->id) }}"
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
