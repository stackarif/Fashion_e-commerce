@extends('layouts.backend_app')

@section('title' ,'Verification')

@section('app_content')

{{-- @if(Session::has(message))
<div class="alert alert-danger">{{Session::get(message)}}</div>

@endif --}}
<div class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <h6 class="login-box-msg">Verify Phone Number</h6>

            <form action="{{ route('verify') }}" method="POST">
                @if(session('status'))
                <span class="text-success">{{ session('status') }}</span>
                @endisset
                @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Confirmation code" name="code">
                <div class="input-group-append">
                  
                </div>
              </div>
                @error('code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              <div class="row">
                    <div class="col-4">
                    <button type="submit" value="verify" class="btn btn-primary btn-block">Submit</button>
                    </div>
              </div>
            </form>

         </div>
          <!-- /.login-card-body -->
        </div>
      </div>
</div>

@stop
