<?php

namespace App\Listeners;

use App\Models\LoginActivity;
use App\Notifications\LoginNotification;
use Illuminate\Auth\Events\Login;

class LogLoginActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $ipAddress = request()->ip();
        $userAgent = request()->userAgent();
        $location = $this->getLocationFromIP($ipAddress);

        // Log the login activity
        LoginActivity::create([
            'user_id' => $event->user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'location' => $location,
            'login_time' => now(),
        ]);

        // Send login notification to user
        $event->user->notify(new LoginNotification($ipAddress, $location, $userAgent));
    }

    /**
     * Get the location from IP address.
     * This is a basic implementation - you can enhance it with an IP geolocation service.
     */
    private function getLocationFromIP($ip)
    {
        // For now, return a basic location based on IP
        // In production, consider using a service like MaxMind GeoIP2
        return 'Location (IP: ' . $ip . ')';
    }
}
