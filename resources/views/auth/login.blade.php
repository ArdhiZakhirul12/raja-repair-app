<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
            <img src="{{ asset('images/raja_repair.svg') }}" alt="logo" class="h-20">
        </x-slot>

        <x-validation-errors class="mb-4" />


        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 end-0 flex items-center px-2">
                        <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path id="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path id="eye-open-line" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.837-.684 1.63-1.208 2.344M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('password');
                    const passwordEye = document.getElementById('password-eye');
                    const eyeOpen = document.getElementById('eye-open');
                    const eyeOpenLine = document.getElementById('eye-open-line');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeOpen.setAttribute('d', 'M12 4.5c-4.477 0-8.268 2.943-9.542 7 .274.837.684 1.63 1.208 2.344M15 12a3 3 0 11-6 0 3 3 0 016 0z');
                        eyeOpenLine.setAttribute('d', 'M3 3l18 18');
                    } else {
                        passwordInput.type = 'password';
                        eyeOpen.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z');
                        eyeOpenLine.setAttribute('d', 'M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.837-.684 1.63-1.208 2.344M15 12a3 3 0 11-6 0 3 3 0 016 0z');
                    }
                }
            </script>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

    
    </x-authentication-card>
    
    
</x-guest-layout>
