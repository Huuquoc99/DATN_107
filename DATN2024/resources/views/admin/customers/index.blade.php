@extends('admin.layouts.master')

@section('title', 'TechStore')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Người dùng</h4>

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
                    <h5 class="card-title mb-0">Danh sách người dùng</h5>
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
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $users->firstItem() + $loop->index }}</td>
                                        <td>
                                            @if ($item->avatar)
                                                <img src="{{ Storage::url($item->avatar) }}" alt="" width="70px" height="60px">
                                            @else
                                                <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" alt="" width="70px" height="60px">
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.customers.show', $item) }}">
                                                {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                            </a>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{!! $item->type == 1 ? '<span class="badge bg-primary">Admin</span>' : '<span class="badge bg-success">User</span>' !!}</td>
                                        <td>
                                            <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span> 
                                            <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2  justify-content-center">
                                                <a href="{{ route('admin.customers.show', $item) }}" class="btn btn-info btn-sm">Chi tiết 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </a>
                                                <a href="{{ route('admin.customers.edit', $item) }}" class="btn btn-primary btn-sm">Chỉnh sửa 
                                                    <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Hiển thị từ {{ $users->firstItem() }} đến {{ $users->lastItem() }} trong tổng số {{ $users->total() }} người dùng</p>
                            </div>
                            <div>
                                {{ $users->links() }}
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


