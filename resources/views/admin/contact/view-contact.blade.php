@extends('admin.master')
@section('title', 'Admin-Contact')
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
                <a href="{{ route('contact.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"
                        aria-hidden="true"></i> Add</a>

                <a href="{{ @$trashData ? route('contact.view') : route('contact.recycle_bin') }}"
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
                                <th class="wd-15p">Address</th>
                                <th class="wd-15p">Mobile Number</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-20p">Facebook</th>
                                <th class="wd-20p">Instagram</th>
                                <th class="wd-20p">Twitter</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$trashData ? $trashData : @$viewData as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->mobile_number }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->facebook }}</td>
                                    <td>{{ $contact->instagram }}</td>
                                    <td>{{ $contact->twitter }}</td>

                                    <td>
                                        <a href="{{ @$trashData ? route('contact.restore', $contact->id) : route('contact.edit', $contact->id) }}"
                                            class="btn btn-warning btn-sm">
                                            @if (@$trashData)
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Restore
                                            @else
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            @endif
                                        </a>

                                        {{-- @if (App\Models\Product::where('contact_id', $contact->id)->count() < 1) --}}
                                        <a href="{{ @$trashData ? route('contact.delete', $contact->id) : route('contact.delete_trash', $contact->id) }}"
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
