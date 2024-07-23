@include('includes.head')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">News and Updates</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">News and Updates
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('news.store') }}">
                        <button class="btn btn-info mb-1" type="button">Create a New Update</button>
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
                                    <h4 class="card-title">Manage News and Updates</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($news as $update)
                                                    <tr>
                                                        <td> {{ $loop->iteration }} </td>
                                                        <td> {{ $update->title }}</td>
                                                        <td> {{ $update->category }} </td>
                                                        <td> {{ \Carbon\Carbon::parse($update->date)->format('F d, Y') }} </td>
                                                        <td>
                                                            <a href="news/view/{{ $update->id }}" style="margin:1px">
                                                                <button type="button" class="btn btn-primary btn-sm">View</button>
                                                            </a>
                                                            <a href="news/edit/{{ $update->id }}" style="margin:1px">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                            <a href="news/delete/{{ $update->id }}" class="delete-news" style="margin:1px" data-id="{{ $update->id }}"
                                                                onclick="confirmDelete({{ $update->id }})">
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Date</th>
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
    <!-- END: Content-->

    <!-- Modal -->
    
    @include('includes.footer') 
    
    <script>
        $('.delete-news').click(function(event) {
            event.preventDefault(); // Prevent the default action (i.e., following the link)

            var newsId = $(this).data('id'); // Get the coordinator ID from the data attribute

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
                    window.location.href = '/news/delete/' + newsId;
                }
            });
        });
    </script>