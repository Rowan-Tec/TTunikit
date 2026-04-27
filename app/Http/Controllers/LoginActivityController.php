<?php

namespace App\Http\Controllers;

use App\Models\LoginActivity;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class LoginActivityController extends Controller
{
    /**
     * Display the user's login activity history.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get activities with filtering
        $query = LoginActivity::where('user_id', $user->id);
        
        // Filter by activity type if specified
        if ($request->has('activity_type') && $request->activity_type !== 'all') {
            $query->where('activity_type', $request->activity_type);
        }
        
        // Filter by date range if specified
        if ($request->has('date_from')) {
            $query->where('login_at', '>=', Carbon::parse($request->date_from));
        }
        
        if ($request->has('date_to')) {
            $query->where('login_at', '<=', Carbon::parse($request->date_to)->endOfDay());
        }
        
        $activities = $query->orderBy('login_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        // Get statistics
        $statistics = $this->getDetailedStatistics($user);

        return view('profile.login-activity', [
            'activities' => $activities,
            'user' => $user,
            'statistics' => $statistics,
            'filters' => [
                'activity_type' => $request->get('activity_type', 'all'),
                'date_from' => $request->get('date_from'),
                'date_to' => $request->get('date_to'),
            ]
        ]);
    }

    /**
     * Get login statistics for the user.
     */
    public function statistics(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $statistics = $this->getDetailedStatistics($user);

        return response()->json($statistics);
    }

    /**
     * Get detailed statistics for the user.
     */
    private function getDetailedStatistics($user): array
    {
        $now = now();
        
        // Basic statistics
        $totalLogins = LoginActivity::where('user_id', $user->id)->count();
        $lastLogin = LoginActivity::where('user_id', $user->id)
            ->orderBy('login_at', 'desc')
            ->first();
        
        // Recent activity
        $loginsToday = LoginActivity::where('user_id', $user->id)
            ->where('login_at', '>=', $now->startOfDay())
            ->count();
        
        $loginsThisWeek = LoginActivity::where('user_id', $user->id)
            ->where('login_at', '>=', $now->startOfWeek())
            ->count();
        
        $loginsThisMonth = LoginActivity::where('user_id', $user->id)
            ->where('login_at', '>=', $now->startOfMonth())
            ->count();

        // Activity type breakdown
        $activityTypes = LoginActivity::where('user_id', $user->id)
            ->select('activity_type', \DB::raw('count(*) as count'))
            ->groupBy('activity_type')
            ->pluck('count', 'activity_type')
            ->toArray();

        // Device breakdown
        $devices = LoginActivity::where('user_id', $user->id)
            ->select('device', \DB::raw('count(*) as count'))
            ->groupBy('device')
            ->orderBy('count', 'desc')
            ->pluck('count', 'device')
            ->toArray();

        // Browser breakdown
        $browsers = LoginActivity::where('user_id', $user->id)
            ->select('browser', \DB::raw('count(*) as count'))
            ->groupBy('browser')
            ->orderBy('count', 'desc')
            ->pluck('count', 'browser')
            ->toArray();

        // Location breakdown
        $locations = LoginActivity::where('user_id', $user->id)
            ->select('location', \DB::raw('count(*) as count'))
            ->whereNotNull('location')
            ->where('location', '!=', 'Unknown Location')
            ->groupBy('location')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->pluck('count', 'location')
            ->toArray();

        // Failed login attempts
        $failedLogins = LoginActivity::where('user_id', $user->id)
            ->where('successful', false)
            ->count();

        // Recent failed attempts
        $recentFailedLogins = LoginActivity::where('user_id', $user->id)
            ->where('successful', false)
            ->where('login_at', '>=', $now->subDays(7))
            ->count();

        return [
            'total_logins' => $totalLogins,
            'last_login' => $lastLogin?->login_at,
            'last_login_details' => $lastLogin ? [
                'ip_address' => $lastLogin->ip_address,
                'device' => $lastLogin->device,
                'browser' => $lastLogin->browser,
                'location' => $lastLogin->location,
                'successful' => $lastLogin->successful,
                'activity_type' => $lastLogin->activity_type,
            ] : null,
            'logins_today' => $loginsToday,
            'logins_this_week' => $loginsThisWeek,
            'logins_this_month' => $loginsThisMonth,
            'activity_types' => $activityTypes,
            'devices' => $devices,
            'browsers' => $browsers,
            'locations' => $locations,
            'failed_logins' => $failedLogins,
            'recent_failed_logins' => $recentFailedLogins,
            'success_rate' => $totalLogins > 0 ? round((($totalLogins - $failedLogins) / $totalLogins) * 100, 2) : 100,
        ];
    }

    /**
     * Export login activity data.
     */
    public function export(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $activities = LoginActivity::where('user_id', $user->id)
            ->orderBy('login_at', 'desc')
            ->get();

        $data = $activities->map(function ($activity) {
            return [
                'Date/Time' => $activity->login_at->format('Y-m-d H:i:s'),
                'Activity Type' => ucfirst(str_replace('_', ' ', $activity->activity_type ?? 'login')),
                'Status' => $activity->successful ? 'Success' : 'Failed',
                'IP Address' => $activity->ip_address,
                'Device' => $activity->device,
                'Browser' => $activity->browser,
                'Platform' => $activity->platform,
                'Location' => $activity->location,
            ];
        });

        return response()->json([
            'data' => $data,
            'filename' => 'login-activity-' . $user->username . '-' . now()->format('Y-m-d') . '.json',
        ]);
    }

    /**
     * Clear old login activity records.
     */
    public function clear(Request $request): JsonResponse
    {
        $request->validate([
            'days' => 'required|integer|min:30|max:365',
        ]);

        $user = $request->user();
        $days = $request->days;

        $deleted = LoginActivity::where('user_id', $user->id)
            ->where('login_at', '<', now()->subDays($days))
            ->delete();

        return response()->json([
            'message' => "Deleted {$deleted} old activity records",
            'deleted_count' => $deleted,
        ]);
    }
}
