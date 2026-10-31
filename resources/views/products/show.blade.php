<!DOCTYPE html> 
<html lang="{{ app()->getLocale() }}"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        
        <title>{{ __('products.show_title') }}</title> 
        
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
    
    </head> 
    
    <body class="bg-slate-100 text-slate-800 antialiased">  
        
        <div class="flex justify-end px-6 pt-6"> 
            
            <div class="flex items-center gap-2"> 
                
            <a href="{{ route('language.switch', 'hy') }}" 
                class="text-2xl transition hover:scale-110" 
                title="Հայերեն"> 
                🇦🇲 
            </a> 
            
        <a href="{{ route('language.switch', 'ru') }}" 
            class="text-2xl transition hover:scale-110" 
            title="Русский"> 
            🇷🇺 
        </a> 
        
        <a href="{{ route('language.switch', 'en') }}" 
           class="text-2xl transition hover:scale-110" 
           title="English"> 
           🇬🇧 
        </a> 
    </div> 
</div> 

<div class="page-shell"> 
    <div class="mb-8"> 
        
        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600"> 
            {{ __('products.catalog') }} 
        </p> 
        
        <h1 class="mt-2 text-3xl font-bold text-slate-900"> 
            {{ __('products.show_title') }} 
        </h1> 
    
    </div> 
    
    <div class="panel-card"> 
        <div class="grid gap-8 lg:grid-cols-[320px,1fr]">  
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50"> 
                
                @if ($product->image) 
                
                <img
                 src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="h-80 w-full object-cover" 
                 >
                 
                 @else 
                 
                 <div class="flex h-80 items-center justify-center bg-slate-100 text-xl font-semibold text-slate-400"> 
                    {{ __('products.no_image') }} 
                </div> 
                
                @endif 
            </div>  
            
            <div class="space-y-6"> 
                <div class="flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between"> 
                    <div> 
                        
                        <p class="info-label"> 
                            {{ __('products.name') }} 
                        </p> 
                        
                        <h2 class="text-3xl font-bold text-slate-900"> 
                            {{ $product->name }} 
                        </h2> 
                    </div> 
                    
                    <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-lg font-bold text-indigo-700"> 
                        {{ number_format($product->price, 2, '.', ' ') }} 
                        ֏ 
                    </span> 
                </div>  
                
                <div> 
                    
                    <p class="info-label"> 
                        {{ __('products.product_description') }} 
                    </p> 
                    
                    <p class="text-base leading-7 text-slate-600"> 
                        @if (app()->getLocale() === 'ru')
    {{ $product->description_ru ?: $product->description }}
@elseif (app()->getLocale() === 'en')
    {{ $product->description_en ?: $product->description }}
@else
    {{ $product->description_hy ?: $product->description }}
@endif 
                    </p> 
                </div>  
                
                <div class="grid gap-4 sm:grid-cols-2"> 
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4"> 
                        
                        <p class="info-label"> 
                            {{ __('products.created_at') }} 
                        </p> 
                        
                        <p class="text-sm text-slate-700"> 
                            {{ $product->created_at->format('d.m.Y H:i') }} 
                        </p> 
                    </div> 
                    
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4"> 
                        
                        <p class="info-label"> 
                            {{ __('products.updated_at') }} 
                        </p> 
                        
                        <p class="text-sm text-slate-700"> 
                            {{ $product->updated_at->format('d.m.Y H:i') }} 
                        </p> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</body> 
</html> 