<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('Backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Pannel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('Backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">@auth
              {{ auth()->user()->name }}
          @endauth</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
            </ul>
          </li>  --}}
          
          {{-- <li class="nav-item">
            <a href="@route('category.index')" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Category</p>
            </a>
          </li>

        </li>
        <li class="nav-item">
            <a href="@route('cache')" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Cache</p>
            </a>
          </li>
        <li class="nav-item">
          <a href="@route('skill.index')" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Skill</p>
          </a>
        </li> --}}

        <li class="nav-item ">
            <a class="nav-link @if ($navItem === 'dashboard')
            active
            @endif" href="{{ route('admin.dashboard') }}">
                <i class=" nav-icon fa fa-home text-warning"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link @if ($navItem === 'slider')
            active
            @endif" href="{{ route('admin.slider.index') }}">
                <i class="nav-icon fas fa-sliders-h text-warning"></i>
              <p>Slider</p>
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link @if ($navItem === 'category')
            active
            @endif" href="{{ route('admin.category.index') }}">
              <i class="nav-icon fas fa-sitemap text-warning"></i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'sub_cat')
            active
            @endif" href="{{ route('admin.sub-category.index') }}">
              <i class="nav-icon fas fa-sitemap text-warning"></i>
              <p>Sub Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'size')
            active
            @endif" href="{{ route('admin.size.index') }}">
              <i class="nav-icon far fa-window-maximize text-warning"></i>
              <p>Size</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'color')
            active
            @endif" href="{{ route('admin.color.index') }}">
              <i class="nav-icon fas fa-palette text-warning"></i>
              <p>Color</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'product')
            active
            @endif" href="{{ route('admin.product.index') }}">
              <i class="nav-icon fab fa-product-hunt text-warning"></i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'coupon')
            active
            @endif" href="{{ route('admin.coupon.index') }}">
              <i class="nav-icon fas fa-ad text-warning"></i>
              <p>Coupon</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link @if ($navItem === 'website')
            active
            @endif" href="{{ route('admin.website.index') }}">
              <i class="nav-icon fas fa-globe-asia text-warning"></i>
              <p>Top Website</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'website')
            active
            @endif" href="{{ route('admin.website_footer.index') }}">
              <i class="nav-icon fas fa-globe-asia text-warning"></i>
              <p>Footer Website</p>
            </a>
          </li> --}}
          
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'order')
            active
            @endif" href="{{ route('admin.orders') }}">
              <i class="nav-icon fas fa-th text-warning"></i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'message')
            active
            @endif" href="{{ route('admin.message.index') }}">
              <i class="nav-icon fa fa-envelope text-warning"></i>
              <p>Message</p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              
              <i class="nav-icon fas fa-globe-asia text-warning"></i>
              <p>
                Website
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link @if ($navItem === 'website')
                active
                
                @endif" href="{{ route('admin.website.index') }}">
                <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Top Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if ($navItem === 'website_footer')
                active
                
                @endif" href="{{ route('admin.website_footer.index') }}">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>Footer Details</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              
              <i class="nav-icon fas fa-globe-asia text-warning"></i>
              <p>
                Blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('blogadmin/dashboard')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard   
                    </p>
                  </a>
                </li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('category.index') }}" class="nav-link {{ (request()->is('blogadmin/category*')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>
                      Categories
                    </p>
                  </a>                    
                </li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('tag.index') }}" class="nav-link {{ (request()->is('blogadmin/tag*')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-tag"></i>
                    <p>
                      Tags
                    </p>
                  </a>                    
                </li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('post.index') }}" class="nav-link {{ (request()->is('blogadmin/post*')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-pen-square"></i>
                    <p>
                      Post
                    </p>
                  </a>                    
                </li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('contact.index') }}" class="nav-link {{ (request()->is('blogadmin/contact*')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                      Messages
                    </p>
                  </a>                    
                </li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('user.index') }}" class="nav-link {{ (request()->is('blogadmin/user*')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      User
                    </p>
                  </a>
                </li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('setting.index') }}" class="nav-link {{ (request()->is('blogadmin/setting')) ? 'active': '' }}">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                      Setting
                    </p>
                  </a>
                </li>
                <li class="nav-header">Your Account</li>
                <li class="nav-item mt-auto">
                  <a href="{{ route('user.profile') }}" class="nav-link {{ (request()->is('blogadmin/profile')) ? 'active': '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Your Profile
                    </p>
                  </a>
                </li>
                
                <li class="text-center mt-2 mb-2">
                  <a href="{{route('website')}}" class="btn btn-primary text-white" target="_blank">
                    <p class="mb-0">
                      View Website
                    </p>
                  </a>                    
                </li>
              </ul>
          </li>
         
          @auth('admin')
          <li class="nav-item">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="btn btn-success btn-block">Logout</button>
            </form>
          </li>
          @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
