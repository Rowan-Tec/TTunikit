@extends('layouts.blankLayout')
@section('title', 'TT UNIK IT SOLUTIONS | IT Company in Polokwane')
@section('description', 'We provide innovative reliable ICT Services. TT UNIK IT SOLUTIONS specialize with Website and Web applications development, Mobile App Design, Computer Repairs, Computer Sales and Supply, Networking and cabling, Technical support, Business Email and web Hosting')
@section('keywords', 'IT Company in Polokwane, Best IT Company in Polokwane, PC Sales in Polokwane, ICT Company in Polokwane, Web Hosting company in Polokwane, Website design company in Polokwane, Hosting Company in South Africa, Hosting company in Johannesburg, Information Technology Company, App Development Company,Networking and cabling company, Best IT Company in South Africa')
@section('authMaxWidth', '720px')
@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <div class="mx-auto" style="max-width: {{ request()->has('referral') ? '720px' : '420px' }};">

      @if(request()->has('referral'))

      <!-- Register Card -->
      <div class="card">
        <div class="card-body">

          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="https://www.ttunikit.co.za/assets/img/branding/TTwebbrand.png" alt="Logo" height="60">
            </a>
          </div>
          <!-- /Logo -->

         
          <p class="mb-6">Create your account and get started today.</p>

          <form id="registerForm" class="mb-4" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="referral" value="{{ request()->get('referral') }}">

            <div class="row">

              <!-- Referral Code -->
              @if(request()->has('referral') && request()->get('referral') == 'with')
              <div class="col-12 mb-4">
                <label for="ref_code" class="form-label">Referral Code<sup class="text-danger">*</sup></label>
                <input type="text"
                       class="form-control @error('ref_code') is-invalid @enderror"
                       id="ref_code"
                       name="ref_code"
                       placeholder="Enter your referral code"
                       value="{{ old('ref_code') }}">
                @error('ref_code')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
              @endif

              <!-- First Name -->
              <div class="col-md-6 mb-4">
                <label for="first_name" class="form-label">First Name<sup class="text-danger">*</sup></label>
                <input type="text"
                       class="form-control @error('first_name') is-invalid @enderror"
                       id="first_name"
                       name="first_name"
                       placeholder="Enter your first name"
                       value="{{ old('first_name') }}">
                @error('first_name')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Last Name -->
              <div class="col-md-6 mb-4">
                <label for="last_name" class="form-label">Last Name<sup class="text-danger">*</sup></label>
                <input type="text"
                       class="form-control @error('last_name') is-invalid @enderror"
                       id="last_name"
                       name="last_name"
                       placeholder="Enter your last name"
                       value="{{ old('last_name') }}">
                @error('last_name')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Contact -->
              <div class="col-md-6 mb-4">
                <label for="contact_number" class="form-label">Contact Number<sup class="text-danger">*</sup></label>
                <input type="text"
                       class="form-control @error('contact_number') is-invalid @enderror"
                       id="contact_number"
                       name="contact_number"
                       placeholder="Enter your contact number"
                       value="{{ old('contact_number') }}">
                @error('contact_number')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-4">
                <label for="email" class="form-label">Email<sup class="text-danger">*</sup></label>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       placeholder="Enter your email"
                       value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Gender -->
              <div class="col-md-6 mb-4">
                <label for="gender" class="form-label">Gender<sup class="text-danger">*</sup></label>
                <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                  <option value="">-- Select Gender --</option>
                  @foreach (['Male','Female','Other'] as $gender)
                    <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
                      {{ $gender }}
                    </option>
                  @endforeach
                </select>
                @error('gender')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Province -->
              <div class="col-md-6 mb-4">
                <label for="province" class="form-label">Province<sup class="text-danger">*</sup></label>
                <select name="province" id="province" class="form-select @error('province') is-invalid @enderror">
                  <option value="">-- Select Province --</option>
                  @foreach ([
                    'Gauteng',
                    'Western Cape',
                    'KwaZulu-Natal',
                    'Eastern Cape',
                    'Limpopo',
                    'Mpumalanga',
                    'North West',
                    'Free State',
                    'Northern Cape'
                  ] as $province)
                    <option value="{{ $province }}" {{ old('province') == $province ? 'selected' : '' }}>
                      {{ $province }}
                    </option>
                  @endforeach
                </select>
                @error('province')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- DOB -->
              <div class="col-12 mb-2">
                <label class="form-label">Date of Birth<sup class="text-danger">*</sup></label>
              </div>

              <!-- Day -->
              <div class="col-md-4 mb-4">
                <select name="dob_day" id="dob_day" class="form-select @error('dob_day') is-invalid @enderror">
                  <option value="">Day</option>
                  @for ($day = 1; $day <= 31; $day++)
                    <option value="{{ $day }}" {{ old('dob_day') == $day ? 'selected' : '' }}>
                      {{ $day }}
                    </option>
                  @endfor
                </select>
                @error('dob_day')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Month -->
              <div class="col-md-4 mb-4">
                <select name="dob_month" id="dob_month" class="form-select @error('dob_month') is-invalid @enderror">
                  <option value="">Month</option>
                  @foreach ([
                    1 => 'January',
                    2 => 'February',
                    3 => 'March',
                    4 => 'April',
                    5 => 'May',
                    6 => 'June',
                    7 => 'July',
                    8 => 'August',
                    9 => 'September',
                    10 => 'October',
                    11 => 'November',
                    12 => 'December',
                  ] as $monthNumber => $monthName)
                    <option value="{{ $monthNumber }}" {{ old('dob_month') == $monthNumber ? 'selected' : '' }}>
                      {{ $monthName }}
                    </option>
                  @endforeach
                </select>
                @error('dob_month')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Year -->
              <div class="col-md-4 mb-4">
                <select name="dob_year" id="dob_year" class="form-select @error('dob_year') is-invalid @enderror">
                  <option value="">Year</option>
                  @for ($year = date('Y'); $year >= 1900; $year--)
                    <option value="{{ $year }}" {{ old('dob_year') == $year ? 'selected' : '' }}>
                      {{ $year }}
                    </option>
                  @endfor
                </select>
                @error('dob_year')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <input type="hidden" id="dob_group" name="dob_group">

              <!-- Password -->
              <div class="col-12 mb-4">
                <label class="form-label" for="password">Password<sup class="text-danger">*</sup></label>
                <div class="input-group input-group-merge">
                  <input type="password"
                         id="password"
                         class="form-control @error('password') is-invalid @enderror"
                         name="password"
                         placeholder="············">
                  <span class="input-group-text cursor-pointer">
                    <i class="fa-solid fa-eye-slash"></i>
                  </span>
                </div>

                @error('password')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Confirm Password -->
              <div class="col-12 mb-4">
                <label class="form-label" for="password_confirmation">
                  Confirm Password<sup class="text-danger">*</sup>
                </label>

                <div class="input-group input-group-merge">
                  <input type="password"
                         id="password_confirmation"
                         class="form-control @error('password_confirmation') is-invalid @enderror"
                         name="password_confirmation"
                         placeholder="············">
                  <span class="input-group-text cursor-pointer">
                    <i class="fa-solid fa-eye-slash"></i>
                  </span>
                </div>
                @error('password_confirmation')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

            </div>

            <!-- Terms -->
            <div class="my-4">
              <div class="form-check mb-0 ms-2">
                <input class="form-check-input @error('terms') is-invalid @enderror"
                       type="checkbox"
                       id="terms-conditions"
                       name="terms"
                       value="1"
                       {{ old('terms') ? 'checked' : '' }}>

                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
                @error('terms')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <input name="g-recaptcha-response"
                   id="g-recaptcha-response"
                   type="hidden"
                   value="register">

            <!-- Submit -->
            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">
              Sign up
            </button>

          </form>

          <!-- Login -->
          <p class="text-center mb-0">
            <span>Already have an account?</span>
            <a href="{{ url('login') }}">
              <span>Sign in instead</span>
            </a>
          </p>

        </div>
      </div>
      <!-- /Register Card -->

      @else

      <!-- Referral Choice Card -->
      <div class="card">
        <div class="card-body">

          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="https://www.ttunikit.co.za/assets/img/branding/TTwebbrand.png" alt="Logo" height="60">
            </a>
          </div>

          <h4 class="mb-1 text-center">Welcome to TT UNIKIT SOLUTIONS </h4>
          <p class="mb-6 text-center">
            Choose how you would like to register.
          </p>

          <form method="GET" action="{{ route('register') }}">

            <div class="d-grid gap-4">

              <button id="with_referral"
                      name="referral"
                      value="with"
                      class="btn btn-outline-primary waves-effect">
                Register with Referral Code
              </button>

              <button id="without_referral"
                      name="referral"
                      value="without"
                      class="btn btn-primary waves-effect waves-light">
                Register without Referral Code
              </button>

            </div>

          </form>

        </div>
      </div>
      <!-- /Referral Choice Card -->

      @endif

      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    ['password', 'password_confirmation'].forEach(function (fieldId) {
      const input = document.getElementById(fieldId);
      const toggle = input ? input.closest('.input-group').querySelector('.input-group-text') : null;
      const icon = toggle ? toggle.querySelector('i') : null;

      if (!input || !toggle || !icon) {
        return;
      }

      toggle.addEventListener('click', function () {
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye-slash', !isHidden);
        icon.classList.toggle('fa-eye', isHidden);
      });
    });
  });
</script>
