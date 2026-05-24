@extends('layouts.blankLayout')

@section('title', 'Login | TT UNIK IT SOLUTIONS')

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

          <h4 class="mb-1 text-center">Welcome back</h4>
          <p class="mb-6 text-center">Sign in to continue to your account.</p>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form id="loginForm" class="mb-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
              <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
              <input type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     id="email"
                     name="email"
                     placeholder="Enter your email"
                     value="{{ old('email') }}"
                     autocomplete="username"
                     autofocus>
              @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label" for="password">Password<sup class="text-danger">*</sup></label>
              <div class="input-group input-group-merge">
                <input type="password"
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="Enter your password"
                       autocomplete="current-password">
                <span class="input-group-text cursor-pointer" id="passwordToggle">
                  <i class="fa-solid fa-eye-slash"></i>
                </span>
              </div>
              @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-6">
              <div class="form-check mb-0">
                <input class="form-check-input"
                       type="checkbox"
                       id="remember_me"
                       name="remember">
                <label class="form-check-label" for="remember_me">
                  Remember me
                </label>
              </div>

              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a>
              @endif
            </div>

            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
              Sign in
            </button>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{ route('register') }}">
              <span>Create an account</span>
            </a>
          </p>

          <div class="divider my-6">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook me-2 waves-effect">
              <i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-twitter me-2 waves-effect">
              <i class="fa-brands fa-twitter"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-github me-2 waves-effect">
              <i class="fa-brands fa-github"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google waves-effect">
              <i class="fa-brands fa-google"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('passwordToggle');
    const input = document.getElementById('password');
    const icon = toggle ? toggle.querySelector('i') : null;

    if (!toggle || !input || !icon) {
      return;
    }

    toggle.addEventListener('click', function () {
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      icon.classList.toggle('fa-eye-slash', !isHidden);
      icon.classList.toggle('fa-eye', isHidden);
    });
  });
</script>
@endsection
