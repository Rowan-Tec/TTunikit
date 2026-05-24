@extends('layouts.app')

@section('title', 'Dashboard | TT UNIK IT SOLUTIONS')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">
          <div>
            <h4 class="mb-1">Welcome, {{ auth()->user()->first_name ?? auth()->user()->name }}</h4>
            <p class="mb-0 text-muted">Manage your account, referral points, and TT UNIK IT services.</p>
          </div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger waves-effect waves-light">
              <i class="ti ti-logout me-1"></i>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="ti ti-gift"></i>
              </span>
            </div>
            <div>
              <p class="mb-0 text-muted">Referral Points</p>
              <h4 class="mb-0">{{ auth()->user()->points ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="ti ti-id-badge"></i>
              </span>
            </div>
            <div>
              <p class="mb-0 text-muted">Referral Code</p>
              <h6 class="mb-0">{{ auth()->user()->reference_code }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-info">
                <i class="ti ti-mail-check"></i>
              </span>
            </div>
            <div>
              <p class="mb-0 text-muted">Email Status</p>
              <h6 class="mb-0">{{ auth()->user()->hasVerifiedEmail() ? 'Verified' : 'Not Verified' }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-7">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="mb-0">Account Details</h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-sm-6">
              <small class="text-muted d-block">Full Name</small>
              <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
            </div>
            <div class="col-sm-6">
              <small class="text-muted d-block">Email</small>
              <span>{{ auth()->user()->email }}</span>
            </div>
            <div class="col-sm-6">
              <small class="text-muted d-block">Contact Number</small>
              <span>{{ auth()->user()->contact_number }}</span>
            </div>
            <div class="col-sm-6">
              <small class="text-muted d-block">Province</small>
              <span>{{ auth()->user()->province }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="mb-0">Quick Actions</h5>
        </div>
        <div class="card-body d-grid gap-3">
          <a href="{{ url('/') }}" class="btn btn-outline-primary waves-effect">
            <i class="ti ti-home me-1"></i>
            Visit Website
          </a>
          <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary waves-effect">
            <i class="ti ti-user-edit me-1"></i>
            Edit Profile
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 waves-effect">
              <i class="ti ti-logout me-1"></i>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
