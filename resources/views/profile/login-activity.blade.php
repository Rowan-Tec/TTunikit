<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Login Activity') }}
            </h2>
            <div class="flex space-x-3">
                <button onclick="exportActivity()" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    <i class="fas fa-download mr-2"></i>{{ __('Export') }}
                </button>
                <a href="{{ route('profile.edit') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                    {{ __('Back to Profile') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enhanced Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600">{{ __('Total Logins') }}</p>
                            <p class="text-3xl font-bold text-gray-900" id="total-logins">-</p>
                            <p class="text-xs text-gray-500 mt-1" id="success-rate">-</p>
                        </div>
                        <div class="text-indigo-600 text-4xl">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600">{{ __('Last Login') }}</p>
                            <p class="text-lg font-semibold text-gray-900" id="last-login">-</p>
                            <p class="text-xs text-gray-500 mt-1" id="last-login-device">-</p>
                        </div>
                        <div class="text-green-600 text-4xl">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600">{{ __('This Week') }}</p>
                            <p class="text-3xl font-bold text-gray-900" id="week-logins">-</p>
                            <p class="text-xs text-gray-500 mt-1" id="today-logins">-</p>
                        </div>
                        <div class="text-blue-600 text-4xl">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600">{{ __('Failed Attempts') }}</p>
                            <p class="text-3xl font-bold text-red-600" id="failed-logins">-</p>
                            <p class="text-xs text-gray-500 mt-1" id="recent-failed">-</p>
                        </div>
                        <div class="text-red-600 text-4xl">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Filters') }}</h3>
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Activity Type') }}</label>
                        <select name="activity_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="all" {{ $filters['activity_type'] == 'all' ? 'selected' : '' }}>{{ __('All Activities') }}</option>
                            <option value="login" {{ $filters['activity_type'] == 'login' ? 'selected' : '' }}>{{ __('Login') }}</option>
                            <option value="logout" {{ $filters['activity_type'] == 'logout' ? 'selected' : '' }}>{{ __('Logout') }}</option>
                            <option value="registration" {{ $filters['activity_type'] == 'registration' ? 'selected' : '' }}>{{ __('Registration') }}</option>
                            <option value="password_reset_request" {{ $filters['activity_type'] == 'password_reset_request' ? 'selected' : '' }}>{{ __('Password Reset Request') }}</option>
                            <option value="password_reset_completed" {{ $filters['activity_type'] == 'password_reset_completed' ? 'selected' : '' }}>{{ __('Password Reset') }}</option>
                            <option value="password_changed" {{ $filters['activity_type'] == 'password_changed' ? 'selected' : '' }}>{{ __('Password Changed') }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('From Date') }}</label>
                        <input type="date" name="date_from" value="{{ $filters['date_from'] }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('To Date') }}</label>
                        <input type="date" name="date_to" value="{{ $filters['date_to'] }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            <i class="fas fa-filter mr-2"></i>{{ __('Apply Filters') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Login History Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Login History') }}</h3>

                    @if ($activities->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('Date & Time') }}</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('Activity') }}</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('IP Address') }}</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('Device') }}</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('Location') }}</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-900">{{ __('Browser') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $activity)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $activity->login_at->format('M d, Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $activity->login_at->format('g:i A') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($activity->activity_type === 'login') bg-blue-100 text-blue-800
                                                    @elseif($activity->activity_type === 'logout') bg-gray-100 text-gray-800
                                                    @elseif($activity->activity_type === 'registration') bg-green-100 text-green-800
                                                    @elseif($activity->activity_type === 'password_reset_request') bg-yellow-100 text-yellow-800
                                                    @elseif($activity->activity_type === 'password_reset_completed') bg-purple-100 text-purple-800
                                                    @elseif($activity->activity_type === 'password_changed') bg-indigo-100 text-indigo-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $activity->activity_type ?? 'login')) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($activity->successful)
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        <i class="fas fa-check mr-1"></i>{{ __('Success') }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        <i class="fas fa-times mr-1"></i>{{ __('Failed') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $activity->ip_address ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-600">
                                                    @if($activity->device)
                                                        <i class="fas fa-{{ $activity->device === 'Mobile Device' ? 'mobile-alt' : 'desktop' }} text-blue-500 mr-2"></i>{{ $activity->device }}
                                                    @else
                                                        <i class="fas fa-desktop text-gray-500 mr-2"></i>Unknown
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center text-sm text-gray-900">
                                                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                                    {{ $activity->location ?? 'Unknown' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-600">
                                                    @if($activity->browser)
                                                        {{ $activity->browser }}
                                                    @else
                                                        Unknown
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $activities->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-info-circle text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-600">{{ __('No login activity recorded yet.') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Security Notice -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-900">{{ __('Security Tip') }}</h3>
                        <p class="mt-2 text-sm text-blue-700">
                            {{ __('Review your login activity regularly. If you see any unrecognized logins, change your password immediately and contact support.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Load enhanced statistics
        fetch('{{ route('login-activity.statistics') }}')
            .then(response => response.json())
            .then(data => {
                // Basic statistics
                document.getElementById('total-logins').textContent = data.total_logins;
                document.getElementById('week-logins').textContent = data.logins_this_week;
                document.getElementById('today-logins').textContent = data.logins_today + ' today';
                document.getElementById('failed-logins').textContent = data.failed_logins;
                document.getElementById('recent-failed').textContent = data.recent_failed_logins + ' this week';
                document.getElementById('success-rate').textContent = data.success_rate + '% success rate';
                
                // Last login details
                if (data.last_login) {
                    const date = new Date(data.last_login);
                    const now = new Date();
                    const diffMs = now - date;
                    const diffMins = Math.floor(diffMs / 60000);
                    const diffHours = Math.floor(diffMins / 60);
                    const diffDays = Math.floor(diffHours / 24);

                    let timeAgo;
                    if (diffMins < 1) {
                        timeAgo = 'Just now';
                    } else if (diffMins < 60) {
                        timeAgo = diffMins + ' mins ago';
                    } else if (diffHours < 24) {
                        timeAgo = diffHours + ' hours ago';
                    } else {
                        timeAgo = diffDays + ' days ago';
                    }

                    document.getElementById('last-login').textContent = timeAgo;
                    
                    if (data.last_login_details) {
                        const device = data.last_login_details.device;
                        const browser = data.last_login_details.browser;
                        document.getElementById('last-login-device').textContent = device + ' • ' + browser;
                    }
                } else {
                    document.getElementById('last-login').textContent = 'Never';
                    document.getElementById('last-login-device').textContent = '';
                }
            })
            .catch(error => {
                console.error('Error loading statistics:', error);
            });

        // Export functionality
        function exportActivity() {
            fetch('{{ route('login-activity.export') }}')
                .then(response => response.json())
                .then(data => {
                    // Create and download JSON file
                    const jsonString = JSON.stringify(data.data, null, 2);
                    const blob = new Blob([jsonString], { type: 'application/json' });
                    const url = window.URL.createObjectURL(blob);
                    
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = data.filename;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                    
                    // Show success message
                    showNotification('success', 'Activity data exported successfully!');
                })
                .catch(error => {
                    console.error('Error exporting data:', error);
                    showNotification('error', 'Failed to export activity data');
                });
        }

        // Clear old records functionality
        function clearOldRecords() {
            const days = prompt('Enter number of days (30-365) to keep records for:');
            if (!days) return;
            
            const daysNum = parseInt(days);
            if (daysNum < 30 || daysNum > 365) {
                showNotification('error', 'Please enter a number between 30 and 365');
                return;
            }
            
            if (!confirm(`Are you sure you want to delete activity records older than ${daysNum} days? This action cannot be undone.`)) {
                return;
            }
            
            fetch('{{ route('login-activity.clear') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ days: daysNum })
            })
            .then(response => response.json())
            .then(data => {
                showNotification('success', data.message);
                // Reload page to show updated data
                setTimeout(() => window.location.reload(), 2000);
            })
            .catch(error => {
                console.error('Error clearing records:', error);
                showNotification('error', 'Failed to clear old records');
            });
        }

        // Notification helper
        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed top-4 right-4`;
            notification.style.zIndex = '9999';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 5000);
        }

        // Add clear button to header
        document.addEventListener('DOMContentLoaded', function() {
            const headerDiv = document.querySelector('.flex.justify-between.items-center');
            const clearBtn = document.createElement('button');
            clearBtn.onclick = clearOldRecords;
            clearBtn.className = 'text-sm bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700';
            clearBtn.innerHTML = '<i class="fas fa-trash mr-2"></i>Clear Old Records';
            headerDiv.appendChild(clearBtn);
        });
    </script>
@endpush
</x-app-layout>
