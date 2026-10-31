<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('menu.add_title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    <x-language-switcher />

    <div class="page-shell">

        <div class="mb-8">

            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
                {{ __('menu.title') }}
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                {{ __('menu.add_title') }}
            </h1>

        </div>


        <div class="panel-card">

            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">

                    <p class="mb-2 font-semibold">
                        {{ __('menu.errors') }}
                    </p>

                    <ul class="list-disc space-y-1 pl-5">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('menu-items.store') }}"
                method="POST"
                class="space-y-6"
            >

                @csrf


              <div>

    <label
        for="title_hy"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        🇦🇲 {{ __('menu.menu_item_name') }} (Հայերեն)
    </label>

    <input
        type="text"
        name="title_hy"
        id="title_hy"
        value="{{ old('title_hy') }}"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
        placeholder="Օրինակ՝ Ապրանքներ"
    >

    @error('title_hy')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>


<div>

    <label
        for="title_ru"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        🇷🇺 {{ __('menu.menu_item_name') }} (Русский)
    </label>

    <input
        type="text"
        name="title_ru"
        id="title_ru"
        value="{{ old('title_ru') }}"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
        placeholder="Например: Товары"
    >

    @error('title_ru')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>


<div>

    <label
        for="title_en"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        🇬🇧 {{ __('menu.menu_item_name') }} (English)
    </label>

    <input
        type="text"
        name="title_en"
        id="title_en"
        value="{{ old('title_en') }}"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
        placeholder="Example: Products"
    >

    @error('title_en')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>


<div>

    <label
        for="title"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        {{ __('menu.menu_item_name') }} (Հիմնական)
    </label>

    <input
        type="text"
        name="title"
        id="title"
        value="{{ old('title') }}"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
        placeholder="{{ __('menu.example_name') }}"
    >

    @error('title')
        <p class="mt-2 text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror

</div>


                <div>

                    <label
                        for="url"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('menu.url') }}
                    </label>

                    <input
                        type="text"
                        name="url"
                        id="url"
                        value="{{ old('url') }}"
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                        placeholder="{{ __('menu.example_url') }}"
                    >

                    @error('url')

                        <p class="mt-2 text-sm text-rose-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div>

                    <label
                        for="parent_id"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('menu.parent') }}
                    </label>

                    <select
                        name="parent_id"
                        id="parent_id"
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

                        <option value="">
                            {{ __('menu.no_parent') }}
                        </option>


                        @foreach($menuItems as $menuItem)

                            <option
                                value="{{ $menuItem->id }}"
                                {{ old('parent_id') == $menuItem->id ? 'selected' : '' }}
                            >

                                @if (app()->getLocale() === 'ru')
                                    {{ $menuItem->title_ru }}
                                @elseif (app()->getLocale() === 'en')
                                    {{ $menuItem->title_en }}
                                @else
                                    {{ $menuItem->title_hy }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label
                        for="sort_order"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('menu.sort_order') }}
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        id="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

                </div>


                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                    <label class="flex items-center gap-3 text-sm font-medium text-slate-700">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        {{ __('menu.active') }}

                    </label>

                </div>


                <div class="flex flex-col gap-3 pt-2 sm:flex-row">

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        {{ __('menu.save') }}
                    </button>


                    <a
                        href="{{ route('menu-items.index') }}"
                        class="secondary-button"
                    >
                        {{ __('menu.back') }}
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
