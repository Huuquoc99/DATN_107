
@extends('admin.layouts.master')

@section('title')
    TechStore
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Banner</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                        <li class="breadcrumb-item active"> Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="title" class="form-label">Tiêu đề</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="2"></textarea>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
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
                                                                name="{{ $key }}" value="1" id="{{ $key }}" @if($key == 'is_active') checked @endif>
                                                        <label class="form-check-label" for="{{ $key }}">{{ $value['name'] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="mt-3">
                                        <label for="image" class="form-label">Hình ảnh</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="link" class="form-label ">Link</label>
                                        <input class="form-control @error('link') is-invalid @enderror" name="link" id="link">
                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary">Thêm mới <i class="fa-regular fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

