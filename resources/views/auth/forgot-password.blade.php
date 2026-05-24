@extends('layouts.blankLayout')

@section('title', 'Forgot Password | TT UNIK IT SOLUTIONS')

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <div class="card">
        <div class="card-body">
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="https://www.ttunikit.co.za/assets/img/branding/TTwebbrand.png" alt="Logo" height="60">
            </a>
          </div>

          <h4 class="mb-2 text-center">Forgot password?</h4>
          <p class="mb-6 text-center">Enter your email address and we will send you a reset code.</p>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
              <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
              <input type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     id="email"
                     name="email"
                     placeholder="Enter your email"
                     value="{{ old('email') }}"
                     autofocus>
              @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
              Send Reset Code
            </button>
          </form>

          <p class="text-center mt-4 mb-0">
            <a href="{{ route('login') }}">Back to login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
