<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-wrap items-center justify-between min-h-16 py-3 gap-4">

            
            <a href="{{ route('home') }}"
               class="text-xl font-bold text-gray-800 hover:text-blue-600">
                Shop Menu
            </a>

            
            <div class="flex flex-wrap items-center gap-4">

                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-blue-600">
                    {{ __('navigation.home') }}
                </a>

                <a href="{{ route('products.index') }}"
                   class="text-gray-700 hover:text-blue-600">
                    {{ __('navigation.products') }}
                </a>

                <a href="{{ route('menu-items.index') }}"
                   class="text-gray-700 hover:text-blue-600">
                    {{ __('navigation.menu') }}
                </a>

                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.index') }}"
                           class="text-gray-700 hover:text-blue-600">
                            {{ __('navigation.admin') }}
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                           class="text-gray-700 hover:text-blue-600">
                            {{ __('navigation.users') }}
                        </a>
                    @endif
                @endauth

            </div>

            
            <div class="flex items-center gap-2">
                <a href="{{ route('language.switch', 'hy') }}"
                   title="Հայերեն"
                   class="rounded-lg bg-gray-100 px-3 py-2 hover:bg-gray-200">
                    🇦🇲
                </a>

                <a href="{{ route('language.switch', 'ru') }}"
                   title="Русский"
                   class="rounded-lg bg-gray-100 px-3 py-2 hover:bg-gray-200">
                    🇷🇺
                </a>

                <a href="{{ route('language.switch', 'en') }}"
                   title="English"
                   class="rounded-lg bg-gray-100 px-3 py-2 hover:bg-gray-200">
                    🇬🇧
                </a>
            </div>

            
            <div class="flex items-center gap-3">

                @auth
                    <span class="text-sm text-gray-700">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="rounded-lg bg-red-500 px-3 py-2 text-white hover:bg-red-600">
                            {{ __('navigation.logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-blue-600">
                        {{ __('navigation.login') }}
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-lg bg-blue-600 px-3 py-2 text-white hover:bg-blue-700">
                        {{ __('navigation.register') }}
                    </a>
                @endauth

            </div>

        </div>
    </div>
</nav>
