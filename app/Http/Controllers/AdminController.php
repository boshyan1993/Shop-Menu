<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MenuItem;

class AdminController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $menuItemsCount = MenuItem::count();

        return view('admin.index', compact(
            'productsCount',
            'menuItemsCount'
        ));
    }
}
