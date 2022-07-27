@extends('admin.master')
@section('title', 'Admin-user')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($editData))
                Edit
            @else
                Add
            @endif
        </span>
    </nav>
@endsection
@section('body')
    <div class="row justify-content-center">
        <div class="col-lg-8 ">
            <div class="card">
                <div class="card-header  d-flex justify-content-between">
                    <div>
                        <h3>
                            @if (isset($editData))
                                Edit User
                            @else
                                Add User
                            @endif
                        </h3>
                    </div>

                    <div class="">
                        <a href="{{ route('user.view_verified') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                                aria-hidden="true"></i> View
                            user</a>
                        {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ @$editData ? route('user.update', $editData->id) : route('user.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout">
                            <div class="img">
                                <img src="{{ @$editData ? asset('uploads/user-image/' . $editData->image) : asset('admin-assets/img/no-image.png') }}"
                                    alt="" id="showImage" style="width: 120px; height:120px; border:1px solid #000">
                            </div>
                            <div class="row  mg-b-15">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Profile: <span class="tx-danger">(Optoional)</span></label>
                                        <input type="file" name="image" class="form-control-file" id="imageInfo"
                                            onchange="showPreview(event);">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ @$editData->name }}" placeholder="Enter User Name.">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->
                        <div class="row mg-b-15">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-control-label">Mobile Number: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="mobile_number"
                                        value="{{ @$editData->mobile_number }}" placeholder="Enter Mobile number.">
                                    @error('mobile_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label class="form-control-label">user Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ @$editData->email }}" placeholder="Enter your Email.">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row  mg-b-15">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Street Adddress: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="street_address"
                                        value="{{ @$editData->street_address }}" placeholder="Enter street address.">
                                    @error('street_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">District: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="district"
                                        value="{{ @$editData->district }}" placeholder="Enter district.">
                                    @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Police Station: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="police_station"
                                        value="{{ @$editData->police_station }}" placeholder="Enter cat name">
                                    @error('police_station')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                    <input class="form-control" {{ @$editData ? 'disabled' : '' }} type="password"
                                        name="password" placeholder="Enter password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                                    <input class="form-control" {{ @$editData ? 'disabled' : '' }} type="password"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-layout-footer">
                            <button type="submit"
                                class="btn btn-primary mg-r-5">{{ @$editData ? 'Update' : 'Submit' }}</button>

                        </div><!-- form-layout-footer -->
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        imageInfo.onchange = evt => {
            const [file] = imageInfo.files
            if (file) {
                showImage.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
