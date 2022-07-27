@extends('admin.master')
@section('title', 'Admin-orders')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($pendinData))
                Pending Orders
            @else
                Approved Orders
            @endif
        </span>
    </nav>
@endsection
@section('body')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mr-auto">
                @if (isset($pendinData))
                Pending Orders
            @else
                Approved Orders
            @endif
            </h3>

            <div class="">
                <a href="{{ @$pendingData ? route('orders.approved_list'):route('orders.pending_list')}}"
                    class="btn btn-outline-danger btn-sm">
                    @if (@$pendingData)
                        <i class="fa fa-users " aria-hidden="true"></i> Approved List
                    @else
                        <i class="fa fa-recycle" aria-hidden="true"></i>  Pending List
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
                                <th class="wd-15p">Order No</th>
                                <th class="wd-15p">Method</th>
                                <th class="wd-15p">Total</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$pendingData ? $pendingData : @$approvedData as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                <td>{{$order->order_no}}</td>
                                <td>{{$order->payment->payment_method}}</td>
                                <td>{{$order->order_total}}</td>
                                <td> 
                                    <span class="badge badge-success">{{ $order->status == 0 ? 'Pending' : 'Approved' }}</span>
                                </td>

                                    <td>

                                        <a href="{{ @$pendingData ? route('orders.approve', $order->id) : route('orders.details', $order->id) }}"
                                            class="btn btn-warning btn-sm">
                                            @if (@$pendingData)
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Approve
                                            @else
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Details
                                            @endif
                                        </a>

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
