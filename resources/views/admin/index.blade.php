<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('admin.title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .admin-header {
            background: #111827;
            color: white;
            padding: 20px 180px 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .admin-label {
            color: #9ca3af;
            margin-left: 10px;
        }

        .header-right {
           display: flex;
           align-items: center;
           gap: 15px;
           padding-right: 20px;
        }

        .user-name {
            font-weight: bold;
        }

        .logout-button {
            border: none;
            background: #dc2626;
            color: white;
            padding: 9px 16px;
            border-radius: 7px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        .admin-container {
            max-width: 1200px;
            margin: 45px auto;
            padding: 0 25px;
        }

        .page-title {
            margin-bottom: 10px;
            font-size: 34px;
        }

        .page-description {
            color: #6b7280;
            margin-bottom: 35px;
            font-size: 17px;
        }

        .welcome-box {
            background: white;
            padding: 22px 25px;
            border-radius: 12px;
            margin-bottom: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .welcome-box strong {
            color: #111827;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .admin-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .admin-card {
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.10);
        }

        .admin-card-icon {
            font-size: 38px;
            margin-bottom: 15px;
        }

        .admin-card h3 {
            margin: 0 0 12px;
            font-size: 21px;
        }

        .admin-card p {
            color: #6b7280;
            line-height: 1.6;
            min-height: 52px;
        }

        .admin-card-button {
            display: inline-block;
            margin-top: 12px;
            padding: 11px 18px;
            background: #111827;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .admin-card-button:hover {
            background: #374151;
        }

        .admin-stats {
            margin-top: 45px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
        }

        .stat-label {
            display: block;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .stat-number {
            display: block;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-description {
            color: #9ca3af;
        }

        @media (max-width: 900px) {
            .admin-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .admin-header {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <x-language-switcher />

    <header class="admin-header">

        <div>
            <span class="logo">
                SHOP MENU
            </span>

            <span class="admin-label">
                ADMIN
            </span>
        </div>

        <div class="header-right">

            <span class="user-name">
                👤 {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="logout-button">
                    {{ __('admin.logout') }}
                </button>

            </form>

        </div>

    </header>


    <main class="admin-container">

        <h1 class="page-title">
            {{ __('admin.title') }}
        </h1>

        <p class="page-description">
            {{ __('admin.description') }}
        </p>


        <div class="welcome-box">

            {{ __('admin.welcome') }}

            <strong>
                {{ auth()->user()->name }}
            </strong>

            {{ __('admin.logged_as') }}

        </div>


        <h2 class="section-title">
            {{ __('admin.sections') }}
        </h2>


        <div class="admin-grid">


            <div class="admin-card">

                <div class="admin-card-icon">
                    📦
                </div>

                <h3>
                    {{ __('admin.products_management') }}
                </h3>

                <p>
                    {{ __('admin.products_description') }}
                </p>

                <a
                    href="{{ route('products.index') }}"
                    class="admin-card-button"
                >
                    {{ __('admin.view_products') }}
                </a>

            </div>


            <div class="admin-card">

                <div class="admin-card-icon">
                    📋
                </div>

                <h3>
                    {{ __('admin.menu_management') }}
                </h3>

                <p>
                    {{ __('admin.menu_description') }}
                </p>

                <a
                    href="{{ route('menu-items.index') }}"
                    class="admin-card-button"
                >
                    {{ __('admin.view_menu') }}
                </a>

            </div>


            <div class="admin-card">

                <div class="admin-card-icon">
                    👥
                </div>

                <h3>
                    {{ __('admin.users_management') }}
                </h3>

                <p>
                    {{ __('admin.users_description') }}
                </p>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="admin-card-button"
                >
                    {{ __('admin.view_users') }}
                </a>

            </div>

        </div>


        <section class="admin-stats">

            <h2 class="section-title">
                {{ __('admin.statistics') }}
            </h2>

            <div class="stats-grid">


                <div class="stat-card">

                    <span class="stat-label">
                        {{ __('admin.products') }}
                    </span>

                    <span class="stat-number">
                        {{ $productsCount }}
                    </span>

                    <span class="stat-description">
                        {{ __('admin.products_count') }}
                    </span>

                </div>


                <div class="stat-card">

                    <span class="stat-label">
                        {{ __('admin.menu_items') }}
                    </span>

                    <span class="stat-number">
                        {{ $menuItemsCount }}
                    </span>

                    <span class="stat-description">
                        {{ __('admin.menu_items_count') }}
                    </span>

                </div>

            </div>

        </section>

    </main>

</body>
</html>