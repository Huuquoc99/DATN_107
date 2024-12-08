@extends('admin.layouts.master')

@section('title', 'TechStore')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Banner</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                        <li class="breadcrumb-item active"> Danh sách</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh sách banner</h5>
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-3">
                        Thêm mới <i class="fa-regular fa-plus"></i>
                    </a>
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
                                <th>Tiêu đề</th>
                                <th>Hoạt động</th>
                                <th> Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listBanner as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            {{-- <img src="{{ Storage::url($item->image)}}" alt="" width="70px" height="60px"> --}}
                                            @if ($item->image)
                                                <img src="{{ Storage::url($item->image) }}" alt="" width="70px" height="60px">
                                            @else
                                                <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" alt="" width="70px" height="60px">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.banners.show', $item) }}">
                                                {{ \Illuminate\Support\Str::limit($item->title, 15, '...') }}
                                            </a>
                                        </td>
                                        <td>{!! $item->is_active ? '<span class="badge bg-primary">Hoạt động</span>' : '<span class="badge bg-danger">Không hoạt động</span>' !!}</td>
                                        <td>
                                            <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span> 
                                            <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                        </td>
                                        <td>
                                            <span id="invoice-date">{{ $item->updated_at->format('d M, Y') }}</span> 
                                            <small class="text-muted" id="invoice-time">{{ $item->updated_at->format('h:iA') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('admin.banners.show', $item) }}" class="btn btn-info btn-sm">Chi tiết 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </a>
                                                <a href="{{ route('admin.banners.edit', $item) }}" class="btn btn-primary btn-sm">Chỉnh sửa 
                                                    <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                                </a>
                                                <form action="{{ route('admin.banners.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Bạn có chắc chắn muốn xoá không?')" type="submit" class="btn btn-danger btn-sm">Xoá 
                                                        <i class="fa-solid fa-delete-left fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Hiển thị từ {{ $listBanner->firstItem() }} đến {{ $listBanner->lastItem() }} trong tổng số {{ $listBanner->total() }} baner</p>
                            </div>
                            <div>
                                {{ $listBanner->links() }}
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



