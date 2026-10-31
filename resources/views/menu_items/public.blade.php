<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @if (app()->getLocale() === 'ru')
            {{ $menuItem->title_ru ?: $menuItem->title }}
        @elseif (app()->getLocale() === 'en')
            {{ $menuItem->title_en ?: $menuItem->title }}
        @else
            {{ $menuItem->title_hy ?: $menuItem->title }}
        @endif
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    {{-- Language Switcher --}}
    <div class="flex justify-end px-6 pt-6">
        <div class="flex items-center gap-2">

            <a
                href="{{ route('language.switch', 'hy') }}"
                class="text-2xl transition hover:scale-110"
                title="Հայերեն"
            >
                🇦🇲
            </a>

            <a
                href="{{ route('language.switch', 'ru') }}"
                class="text-2xl transition hover:scale-110"
                title="Русский"
            >
                🇷🇺
            </a>

            <a
                href="{{ route('language.switch', 'en') }}"
                class="text-2xl transition hover:scale-110"
                title="English"
            >
                🇬🇧
            </a>

        </div>
    </div>


    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Back --}}
        <div class="mb-6">

            <a
                href="{{ route('home') }}"
                class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                ←
                {{ __('menu.back_home') }}
            </a>

        </div>


        {{-- Category Header --}}
        <div class="mb-10">

            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
                {{ __('menu.category') }}
            </p>

            <h1 class="mt-2 text-4xl font-bold text-slate-900">

                @if (app()->getLocale() === 'ru')
                    {{ $menuItem->title_ru ?: $menuItem->title }}
                @elseif (app()->getLocale() === 'en')
                    {{ $menuItem->title_en ?: $menuItem->title }}
                @else
                    {{ $menuItem->title_hy ?: $menuItem->title }}
                @endif

            </h1>

            <a
    href="{{ route('products.create', ['menu_item_id' => $menuItem->id]) }}"
    class="mt-5 inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"
>
    + {{ __('menu.add_product') }}
</a>

        </div>


        
        @if ($menuItem->children->count())

            <div class="mb-10">

                <h2 class="mb-4 text-2xl font-bold text-slate-900">
                    {{ __('menu.subcategories') }}
                </h2>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                    @foreach ($menuItem->children as $child)

                        <a
                            href="{{ route('menu.show', $child->id) }}"
                            class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                        >

                            <h3 class="text-lg font-semibold text-slate-900">

                                @if (app()->getLocale() === 'ru')
                                    {{ $child->title_ru ?: $child->title }}
                                @elseif (app()->getLocale() === 'en')
                                    {{ $child->title_en ?: $child->title }}
                                @else
                                    {{ $child->title_hy ?: $child->title }}
                                @endif

                            </h3>

                        </a>

                    @endforeach

                </div>

            </div>

        @endif


        
        <div>

            <h2 class="mb-6 text-2xl font-bold text-slate-900">
                {{ __('menu.products') }}
            </h2>


            @if ($products->count())

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($products as $product)

                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                            @if ($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="h-64 w-full object-contain bg-slate-50"
                                >

                            @else

                                <div class="flex h-64 items-center justify-center bg-slate-50 text-slate-400">
                                    {{ __('menu.no_image') }}
                                </div>

                            @endif


                            <div class="p-6">

                                <h3 class="text-xl font-bold text-slate-900">
                                    {{ $product->name }}
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    @if (app()->getLocale() === 'ru')
    {{ $product->description_ru ?: $product->description }}
@elseif (app()->getLocale() === 'en')
    {{ $product->description_en ?: $product->description }}
@else
    {{ $product->description_hy ?: $product->description }}
@endif
                                </p>

                                <p class="mt-4 text-xl font-bold text-indigo-600">
                                    {{ number_format($product->price, 0, '.', ' ') }} ֏
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

                    <p class="text-lg font-medium text-slate-500">
                        {{ __('menu.empty_category') }}
                    </p>

                </div>

            @endif

        </div>

    </div>

</body>

</html>