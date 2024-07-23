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
                    <h3 class="content-header-title mb-0 d-inline-block">Clubs</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Clubs
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('clubs.add') }}">
                        <button class="btn btn-info mb-1" type="button">Create New Club</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- File export table -->
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Manage Clubs</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Logo</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(Auth::user()->role == 'admin')
                                                    @foreach($clubs as $club)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $club->name }}</td>
                                                        <td>
                                                        <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/club_logos/' . $club->logo) }}', '{{ $club->name }}')">
                                                            <img src="{{ asset('images/club_logos/' . $club->logo) }}" class="rounded-circle img-thumbnail" style="width: 50px; height: 50px;">
                                                        </a>
                                                        </td>
                                                        <td>{{ $club->created_at->format('F d, Y') }}</td>
                                                        <td>
                                                            <a href="clubs/view/{{ $club->id }}">
                                                                <button type="button" class="btn btn-primary btn-sm">View</button>
                                                            </a>
                                                            <a href="clubs/edit/{{ $club->id }}">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                            <a href="clubs/delete/{{ $club->id }}" class="delete-club" data-id="{{ $club->id }}"
                                                                onclick="confirmDelete({{ $club->id }})">
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif

                                                @if(Auth::user()->role == 'coordinator')
                                                    @foreach($specificClubs as $specificClub)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $specificClub->name }}</td>
                                                        <td>    
                                                        <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/club_logos/' . $specificClub->logo) }}', '{{ $specificClub->name }}')">
                                                            <img src="{{ asset('images/club_logos/' . $specificClub->logo) }}" class="rounded-circle img-thumbnail" style="width: 50px; height: 50px;">
                                                        </a>
                                                        </td>
                                                        <td>{{ $specificClub->created_at->format('F d, Y') }}</td>
                                                        <td>
                                                            <a href="clubs/view/{{ $specificClub->id }}">
                                                                <button type="button" class="btn btn-primary btn-sm">View</button>
                                                            </a>
                                                            <a href="clubs/edit/{{ $specificClub->id }}">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Logo</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
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
    
    @include('includes.footer')

    <script>

        $('.delete-club').click(function(event) {
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
                    window.location.href = '/clubs/delete/' + clubId;
                }
            });
        });
        
        function setModalImage(imageUrl, title) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalTitle').innerHTML = title;
        }
         // When the delete link is clicked
        
    </script>