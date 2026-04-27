<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class TokenService
{
    /**
     * Generate a secure API token for the user
     */
    public static function generateApiToken($userId, $expiresInMinutes = 60): string
    {
        $payload = [
            'user_id' => $userId,
            'iat' => time(), // issued at
            'exp' => time() + ($expiresInMinutes * 60), // expiration
            'jti' => uniqid('token_', true), // JWT ID
            'type' => 'api'
        ];

        $token = self::encodeToken($payload);
        
        // Store token in cache for quick validation
        Cache::put("api_token:{$payload['jti']}", $userId, $expiresInMinutes * 60);
        
        return $token;
    }

    /**
     * Validate and decode a token
     */
    public static function validateToken($token): ?array
    {
        try {
            $payload = self::decodeToken($token);
            
            // Check if token has expired
            if (isset($payload['exp']) && $payload['exp'] < time()) {
                return null;
            }
            
            // Check if token exists in cache
            if (isset($payload['jti']) && !Cache::has("api_token:{$payload['jti']}")) {
                return null;
            }
            
            return $payload;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Revoke a token
     */
    public static function revokeToken($token): bool
    {
        try {
            $payload = self::decodeToken($token);
            
            if (isset($payload['jti'])) {
                Cache::forget("api_token:{$payload['jti']}");
                return true;
            }
        } catch (\Exception $e) {
            // Token was invalid anyway
        }
        
        return false;
    }

    /**
     * Revoke all tokens for a user
     */
    public static function revokeAllUserTokens($userId): void
    {
        // This is a simplified approach
        // In production, you'd want to store user tokens in a database table
        $keys = Cache::getRedis()->keys("api_token:*");
        
        foreach ($keys as $key) {
            $cachedUserId = Cache::get($key);
            if ($cachedUserId == $userId) {
                Cache::forget($key);
            }
        }
    }

    /**
     * Encode token payload
     */
    private static function encodeToken(array $payload): string
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($payload);
        
        $headerEncoded = self::base64UrlEncode($header);
        $payloadEncoded = self::base64UrlEncode($payload);
        
        $signature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, config('app.key'), true);
        $signatureEncoded = self::base64UrlEncode($signature);
        
        return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
    }

    /**
     * Decode token payload
     */
    private static function decodeToken($token): array
    {
        $parts = explode('.', $token);
        
        if (count($parts) !== 3) {
            throw new \InvalidArgumentException('Invalid token format');
        }
        
        $payload = json_decode(self::base64UrlDecode($parts[1]), true);
        
        if (!$payload) {
            throw new \InvalidArgumentException('Invalid payload');
        }
        
        return $payload;
    }

    /**
     * Base64 URL encode
     */
    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Base64 URL decode
     */
    private static function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }

    /**
     * Generate a secure session token
     */
    public static function generateSessionToken($userId): string
    {
        $token = bin2hex(random_bytes(32));
        Cache::put("session_token:{$token}", $userId, 24 * 60 * 60); // 24 hours
        return $token;
    }

    /**
     * Validate session token
     */
    public static function validateSessionToken($token): ?int
    {
        return Cache::get("session_token:{$token}");
    }

    /**
     * Revoke session token
     */
    public static function revokeSessionToken($token): void
    {
        Cache::forget("session_token:{$token}");
    }

    /**
     * Encrypt sensitive data
     */
    public static function encryptData($data): string
    {
        return Crypt::encrypt($data);
    }

    /**
     * Decrypt sensitive data
     */
    public static function decryptData($encryptedData)
    {
        try {
            return Crypt::decrypt($encryptedData);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Generate CSRF token
     */
    public static function generateCsrfToken(): string
    {
        $token = bin2hex(random_bytes(32));
        Cache::put("csrf_token:{$token}", true, 2 * 60 * 60); // 2 hours
        return $token;
    }

    /**
     * Validate CSRF token
     */
    public static function validateCsrfToken($token): bool
    {
        return Cache::has("csrf_token:{$token}");
    }

    /**
     * Revoke CSRF token
     */
    public static function revokeCsrfToken($token): void
    {
        Cache::forget("csrf_token:{$token}");
    }
}
