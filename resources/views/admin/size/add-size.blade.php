@extends('admin.master')
@section('title', 'Admin-size')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($editData))
                edit-size
            @else
                add-size
            @endif
        </span>
    </nav>
@endsection
@section('body')
    <div class="card">
        <div class="card-header  d-flex justify-content-between">
            <div>
                <h3>
                    @if (isset($editData))
                        Edit size
                    @else
                        Add size
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('size.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View
                    size</a>
                {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('size.update', $editData->id) : route('size.store') }}" method="POST">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Size Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name"
                                    value="{{ @$editData ? $editData->name : '' }}" placeholder="Enter size name">
                                @error('name')
                                    <span class="tx-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                </div><!-- row -->
                <div class="form-layout-footer">
                    <button type='submit' class="btn btn-primary mg-r-5">{{ @$editData ? 'Update' : 'Submit' }}</button>

                </div><!-- form-layout-footer -->
            </form>

        </div>
    </div>
@endsection
