<!DOCTYPE html> 
<html lang="{{ app()->getLocale() }}"> 
    <head> <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" > 
        <title>{{ __('products.edit_title') }}</title> 
        
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
    </head> 
    
    <body class="min-h-screen bg-slate-100 text-slate-800 antialiased">  
        
        <div class="flex justify-end px-6 pt-6"> 
            <div class="flex items-center gap-2"> 
                
                <a 
                href="{{ route('language.switch', 'hy') }}" 
                class="text-2xl transition hover:scale-110" 
                title="Հայերեն" 
                > 
                🇦🇲 
            </a> 
            
            <a 
            href="{{ route('language.switch', 'ru') }}" 
            class="text-2xl transition hover:scale-110" 
            title="Русский" 
            > 
            🇷🇺 
        </a> 
        
        <a 
        href="{{ route('language.switch', 'en') }}" 
        class="text-2xl transition hover:scale-110" 
        title="English" 
        > 
        🇬🇧 
       </a> 
    </div> 
</div> 

   <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8"> 
    <div class="mb-6"> 
        
        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">
            Catalog 
        </p> 
        
        <h1 class="mt-2 text-3xl font-bold text-slate-900"> 
            {{ __('products.edit_title') }} 
        </h1> 
        
        <p class="mt-2 text-slate-500"> 
            {{ __('products.edit_description') }} 
        </p> </div>  
        
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">  
            
            @if ($errors->any()) 
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700"> 
                
                <p class="mb-2 font-semibold"> 
                    {{ __('products.validation_error') }} 
                </p> <ul class="list-disc space-y-1 pl-5">
                    
                    @foreach ($errors->all() as $error) 
                    
                    <li> 
                        {{ $error }} 
                    </li> 
                    
                    @endforeach 
                </ul> 
            </div> 
            @endif 
            
            <form 
            action="{{ route('products.update', $product->id) }}" 
            method="POST" 
            enctype="multipart/form-data" 
            class="space-y-6" 
            > 
            
            @csrf 
            
            @method('PUT')  
            
            <div> 
                
                <label 
                for="name" class="mb-2 block text-sm font-medium text-slate-700" 
                > 
                {{ __('products.name') }} 
            </label> 
            
            <input
            type="text" 
            id="name" 
            name="name" 
            value="{{ old('name', $product->name) }}" 
            required 
            maxlength="255" 
            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200" 
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
    >{{ old('description_hy', $product->description_hy) }}</textarea>

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
    >{{ old('description_ru', $product->description_ru) }}</textarea>

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
    >{{ old('description_en', $product->description_en) }}</textarea>

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
    Բաժին 
</label> 

<select 
id="menu_item_id" 
name="menu_item_id" 
required 
class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200" 
> 

<option value=""> 
    Ընտրիր բաժինը 
</option> 

@foreach ($menuItems as $menuItem) 

<option 
value="{{ $menuItem->id }}" 
{{ old('menu_item_id', $product->menu_item_id) == $menuItem->id ? 'selected' : '' }} 
> 
{{ $menuItem->title }} 
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
    {{ __('products.price') }} (֏) 
</label> 

<input 
type="number" 
id="price" 
name="price" 
step="0.01"
 min="0" 
 value="{{ old('price', $product->price) }}" 
 required 
 class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200" 
 > 
 
 @error('price') 
 
   <p class="mt-2 text-sm text-rose-600"> 
    {{ $message }} 
   </p> @enderror 
</div>  

<div> 
    
    <label 
    class="mb-3 block text-sm font-medium text-slate-700"
    > 
    {{ __('products.current_image') }} 

    </label> 
    
    @if ($product->image) 
    
    <img 
    src="{{ asset('storage/' . $product->image) }}" 
    alt="{{ $product->name }}" 
    class="mb-4 h-56 w-full rounded-xl border border-slate-200 bg-slate-50 object-contain" 
    > 
    
    @else 
    
    <div class="mb-4 flex h-56 items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-400"> 
        {{ __('products.no_image') }} 
    </div> 
    
    @endif 
</div>  

<div> 
    
    <label 
    for="image" 
    class="mb-2 block text-sm font-medium text-slate-700" 
    > 
    {{ __('products.upload_new_image') }} 
</label> 

<input 
type="file" 
id="image" 
name="image" 
accept=".jpg,.jpeg,.png,.webp" 
class="block w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200" 
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

<div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row"> 
    
    <button 
    type="submit" 
    class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" 
    > 
    {{ __('products.save_changes') }} 
</button> 

<a 
href="{{ route('products.index') }}" 
class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50" 
> 
{{ __('products.back_to_products') }} 
</a> 
</div> 
</form> 
</div> 
</div> 
</body> 
</html>
