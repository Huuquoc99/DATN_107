@foreach($notifications as $notification)
    @php
        $data = $notification->data;
        $order = $data['order'];
    @endphp

    <div class="text-reset notification-item d-block dropdown-item position-relative">
        <div class="d-flex">
            <img src="{{ "https://ui-avatars.com/api/?name={$order['user_name']}&color=7F9CF5&background=EBF4FF" }}"
                 class="me-1 rounded-circle avatar-xs flex-shrink-0" alt="user-pic">
            <div class="flex-grow-1">
                <a href="{{ route('admin.orders.show', ['order' => $order['id'], 'noti' => $notification->id]) }}" class="stretched-link">
                    <div class="flex-grow-1  {{!empty($notification->read_at) ? 'text-muted' : 'text-dark'}}">
                        <div class="mt-0 mb-2 lh-base"><b>{{ $order['user_name'] }}</b>
                            {!! $data['message'] !!}
                        </div>
                        <p class="mb-0 fs-11 fw-medium text-uppercase">
                            <span><i class="mdi mdi-clock-outline"></i> {{\Carbon\Carbon::parse($notification->created_at)->diffForHumans(now())}}</span>
                        </p>
                    </div>
                </a>
            </div>
            @empty($notification->read_at)
                <div class="my-auto rounded-circle bg-primary" style="width: 10px; height: 10px; flex:none"></div>
            @endempty
        </div>
    </div>
@endforeach
