<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('products.add_title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    <x-language-switcher />

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-6">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
                {{ __('products.catalog') }}
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                {{ __('products.add_title') }}
            </h1>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">

                    <p class="mb-2 font-semibold">
                        {{ __('products.errors') }}
                    </p>

                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <form
                action="{{ route('products.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf

               
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('products.name') }}
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-rose-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                
                <div>

    <label
        for="description_hy"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        Հայերեն նկարագրություն
    </label>

    <textarea
        id="description_hy"
        name="description_hy"
        rows="5"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
    >{{ old('description_hy') }}</textarea>

    @error('description_hy')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>



<div>

    <label
        for="description_ru"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        Ռուսերեն նկարագրություն
    </label>

    <textarea
        id="description_ru"
        name="description_ru"
        rows="5"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
    >{{ old('description_ru') }}</textarea>

    @error('description_ru')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>



<div>

    <label
        for="description_en"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        Անգլերեն նկարագրություն
    </label>

    <textarea
        id="description_en"
        name="description_en"
        rows="5"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
    >{{ old('description_en') }}</textarea>

    @error('description_en')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>
                
<div>
    <label
        for="menu_item_id"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        {{ __('products.category') }}
    </label>

    <select
        id="menu_item_id"
        name="menu_item_id"
        required
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
    >
        <option value="">{{ __('products.select_category') }}</option>

      @foreach($menuItems as $menuItem)

    <option
        value="{{ $menuItem->id }}"
        {{ old('menu_item_id', $selectedMenuItem ?? '') == $menuItem->id ? 'selected' : '' }}
    >
        @if (app()->getLocale() === 'ru')
            {{ $menuItem->title_ru ?: $menuItem->title }}
        @elseif (app()->getLocale() === 'en')
            {{ $menuItem->title_en ?: $menuItem->title }}
        @else
            {{ $menuItem->title_hy ?: $menuItem->title }}
        @endif
    </option>

@endforeach
    
</select>

    @error('menu_item_id')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror
</div>

              
                <div>
                    <label
                        for="price"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('products.price') }}
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        min="0"
                        value="{{ old('price') }}"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

                    @error('price')
                        <p class="mt-2 text-sm text-rose-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

              
                <div>

                    <label
                        for="image"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('products.image') }}
                    </label>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                        <label
                            for="image"
                            class="inline-flex cursor-pointer items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500"
                        >
                            {{ __('products.choose_file') }}
                        </label>

                        <span
                            id="file-name"
                            class="text-sm text-slate-500"
                        >
                            {{ __('products.no_file') }}
                        </span>

                    </div>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="hidden"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        {{ __('products.image_help') }}
                    </p>

                    @error('image')
                        <p class="mt-2 text-sm text-rose-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                
                <div class="flex flex-col gap-3 pt-2 sm:flex-row">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        {{ __('products.add') }}
                    </button>

                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50"
                    >
                        {{ __('products.back') }}
                    </a>

                </div>

            </form>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function () {

            const fileName = document.getElementById('file-name');

            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = @json(__('products.no_file'));
            }

        });
    </script>

</body>
</html>