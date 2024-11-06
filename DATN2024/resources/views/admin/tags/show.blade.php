@extends('admin.layouts.master')

@section('title')
    Thêm mới Tag
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tag</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tag</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin chi tiết</h4>
                </div>
                <div class="mt-5">
                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 400px;">ID</th>
                                <td>{{ $tag->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 400px;">Name</th>
                                <td>{{ $tag->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 400px;">Description</th>
                                <td>{{ $tag->description }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 400px;">Created At</th>
                                <td>{{ \Carbon\Carbon::parse($tag->created_at)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 400px;">Updated At</th>
                                <td>{{ \Carbon\Carbon::parse($tag->updated_at)->format('d/m/Y') }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-info">Danh sách</a>
    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-outline-info">Sửa</a>
    <a href="{{ route('admin.tags.destroy', $tag->id) }}" class="btn btn-outline-info">Xóa</a>
@endsection

