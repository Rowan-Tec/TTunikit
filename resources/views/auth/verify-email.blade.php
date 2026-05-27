@extends('layouts.blankLayout')

@section('title', 'Verify Email')

@section('content')
@php
  $resendAvailableAt = (int) session('verification_resend_available_at', 0);
  $resendWaitSeconds = max(0, $resendAvailableAt - now()->timestamp);
@endphp
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

          <h4 class="mb-2 text-center">Verify your email</h4>

          <p class="mb-6 text-center">
            Thanks for signing up. Enter the 6-digit verification code we sent to your email address.
          </p>

          @if (session('status') == 'verification-code-sent')
            <div class="alert alert-success">
              A new verification code has been sent to your email address.
            </div>
          @elseif (session('status') == 'verification-link-wait')
            <div class="alert alert-warning">
              Please wait before requesting another verification code.
            </div>
          @endif

          <form method="POST" action="{{ route('verification.verify') }}" class="mb-4">
            @csrf

            <div class="mb-4">
              <label for="verification_code" class="form-label">Verification Code<sup class="text-danger">*</sup></label>
              <input type="text"
                     inputmode="numeric"
                     pattern="[0-9]{6}"
                     maxlength="6"
                     class="form-control text-center @error('verification_code') is-invalid @enderror"
                     id="verification_code"
                     name="verification_code"
                     placeholder="000000"
                     value="{{ old('verification_code') }}"
                     autocomplete="one-time-code"
                     autofocus>
              @error('verification_code')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
              Verify Email
            </button>
          </form>

          <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button type="submit"
                    id="resendVerificationButton"
                    class="btn btn-outline-primary d-grid w-100 waves-effect waves-light"
                    data-wait-seconds="{{ $resendWaitSeconds }}"
                    {{ $resendWaitSeconds > 0 ? 'disabled' : '' }}>
              <span id="resendVerificationText">
                {{ $resendWaitSeconds > 0 ? 'Resend available soon' : 'Resend Verification Code' }}
              </span>
            </button>
          </form>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary d-grid w-100 waves-effect">
              Log Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('resendVerificationButton');
    const label = document.getElementById('resendVerificationText');

    if (!button || !label) {
      return;
    }

    let remainingSeconds = parseInt(button.dataset.waitSeconds || '0', 10);

    const formatTime = function (seconds) {
      const minutes = Math.floor(seconds / 60);
      const remainder = seconds % 60;

      return minutes + ':' + String(remainder).padStart(2, '0');
    };

    const refreshButton = function () {
      if (remainingSeconds <= 0) {
        button.disabled = false;
        label.textContent = 'Resend Verification Code';
        return;
      }

      button.disabled = true;
      label.textContent = 'Resend Verification Code in ' + formatTime(remainingSeconds);
      remainingSeconds -= 1;
      window.setTimeout(refreshButton, 1000);
    };

    refreshButton();
  });
</script>
@endsection
