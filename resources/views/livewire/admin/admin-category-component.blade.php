<style>
    .pagination {
        justify-content: center;
    }
</style>
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Categories Tables</h4>
                            <span>Tablas de cada una de las categorias de la tienda</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Tablas de la tienda</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Tabla de Categorias</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <!-- Page-body start -->
        <div class="page-body">
            <!-- Border-bottom color table start-->
            <div class="card">
                <div class="card-header">
                    <h5>Categorias</h5>
                    <a href="{{ route('admin.addcategory') }}">
                        <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"
                                data-modal="modal-13" >
                            <i class="icofont icofont-plus m-r-5"></i> Add Category
                        </button>
                    </a>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        @if( Session::has('message'))
                            <div class="alert alert-success icons-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <p><strong>Success!</strong>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr class="border-bottom-danger">
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-bottom-primary">
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.editcategory',['category_slug'=>$category->slug]) }}">
                                                <i class="zmdi zmdi-edit"></i><span> Edit </span></a>
                                            <a href="{{ url('/admin/categories/'.$category->id) }}">
                                                <i class="zmdi zmdi-delete"></i><span> Delete </span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="styleSelector">

</div>

