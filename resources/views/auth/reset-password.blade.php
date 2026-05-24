@extends('layouts.blankLayout')

@section('title', 'Reset Password | TT UNIK IT SOLUTIONS')

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

          <h4 class="mb-2 text-center">Reset password</h4>
          <p class="mb-6 text-center">Enter the code sent to your email and choose a new password.</p>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <div class="mb-4">
              <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
              <input type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     id="email"
                     name="email"
                     placeholder="Enter your email"
                     value="{{ old('email', $email) }}"
                     autocomplete="username">
              @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="code" class="form-label">Reset Code<sup class="text-danger">*</sup></label>
              <input type="text"
                     class="form-control @error('code') is-invalid @enderror"
                     id="code"
                     name="code"
                     placeholder="Enter 6-digit code"
                     value="{{ old('code') }}"
                     inputmode="numeric"
                     maxlength="6">
              @error('code')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label" for="password">New Password<sup class="text-danger">*</sup></label>
              <div class="input-group input-group-merge">
                <input type="password"
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="Enter new password"
                       autocomplete="new-password">
                <span class="input-group-text cursor-pointer password-toggle" data-target="password">
                  <i class="fa-solid fa-eye-slash"></i>
                </span>
              </div>
              @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label" for="password_confirmation">Confirm Password<sup class="text-danger">*</sup></label>
              <div class="input-group input-group-merge">
                <input type="password"
                       id="password_confirmation"
                       class="form-control"
                       name="password_confirmation"
                       placeholder="Confirm new password"
                       autocomplete="new-password">
                <span class="input-group-text cursor-pointer password-toggle" data-target="password_confirmation">
                  <i class="fa-solid fa-eye-slash"></i>
                </span>
              </div>
              @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
              Reset Password
            </button>
          </form>

          <p class="text-center mt-4 mb-0">
            <a href="{{ route('password.request') }}">Request a new code</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.password-toggle').forEach(function (toggle) {
      toggle.addEventListener('click', function () {
        const input = document.getElementById(toggle.dataset.target);
        const icon = toggle.querySelector('i');

        if (!input || !icon) {
          return;
        }

        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye-slash', !isHidden);
        icon.classList.toggle('fa-eye', isHidden);
      });
    });
  });
</script>
@endsection
