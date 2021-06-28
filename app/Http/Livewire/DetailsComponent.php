<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {   
    
            
        if (Cache::has('product')){
            $product=Cache::get('product');
        }
        else{
            $product = Product::where('slug',$this->slug)->first();
            Cache::put('product',$product);      
        }

        if (Cache::has('popular_products')){
            $popular_products=Cache::get('popular_products');
        }
        else{
            $popular_products = Product::inRandomOrder()->limit(4)->get();
            Cache::put('popular_products',$popular_products, $seconds=30);      
        }

        if (Cache::has('related_products')){
            $related_products=Cache::get('related_products');
        }
        else{
            $related_products = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(5)->get();
            Cache::put('related_products',$related_products);      
        }

        //$product = Product::where('slug',$this->slug)->first();
        //$popular_products = Product::inRandomOrder()->limit(4)->get();
        //$related_products = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(5)->get();
        return view('livewire.details-component',['product'=>$product, 'popular_products'=>$popular_products, 'related_products'=>$related_products])->layout('layouts.base');
    }
}
