@extends('layouts.blankLayout')

@section('title', 'Verify Email')

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

          <h4 class="mb-2 text-center">Verify your email</h4>

          <p class="mb-6 text-center">
            Thanks for signing up. Please verify your email address using the link we sent to you.
          </p>

          @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
              A new verification link has been sent to your email address.
            </div>
          @endif

          <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
              Resend Verification Email
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
@endsection
