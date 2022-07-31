{{-- @extends('layouts.frontend_app')

@section('title','Email Verification')

@section('app_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h4 class="text-center">Verification Form</h4>
            <p class="text-info">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-success">
                    <h6>A new verification link has been sent to the email address you provided during registration.</h6>
                </div>
            @endif
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button  class="btn btn-sm btn-primary">Send Verification Email</button>
            </form>
            <br>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        </div>
    </div>
</div>
@stop --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('Frontend') }}/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    li{
        list-style: none;
    }
</style>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('Frontend') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('Frontend') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('Frontend') }}/css/style.css" rel="stylesheet">
    <x-Utility.toaster-css/>
    @stack('css')
    <title>Email Verification</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h4 class="text-center">Verification Form</h4>
                <p class="text-info">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-success">
                        <h6>A new verification link has been sent to the email address you provided during registration.</h6>
                    </div>
                @endif
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <button  class="btn btn-sm btn-primary">Send Verification Email</button>
                </form>
                <br>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button>Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    
    
    
</body>
</html>
