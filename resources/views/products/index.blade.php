<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ապրանքներ</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    <x-language-switcher />

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
                    {{ __('products.catalog') }}
                </p>

                <h1 class="mt-2 text-3xl font-bold text-slate-900">
                   {{ __('products.title') }}
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    {{ __('products.description') }}
                </p>
            </div>

            <a
                href="{{ route('products.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
               + {{ __('products.add') }}
            </a>

        </div>

       
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        
        @if($errors->any())
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="mb-2 font-semibold">
                    {{ __('products.errors') }}
                </p>

                <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Որոնում և ֆիլտրեր --}}
<form action="{{ route('products.index') }}" method="GET"
      class="mb-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Ապրանքի անվան որոնում --}}
        <div>
            <label for="search" class="mb-2 block text-sm font-semibold text-slate-700">
                	{{ __('products.search') }} 
            </label>
            <input
                type="text"
                name="search"
                id="search"
                value="{{ request('search') }}"
                placeholder="{{ __('products.search_placeholder') }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            >
        </div>

        {{-- Կատեգորիայի ֆիլտր --}}
        <div>
            <label for="menu_item_id" class="mb-2 block text-sm font-semibold text-slate-700">
                {{ __('products.category_filter') }}            
            </label>
            <select
                name="menu_item_id"
                id="menu_item_id"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            >
                <option value="">{{ __('products.all_categories') }}</option>

                @foreach($menuItems as $menuItem)
                    <option
                        value="{{ $menuItem->id }}"
                        @selected((string) request('menu_item_id') === (string) $menuItem->id)
                    >
                        {{ app()->getLocale() === 'ru'
                            ? ($menuItem->title_ru ?: $menuItem->title)
                            : (app()->getLocale() === 'en'
                                ? ($menuItem->title_en ?: $menuItem->title)
                                : ($menuItem->title_hy ?: $menuItem->title)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Նվազագույն գին --}}
        <div>
            <label for="min_price" class="mb-2 block text-sm font-semibold text-slate-700">
                {{ __('products.min_price') }}
            </label>
            <input
                type="number"
                name="min_price"
                id="min_price"
                min="0"
                step="any"
                value="{{ request('min_price') }}"
                placeholder="{{ __('products.min_price_placeholder') }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            >
        </div>

        {{-- Առավելագույն գին --}}
        <div>
            <label for="max_price" class="mb-2 block text-sm font-semibold text-slate-700">
                {{ __('products.max_price') }}          
            </label>
            <input
                type="number"
                name="max_price"
                id="max_price"
                min="0"
                step="any"
                value="{{ request('max_price') }}"
                placeholder="{{ __('products.max_price_placeholder') }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            >
        </div>

    </div>

    <div class="mt-5 flex flex-wrap gap-3">
        <button
            type="submit"
            class="rounded-xl bg-indigo-600 px-6 py-3 font-semibold text-white transition hover:bg-indigo-500"
        >
            🔍 {{ __('products.search_button') }}   
        </button>

        <a
            href="{{ route('products.index') }}"
            class="rounded-xl border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-50"
        >
            {{ __('products.clear_filters') }}
        </a>
    </div>
</form>

        @if($products->count())

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        
                        <thead class="bg-slate-50">

                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    {{ __('products.image') }}
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    {{ __('products.name') }}
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    {{ __('products.product_description') }}    
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    {{ __('products.price') }}
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                    {{ __('products.actions') }}        
                                </th>
                            </tr>

                        </thead>

                       
                        <tbody class="divide-y divide-slate-100 bg-white">

                            @foreach($products as $product)

                                <tr class="transition hover:bg-slate-50">

                                    
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                        {{ $product->id }}
                                    </td>

                                  
                                    <td class="px-6 py-4">

                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-16 w-16 rounded-xl border border-slate-200 object-cover shadow-sm"
                                                loading="lazy"
                                            >

                                        @else

                                            <div class="flex h-16 w-16 items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-center text-xs text-slate-400">
                                                {{ __('products.no_image') }}           
                                            </div>

                                        @endif

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="text-sm font-semibold text-slate-900">
                                            {{ $product->name }}
                                        </div>

                                    </td>

                                    
                                    <td class="px-6 py-4 text-sm text-slate-600">

                                        <div class="max-w-md">
                                            @if (app()->getLocale() === 'ru')
    {{ $product->description_ru ?: $product->description }}
@elseif (app()->getLocale() === 'en')
    {{ $product->description_en ?: $product->description }}
@else
    {{ $product->description_hy ?: $product->description }}
@endif
                                        </div>

                                    </td>

                                   
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-bold text-indigo-600">

                                        {{ number_format($product->price, 0, '.', ' ') }} ֏

                                    </td>

                                    
                                    <td class="px-6 py-4">

                                        <div class="flex flex-wrap items-center gap-2">

                                            
                                            <a
                                                href="{{ route('products.show', $product->id) }}"
                                                class="inline-flex items-center rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 transition hover:border-slate-300 hover:bg-slate-100"
                                            >
                                                {{ __('products.view') }}                                       
                                            </a>

                                           
                                            <a
                                                href="{{ route('products.edit', $product->id) }}"
                                                class="inline-flex items-center rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700 transition hover:border-indigo-300 hover:bg-indigo-100"
                                            >
                                                {{ __('products.edit') }}
                                            </a>

                                       
                                            <form
                                                action="{{ route('products.destroy', $product->id) }}"
                                                method="POST"
                                                class="product-delete-form"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center rounded-lg border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 transition hover:border-rose-300 hover:bg-rose-100"
                                                >
                                                    {{ __('products.delete') }}
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

    
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center shadow-sm">

                <div class="mb-4 text-5xl">
                    📦
                </div>

                <h2 class="text-lg font-semibold text-slate-800">
                    {{ __('products.empty_title') }}
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    {{ __('products.empty_description') }}  
                </p>

                <a
                    href="{{ route('products.create') }}"
                    class="mt-5 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"
                >
                    + {{ __('products.add_first') }}
                </a>

            </div>

        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const deleteForms = document.querySelectorAll('.product-delete-form');

            deleteForms.forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    const confirmed = confirm(
                        '{{ __('products.delete_confirm') }}'
                    );

                    if (!confirmed) {
                        event.preventDefault();
                    }

                });

            });

        });
    </script>

</body>
</html>
