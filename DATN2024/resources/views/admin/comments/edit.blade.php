
@extends('admin.layouts.master')

@section('title')
TechStore 
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Bình luận</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                        <li class="breadcrumb-item active"> Chỉnh sửa</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control"  id="name" value="{{ $comment->user->name }}" disabled>
                                    </div>
                                    <div class="mt-3">
                                        <label for="content" class="form-label">Nội dung</label>
                                        <input type="text" class="form-control" id="content" value="{{ $comment->content }}" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="mt-4">
                                            @php
                                                $is = [
                                                    'is_active' => ['name' => 'Hoạt động', 'color' => 'primary'],
                                                ];
                                            @endphp
                                            @foreach($is as $key => $value)
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-check form-switch form-switch-{{ $value['color'] }} d-flex align-items-center">
                                                        <input class="form-check-input me-2" type="checkbox" role="switch"
                                                               name="{{ $key }}" value="1" id="{{ $key }}"
                                                               {{ isset($comment) && $comment->is_active == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="{{ $key }}">{{ $value['name'] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="mt-3">
                                        <label for="product" class="form-label">Sản phẩm</label>
                                        <input type="text" class="form-control" id="product" value="{{ $comment->product->name }}" disabled>
                                    </div>
                                    <div class="mt-3">
                                        <label for="rate" class="form-label">Xếp hạng</label>
                                        <div id="rate" class="d-flex align-items-center gap-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="rate" id="rate-{{ $i }}" value="{{ $i }}" {{ $comment->rate == $i ? 'checked' : '' }} class="d-none">
                                                <label for="rate-{{ $i }}" style="cursor: pointer;">
                                                    <i class="fa fa-star {{ $comment->rate >= $i ? 'text-warning' : 'text-secondary' }}" id="star-{{ $i }}"></i>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary">Chỉnh sửa
                            <i class="fa-regular fa-pen-to-square fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection


