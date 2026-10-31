<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ __('home.site_title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        a {
            text-decoration: none;
        }

        .public-header {
            background: #111827;
            color: white;
        }

        .public-container {
            width: min(1200px, 92%);
            margin: auto;
        }

        .header-inner {
            min-height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .site-logo a {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .user-navigation {
            flex: 1;
        }

        .user-menu-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .user-menu-item {
            position: relative;
        }

        .user-menu-link {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            transition: 0.2s;
            white-space: nowrap;
        }

        .user-menu-link:hover {
            background: #374151;
        }

        .menu-arrow {
            font-size: 18px;
        }

        .user-submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            background: white;
            padding: 8px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .user-menu-item:hover > .user-submenu {
            display: block;
        }

        .user-submenu .user-menu-list {
            display: block;
        }

        .user-submenu .user-menu-link {
            color: #1f2937;
            justify-content: space-between;
            width: 100%;
        }

        .user-submenu .user-menu-link:hover {
            background: #f3f4f6;
        }

        .user-submenu .user-submenu {
            top: -8px;
            left: 100%;
        }

        .auth-area {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .auth-user {
            color: white;
            font-weight: bold;
        }

        .auth-link {
            color: white;
            padding: 9px 12px;
            border-radius: 7px;
        }

        .auth-link:hover {
            background: #374151;
        }

        .admin-link {
            background: #0f766e;
            color: white;
            padding: 9px 13px;
            border-radius: 7px;
            font-weight: bold;
        }

        .admin-link:hover {
            background: #115e59;
        }

        .logout-button {
            border: none;
            background: #dc2626;
            color: white;
            padding: 9px 13px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        .hero {
            background: white;
            padding: 80px 0;
        }

        .hero h1 {
            font-size: 48px;
            margin: 0 0 20px;
        }

        .hero p {
            color: #6b7280;
            font-size: 18px;
        }

        .eyebrow {
            color: #0f766e;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 2px;
        }


        /* PRODUCTS */

        .products-section {
            padding: 70px 0;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .product-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.07);
            transition: 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-card h3 {
            margin-top: 0;
        }

        .product-card p {
            color: #6b7280;
            line-height: 1.6;
        }

        .product-price {
            display: block;
            margin-top: 20px;
            color: #0f766e;
            font-size: 21px;
        }

        .public-footer {
            background: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 30px;
        }


        /* RESPONSIVE */

        @media (max-width: 1100px) {

            .header-inner {
                flex-wrap: wrap;
                padding: 20px 0;
            }

            .user-navigation {
                order: 3;
                width: 100%;
                flex-basis: 100%;
            }

            .auth-area {
                margin-left: auto;
            }

        }

        @media (max-width: 900px) {

            .user-menu-list {
                flex-wrap: wrap;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .header-inner {
                flex-direction: column;
                align-items: stretch;
            }

            .auth-area {
                justify-content: center;
                flex-wrap: wrap;
            }

            .user-menu-list {
                justify-content: center;
            }

            .hero h1 {
                font-size: 36px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>
 @include('components.language-switcher')

<header class="public-header">

    <div class="public-container header-inner">

        <div class="site-logo">

            <a href="{{ route('home') }}">
                {{ __('home.site_title') }}
            </a>

        </div>

        <nav class="user-navigation">

            @include('components.menu', [
                'items' => $menuItems
            ])

        </nav>

        <div class="auth-area">

            @auth

                <span class="auth-user">
                    👤 {{ auth()->user()->name }}
                </span>


                @if(auth()->user()->role === 'admin')

                    <a
                        class="admin-link"
                        href="{{ route('admin.index') }}"
                    >
                        {{ __('home.admin') }}
                    </a>

                @endif


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-button"
                    >
                        {{ __('home.logout') }}
                    </button>

                </form>


            @else

                <a
                    class="auth-link"
                    href="{{ route('login') }}"
                >
                    {{ __('home.login') }}
                </a>


                <a
                    class="auth-link"
                    href="{{ route('register') }}"
                >
                    {{ __('home.register') }}
                </a>

            @endauth

        </div>


    </div>

</header>



<main>

    <section class="hero">

        <div class="public-container">

            <p class="eyebrow">
                {{ __('home.welcome_label') }}
            </p>

            <h1>
                {{ __('home.welcome') }}
            </h1>

            <p>
                {{ __('home.description') }}
            </p>

        </div>

    </section>



    {{-- PRODUCTS --}}

    <section class="products-section">

        <div class="public-container">

            <p class="eyebrow">
                {{ __('home.products_label') }}
            </p>

            <h2>
                 {{ __('home.products') }}
            </h2>

            <br>


            @if ($products->count())

                <div class="products-grid">

                    @foreach ($products as $product)

                        <article class="product-card">

                            <h3>
                                {{ $product->name }}
                            </h3>

                           @php
                           $locale = app()->getLocale();

                            $description = match ($locale) {
                            'ru' => $product->description_ru,
                            'en' => $product->description_en,
                            default => $product->description_hy ?: $product->description,
                        };

                            $description = $description
                            ?: $product->description
                            ?: $product->description_hy
                            ?: $product->description_ru
                            ?: $product->description_en;

                        @endphp

                    <p>
                      {{ $description }}
                    </p>

                            <strong class="product-price">
                                {{ number_format($product->price, 0, '.', ' ') }} ֏
                            </strong>

                        </article>

                    @endforeach

                </div>

            @else

                <p>
                    {{ __('home.no_products') }}
                </p>

            @endif

        </div>

    </section>


</main>



<footer class="public-footer">

    <p>
        © {{ date('Y') }} Shop Menu
    </p>

</footer>


</body>

</html>