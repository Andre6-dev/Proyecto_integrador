<style>
    .pagination {
        justify-content: center;
    }
</style>
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Product List</h4>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">E-Commerce</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Product List</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <!-- Page body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Product list card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Product List</h5>
                            <a href="{{route('admin.addproduct')}}">
                                <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"
                                        data-modal="modal-13"> <i class="icofont icofont-plus m-r-5"></i> Add Product
                                </button>
                            </a>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <div class="table-content">
                                    <div class="project-table">
                                        @if( Session::has('message'))
                                            <div class="alert alert-success icons-alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled"></i>
                                                </button>
                                                <p><strong>Success!</strong>{{ Session::get('message') }}</p>
                                            </div>
                                        @endif
                                        <table id="e-product-list" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Stock_status</th>
                                                <th>Price</th>
                                                <th>Sale Price</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td class="pro-list-img">
                                                        <img src="{{ asset('assets/images/products') }}/{{ $product->image }}" width="60" class="img-fluid" alt="tbl">
                                                    </td>
                                                    <td class="pro-name">
                                                        <h6>{{ $product->name }}</h6>
                                                    </td>
                                                    <td>{{ $product->stock_status }}</td>
                                                    <td>{{ $product->regular_price }}</td>
                                                    <td>{{ $product->sale_price }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->created_at }}</td>
                                                    <td class="action-icon">
                                                        <a href="{{ route('admin.editproduct', ['product_slug'=>$product->slug]) }}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top"
                                                           title="" data-original-title="Edit"><i class="icofont icofont-ui-edit"></i></a>
                                                        <a href="{{ url('/admin/products/'.$product->id) }} }}" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="icofont icofont-delete-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product list card end -->
                </div>
            </div>
            <!-- Add Contact Start Model start-->
            <div class="md-modal md-effect-13 addcontact" id="modal-13">
                <div class="md-content">
                    <h3 class="f-26">Add Product</h3>
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control pname" placeholder="Prodcut Name">
                            <span class="input-group-addon btn btn-primary">Chooese File</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                            <input type="text" class="form-control pname" placeholder="Product Name">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                            <input type="text" class="form-control pamount" placeholder="Amount">
                        </div>
                        <div class="input-group">
                            <select id="hello-single" class="form-control stock">
                                <option value="">---- Select Stock ----</option>
                                <option value="married">In Stock</option>
                                <option value="unmarried">Out of Stock</option>
                                <option value="unmarried">Law Stock</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Save</button>
                            <button type="button" class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md-overlay"></div>
            <!-- Add Contact Ends Model end-->
        </div>
        <!-- Page body end -->
    </div>
</div>
<!-- Main-body end -->
<div id="styleSelector">

</div>

