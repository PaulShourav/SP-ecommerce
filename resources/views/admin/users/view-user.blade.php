@extends('admin.master')
@section('title', 'Admin-user')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($unverifiedData))
                Unverified 
            @else
                Verified
            @endif
        </span>
    </nav>
@endsection
@section('body')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mr-auto">
                @if (isset($unverifiedData))
                Unverified User
            @else
                Verified User
            @endif
            </h3>

            <div class="">
                <a href="{{ route('user.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"
                        aria-hidden="true"></i> Add</a>

                <a href="{{ @$unverifiedData ? route('user.view_verified') : route('user.view_unverified') }}"
                    class="btn btn-outline-danger btn-sm">
                    @if (@$unverifiedData)
                        <i class="fa fa-users " aria-hidden="true"></i> Verified
                    @else
                        <i class="fa fa-recycle" aria-hidden="true"></i> Unverified
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
                                <th class="wd-15p">Mobile Number</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-20p">Status</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$unverifiedData ? $unverifiedData : @$verifiedData as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td> 
                                        <span class="badge badge-success">{{ $user->status == 1 ? 'Verified' : 'Unverified' }}</span> 
                                    </td>

                                    <td>
                                        <a href="{{ @$unverifiedData ? route('user.active', $user->id) : route('user.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm">
                                            @if (@$unverifiedData)
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i> Verified
                                            @else
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            @endif
                                        </a>

                                        {{-- @if (App\Models\Product::where('user_id', $user->id)->count() < 1) --}}
                                        <a href="{{ @$unverifiedData ? route('user.delete', $user->id) : route('user.deactive', $user->id) }}"
                                            class="btn btn-outline-danger btn-sm">
                                            @if (@$unverifiedData)
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Delete
                                            @else
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i> Unverified
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
