<div class="d-flex justify-content-between mb-4 pb-md-2">
    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
        <a href="{{ route('home') }}"
           class="menu-link menu-link_us-s text-uppercase fw-medium"
           style="color:black">Trang chủ</a>
        @foreach ($breadcrumbs as $breadcrumb)
            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1" style="color:black">/</span>
            @if (isset($breadcrumb['url']))
                <a href="{{ $breadcrumb['url'] }}"
                   class="menu-link menu-link_us-s text-uppercase fw-medium"
                   style="color:black">{{ $breadcrumb['label'] }}</a>
            @else
                <span class="text-uppercase fw-medium" style="color:black">{{ $breadcrumb['label'] }}</span>
            @endif
        @endforeach
    </div>
</div>
