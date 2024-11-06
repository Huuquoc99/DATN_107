@extends('admin.layouts.master')

@section('title', 'Danh sách Sản phẩm')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách Tags</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                        <li class="breadcrumb-item active">Danh sách tag</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

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
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{!! $item->status ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.tags.show', $item) }}"
                                               class="btn btn-info btn-sm">Xem chi tiết <i
                                                    class="fa-solid fa-circle-info fa-sm"></i></a>
                                            <a href="{{ route('admin.tags.edit', $item) }}"
                                               class="btn btn-primary btn-sm">Sửa <i
                                                    class="fa-regular fa-pen-to-square fa-sm"></i></a>
                                            <form action="{{ route('admin.tags.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Chắc chắn không?')" type="submit"
                                                        class="btn btn-danger btn-sm">Xóa <i
                                                        class="fa-solid fa-delete-left fa-sm"></i>
                                                </button>
                                            </form>
                                            {{--                                            <a class="btn btn-danger btn-sm delete-product " data-id="{{ $item->id }}">Xóa <i class="fa-solid fa-delete-left fa-sm"></i>--}}
                                            {{--                                            </a>--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

