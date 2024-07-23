@include('includes.head')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    
    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Carousel Images</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                    </li>
                                    <li class="breadcrumb-item active">Carousel Images
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12">
                        <div class="btn-group float-md-right">
                            <a href="{{ route('carousel.add') }}">
                                <button class="btn btn-info mb-1" type="button">Add a New Image</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- File export table -->
                    <section id="file-export">
                        <div class="row">
                            <div class="col-12">
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Manage Carousel Images</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                            <table class="table table-striped table-bordered file-export">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($carousel as $image)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/carousel_images/' . $image->image) }}', '{{ $image->image }}')">
                                                                <img src="{{ asset('images/carousel_images/' . $image->image) }}" class="rounded-circle img-thumbnail" style="width: 50px; height: 50px;">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="carousel/edit/{{ $image->id }}">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                            <a href="carousel/delete/{{ $image->id }}" class="delete-carousel" data-id="{{ $image->id }}"
                                                                onclick="confirmDelete({{ $image->id }})">
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                            </a>
                                                        </td>
                                                        
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- File export table -->
                </div>
        </div>
    </div>
    <div class="modal fade text-left" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Dynamic modal title -->
                    <h4 class="modal-title text-center" id="modalTitle"><i class="la la-road2"></i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Image displayed here -->
                    <img id="modalImage" src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @include('includes.footer') 

    <script>
        function setModalImage(imageUrl, title) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalTitle').innerHTML = title;
        }

        $('.delete-carousel').click(function(event) {
            event.preventDefault(); // Prevent the default action (i.e., following the link)

            var clubId = $(this).data('id'); // Get the coordinator ID from the data attribute

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete route
                    window.location.href = '/carousel/delete/' + clubId;
                }
            });
        });
    </script>
    