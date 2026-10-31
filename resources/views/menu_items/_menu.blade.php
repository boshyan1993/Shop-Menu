@if($items->count())

<ul
    class="menu-sortable space-y-3 {{ $level === 0 ? '' : 'mt-3 border-l border-slate-200 pl-4' }}"
    data-level="{{ $level }}"
>

    @foreach($items as $item)

        <li
            class="menu-draggable rounded-xl border border-slate-200 bg-slate-50/80 p-3 shadow-sm transition hover:border-violet-200 hover:bg-violet-50/50"
            data-menu-id="{{ $item->id }}"
        >

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    
                    <span
                        class="drag-handle cursor-grab select-none text-xl text-slate-400 hover:text-violet-600"
                        draggable="true"
                    >
                        ⠿
                    </span>


                    <a
                        href="{{ $item->url ?? '#' }}"
                        class="text-base font-semibold text-slate-800 transition hover:text-violet-600"
                    >

                        @if (app()->getLocale() === 'ru')
                            {{ $item->title_ru }}
                        @elseif (app()->getLocale() === 'en')
                            {{ $item->title_en }}
                        @else
                            {{ $item->title_hy }}
                        @endif

                    </a>

                </div>


                <div class="flex flex-wrap items-center gap-2">

                    <a
                        href="{{ route('menu-items.show', $item->id) }}"
                        class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 transition hover:border-slate-300 hover:bg-slate-100"
                    >
                        {{ __('menu.view') }}
                    </a>


                    <a
                        href="{{ route('menu-items.edit', $item->id) }}"
                        class="inline-flex items-center rounded-lg border border-violet-200 bg-violet-50 px-3 py-1.5 text-xs font-medium text-violet-700 transition hover:border-violet-300 hover:bg-violet-100"
                    >
                        {{ __('menu.edit') }}
                    </a>


                    <form
                        action="{{ route('menu-items.destroy', $item->id) }}"
                        method="POST"
                        class="delete-form"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex items-center rounded-lg border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 transition hover:border-rose-300 hover:bg-rose-100"
                        >
                            {{ __('menu.delete') }}
                        </button>

                    </form>

                </div>

            </div>


            @if($item->children->count())

                @include('menu_items._menu', [
                    'items' => $item->children,
                    'level' => $level + 1
                ])

            @endif

        </li>

    @endforeach

</ul>

@endif