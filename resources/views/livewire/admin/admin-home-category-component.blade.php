<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Manage Home Categories</h4>
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
                            <h5>Home Categories</h5>
                            <a href="{{ route('admin.products') }}">
                                <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"
                                        data-modal="modal-13">
                                    <i class="icofont icofont-plus m-r-5"></i> All Products
                                </button>
                            </a>
                        </div>
                        <div class="card-block">
                            <form id="main" method="post" action="/" novalidate="">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Choose Categories</label>
                                    <div class="col-sm-10">
                                        <select name="categories[]" class="sel_categories form-control" >
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No Of Products</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="No Of Products">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0">Save</button>
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
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.sel_categories').select2();
        });
    </script>
@endpush

