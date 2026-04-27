@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-camera me-2"></i>
                            Profile Photo
                        </h4>
                        <p class="text-muted mb-0">Update your profile picture</p>
                    </div>
                    <div class="card-body">
                        <!-- Current Photo Display -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img id="currentPhoto" 
                                     src="{{ Auth::user()->profile_photo ? Storage::url(Auth::user()->profile_photo) : asset('images/default-avatar.png') }}" 
                                     alt="Profile Photo" 
                                     class="rounded-circle border border-3 border-light shadow-lg"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                <div class="position-absolute bottom-0 end-0">
                                    <button type="button" class="btn btn-primary btn-sm rounded-circle" onclick="document.getElementById('photoInput').click()">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h5 class="mb-1">{{ Auth::user()->full_names }} {{ Auth::user()->surname }}</h5>
                                <p class="text-muted">@{{ Auth::user()->username }}</p>
                            </div>
                        </div>

                        <!-- Upload Form -->
                        <form id="photoUploadForm" class="mb-4">
                            @csrf
                            <input type="file" 
                                   id="photoInput" 
                                   name="photo" 
                                   accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                                   class="d-none">
                            
                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong>Photo Requirements:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Format: JPEG, PNG, GIF, or WebP</li>
                                        <li>Size: Maximum 5MB</li>
                                        <li>Dimensions: Between 100x100 and 2000x2000 pixels</li>
                                        <li>Recommended: Square format for best results</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div id="previewArea" class="d-none mb-4">
                                <h6 class="mb-3">Preview</h6>
                                <div class="text-center">
                                    <img id="previewImage" class="rounded-circle border border-3 border-light shadow-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-2" id="cropBtn">
                                            <i class="fas fa-crop me-1"></i>Crop
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="cancelBtn">
                                            <i class="fas fa-times me-1"></i>Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Cropper Area (Hidden by default) -->
                            <div id="cropperArea" class="d-none mb-4">
                                <h6 class="mb-3">Crop Your Photo</h6>
                                <div class="text-center mb-3">
                                    <img id="cropperImage" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-primary" id="applyCropBtn">
                                        <i class="fas fa-check me-1"></i>Apply Crop
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" id="cancelCropBtn">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="button" onclick="document.getElementById('photoInput').click()" class="btn btn-primary">
                                    <i class="fas fa-upload me-2"></i>Choose Photo
                                </button>
                                @if(Auth::user()->profile_photo)
                                <button type="button" id="deletePhotoBtn" class="btn btn-outline-danger">
                                    <i class="fas fa-trash me-2"></i>Delete Photo
                                </button>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Profile
                                </a>
                            </div>
                        </form>

                        <!-- Default Avatar Options -->
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="mb-3">Or Use Default Avatar</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-outline-secondary w-100" onclick="setDefaultAvatar('initials')">
                                        <div class="text-center">
                                            <img src="https://ui-avatars.com/api/?name={{ substr(Auth::user()->full_names, 0, 1) }}{{ substr(Auth::user()->surname, 0, 1) }}&size=80&background=4ECDC4&color=fff&bold=true" 
                                                 alt="Initials" 
                                                 class="rounded-circle mb-2"
                                                 style="width: 60px; height: 60px;">
                                            <div class="small">Initials</div>
                                        </div>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-outline-secondary w-100" onclick="setDefaultAvatar('gravatar')">
                                        <div class="text-center">
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=80&d=identicon&r=pg" 
                                                 alt="Gravatar" 
                                                 class="rounded-circle mb-2"
                                                 style="width: 60px; height: 60px;">
                                            <div class="small">Gravatar</div>
                                        </div>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-outline-secondary w-100" onclick="setDefaultAvatar('built-in')">
                                        <div class="text-center">
                                            <img src="{{ asset('images/default-avatar.png') }}" 
                                                 alt="Default" 
                                                 class="rounded-circle mb-2"
                                                 style="width: 60px; height: 60px;">
                                            <div class="small">Default</div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">

<style>
    .cropper-container {
        max-height: 400px;
    }
    
    .preview-container {
        overflow: hidden;
        border-radius: 50%;
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }
    
    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<!-- Include Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let cropper = null;
    let currentFile = null;
    
    // File input change handler
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        // Validate file
        if (!validateFile(file)) {
            return;
        }
        
        currentFile = file;
        
        // Read and display preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('cropperImage').src = e.target.result;
            document.getElementById('previewArea').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
    
    // Crop button handler
    document.getElementById('cropBtn').addEventListener('click', function() {
        document.getElementById('previewArea').classList.add('d-none');
        document.getElementById('cropperArea').classList.remove('d-none');
        
        // Initialize cropper
        const image = document.getElementById('cropperImage');
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            guides: true,
            center: true,
            highlight: true,
            background: true,
            autoCrop: true,
            movable: true,
            rotatable: false,
            scalable: true,
            zoomable: true,
            cropBoxMovable: true,
            cropBoxResizable: true,
        });
    });
    
    // Apply crop handler
    document.getElementById('applyCropBtn').addEventListener('click', function() {
        if (!cropper) return;
        
        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400,
        });
        
        canvas.toBlob(function(blob) {
            uploadPhoto(blob);
        });
    });
    
    // Cancel crop handler
    document.getElementById('cancelCropBtn').addEventListener('click', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        document.getElementById('cropperArea').classList.add('d-none');
        document.getElementById('previewArea').classList.remove('d-none');
    });
    
    // Cancel handler
    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('previewArea').classList.add('d-none');
        document.getElementById('photoInput').value = '';
        currentFile = null;
    });
    
    // Delete photo handler
    document.getElementById('deletePhotoBtn')?.addEventListener('click', function() {
        if (!confirm('Are you sure you want to delete your profile photo?')) {
            return;
        }
        
        deletePhoto();
    });
    
    // Validate file function
    function validateFile(file) {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        if (!validTypes.includes(file.type)) {
            showAlert('error', 'Please select a valid image file (JPEG, PNG, GIF, or WebP).');
            return false;
        }
        
        if (file.size > maxSize) {
            showAlert('error', 'File size must be less than 5MB.');
            return false;
        }
        
        return true;
    }
    
    // Upload photo function
    function uploadPhoto(blob) {
        const formData = new FormData();
        formData.append('photo', blob, 'profile.jpg');
        
        const submitBtn = document.querySelector('#photoUploadForm button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
        }
        
        fetch('{{ route("profile.photo.upload") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showAlert('success', data.message);
                document.getElementById('currentPhoto').src = data.photo_url;
                
                // Reset form
                document.getElementById('previewArea').classList.add('d-none');
                document.getElementById('cropperArea').classList.add('d-none');
                document.getElementById('photoInput').value = '';
                
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                
                // Show delete button if it was hidden
                const deleteBtn = document.getElementById('deletePhotoBtn');
                if (deleteBtn) {
                    deleteBtn.style.display = 'inline-block';
                }
            } else {
                showAlert('error', data.message || 'Failed to upload photo.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while uploading the photo.');
        })
        .finally(() => {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-upload me-2"></i>Choose Photo';
            }
        });
    }
    
    // Delete photo function
    function deletePhoto() {
        fetch('{{ route("profile.photo.delete") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showAlert('success', data.message);
                document.getElementById('currentPhoto').src = '{{ asset("images/default-avatar.png") }}';
                
                // Hide delete button
                const deleteBtn = document.getElementById('deletePhotoBtn');
                if (deleteBtn) {
                    deleteBtn.style.display = 'none';
                }
            } else {
                showAlert('error', data.message || 'Failed to delete photo.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while deleting the photo.');
        });
    }
    
    // Set default avatar function
    function setDefaultAvatar(type) {
        fetch('{{ route("profile.photo.set-default") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                avatar_type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showAlert('success', data.message);
                document.getElementById('currentPhoto').src = data.avatar_url;
                
                // Hide delete button
                const deleteBtn = document.getElementById('deletePhotoBtn');
                if (deleteBtn) {
                    deleteBtn.style.display = 'none';
                }
            } else {
                showAlert('error', data.message || 'Failed to set default avatar.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while setting the default avatar.');
        });
    }
    
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
