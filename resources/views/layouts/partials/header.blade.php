<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold text-gray-900 hover:text-gray-700 transition-colors">
                    {{ config('app.name', 'Logo') }}
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-4">
                <nav class="flex space-x-8">
                    <x-cms-menu name="main" />
                </nav>
                <x-language-switcher />
            </div>

            {{-- Mobile menu button and Language Switcher --}}
            <div class="md:hidden flex items-center space-x-2">
                <x-language-switcher />
                <button type="button"
                        class="text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 p-2"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2">
                <x-cms-menu name="main" />
            </div>
        </div>
    </div>

    {{-- Content Region for custom header content --}}
    <div class="border-t border-gray-100">
        <x-cms-content-region name="header" />
    </div>
</header>
