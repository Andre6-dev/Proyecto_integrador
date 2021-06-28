<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ShopComponent extends Component
{
    public function render()
    {

        if (request()->page){
            $productsN='productsN'.request()->page;
        }else{
            $productsN='productsN';
        }

        if (Cache::has($productsN)){
            $products=Cache::get($productsN);
        }
        else{
            $products = Product::paginate(12);
            Cache::put($productsN,$products,$seconds=30);      
        }

        //$products = Product::paginate(12);
        return view('livewire.shop-component',['products' => $products])->layout('layouts.base');
    }
}
