<li class="dropdown dropdown-notification nav-item">
    <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" id="notificationDropdown">
        <i class="ficon ft-bell"></i>
        @if (Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-pill badge-danger badge-up badge-glow">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
        <li class="dropdown-menu-header">
            <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
        </li>
        <li class="scrollable-container media-list w-100 mt-1">
        @forelse($notifications as $notification)
            <a href="javascript:void(0)">
                <div class="media">
                    <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan mr-0"></i></div>
                    <div class="media-body">
                    @if(isset($notification->data['message']))
                        <h6 class="media-heading">{!! $notification->data['message'] !!}</h6>
                    @else
                        <h6 class="media-heading">No message available</h6>
                    @endif
                        <p class="notification-text font-small-3 text-muted">{!! $notification->data['description'] ?? 'No description available' !!}</p>
                        <small>
                            <time class="media-meta text-muted" datetime="{{ $notification->created_at }}">{{ $notification->created_at->diffForHumans() }}</time>
                        </small>
                    </div>
                </div>
            </a>
        @empty
            <h5 class="mt-1 text-center"><strong>No Notifications</strong></h5>
        @endforelse
        </li>
        <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
    </ul>
</li>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#notificationDropdown').on('click', function() {
            $.ajax({
                url: '{{ route('notifications.markAllAsRead') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#notificationCount').remove();
                    }
                }
            });
        });
    });
</script>
