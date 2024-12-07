<div class="dropdown-head bg-primary bg-pattern rounded-top">
    <div class="p-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 fs-16 fw-semibold text-white"> Thông báo </h6>
            </div>
            <div class="col-auto dropdown-tabs">
                <span class="badge bg-light-subtle text-body fs-13 count-noti"> {{\App\Models\AdminNotification::unread()->count()}} mới</span>
            </div>
        </div>
    </div>

    <div class="px-2 pt-2">
        <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
            id="notificationItemsTab" role="tablist">
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                   role="tab" aria-selected="true">
                    Tất cả
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="tab-content position-relative" id="notificationItemsTabContent">
    <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
        <div data-simplebar style="max-height: 300px;" class="pe-2">
            <div id="noti-list">
                @include('admin.notification.data')
            </div>
            <div class="auto-load text-center" style="display: none;">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
                     xml:space="preserve">
                    <path fill="#000"
                          d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                          from="0 50 50" to="360 50 50" repeatCount="indefinite"/>
                    </path>
                </svg>
            </div>
            <div class="my-3 text-center view-all">
                <button type="button"
                        class="btn btn-soft-success waves-effect waves-light load-more-noti" data-type="1">Xem thông báo tiếp theo <i class="ri-arrow-right-line align-middle"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    var ENDPOINT = "{{ route('admin.notification.index') }}";
    var totalPage = "{{ $notifications->lastPage() }}";
    var page = 1;
    $('.load-more-noti').click(function () {
        page++;
        if(page == totalPage) {
            $('.view-all').hide();
        }
        notiLoadMore(page);
    })
    function notiLoadMore(page) {
        $.ajax({
            url: ENDPOINT + "?page=" + page,
            type: "get",
            datatype: "html",
            beforeSend: function () {
                $('.auto-load').show();
            },
            success: function (data) {
                $('#noti-list').append(data)
                $('.auto-load').hide();
            }
        })
    }
</script>
