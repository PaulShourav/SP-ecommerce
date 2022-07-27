@extends('admin.master')
@section('title', 'Admin-Category')
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
                        Edit Category
                    @else
                        Add Category
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('category.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View
                    category</a>
                {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('category.update', $editData->id) : route('category.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="form-control-label">Category Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{ @$editData->name }}"
                                    placeholder="Enter cat name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label>Category Image: <span class="tx-danger">(Optoional)</span></label>
                                        <input type="file" name="image" class="form-control-file" id="imageInfo"
                                            onchange="showPreview(event);">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <img src="{{ @$editData ? asset('uploads/cat-image/' . $editData->image) : asset('admin-assets/img/no-image.png') }}"
                                        alt="" id="showImage"
                                        style="width: 170px; height:180px; border:1px solid #000">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description: <span class="tx-danger">(Optoional)</span></label>
                                <textarea class="form-control overflow-auto" id="summernote" name="description" rows="6">{{ @$editData ? $editData->description : '' }}</textarea>
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
