
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
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{{ $product->name }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="sku" class="form-label">Mã</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                               value="{{ $product->sku }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" value="{{ $product->price_regular }}" class="form-control"
                                               name="price_regular" id="price_regular">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" value="{{ $product->price_sale }}" class="form-control"
                                               name="price_sale" id="price_sale">
                                    </div>
                                    <div class="mt-3">
                                        <label for="catalogue_id " class="form-label">Catalogues</label>
                                        <select type="text" class="form-select" name="catalogue_id" id="catalogue_id">
                                            @foreach($catalogues as $id => $name)
                                                <option
                                                    value="{{ $id }}" {{ $product->catelogue_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Ảnh đại diện</label>
                                        @if($product->img_thumbnail)
                                            <img src="{{ \Storage::url($product->img_thumbnail) }}"
                                                 alt="{{ $product->name }}" class="img-thumbnail mb-2"
                                                 style="max-width: 200px;">
                                        @endif
                                        <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail">
                                    </div>
                                </div>
                                <div class="col-md-7 mt-2">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="screen_size" class="form-label">Kích thước màn hình</label>
                                            <input type="text" class="form-control" name="screen_size" id="screen_size" value="{{ $product->screen_size }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="operating_system" class="form-label">Hệ điều hành</label>
                                            <input type="text" class="form-control" name="operating_system" id="operating_system" value="{{ $product->operating_system }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="battery_capacity" class="form-label">Dung lượng pin</label>
                                            <input type="text" class="form-control" name="battery_capacity" id="battery_capacity" value="{{ $product->battery_capacity }}">
                                        </div>

                                        <div class="mt-3">
                                            <label for="camera_resolution" class="form-label">Camera</label>
                                            <input type="text" class="form-control" name="camera_resolution" id="camera_resolution" value="{{ $product->camera_resolution }}">
                                        </div>

                                        <div class="mt-3">
                                            <label for="network_connectivity" class="form-label">Mạng</label>
                                            <input type="text" class="form-control" name="network_connectivity" id="network_connectivity" value="{{ $product->network_connectivity }}">
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
                                                                   name="{{ $key }}" value="1" id="{{ $key }}"
                                                                {{ isset($product) && $product->$key ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="{{ $key }}">{{ $value['name'] }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <label for="short_description" class="form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" name="short_description" id="short_description" rows="2">{{ $product->short_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="description" class="form-label">Mô tả dài<</label>
                                <textarea class="form-control" name="description" id="content"
                                          rows="2">{!! $product->description !!}</textarea>
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
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                        </tr>

                                        @php
                                            $variants = [];
                                            $product->variants->map(function ($item) use (&$variants) {
                                                $key = $item->product_capacity_id . '-' . $item->product_color_id;

                                                $variants[$key] = [
                                                    'quantity' => $item->quantity,
                                                    'image' => $item->image,
                                                    'price' => $item->price,
                                                    'sku' => $item->sku,
                                                ];
                                            });
                                        @endphp


                                        @foreach($capacities as $capacityID => $capacityName)
                                            @php($flagRowspan = true)
                                            @foreach($colors as $colorID => $colorName)
                                                @php($key = $capacityID . '-' . $colorID)
                                                <tr class="text-center">
                                                    @if($flagRowspan)
                                                        <td style="vertical-align: middle;" rowspan="{{ count($colors) }}"><b>{{ $capacityName }}</b></td>
                                                    @endif
                                                    @php($flagRowspan = false)
                                                    <td>
                                                        <div style="width: 50px; height: 50px; background: {{ $colorName }}; border: #0a0c0d 1px solid"></div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ isset($variants[$key]['quantity']) ? $variants[$key]['quantity'] : 0 }}" name="product_variants[{{ $key }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ isset($variants[$key]['price']) ? $variants[$key]['price'] : 0 }}" name="product_variants[{{ $key }}][price]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ isset($variants[$key]['sku']) ? $variants[$key]['sku'] : 0 }}" name="product_variants[{{ $key }}][sku]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="product_variants[{{ $key }}][image]">
                                                        <input type="hidden" class="form-control" value="{{ isset($variants[$key]['image']) ? $variants[$key]['image'] : '' }}" name="product_variants[{{ $key }}][current_image]">
                                                    </td>
                                                    <td>
                                                        @if(isset($variants[$key]['image']) && $variants[$key]['image'])
                                                            <img src="{{ \Storage::url($variants[$key]['image']) }}" width="100px">
                                                        @endif
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
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                @if(count($product->galleries) > 0)
                                    @foreach($product->galleries as $item)
                                        <div class="col-md-4" id="storage_{{ $item->id }}_item">
                                            <label for="gallery_default" class="form-label">Image</label>
                                            <div class="d-flex">
                                                <input type="file" class="form-control" name="product_galleries[]"
                                                       id="gallery_default">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}" width="100px" alt="">
                                                <button type="button" class="btn btn-danger"
                                                        onclick="removeImageGallery('storage_{{ $item->id }}_item', '{{ $item->id }}', '{{ $item->image }}')">
                                                    <span class="bx bx-trash"></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="product_galleries[]"
                                                   id="gallery_default">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{--Thằng này dùng để lưu ảnh xóa--}}
                            <div id="delete_galleries"></div>
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
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin thêm</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="tags" class="form-label">Tags</label>
                                        <select class="form-select" name="tags[]" id="tags" multiple>
                                            @foreach($tags as $id => $name)
                                                <option
                                                    value="{{ $id }}" {{ $product->tags->contains($id) ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
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
                        <button class="btn btn-primary">Chỉnh sửa  <i
                                class="fa-regular fa-pen-to-square fa-sm"></i></button>
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
