
@extends('admin.master')
@section('title', 'Profile')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">
            profile
        </span>
    </nav>
@endsection
@section('body')
    <div class="row justify-content-center">
        <div class="col-lg-6 ">
            <div class="card">
                <div class="card-header text-center">
                    <div class="image">
                        <img src="{{@$profile->image==null?asset('admin-assets/img/usericon8.png'):asset('uploads/user-image/'.@Auth::user()->image)}}" 
                        style=" border:1px solid black;    
                        height:100px;
                        width:100px;
                        border-radius:50%;" alt="">
                    </div>
                    <h4 class="mt-3">{{@$profile->name }}</h4>
                </div>
                
                <div class="card-body">
                 <table class="table table-light">
                    <tbody>
                        <tr>
                            <td width='30%'>Mobile Number:</td>
                            <td width='70%'>{{@$profile->mobile_number}}</td>
                        </tr>
                        <tr>
                            <td width='30%'>Email:</td>
                            <td width='70%'>{{@$profile->email}}</td>
                        </tr>
                        <tr>
                            <td width='30%'>Street Address:</td>
                            <td width='70%'>{{@$profile->street_address}}</td>
                        </tr>
                        <tr>
                            <td width='30%'>District:</td>
                            <td width='70%'>{{@$profile->district}}</td>
                        </tr>
                        <tr>
                            <td width='30%'>Police Station:</td>
                            <td width='70%'>{{@$profile->police_station}}</td>
                        </tr>
                    </tbody>
                 </table>
                </div>
              </div>
        </div>
    </div>


@endsection


