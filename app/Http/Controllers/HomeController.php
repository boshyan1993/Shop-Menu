<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MenuItem;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        $menuItems = $this->buildMenu();

        return view('home', compact('products', 'menuItems'));
    }

    private function buildMenu($parentId = null)
    {
        return MenuItem::where('parent_id', $parentId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function ($item) {
                $item->children = $this->buildMenu($item->id);

                return $item;
            });
    }
}