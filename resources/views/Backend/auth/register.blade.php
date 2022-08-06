@extends('layouts.backend_app')

@section('title' ,'Admin Register')

@section('app_content')
<div class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <h3 class="login-box-msg">Admin Register</h3>

            <form action="{{ route('admin.register') }}" method="POST">
                {{-- @if(session('status'))
                <span class="text-success">{{ session('status') }}</span>
                @endisset --}}
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="name">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>  
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              {{-- <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="01...." name="phone">
                <div class="input-group-append">
                  
                </div>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div> --}}

              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder=" Enter Your Password" name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="input-group mb-3">
                <label for="password_confirmation" value="__('Confirm Password')"></label>
                <input id="password_confirmation" type="password" class="form-control" placeholder="Confirm Your Password" name="password_confirmation">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              @error('password_confirmation')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <p class="mb-0">
              <a href="{{ route('admin.login') }}" class="text-center">Login</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
</div>

@stop
