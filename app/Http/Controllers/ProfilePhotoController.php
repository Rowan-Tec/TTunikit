<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfilePhotoController extends Controller
{
    /**
     * Upload or update profile photo.
     */
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png,gif,webp',
                'max:5120', // 5MB max
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            ],
        ], [
            'photo.required' => 'Please select a photo to upload.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The photo must be a JPEG, PNG, GIF, or WebP file.',
            'photo.max' => 'The photo may not be larger than 5MB.',
            'photo.dimensions' => 'The photo must be between 100x100 and 2000x2000 pixels.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $user = Auth::user();

        try {
            $photo = $request->file('photo');
            
            // Generate unique filename
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $directory = 'profile-photos/' . date('Y/m');
            
            // Process and optimize the image
            $image = Image::make($photo);
            
            // Resize to optimal size while maintaining aspect ratio
            $image->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Optimize the image
            $image->encode($photo->getClientOriginalExtension(), 85);
            
            // Store the processed image
            $path = $directory . '/' . $filename;
            Storage::disk('public')->put($path, $image->getEncoded());
            
            // Delete old photo if exists
            if ($user->profile_photo) {
                $this->deleteOldPhoto($user->profile_photo);
            }
            
            // Update user profile
            $user->update([
                'profile_photo' => $path,
            ]);
            
            // Generate URLs for different sizes
            $urls = [
                'original' => Storage::url($path),
                'thumbnail' => $this->generateThumbnail($path),
            ];
            
            return response()->json([
                'message' => 'Profile photo updated successfully!',
                'photo_url' => $urls['original'],
                'thumbnail_url' => $urls['thumbnail'],
                'status' => 'success'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload photo. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Delete profile photo.
     */
    public function delete(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user->profile_photo) {
            return response()->json([
                'message' => 'No profile photo to delete.',
                'status' => 'error'
            ], 404);
        }

        try {
            // Delete the photo file
            $this->deleteOldPhoto($user->profile_photo);
            
            // Update user profile
            $user->update([
                'profile_photo' => null,
            ]);
            
            return response()->json([
                'message' => 'Profile photo deleted successfully!',
                'status' => 'success'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete photo. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Get profile photo information.
     */
    public function getPhoto(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user->profile_photo) {
            return response()->json([
                'photo_url' => null,
                'thumbnail_url' => null,
                'has_photo' => false
            ]);
        }

        return response()->json([
            'photo_url' => Storage::url($user->profile_photo),
            'thumbnail_url' => $this->generateThumbnail($user->profile_photo),
            'has_photo' => true,
            'uploaded_at' => $user->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Generate thumbnail URL.
     */
    private function generateThumbnail($path): string
    {
        try {
            // For now, return the same URL (you can implement actual thumbnail generation)
            return Storage::url($path);
        } catch (\Exception $e) {
            return Storage::url($path);
        }
    }

    /**
     * Delete old photo file.
     */
    private function deleteOldPhoto($photoPath): void
    {
        try {
            if (Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
        } catch (\Exception $e) {
            // Log error but don't fail the operation
            \Log::error('Failed to delete old profile photo: ' . $e->getMessage());
        }
    }

    /**
     * Crop and resize photo.
     */
    public function crop(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'photo' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
            'x' => ['required', 'integer', 'min:0'],
            'y' => ['required', 'integer', 'min:0'],
            'width' => ['required', 'integer', 'min:50', 'max:2000'],
            'height' => ['required', 'integer', 'min:50', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $user = Auth::user();

        try {
            $photo = $request->file('photo');
            $x = $request->input('x');
            $y = $request->input('y');
            $width = $request->input('width');
            $height = $request->input('height');
            
            // Generate unique filename
            $filename = 'profile_' . $user->id . '_' . time() . '_cropped.' . $photo->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $directory = 'profile-photos/' . date('Y/m');
            
            // Process and crop the image
            $image = Image::make($photo);
            
            // Crop the image
            $image->crop($width, $height, $x, $y);
            
            // Resize to optimal size
            $image->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Optimize the image
            $image->encode($photo->getClientOriginalExtension(), 85);
            
            // Store the processed image
            $path = $directory . '/' . $filename;
            Storage::disk('public')->put($path, $image->getEncoded());
            
            // Delete old photo if exists
            if ($user->profile_photo) {
                $this->deleteOldPhoto($user->profile_photo);
            }
            
            // Update user profile
            $user->update([
                'profile_photo' => $path,
            ]);
            
            return response()->json([
                'message' => 'Profile photo cropped and updated successfully!',
                'photo_url' => Storage::url($path),
                'thumbnail_url' => $this->generateThumbnail($path),
                'status' => 'success'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to crop photo. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Set default profile photo.
     */
    public function setDefault(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'avatar_type' => ['required', 'in:initials,gravatar,built-in'],
            'avatar_data' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $user = Auth::user();

        try {
            // Delete existing photo if any
            if ($user->profile_photo) {
                $this->deleteOldPhoto($user->profile_photo);
            }

            $avatarType = $request->input('avatar_type');
            $avatarData = $request->input('avatar_data');
            
            // Generate default avatar URL based on type
            $avatarUrl = $this->generateDefaultAvatar($user, $avatarType, $avatarData);
            
            // Update user profile
            $user->update([
                'profile_photo' => null, // Clear custom photo
                'avatar_type' => $avatarType,
                'avatar_data' => $avatarData,
            ]);
            
            return response()->json([
                'message' => 'Default avatar set successfully!',
                'avatar_url' => $avatarUrl,
                'status' => 'success'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to set default avatar. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Generate default avatar URL.
     */
    private function generateDefaultAvatar($user, $type, $data = null): string
    {
        switch ($type) {
            case 'initials':
                $initials = substr($user->full_names, 0, 1) . substr($user->surname, 0, 1);
                $size = 200;
                $background = $this->getAvatarColor($user->id);
                return "https://ui-avatars.com/api/?name={$initials}&size={$size}&background={$background}&color=fff&bold=true";
                
            case 'gravatar':
                $email = strtolower(trim($user->email));
                $hash = md5($email);
                $size = 200;
                return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=identicon&r=pg";
                
            case 'built-in':
                // Return a built-in default avatar
                return asset('images/default-avatar.png');
                
            default:
                return asset('images/default-avatar.png');
        }
    }

    /**
     * Get avatar background color based on user ID.
     */
    private function getAvatarColor($userId): string
    {
        $colors = [
            'FF6B6B', '4ECDC4', '45B7D1', '96CEB4', 'FFEAA7',
            'DDA0DD', '98D8C8', 'F7DC6F', 'BB8FCE', '85C1E2'
        ];
        
        return $colors[$userId % count($colors)];
    }
}
