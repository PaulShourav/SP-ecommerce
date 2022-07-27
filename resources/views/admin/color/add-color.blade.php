@extends('admin.master')
@section('title', 'Admin-Color')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($editData))
                edit-color
            @else
                add-color
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
                        Edit Color
                    @else
                        Add Color
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('color.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View
                    Color</a>
                {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('color.update', $editData->id) : route('color.store') }}" method="POST">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Color Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name"
                                    value="{{ @$editData ? $editData->name : '' }}" placeholder="Enter Color name">
                                @error('name')
                                    <span class="tx-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Coler Code: <span class="tx-danger">*</span></label>
                                <div><input type="text" style="width: 200px ; height:30px" class="colorCodeJs"
                                        name="color_code" value="{{ @$editData ? $editData->color_code : '#ff0000' }}"></div>
                                @error('color_code')
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
@push('scripts')
    <script>
        $('.colorCodeJs').minicolors({
            position: 'bottom right',
            theme: 'default',
        });
    </script>
@endpush
