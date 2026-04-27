@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4 class="card-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Delete Account
                        </h4>
                        <p class="text-white-50 mb-0">This action cannot be undone</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <div>
                                <strong>Warning:</strong> Deleting your account will permanently remove all your data, including:
                                <ul class="mb-0 mt-2">
                                    <li>Personal information and profile data</li>
                                    <li>Login history and activity logs</li>
                                    <li>Account settings and preferences</li>
                                    <li>Any associated data or content</li>
                                </ul>
                            </div>
                        </div>

                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>
                                <strong>What happens after deletion:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>You will be immediately logged out</li>
                                    <li>Your account cannot be recovered</li>
                                    <li>You'll need to create a new account to use our services again</li>
                                    <li>You'll receive a confirmation email for your records</li>
                                </ul>
                            </div>
                        </div>

                        <form id="deleteAccountForm">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Confirm Your Password</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password" 
                                           name="password" 
                                           required
                                           autocomplete="current-password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Enter your password to confirm account deletion</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="reason" class="form-label">Reason for Leaving (Optional)</label>
                                <textarea class="form-control" 
                                          id="reason" 
                                          name="reason" 
                                          rows="3" 
                                          maxlength="500"
                                          placeholder="Please let us know why you're deleting your account..."></textarea>
                                <div class="form-text">Your feedback helps us improve our service (max 500 characters)</div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirmation" name="confirmation" required>
                                    <label class="form-check-label" for="confirmation">
                                        I understand that deleting my account is permanent and cannot be undone. I want to proceed with deleting my account.
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger" id="deleteAccountBtn">
                                    <span class="btn-text">Delete My Account</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </span>
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Alternative Options -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            Consider These Alternatives
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('password.change.form') }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Change Password</h6>
                                    <small>Secure your account</small>
                                </div>
                                <p class="mb-1">If you're concerned about security, consider changing your password instead.</p>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Update Profile</h6>
                                    <small>Manage your information</small>
                                </div>
                                <p class="mb-1">You can update your profile information or preferences.</p>
                            </a>
                            <a href="{{ route('login-activity.index') }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Review Activity</h6>
                                    <small>Check your login history</small>
                                </div>
                                <p class="mb-1">Review your account activity for any unauthorized access.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    document.getElementById('togglePassword').addEventListener('click', function() {
        const input = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Form submission
    document.getElementById('deleteAccountForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('deleteAccountBtn');
        const btnText = submitBtn.querySelector('.btn-text');
        const spinner = submitBtn.querySelector('.spinner-border');
        
        // Double confirmation
        if (!confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.')) {
            return;
        }
        
        // Show loading state
        btnText.textContent = 'Deleting Account...';
        spinner.classList.remove('d-none');
        submitBtn.disabled = true;
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit via AJAX
        fetch('{{ route("account.delete") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                password: formData.get('password'),
                reason: formData.get('reason'),
                confirmation: formData.get('confirmation') ? 'on' : null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showAlert('success', data.message);
                
                // Redirect to login page after delay
                setTimeout(() => {
                    window.location.href = data.redirect || '{{ route("login") }}';
                }, 2000);
            } else {
                showAlert('error', data.message || 'Failed to delete account');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred. Please try again.');
        })
        .finally(() => {
            // Reset button state
            btnText.textContent = 'Delete My Account';
            spinner.classList.add('d-none');
            submitBtn.disabled = false;
        });
    });

    // Show alert function
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Insert at the top of the card body
        const cardBody = document.querySelector('.card-body');
        cardBody.insertBefore(alertDiv, cardBody.firstChild);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>
@endsection
