@extends('admin.master')
@section('title', 'Admin-Banner')
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
                        Edit Banner
                    @else
                        Add Banner
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('banner.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View
                    banner</a>
                {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('banner.update', $editData->id) : route('banner.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="form-control-label">Banner Short Title: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="short_title" value="{{ @$editData->short_title }}"
                                    placeholder="Enter Short title.">
                                @error('short_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label>Banner Image: <span class="tx-danger">*</span></label>
                                        <input type="file" name="image" class="form-control-file" id="imageInfo"
                                            onchange="showPreview(event);">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <img src="{{ @$editData ? asset('uploads/banner-image/' . $editData->image) : asset('admin-assets/img/no-image.png') }}"
                                        alt="" id="showImage"
                                        style="width: 170px; height:180px; border:1px solid #000">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Banner Long Title: <span class="tx-danger">*</span></label>
                                <textarea class="form-control overflow-auto" id="summernote" name="long_title" rows="6">{{ @$editData ? $editData->long_title : '' }}</textarea>
                                @error('long_title')
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
