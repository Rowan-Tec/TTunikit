<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and contact details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
            <div class="mt-2 flex items-center gap-4">
                @if ($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="h-20 w-20 rounded-lg object-cover">
                @else
                    <div class="h-20 w-20 rounded-lg bg-gray-200 flex items-center justify-center">
                        <svg class="h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
                <div class="flex-1">
                    <input id="profile_photo" name="profile_photo" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" />
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- Full Names -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <x-input-label for="full_names" :value="__('Full Names')" />
                <x-text-input id="full_names" name="full_names" type="text" class="mt-1 block w-full" :value="old('full_names', $user->full_names)" required />
                <x-input-error class="mt-2" :messages="$errors->get('full_names')" />
            </div>

            <div>
                <x-input-label for="surname" :value="__('Surname')" />
                <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $user->surname)" required />
                <x-input-error class="mt-2" :messages="$errors->get('surname')" />
            </div>
        </div>

        <!-- Display Name and Username -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Display Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>
        </div>

        <!-- Email and Cellphone -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <x-input-label for="email" :value="__('Primary Email Address')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <x-input-label for="cellphone" :value="__('Cellphone')" />
                <x-text-input id="cellphone" name="cellphone" type="tel" class="mt-1 block w-full" :value="old('cellphone', $user->cellphone)" required />
                <x-input-error class="mt-2" :messages="$errors->get('cellphone')" />
            </div>
        </div>

        <!-- Date of Birth -->
        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $user->date_of_birth)" required />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <!-- Billing Address -->
        <div>
            <x-input-label for="billing_address" :value="__('Billing Address')" />
            <textarea id="billing_address" name="billing_address" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Enter your billing address">{{ old('billing_address', $user->billing_address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('billing_address')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('Profile updated successfully.') }}</p>
            @endif
        </div>
    </form>
</section>

