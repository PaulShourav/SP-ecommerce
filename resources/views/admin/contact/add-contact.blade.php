@extends('admin.master')
@section('title', 'Admin-contact')
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
    <div class="card">
        <div class="card-header  d-flex justify-content-between">
            <div>
                <h3>
                    @if (isset($editData))
                        Edit contact
                    @else
                        Add contact
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('contact.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View
                    Contact</a>
                {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('contact.update', $editData->id) : route('contact.store') }}"
                method="POST" >
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                                <textarea class="form-control overflow-auto"  name="address"  rows="4" style="resize: none" placeholder="Enter address">{{ @$editData->address }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="mobile_number" value="{{ @$editData->mobile_number }}"
                                    placeholder="Enter mobile number">
                                @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email" value="{{ @$editData->email }}"
                                    placeholder="Enter email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Facebook Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="link" name="facebook" value="{{ @$editData->facebook }}"
                                    placeholder="Enter facebook link">
                                @error('facebook')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Instagram Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="link" name="instagram" value="{{ @$editData->instagram }}"
                                    placeholder="Enter instagram link">
                                @error('instagram')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Twitter Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="link" name="twitter" value="{{ @$editData->twitter }}"
                                    placeholder="Enter twitter link">
                                @error('twitter')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div><!-- row -->

                <div class="form-layout-footer">
                    <button type="submit" class="btn btn-primary mg-r-5">{{ @$editData ? 'Update' : 'Submit' }}</button>

                </div><!-- form-layout-footer -->
            </form>

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
        $(function() {
            'use strict';

            // Inline editor
            var editor = new MediumEditor('.editable');

            // Summernote editor
            $('#summernote').summernote({
                height: 150,
                tooltip: false,
                disableResize: true, // Does not work
                disableResizeEditor: true, // Does not work either
                resize: false
            })
        });
    </script>
@endpush
