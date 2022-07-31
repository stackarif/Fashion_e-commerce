@extends('layouts.backend_app')

@section('title' ,'Email Verification')

@section('app_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h4 class="text-center">Admin Verification Form</h4>
            <p class="text-info">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-success">
                    <h6>A new verification link has been sent to the email address you provided during registration.</h6>
                </div>
            @endif
            <form action="{{ route('admin.verification.send') }}" method="POST">
                @csrf
                <button  class="btn btn-sm btn-primary">Send Verification Email</button>
            </form>
            <br>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        </div>
    </div>
</div>
@stop
