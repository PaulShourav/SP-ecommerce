@extends('admin.master')
@section('title', 'Admin-section')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($editData))
                section/edit
            @else
               section/add
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
                        Edit Section
                    @else
                        Add Section
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('section.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View
                    section</a>
                {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('section.update', $editData->id) : route('section.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-layout ">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="form-control-label">Section Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{ @$editData->name }}"
                                    placeholder="Enter section name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
        
                              
                                    <div class="form-group">
                                        <label>Category Name: <span class="tx-danger">*</span></label>
                                        <select class=" form-control" name="category_id" id="categoryId">
                                            <option selected value="{{ @$editData ? $editData->category_id : '' }}">
                                                {{ @$editData ? $editData->category->name : 'Choose One...' }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                

                            </div>

                        </div>
                        <div class="col-lg-6">
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
