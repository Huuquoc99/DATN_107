@extends('admin.layouts.master')

@section('title', 'TechStore')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tag</h4>

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
                    <h5 class="card-title mb-0">Danh sách</h5>
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary mb-3">
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
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                            {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($item->description, 15, '...') }}
                                    </td>
                                    <td>{!! $item->status ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>
                                        <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span> 
                                        <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                    </td>
                                    <td>
                                        <span id="invoice-date">{{ $item->updated_at->format('d M, Y') }}</span> 
                                        <small class="text-muted" id="invoice-time">{{ $item->updated_at->format('h:iA') }}</small>
                                    </td>
                                    {{-- <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('admin.tags.edit', $item) }}"
                                               class="btn btn-primary btn-sm">Chỉnh sửa <i
                                                    class="fa-regular fa-pen-to-square fa-sm"></i></a>
                                            <form action="{{ route('admin.tags.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" type="submit"
                                                        class="btn btn-danger btn-sm">Xoá <i
                                                        class="fa-solid fa-delete-left fa-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <!-- Chỉnh sửa -->
                                            <a href="{{ route('admin.tags.edit', $item) }}" class="btn btn-primary btn-sm">
                                                Chỉnh sửa 
                                                <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                            </a>
                                    
                                            <!-- Xoá - Dùng Modal -->
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                Xoá 
                                                <i class="fa-solid fa-delete-left fa-sm"></i>
                                            </a>
                                        </div>
                                    
                                        <!-- Modal Xoá -->
                                        <div id="deleteModal{{ $item->id }}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                                                                <p class="text-muted mx-4 mb-0">Do you want to delete this tag?</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                            <form id="delete-form{{ $item->id }}" action="{{ route('admin.tags.destroy', $item) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn w-sm btn-danger">Yes, Delete It!</button>
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
                                <p>Hiển thị từ {{ $data->firstItem() }} đến {{ $data->lastItem() }} trong tổng số {{ $data->total() }} tag</p>
                            </div>
                            <div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

