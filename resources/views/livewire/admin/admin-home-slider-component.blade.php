<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Home Slider</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Bootstrap Table</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Border Table</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="card-header">
                <h5>Home Slider</h5>
                <a href="{{ route('admin.addhomeslider') }}">
                    <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"
                            data-modal="modal-13" >
                        <i class="icofont icofont-plus m-r-5"></i> Add Home Slider
                    </button>
                </a>
            </div>
            <div class="table-responsive">
                <div class="table-content">
                    <div class="project-table">
                        @if( Session::has('message'))
                            <div class="alert alert-success icons-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <p><strong>Success! </strong>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        <table id="e-product-list" class="table table-striped dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Price</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td class="pro-list-img">
                                        <img src="{{ asset('assets/images/sliders') }}/{{ $slider->image }}" width="120" class="img-fluid" alt="tbl">
                                    </td>
                                    <td class="pro-name">
                                        <h6>{{ $slider->title }}</h6>
                                    </td>
                                    <td>{{ $slider->subtitle }}</td>
                                    <td>{{ $slider->price }}</td>
                                    <td>{{ $slider->link }}</td>
                                    <td>{{ $slider->status == 1 ? 'Active':'Inactive' }}</td>
                                    <td>{{ $slider->created_at }}</td>
                                    <td class="action-icon">
                                        <a href="{{ route('admin.edithomeslider',['slide_id'=>$slider->id]) }}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top"
                                           title="" data-original-title="Edit"><i class="icofont icofont-ui-edit"></i></a>
                                        <a href="#" wire:click.prevent="deleteSlide({{ $slider->id }})" class="text-muted" data-toggle="tooltip" data-placement="top"
                                           title="" data-original-title="Delete"><i class="icofont icofont-delete-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main-body end -->
<div id="styleSelector">

</div>

