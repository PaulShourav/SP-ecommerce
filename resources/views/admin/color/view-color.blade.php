@extends('admin.master')
@section('title','Admin-color')
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
                    <a href="{{ route('color.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"
                            aria-hidden="true"></i> Add</a>

                    <a href="{{ @$trashData ? route('color.view') : route('color.recycle_bin') }}"
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
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Color Code</th>
                  <th class="wd-25p">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach (@$trashData?$trashData:@$viewData as $color)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                  <td>{{$color->name}}</td>
                  <td>{{$color->color_code}}</td>

                
                  <td>
                    <a href="{{ @$trashData ? route('color.restore',$color->id) : route('color.edit',$color->id) }}"
                      class="btn btn-warning btn-sm">
                      @if (@$trashData)
                          <i class="fa fa-pencil-square" aria-hidden="true"></i> Restore
                      @else
                          <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                      @endif
                  </a>

                  {{-- @if (App\Models\Product::where('color_id', $color->id)->count() < 1) --}}
                      <a href="{{ @$trashData ? route('color.delete', $color->id) : route('color.delete_trash',$color->id) }}"
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