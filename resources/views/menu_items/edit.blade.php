<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('menu.edit_title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    <x-language-switcher />

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8">

            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
                {{ __('menu.title') }}
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                {{ __('menu.edit_title') }}
            </h1>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">

            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">

                    <strong>
                        {{ __('menu.errors') }}
                    </strong>

                    <ul class="mt-2 list-disc space-y-1 pl-5">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('menu-items.update', $menuItem->id) }}"
                method="POST"
                class="space-y-6"
            >

                @csrf
                @method('PUT')


                <div>

                    <label
                        for="title"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        {{ __('menu.menu_item_name') }}
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $menuItem->title) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

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
                        value="{{ old('url', $menuItem->url) }}"
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

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


                        @foreach($menuItems as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('parent_id', $menuItem->parent_id) == $item->id ? 'selected' : '' }}
                            >

                                @if (app()->getLocale() === 'ru')
                                    {{ $item->title_ru }}
                                @elseif (app()->getLocale() === 'en')
                                    {{ $item->title_en }}
                                @else
                                    {{ $item->title_hy }}
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
                        value="{{ old('sort_order', $menuItem->sort_order) }}"
                        min="0"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                    >

                </div>


                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                    <label class="flex items-center gap-3 text-sm font-medium text-slate-700">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $menuItem->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        {{ __('menu.active') }}

                    </label>

                </div>


                <div class="flex flex-col gap-3 pt-2 sm:flex-row">

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white transition hover:bg-indigo-500"
                    >
                        {{ __('menu.update') }}
                    </button>


                    <a
                        href="{{ route('menu-items.index') }}"
                        class="rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        {{ __('menu.back') }}
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>