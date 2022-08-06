@extends('layouts.backend_app')

@section('title' ,'Admin Login')

@section('app_content')
<div class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <h3 class="login-box-msg">Confirmation Code</h3>

            <form action="{{ route('otp') }}" method="POST">
                @if(session('status'))
                <span class="text-success">{{ session('status') }}</span>
                @endisset
                @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="01...." name="phone">
                <div class="input-group-append">
                  
                </div>
              </div>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              <div class="row">
                    <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
              </div>
            </form>

         </div>
          <!-- /.login-card-body -->
        </div>
      </div>
</div>

@stop
