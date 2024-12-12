@extends('admin.layouts.master')

@section('title', 'TechStore')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thùng rác</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Thùng rác</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive table-data ">

                        @if (session("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session("success")}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên</th>
                                <th>Ngày xoá</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                            @foreach($trashed as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    {{-- <td>
                                        @php
                                            $url = $item->img_thumbnail;
                                            if (!Str::contains($url, 'http')) {
                                                $url = \Illuminate\Support\Facades\Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="70px" height="60px">
                                    </td> --}}
                                    <td style="width: auto; height: 30px">
                                        @php
                                            $url = $item->img_thumbnail;
                                            if (!$url || !Str::contains($url, 'http')) {
                                                if ($url) {
                                                    $url = \Illuminate\Support\Facades\Storage::exists($url) 
                                                        ? \Illuminate\Support\Facades\Storage::url($url) 
                                                        : null;
                                                }
                                            }
                                            if (!$url) {
                                                $url = asset('theme/admin/assets/images/default-avatar.png');
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="70px" height="60px">
                                    </td>
                                    
                                    <td>
                                        <a href="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                            {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                        </a>
                                        
                                    </td>
                                    <td>
                                        @if($item->deleted_at)
                                            <span id="invoice-date">{{ $item->deleted_at->format('d M, Y') }}</span>
                                            <small class="text-muted" id="invoice-time">{{ $item->deleted_at->format('h:iA') }}</small>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <div class="d-flex gap-2  justify-content-center">
                                         
                                         
                                            <form action="{{ route('admin.restore', $item) }}" method="post">
                                                @csrf
                                                <button onclick="return confirm('Bạn có chắc chắn muốn khôi phục không?')" type="submit" class="btn btn-danger btn-sm">
                                                    Khôi phục 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td> --}}
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <!-- Khôi phục -->
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $item->id }}">
                                                Khôi phục
                                                <i class="fa-solid fa-circle-info fa-sm"></i>
                                            </a>
                                        </div>
                                    
                                        <!-- Modal for Restore Confirmation -->
                                        <div id="restoreModal{{ $item->id }}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mt-2 text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                            <div class="mt-4 pt-2 fs-15 mx-sm-5">
                                                                <h4>Are you sure?</h4>
                                                                <p class="text-muted mx-4 mb-0">Do you want to restore this item?</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                            <form id="restore-form{{ $item->id }}" action="{{ route('admin.restore', $item) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn w-sm btn-danger">Yes, Restore It!</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Hiển thị từ {{ $trashed->firstItem() }} đến {{ $trashed->lastItem() }} trong tổng số {{ $trashed->total() }} sản phẩm</p>
                            </div>
                            <div>
                                {{ $trashed->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')

@endsection

@section('script-libs')

    {{-- <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                product(page);
            })


            function product(page) {
                $.ajax({
                    url: "products/pagination/?page=" + page,
                    success: function (res) {
                        $('.table-data').html(res);
                    }
                })
            }

            $(document).on('keyup', function (e) {
                e.preventDefault();
                let search_string = $('#search').val();
                $.ajax({
                    url: "{{ route('admin.products.search') }}",
                    method: 'get',
                    data: {search_string: search_string},
                    success: function (res) {
                        $('.table-data').html(res);
                    },
                    error: function (res) {
                        if (res.status === 404) {
                            $('.table-data').html('<p class="alert alert-primary">Không tìm thấy kết quả!</p>');
                        }
                    }
                })
            })
        });

    </script> --}}
@endsection

