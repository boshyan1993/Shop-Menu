<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('menu.title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    <x-language-switcher />

    @php
        $menuTitle = match (app()->getLocale()) {
            'ru' => $menuItem->title_ru,
            'en' => $menuItem->title_en,
            default => $menuItem->title_hy,
        };

        $parentTitle = $menuItem->parent
            ? match (app()->getLocale()) {
                'ru' => $menuItem->parent->title_ru,
                'en' => $menuItem->parent->title_en,
                default => $menuItem->parent->title_hy,
            }
            : null;
    @endphp

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
                {{ __('menu.title') }}
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                {{ $menuTitle }}
            </h1>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">

            <div class="space-y-5">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        {{ __('menu.menu_item_name') }}
                    </p>

                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $menuTitle }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        {{ __('menu.url') }}
                    </p>

                    <p class="mt-1 text-slate-900">
                        {{ $menuItem->url ?: '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        {{ __('menu.parent') }}
                    </p>

                    <p class="mt-1 text-slate-900">
                        {{ $parentTitle ?: __('menu.no_parent') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        {{ __('menu.sort_order') }}
                    </p>

                    <p class="mt-1 text-slate-900">
                        {{ $menuItem->sort_order }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        {{ __('menu.active') }}
                    </p>

                    <p class="mt-1 font-semibold {{ $menuItem->is_active ? 'text-emerald-600' : 'text-rose-600' }}">
                        {{ $menuItem->is_active ? '✓' : '✕' }}
                    </p>
                </div>

            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                <a
                    href="{{ route('menu-items.edit', $menuItem->id) }}"
                    class="rounded-xl bg-indigo-600 px-5 py-3 text-center font-semibold text-white transition hover:bg-indigo-500"
                >
                    {{ __('menu.edit') }}
                </a>

                <a
                    href="{{ route('menu-items.index') }}"
                    class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-center font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    {{ __('menu.back') }}
                </a>

            </div>

        </div>
    </div>

</body>
</html>