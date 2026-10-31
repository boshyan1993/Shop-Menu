@if ($items->count())

    <ul class="user-menu-list">

        @foreach ($items as $item)

            <li class="user-menu-item">

                <a
                    href="{{ route('menu.show', $item->id) }}"
                    class="user-menu-link"
                >

                    <span>
                        @if (app()->getLocale() === 'ru')
                            {{ $item->title_ru ?: $item->title }}
                        @elseif (app()->getLocale() === 'en')
                            {{ $item->title_en ?: $item->title }}
                        @else
                            {{ $item->title_hy ?: $item->title }}
                        @endif
                    </span>

                    @if ($item->children->count())
                        <span class="menu-arrow">›</span>
                    @endif

                </a>

                @if ($item->children->count())

                    <div class="user-submenu">

                        @include('components.menu', [
                            'items' => $item->children
                        ])

                    </div>

                @endif

            </li>

        @endforeach

    </ul>

@endif