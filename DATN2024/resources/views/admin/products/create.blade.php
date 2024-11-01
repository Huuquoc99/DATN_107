
@extends('admin.layouts.master')

@section('title')
    Thêm mới Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-5">
                                    <div>
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Giá thường</label>
                                        <input type="number" value="0" class="form-control" name="price_regular" id="price_regular">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Giá giảm giá</label>
                                        <input type="number" value="0" class="form-control" name="price_sale" id="price_sale">
                                    </div>
                                    <div class="mt-3">
                                        <label for="catalogue_id" class="form-label">Hãng điện thoại</label>
                                        <select class="form-select" name="catalogue_id" id="catalogue_id">
                                            @foreach($catalogues as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Ảnh đại diện</label>
                                        <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail">
                                    </div>
                                    <div class="mt-3">
                                        <label for="processor" class="form-label">CPU</label>
                                        <input type="text" class="form-control" name="processor" id="processor">
                                    </div>
                                    <div class="mt-3">
                                        <label for="ram" class="form-label">Ram</label>
                                        <input type="text" class="form-control" name="ram" id="ram">
                                    </div>
                                    <div class="mt-3">
                                        <label for="short_description" class="form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" name="short_description" id="short_description" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-7 mt-2">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="sku" class="form-label">Mã sản phẩm</label>
                                            <input type="text" class="form-control" name="sku" id="sku"
                                                   value="{{ strtoupper(\Str::random(8)) }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="screen_size" class="form-label">Kích thước màn hình</label>
                                            <input type="text" class="form-control" name="screen_size" id="screen_size">
                                        </div>
                                        <div class="mt-3">
                                            <label for="operating_system" class="form-label">Hệ điều hành</label>
                                            <input type="text" class="form-control" name="operating_system" id="operating_system">
                                        </div>
                                        <div class="mt-3">
                                            <label for="battery_capacity" class="form-label">Dung lượng pin</label>
                                            <input type="text" class="form-control" name="battery_capacity" id="battery_capacity">
                                        </div>

                                        <div class="mt-3">
                                            <label for="camera_resolution" class="form-label">Camera</label>
                                            <input type="text" class="form-control" name="camera_resolution" id="camera_resolution">
                                        </div>

                                        <div class="mt-3">
                                            <label for="network_connectivity" class="form-label">Mạng</label>
                                            <input type="text" class="form-control" name="network_connectivity" id="network_connectivity">
                                        </div>

                                        <div class="mt-3">
                                            <label for="storage" class="form-label">Dung lượng lưu trữ</label>
                                            <input type="text" class="form-control" name="storage" id="storage">
                                        </div>

                                        <div class="mt-5">
                                            <div class="row">
                                                @php
                                                    $is = [
                                                        'is_active' => ['name' => 'Kích hoạt', 'color' => 'primary'],
                                                        'is_hot_deal' => ['name' => 'Sản phẩm Hot', 'color' => 'danger'],
                                                        'is_good_deal' => ['name' => 'Ưu đãi tốt', 'color' => 'warning'],
                                                        'is_new' => ['name' => 'Sản phẩm Mới', 'color' => 'success'],
                                                        'is_show_home' => ['name' => 'Hiển thị trên Trang Chủ', 'color' => 'info'],
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
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="content" class="form-label">Mô tả dài</label>
                                <textarea class="form-control" name="description" id="content"></textarea>
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
                        <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                    </div><!-- end card header -->
                    <div class="card-body" style="height: 450px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="text-center">
                                            <th>Dung lượng</th>
                                            <th>Màu sắc</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Hình ảnh</th>
                                        </tr>

                                        @foreach($capacity as $sizeID => $sizeName)
                                            @php($flagRowspan = true)

                                            @foreach($colors as $colorID => $colorName)
                                                <tr class="text-center">

                                                    @if($flagRowspan)
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{ count($colors) }}"><b>{{ $sizeName }}</b></td>
                                                    @endif
                                                    @php($flagRowspan = false)

                                                    <td>
                                                        {{$colorName}}
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="0" name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="0" name="product_variants[{{ $sizeID . '-' . $colorID }}][price]">
                                                    </td>

                                                    <td>
                                                        <input type="text" class="form-control" name="product_variants[{{ $sizeID . '-' . $colorID }}][sku]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </table>
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
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                            <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4" id="gallery_list">
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Ảnh sản phẩm</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]" id="gallery_default">
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
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin thêm</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="tags" class="form-label">Tags</label>
                                        <select class="form-select" name="tags[]" id="tags" multiple>
                                            @foreach($tags as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
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

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
