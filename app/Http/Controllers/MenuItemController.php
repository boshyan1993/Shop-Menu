<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
public function index()
{
    $items = MenuItem::with('children')
        ->whereNull('parent_id')
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    return view('menu_items.index', compact('items'));
}

    public function create()
    {
        $menuItems = MenuItem::orderBy('title')->get();

        return view('menu_items.create', compact('menuItems'));
    }

    public function store(Request $request)
    {
$data = $request->validate([
    'title' => ['required', 'string', 'max:255'],
    'title_hy' => ['nullable', 'string', 'max:255'],
    'title_ru' => ['nullable', 'string', 'max:255'],
    'title_en' => ['nullable', 'string', 'max:255'],
    'url' => ['nullable', 'string', 'max:255'],
    'parent_id' => ['nullable', 'exists:menu_items,id'],
    'sort_order' => ['required', 'integer', 'min:0'],
    'is_active' => ['nullable', 'boolean'],
]);

        $data['is_active'] = $request->boolean('is_active');

        MenuItem::create($data);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Մենյուի տարրը հաջողությամբ ավելացվեց։');
    }

    public function show(MenuItem $menuItem)
    {
        return view('menu_items.show', compact('menuItem'));
    }

    public function publicPage(MenuItem $menuItem)
{
    $menuItem->load('children');

    $products = \App\Models\Product::where('menu_item_id', $menuItem->id)
        ->latest()
        ->get();

    return view('menu_items.public', compact('menuItem', 'products'));
}
public function edit(MenuItem $menuItem)
{
    $menuItems = MenuItem::where('id', '!=', $menuItem->id)
        ->orderBy('title')
        ->get();

    return view('menu_items.edit', compact('menuItem', 'menuItems'));
}

    public function update(Request $request, MenuItem $menuItem)
{
    $data = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'title_hy' => ['nullable', 'string', 'max:255'],
        'title_ru' => ['nullable', 'string', 'max:255'],
        'title_en' => ['nullable', 'string', 'max:255'],
        'url' => ['nullable', 'string', 'max:255'],
        'parent_id' => [
            'nullable',
            'exists:menu_items,id',
            function ($attribute, $value, $fail) use ($menuItem) {
                if ($value !== null && (int) $value === (int) $menuItem->id) {
                    $fail('Մենյուի տարրը չի կարող լինել ինքն իր ծնողը։');
                }
            },
        ],
        'sort_order' => ['required', 'integer', 'min:0'],
        'is_active' => ['nullable', 'boolean'],
    ]);

    $data['is_active'] = $request->boolean('is_active');

    $menuItem->update($data);

    return redirect()
        ->route('menu-items.index')
        ->with('success', 'Մենյուի տարրը հաջողությամբ փոփոխվեց։');
}

public function reorder(Request $request)
{
    $data = $request->validate([
        'items' => ['required', 'array', 'min:1'],
        'items.*' => ['required', 'array:id,sort_order'],
        'items.*.id' => ['required', 'integer', 'distinct', 'exists:menu_items,id'],
        'items.*.sort_order' => ['required', 'integer', 'min:0'],
    ]);

    \Illuminate\Support\Facades\DB::transaction(function () use ($data) {
        foreach ($data['items'] as $item) {
            MenuItem::where('id', $item['id'])
                ->update([
                    'sort_order' => $item['sort_order'],
                ]);
        }
    });

    return response()->json([
        'success' => true,
        'message' => 'Մենյուի հերթականությունը պահպանվեց։',
    ]);
}
private function isDescendantOf($item, int $ancestorId): bool
{
    foreach ($item->children as $child) {
        if ((int) $child->id === $ancestorId) {
            return true;
        }

        if ($this->isDescendantOf($child, $ancestorId)) {
            return true;
        }
    }

    return false;
}

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Մենյուի տարրը հաջողությամբ ջնջվեց։');
    }
}
