@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Change Password</h4>
                        <p class="text-muted">Update your account password for enhanced security</p>
                    </div>
                    <div class="card-body">
                        <form id="changePasswordForm">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="current_password" 
                                           name="current_password" 
                                           required
                                           autocomplete="current-password">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleCurrent">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Enter your current password for verification</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password" 
                                           name="password" 
                                           required
                                           autocomplete="new-password"
                                           minlength="8">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleNew">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Minimum 8 characters with at least 1 uppercase, 1 lowercase, and 1 number</div>
                                <div id="passwordStrength" class="mt-2"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required
                                           autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong>Security Notice:</strong> After changing your password, you will be logged out from all other devices for your security.
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="changePasswordBtn">
                                    <span class="btn-text">Change Password</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </span>
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.password-strength {
    height: 5px;
    border-radius: 3px;
    margin-top: 5px;
    transition: all 0.3s ease;
}

.strength-weak { background-color: #dc3545; width: 25%; }
.strength-fair { background-color: #ffc107; width: 50%; }
.strength-good { background-color: #28a745; width: 75%; }
.strength-strong { background-color: #007bff; width: 100%; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggles
    document.getElementById('toggleCurrent').addEventListener('click', function() {
        const input = document.getElementById('current_password');
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

    document.getElementById('toggleNew').addEventListener('click', function() {
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

    document.getElementById('toggleConfirm').addEventListener('click', function() {
        const input = document.getElementById('password_confirmation');
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

    // Password strength checker
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthDiv = document.getElementById('passwordStrength');
        
        if (password.length === 0) {
            strengthDiv.innerHTML = '';
            return;
        }
        
        let strength = 0;
        let feedback = [];
        
        // Length check
        if (password.length >= 8) strength++;
        else feedback.push('At least 8 characters');
        
        // Uppercase check
        if (/[A-Z]/.test(password)) strength++;
        else feedback.push('1 uppercase letter');
        
        // Lowercase check
        if (/[a-z]/.test(password)) strength++;
        else feedback.push('1 lowercase letter');
        
        // Number check
        if (/[0-9]/.test(password)) strength++;
        else feedback.push('1 number');
        
        // Special character check
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        let strengthClass = '';
        let strengthText = '';
        let strengthColor = '';
        
        switch (strength) {
            case 0:
            case 1:
                strengthClass = 'strength-weak';
                strengthText = 'Weak';
                strengthColor = '#dc3545';
                break;
            case 2:
            case 3:
                strengthClass = 'strength-fair';
                strengthText = 'Fair';
                strengthColor = '#ffc107';
                break;
            case 4:
                strengthClass = 'strength-good';
                strengthText = 'Good';
                strengthColor = '#28a745';
                break;
            case 5:
                strengthClass = 'strength-strong';
                strengthText = 'Strong';
                strengthColor = '#007bff';
                break;
        }
        
        strengthDiv.innerHTML = `
            <div class="password-strength ${strengthClass}"></div>
            <small class="text-muted">Password strength: <span style="color: ${strengthColor}">${strengthText}</span></small>
            ${feedback.length > 0 ? '<br><small class="text-muted">Missing: ' + feedback.join(', ') + '</small>' : ''}
        `;
    });

    // Form submission
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('changePasswordBtn');
        const btnText = submitBtn.querySelector('.btn-text');
        const spinner = submitBtn.querySelector('.spinner-border');
        
        // Show loading state
        btnText.textContent = 'Changing Password...';
        spinner.classList.remove('d-none');
        submitBtn.disabled = true;
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit via AJAX
        fetch('{{ route("password.change") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                current_password: formData.get('current_password'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Show success message
                showAlert('success', data.message);
                
                // Reset form
                form.reset();
                document.getElementById('passwordStrength').innerHTML = '';
                
                // Redirect to dashboard after delay
                setTimeout(() => {
                    window.location.href = '{{ route("dashboard") }}';
                }, 2000);
            } else {
                showAlert('error', data.message || 'Failed to change password');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred. Please try again.');
        })
        .finally(() => {
            // Reset button state
            btnText.textContent = 'Change Password';
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
