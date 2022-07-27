@php
    $prefix=Request::route()->getPrefix();
    $route=Route::current()->getName();
@endphp
<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> starlight</a></div>
    <div class="sl-sideleft " data-widget="treeView" role="menu-open" data-accordation="false">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="index.html" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        
        <a href="widgets.html" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Cards &amp; Widgets</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        
        <a href="#" class="sl-menu-link {{$prefix=='/user'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Manage User</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('user.add')}}" class="nav-link {{$route=='user.add'?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('user.view_verified')}}" class="nav-link {{$route=='user.view_verified'?'active':''}}">View User</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{$prefix=='/contact'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Contact</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('contact.add')}}" class="nav-link {{$route=='contact.add'?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('contact.view')}}" class="nav-link {{$route=='contact.view'?'active':''}}">View Contacts</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{$prefix=='/banner'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Banner</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('banner.add')}}" class="nav-link {{$route=='banner.add'?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('banner.view')}}" class="nav-link {{$route=='banner.view'?'active':''}}">View Banners</a></li>
        </ul>
          <a href="#" class="sl-menu-link {{($prefix=='/category')?'show-sub bg-success text-white':''}}">
            <div class="sl-menu-item ">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Category</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column ">
            <li class="nav-item "><a href="{{route('category.add')}}" class="nav-link {{($route=='category.add')?'active':''}}">Add New</a></li>
            <li class="nav-item"><a href="{{route('category.view')}}" class="nav-link {{($route=='category.view')?'active':''}}">View Cat</a></li>
          </ul>
     
        
        <a href="#" class="sl-menu-link {{$prefix=="/subCategory"?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Sub Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item "><a href="{{route('subCategory.add')}}" class="nav-link {{$route=="subCategory.add"?'active':''}}">Add New</a></li>
          <li class="nav-item "><a href="{{route('subCategory.view')}}" class="nav-link {{$route=="subCategory.view"?'active':''}}">View SubCat</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{($prefix=='/section')?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item ">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Section</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column ">
          <li class="nav-item "><a href="{{route('section.add')}}" class="nav-link {{($route=='section.add')?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('section.view')}}" class="nav-link {{($route=='section.view')?'active':''}}">View Cat</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{$prefix=='/color'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Color</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('color.add')}}" class="nav-link {{$route=='color.add'?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('color.view')}}" class="nav-link {{$route=='color.view'?'active':''}}">View Colors</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{$prefix=='/size'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Size</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('size.add')}}" class="nav-link {{$route=='size.add'?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('size.view')}}" class="nav-link {{$route=='size.view'?'active':''}}">View Size</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{$prefix=='/product'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Product</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('product.add')}}" class="nav-link {{$route=='product.add'?'active':''}}">Add New</a></li>
          <li class="nav-item"><a href="{{route('product.view')}}" class="nav-link {{$route=='product.view'?'active':''}}">View Product</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{$prefix=='/orders'?'show-sub bg-success text-white':''}}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i>
            <span class="menu-item-label">Manage Orders</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('orders.pending_list')}}" class="nav-link {{$route=="orders.pending_list"?'active':''}}">Pending Order</a></li>
          <li class="nav-item"><a href="{{route('orders.approved_list')}}" class="nav-link {{$route=="orders.approved_list"?'active':''}}">Approved Order</a></li>
        </ul>
        <a href="mailbox.html" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
            <span class="menu-item-label">Mailbox</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Pages</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="blank.html" class="nav-link">Blank Page</a></li>
          <li class="nav-item"><a href="page-signin.html" class="nav-link">Signin Page</a></li>
          <li class="nav-item"><a href="page-signup.html" class="nav-link">Signup Page</a></li>
          <li class="nav-item"><a href="page-notfound.html" class="nav-link">404 Page Not Found</a></li>
        </ul>
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->