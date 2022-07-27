@extends('admin.master')
@section('title', 'Admin-product')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin') }}">Starlight</a>
        <span class="breadcrumb-item active">
            @if (isset($editData))
                edit-product
            @else
                add-product
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
                    Edit Product
                @else
                    Add Product
                @endif
            </h3>
        </div>

        <div class="">
            <a href="{{ route('product.view') }}" class="btn btn-warning btn-sm"><i class="fa fa-users"
                    aria-hidden="true"></i> View
                Product</a>
            {{-- <a href="" class="btn btn-warning btn-sm">Recycle bin</a> --}}
        </div>

    </div>
    <div class="card-body">
        <form action="{{ @$editData ? route('product.update', $editData->id) : route('product.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-layout">
                <div class="row ">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Product Name: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ @$editData->name }}"
                                placeholder="Enter Product name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>SubCategory Name: <span class="tx-danger">*</span></label>
                            <select class=" form-control" name="subCategory_id" id="subCategoryId">
                                <option selected value="{{ @$editData ? $editData->subCategory_id : '' }}">
                                    {{ @$editData ? $editData->subCategory->name : 'Choose One...' }}</option>
                                @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}">
                                        {{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subCategory_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">

                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-control-label">Tag Title: <span
                                        class="tx-danger">(Optional)</span></label>
                                <input class="form-control" type="text" name="tag_title"
                                    value="{{ @$editData ? $editData->tag_title : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-control-label">Quantity: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="quantity"
                                    value="{{ @$editData ? $editData->quantity : '' }}"
                                    placeholder="Enter Product name">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-control-label">Regular Price: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="regular_price"
                                    value="{{ @$editData ? $editData->regular_price : '' }}"
                                    placeholder="Enter Regular Price">
                                @error('regular_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-control-label">Speacial Price: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="special_price"
                                    value="{{ @$editData ? $editData->special_price : '' }}"
                                    placeholder="Enter Seller Prce">
                                @error('special_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row "> <!-- row -->                      
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Product Image: <span class="tx-danger">*</span></label>
                            <input type="file" class="form-control-file" name="image" id="imageInfo"
                                onchange="showPreview(event);">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mt-3">
                                <img src="{{ @$editData ? asset('uploads/product-image/' . $editData->image) : asset('admin-assets/img/no-image.png') }}"
                                    alt="" id="showImage" style="width: 170px; height:180px; border:1px solid #000">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Sub Images: <span class="tx-danger">*</span></label>
                            <input type="file" class="form-control-file" name="sub_image[]" multiple>
                            @error('sub_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mt-3">
                                @if (!empty(@$subImages))
                                    @foreach (@$subImages as $subImage)
                                        <img src="{{ @$subImage ? asset('uploads/product-image/sub-image/' . $subImage->sub_image) : asset('admin-assets/img/no-image.png') }}"
                                            alt="" id="showImage"
                                            style="width: 85px; height:90px; border:1px solid #000">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="from-group">
                            <label>Colors: <span class="tx-danger">(Optional)</span></label>
                            <select class="form-control select2" name="color_id[]" data-placeholder="Choose Colors"
                                multiple>
                                @foreach ($colors as $color)
                                <option value="{{ $color->id }}"
                                   @if ( !empty(@$colorArray) && @in_array(['color_id' => $color->id],$colorArray))
                                   @selected(true)
                                   @else
                                   @selected(false)  
                                   @endif>
                                    {{-- {{ @in_array(['color_id' => $color->id],$colorArray) ? 'selected' : '' }}> --}}
                                    {{ $color->name }}</option>
                            @endforeach
                            </select>
                        </div>


                        <div class="from-group mt-3">
                            <label>Sizes: <span class="tx-danger">(Optional)</span></label>
                            <select class="form-control select2" name="size_id[]" data-placeholder="Choose Sizes"
                                multiple>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}"
                                        @if ( !empty(@$sizeArray) &&@in_array(['size_id' => $size->id],$sizeArray) )
                                        @selected(true)
                                        @else
                                        @selected(false)  
                                        @endif>
                                        {{-- {{ @in_array(['size_id' => $size->id],$sizeArray) ? 'selected' : '' }}> --}}
                                        {{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row ">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Description: <span class="tx-danger">*</span></label></label>
                            <textarea class="form-control summernote"  name="description" style="resize: none;" rows="6">{{@$editData?$editData->description:''}}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Additional Info: <span class="tx-danger">(Optional)</span></label></label>
                            <textarea class="form-control summernote" name="additional_info" style="resize: none;" rows="6"></textarea>
                        </div>
                    </div>
                </div><!-- row -->
                <div class="form-layout-footer">
                    <button class="btn btn-primary mg-r-5">{{ @$editData ? 'Update' : 'Submit' }}</button>

                </div><!-- form-layout-footer -->
        </form>

    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function() {

        'use strict';

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });

        // Select2 by showing the search
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });

        // Select2 with tagging support
        $('.select2-tag').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
    $(document).on('change', '#categoryId', function() {
        var categoryId = $(this).val();
        $.ajax({
            url: 'http://127.0.0.1:8000/product/get-category-id-by-category-id/' + categoryId,
            method: 'GET',
            dataType: 'JSON',
            data: {},

            success: function(res) {
                var option = '';
                option += '<option selected>Choose...</option>';
                $.each(res, function(key, value) {
                    option += '<option value="' + value.id + '">' + value
                        .name + '</option>';
                })
                $('#subCategoryId').empty().append(option);
            },
            error: function(e) {
                console.log(e);
            }
        })
    });
    imageInfo.onchange = evt => {
        const [file] = imageInfo.files
        if (file) {
            showImage.src = URL.createObjectURL(file)
        };

    }
    $(function() {
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('.summernote').summernote({
            height: 150,
            tooltip: false,
            disableResize: true, // Does not work
            disableResizeEditor: true, // Does not work either
            resize: false
        })
    });
</script>
@endpush
