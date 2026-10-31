<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ __('menu.title') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

<x-language-switcher />

<div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-600">
                {{ __('menu.navigation') }}
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                {{ __('menu.title') }}
            </h1>

        </div>


        <a
            href="{{ route('menu-items.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-violet-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-500/20 transition hover:bg-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2"
        >
            {{ __('menu.add') }}
        </a>

    </div>


    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/60 sm:p-7">

        @include('menu_items._menu', [
            'items' => $items,
            'level' => 0
        ])

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', () => {

    console.log('DRAG SCRIPT WORKING');

    let dragged = null;

    document.querySelectorAll('.drag-handle').forEach(handle => {

        handle.addEventListener('dragstart', e => {

            dragged = handle.closest('.menu-draggable');

            if (!dragged) return;

            console.log('DRAG START:', dragged.dataset.menuId);

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData(
                'text/plain',
                dragged.dataset.menuId
            );
        });

    });


    document.querySelectorAll('.menu-sortable').forEach(list => {

        list.addEventListener('dragover', e => {

            if (!dragged) return;

            const target = e.target.closest('.menu-draggable');

            if (!target) return;

            if (target === dragged) return;

            /*
             * Չթողնել, որ տարրը տեղափոխվի
             * իր սեփական child-ի մեջ։
             */
            if (dragged.contains(list)) {
                return;
            }

            /*
             * Աշխատում ենք միայն նույն մակարդակի
             * տարրերի հետ։
             */
            if (target.parentElement !== list) {
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            const rect = target.getBoundingClientRect();

            if (e.clientY < rect.top + rect.height / 2) {

                if (dragged !== target.previousElementSibling) {
                    list.insertBefore(dragged, target);
                }

            } else {

                const next = target.nextSibling;

                if (next !== dragged) {
                    list.insertBefore(dragged, next);
                }

            }

        });


        list.addEventListener('drop', async e => {

            e.preventDefault();
            e.stopPropagation();

            if (!dragged) return;

            /*
             * Ստանում ենք միայն այս մակարդակի
             * menu item-ները։
             */
            const items = [...list.children]
                .filter(el => {
                return el.classList.contains('menu-draggable')
                && el.parentElement === list;
            })
               .map((el, index) => ({
               id: el.dataset.menuId,
               sort_order: index
            }));

            console.log('SENDING:', items);

            try {

                const response = await fetch(
                    '{{ route("menu-items.reorder") }}',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },

                        body: JSON.stringify({
                            items: items
                        })
                    }
                );

                const result = await response.json();

                console.log('SERVER:', result);

                if (!response.ok) {

                    console.error('ERROR:', result);

                    alert('Դասավորությունը չպահպանվեց։');
                }

            } catch (error) {

                console.error('FETCH ERROR:', error);

                alert('Սխալ տեղի ունեցավ։');
            }

            dragged = null;
        });

    });

});
</script>

</body> 
</html>