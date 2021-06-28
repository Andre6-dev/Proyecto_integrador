<?php

namespace App\Http\Livewire;

use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);

        $sproducts = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component',['sliders'=>$sliders, 'lproducts'=>$lproducts, 'sproducts'=>$sproducts])->layout('layouts.base');
    }
}
