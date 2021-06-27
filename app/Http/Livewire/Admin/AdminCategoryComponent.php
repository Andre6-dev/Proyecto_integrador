<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;


class  AdminCategoryComponent extends Component
{
    public $category_id;

    public function deleteCategory($id)
    {
        $category_id = Category::find($id);
        $category_id->delete();
        session()->flash('message', 'Category has been deleted successfully!');
        return redirect('/admin/categories');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.admin');
    }
}
