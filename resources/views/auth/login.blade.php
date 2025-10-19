<x-guest-layout>
    <!-- Título da Página -->
    <div class="text-center mb-4 sm:mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 font-sans">Login</h2>
        <p class="text-gray-600 mt-1 sm:mt-2 text-sm sm:text-base">Acesse sua conta espiritual</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                Email
            </label>
            <input
                id="email"
                class="block w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-oxossi/50 focus:border-oxossi transition-all duration-300"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="seu@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                Senha
            </label>
            <input
                id="password"
                class="block w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-oxossi/50 focus:border-oxossi transition-all duration-300"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Sua senha"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-oxossi shadow-sm focus:ring-oxossi focus:ring-offset-0"
                name="remember"
            >
            <label for="remember_me" class="ml-3 text-sm text-gray-600">
                Lembrar de mim
            </label>
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <!-- Login Button -->
            <button
                type="submit"
                class="w-full bg-oxossi hover:bg-oxossi-dark text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-oxossi/50 shadow-md hover:shadow-lg hover:-translate-y-0.5"
            >
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                </svg>
                Entrar
            </button>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a
                        class="text-sm text-oxossi hover:text-oxossi-dark font-medium transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-oxossi/50 rounded-md px-2 py-1"
                        href="{{ route('password.request') }}"
                    >
                        Esqueceu sua senha?
                    </a>
                </div>
            @endif
        </div>
    </form>

    <!-- Divider -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <p class="text-center text-sm text-gray-600">
            "A fé sem obras é morta"<br>
            <span class="text-oxossi font-medium">Saravá Oxóssi e Ogum!</span>
        </p>
    </div>
</x-guest-layout>
