<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Agregar Producto</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Form Components</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Form Validation</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Basic Inputs Validation start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Basic Inputs Validation</h5>
                            <a href="{{ route('admin.products') }}">
                                <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"
                                        data-modal="modal-13">
                                    <i class="icofont icofont-plus m-r-5"></i> Add Product
                                </button>
                            </a>
                        </div>
                        <div class="card-block">
                            @if( Session::has('message'))
                                <div class="alert alert-success icons-alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled"></i>
                                    </button>
                                    <p><strong>Success! </strong>{{ Session::get('message') }}</p>
                                </div>
                            @endif
                            <form id="main" method="post" wire:submit.prevent="addProduct" action="/" novalidate="">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Product Name" wire:model="name" wire:keyup="generateSlug">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Product Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Product Slug" wire:model="slug">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="5" class="form-control" placeholder="Short Description" wire:model="short_description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="5" class="form-control" placeholder="Description" wire:model="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Regular Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Regular Price" wire:model="regular_price">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Sales Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Sales Price" wire:model="sale_price">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">SKU</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="SKU" wire:model="SKU">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Stock</label>
                                    <div class="col-sm-10">
                                        <select name="select" class="form-control" wire:model="stock_status">
                                            <option value="instock">In Stock</option>
                                            <option value="outofstock">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Featured</label>
                                    <div class="col-sm-10">
                                        <select name="select" class="form-control" wire:model="featured">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Quantity" wire:model="quantity">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Product Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" wire:model="image">
                                        @if($image)
                                            <img src="{{$image->temporaryUrl()}}" width="120" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="select" class="form-control" wire:model="category_id">
                                            <option value="0">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body end -->
    </div>
</div>
<div id="styleSelector">

</div>
