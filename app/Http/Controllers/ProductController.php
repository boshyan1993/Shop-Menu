<?php 
namespace App\Http\Controllers; 
use App\Models\MenuItem; 
use App\Models\Product; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller 
{ 
    public function index(Request $request)
{
    $query = Product::query();

    // Որոնում ըստ ապրանքի անվան
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Ֆիլտր ըստ կատեգորիայի
    if ($request->filled('menu_item_id')) {
        $query->where('menu_item_id', $request->menu_item_id);
    }

    // Նվազագույն գին
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    // Առավելագույն գին
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->latest()->get();

    $menuItems = MenuItem::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('products.index', compact('products', 'menuItems'));
}
        
  public function create(Request $request)
{
    $menuItems = MenuItem::where('is_active', true)
        ->orderBy('title')
        ->get();

    $selectedMenuItem = $request->query('menu_item_id');

    return view('products.create', compact(
        'menuItems',
        'selectedMenuItem'
    ));
} 
        
    public function store(Request $request) 
    { 
      $data = $request->validate([
    'name' => ['required', 'string', 'max:255'],

    'description' => ['nullable', 'string', 'max:10000'],
    'description_hy' => ['nullable', 'string', 'max:10000'],
    'description_ru' => ['nullable', 'string', 'max:10000'],
    'description_en' => ['nullable', 'string', 'max:10000'],

    'price' => ['required', 'numeric', 'min:0', 'max:999999999.99', 'decimal:0,2'],

    'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

    'menu_item_id' => ['required', 'integer', 'exists:menu_items,id'],
]); 
            
            if ($request->hasFile('image')) { 
                $data['image'] = $request 
                ->file('image') 
                ->store('products', 'public'); 
                } 
                
            Product::create($data); 
            
            return redirect() 
            ->route('products.index') 
            ->with('success', 'Ապրանքը հաջողությամբ ավելացվեց։'); 
            } 
            
        public function show(Product $product) 
        { 
            return view('products.show', compact('product')); 
        } 
        
        public function edit(Product $product) 
        { 
            $menuItems = MenuItem::where('is_active', true) 
            ->orderBy('title') 
            ->get(); 
            
            return view('products.edit', compact('product', 'menuItems')); 
            
            } 
            
        public function update(Request $request, Product $product) 
        { 
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'description_hy' => 'nullable|string',
                'description_ru' => 'nullable|string',
                'description_en' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'menu_item_id' => 'required|exists:menu_items,id',
  ]); 
            
            if ($request->hasFile('image')) { 
                if ($product->image) { 
                    Storage::disk('public')->delete($product->image); 
                    } 
                
                    $data['image'] = $request 
                    ->file('image') 
                    ->store('products', 'public'); 
                    } 
                    
                    $product->update($data); 
                    
                    return redirect() 
                    ->route('products.index') 
                    ->with('success', 'Ապրանքը հաջողությամբ փոփոխվեց։'); 
                    } 
                    
                    public function destroy(Product $product) 
                    { 
                        if ($product->image) { 
                            Storage::disk('public')->delete($product->image); 
                            } 
                            $product->delete(); 
                            return redirect() 
                            ->route('products.index') 
                            ->with('success', 'Ապրանքը հաջողությամբ ջնջվեց։'); 
                            } 
                        }