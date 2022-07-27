@extends('admin.master')
@section('title','Admin SubCat')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">@if (isset($editData))
            edit
        @else
            add
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
                        Edit SubCat
                    @else
                        Add SubCat
                    @endif
                </h3>
            </div>

            <div class="">
                <a href="{{ route('subCategory.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                        aria-hidden="true"></i> View All</a>
            </div>

        </div>
        <div class="card-body">
            <form action="{{ @$editData ? route('subCategory.update', $editData->id) : route('subCategory.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">
                            <div class="row">                              
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Category Name: <span class="tx-danger">*</span></label>
                                        <select class=" form-control" name="category_id" >
                                          <option  value="{{@$editData?$editData->category_id:''}}">{{@$editData?$editData->category->name:"Choose one..."}}</option>
                                          @foreach ($categories as $category)
                                              <option value="{{$category->id}}">{{$category->name}}</option>
                                          @endforeach
                                          
                                        </select>
                                        @error('category_id')
                                        <span class="tx-danger">{{ $message }}</span>
                                    @enderror
                                      </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">SubCat Name: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{@$editData->name}}" placeholder="Enter SubCat Name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label>Image: <span class="tx-danger">(Optional)</span></label>
                                        <input type="file" name="image"  class="form-control-file" id="imageInfo"
                                            onchange="showPreview(event);">
    
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <img src="{{ @$editData ? asset('uploads/subCat-image/'.$editData->image) : asset('admin-assets/img/no-image.png') }}" alt="" id="showImage"
                                        style="width: 170px; height:180px; border:1px solid #000">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description: <span class="tx-danger">(Optional)</span></label>
                                <textarea class="form-control overflow-auto" id='summernote' style='resize:none;' name="description" rows="6"></textarea>
                            </div>
                        </div>
                    </div><!-- row -->
                </div>

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
