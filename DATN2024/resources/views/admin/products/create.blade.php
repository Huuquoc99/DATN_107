@extends('admin.layouts.master')

@section('title')
    TechStore
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-5">
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="name" value="{{ old('name') }}">
                                        @error("name")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price Regular -->
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Giá thường</label>
                                        <input type="number"
                                               class="form-control @error('price_regular') is-invalid @enderror"
                                               name="price_regular" id="price_regular"
                                               value="{{ old('price_regular') }}">
                                        @error("price_regular")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price Sale -->
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Giá khuyến mãi</label>
                                        <input type="number" class="form-control" name="price_sale" id="price_sale"
                                               value="{{ old('price_sale') }}">
                                        @error("price_sale")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Catalogues -->
                                    <div class="mt-3">
                                        <label for="catalogue_id" class="form-label">Danh mục</label>
                                        <select class="form-select @error('catalogue_id') is-invalid @enderror"
                                                name="catalogue_id" id="catalogue_id">
                                            <option value="0" {{ old('catalogue_id') == 0 ? 'selected' : '' }}>
                                                Danh mục
                                            </option>
                                            @foreach($catalogues as $id => $name)
                                                <option
                                                    value="{{ $id }}" {{ old('catalogue_id') == $id ? 'selected' : '' }}>
                                                    {{ \Illuminate\Support\Str::limit($name, 55, '...') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("catalogue_id")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Image Thumbnail -->
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Hình ảnh</label>
                                        <input type="file"
                                               class="form-control @error('img_thumbnail') is-invalid @enderror"
                                               name="img_thumbnail" id="img_thumbnail">
                                        @error("img_thumbnail")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Processor -->
                                    <div class="mt-3">
                                        <label for="processor" class="form-label">Bộ xử lý</label>
                                        <input type="text" class="form-control @error('processor') is-invalid @enderror"
                                               name="processor" id="processor" value="{{ old('processor') }}">
                                        @error("processor")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- RAM -->
                                    <div class="mt-3">
                                        <label for="ram" class="form-label">Ram</label>
                                        <input type="text" class="form-control @error('ram') is-invalid @enderror"
                                               name="ram" id="ram" value="{{ old('ram') }}">
                                        @error("ram")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    <!-- Short Description -->
                                    <div class="mt-3">
                                        <label for="short_description" class="form-label">Mô tả ngắn gọn</label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror"
                                                  name="short_description" id="short_description"
                                                  rows="2">{{ old('short_description') }}</textarea>
                                        @error("short_description")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-7 mt-2">
                                    <div class="row">
                                        <!-- SKU -->
                                        <div class="mt-3">
                                            <label for="sku" class="form-label">SKU</label>
                                            <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                                   name="sku" id="sku"
                                                   value="{{ old('sku', strtoupper(\Str::random(8))) }}">
                                        </div>

                                        <!-- Screen Size -->
                                        <div class="mt-3">
                                            <label for="screen_size" class="form-label">Kích thước màn hình</label>
                                            <input type="text"
                                                   class="form-control @error('screen_size') is-invalid @enderror"
                                                   name="screen_size" id="screen_size" value="{{ old('screen_size') }}">
                                            @error("screen_size")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Operating System -->
                                        <div class="mt-3">
                                            <label for="operating_system" class="form-label">Hệ điều hành</label>
                                            <input type="text"
                                                   class="form-control @error('operating_system') is-invalid @enderror"
                                                   name="operating_system" id="operating_system"
                                                   value="{{ old('operating_system') }}">
                                            @error("operating_system")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Battery Capacity -->
                                        <div class="mt-3">
                                            <label for="battery_capacity" class="form-label">Dung lượng pin</label>
                                            <input type="text"
                                                   class="form-control @error('battery_capacity') is-invalid @enderror"
                                                   name="battery_capacity" id="battery_capacity"
                                                   value="{{ old('battery_capacity') }}">
                                            @error("battery_capacity")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Camera Resolution -->
                                        <div class="mt-3">
                                            <label for="camera_resolution" class="form-label">Độ phân giải của máy ảnh</label>
                                            <input type="text"
                                                   class="form-control @error('camera_resolution') is-invalid @enderror"
                                                   name="camera_resolution" id="camera_resolution"
                                                   value="{{ old('camera_resolution') }}">
                                            @error("camera_resolution")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Network Connectivity -->
                                        <div class="mt-3">
                                            <label for="network_connectivity" class="form-label">Kết nối mạng</label>
                                            <input type="text"
                                                   class="form-control @error('network_connectivity') is-invalid @enderror"
                                                   name="network_connectivity" id="network_connectivity"
                                                   value="{{ old('network_connectivity') }}">
                                            @error("network_connectivity")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                         <!-- Storage -->
                                        <div class="mt-3">
                                            <label for="storage" class="form-label">Storage</label>
                                            <input type="text"
                                                   class="form-control @error('storage') is-invalid @enderror"
                                                   name="storage" id="storage" value="{{ old('storage') }}">
                                            @error("storage")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- SIM Type -->
                                        <div class="mt-3">
                                            <label for="sim_type" class="form-label">Loại SIM</label>
                                            <input type="text" class="form-control @error('sim_type') is-invalid @enderror"
                                                name="sim_type" id="sim_type" value="{{ old('sim_type') }}">
                                            @error("sim_type")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Checkboxes -->
                                        <div class="mt-5">
                                            <div class="row">
                                                @php
                                                    $is = [
                                                        'is_active' => ['name' => 'Hoạt động', 'color' => 'primary'],
                                                        'is_hot_deal' => ['name' => 'Khuyến mãi hấp dẫn', 'color' => 'danger'],
                                                        'is_good_deal' => ['name' => 'Thỏa thuận tốt', 'color' => 'warning'],
                                                        'is_new' => ['name' => 'Mới', 'color' => 'success'],
                                                        'is_show_home' => ['name' => 'Hiển thị Trang chủ', 'color' => 'info'],
                                                    ];
                                                @endphp

                                                @foreach($is as $key => $value)
                                                    <div class="col-md-4 mb-3">
                                                        <div
                                                            class="form-check form-switch form-switch-{{ $value['color'] }} d-flex align-items-center">
                                                            <input class="form-check-input me-2" type="checkbox"
                                                                   role="switch"
                                                                   name="{{ $key }}" value="1" id="{{ $key }}"
                                                                {{ old($key, $key == 'is_active' ? 1 : 0) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                   for="{{ $key }}">{{ $value['name'] }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                                        <h4 class="card-title mb-0 flex-grow-1">Biến thể sản phẩm</h4>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addNewVariant()"><i
                                                class="fa-solid fa-plus fa-xl"></i></button>
                                    </div>
                                    <div class="card-body" style="height: 450px; overflow: scroll">
                                        <div class="live-preview">
                                            <div class="row gy-4">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="variant-table">
                                                        <tbody>
                                                        <tr class="text-center">
                                                            <th>Dung lượng</th>
                                                            <th>Màu sắc</th>
                                                            <th>Số lượng</th>
                                                            <th>Giá</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                        @php($product_variants = session('product_variants'))
                                                        @php($new_product_variants = session('new_product_variants'))
                                                        @foreach ($capacity as $sizeID => $sizeName)
                                                            @php($flagRowspan = true)
                                                            @foreach ($colors as $colorID => $colorName)
                                                                @php($check = check_show_variants_ui($sizeID . '-' . $colorID))
                                                                @if ($check || is_null($product_variants))
                                                                    <tr class="text-center"
                                                                        data-variant="{{ $sizeID . '-' . $colorID }}"
                                                                        data-size="{{ $sizeID }}">
                                                                        @if ($flagRowspan)
                                                                            <td style="vertical-align: middle;"
                                                                                rowspan="{{ count($colors) }}"
                                                                                class="size-cell-{{ $sizeID }}">
                                                                                {{ $sizeName }}
                                                                            </td>
                                                                        @endif
                                                                        @php($flagRowspan = false)

                                                                        <td>
                                                                            <div>{{ $colorName }}</div>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control"
                                                                                   name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                                                   value="{{ !is_null($check) ? @$product_variants["$sizeID-$colorID"]['quantity'] : '' }}">
                                                                            @error("product_variants.{$sizeID}-{$colorID}.quantity")
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control"
                                                                                   name="product_variants[{{ $sizeID . '-' . $colorID }}][price]"
                                                                                   value="{{ !is_null($check) ? @$product_variants["$sizeID-$colorID"]['price'] : '' }}">
                                                                            @error("product_variants.{$sizeID}-{$colorID}.price")
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </td>
                                                                        <td>
                                                                            <input type="file" class="form-control"
                                                                                   name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                                            @error("product_variants.{$sizeID}-{$colorID}.image")
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                                    onclick="removeVariant('{{ $sizeID . '-' . $colorID }}')">Del</button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        </tbody>
                                                        @if ($new_product_variants)
                                                            @foreach ($new_product_variants as $key => $new_product_variant)
                                                                <tr class="text-center new_product_variants">
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                               name="new_product_variants[{{ $key }}][size]"
                                                                               placeholder="Capacity"
                                                                               value="{{ @$new_product_variant['size'] }}">
                                                                        @error("new_product_variants.$key.size")
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                               name="new_product_variants[{{ $key }}][color]"
                                                                               placeholder="Color"
                                                                               value="{{ @$new_product_variant['color'] }}">
                                                                        @error("new_product_variants.$key.color")
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                               name="new_product_variants[{{ $key }}][quantity]"
                                                                               placeholder="Quantity"
                                                                               value="{{ @$new_product_variant['quantity'] }}">
                                                                        @error("new_product_variants.$key.quantity")
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                               name="new_product_variants[{{ $key }}][price]"
                                                                               placeholder="Price"
                                                                               value="{{ @$new_product_variant['price'] }}">
                                                                        @error("new_product_variants.$key.price")
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="file" class="form-control"
                                                                               name="new_product_variants[{{ $key }}][image]">
                                                                        @error("new_product_variants.$key.image")
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                                onclick="this.parentNode.parentNode.remove()">Xóa</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </table>
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
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Bộ sưu tập</h4>
                                            <button type="button" class="btn btn-primary" onclick="addImageGallery()"><i
                                                    class="fa-solid fa-plus fa-lg"></i></button>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row gy-4" id="gallery_list">
                                                    <div class="col-md-4" id="gallery_default_item">
                                                        <label for="gallery_default" class="form-label">Hình ảnh</label>
                                                        <div class="d-flex">
                                                            <input type="file" class="form-control"
                                                                   name="product_galleries[]" id="gallery_default">
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
                                        <button class="btn btn-primary">Thêm mới <i
                                                class="fa-regular fa-plus"></i></button>
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-success"
                                           style="margin-left: 10px">Danh sách</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <input type="file" class="form-control me-3" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger " onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Are you sure you want to delete?')) {
                $('#' + id).remove();
            }
        }

        function removeVariant(variantId) {
            const row = document.querySelector(`tr[data-variant="${variantId}"]`);
            if (!row) return;

            const sizeId = row.getAttribute('data-size');
            const sizeRows = document.querySelectorAll(`tr[data-size="${sizeId}"]`);
            const totalRows = sizeRows.length;

            if (totalRows === 1) {
                row.remove();
                return;
            }

            const currentIndex = Array.from(sizeRows).indexOf(row);
            const sizeCell = document.querySelector(`.size-cell-${sizeId}`);

            if (currentIndex === 0 && sizeCell) {
                const nextRow = sizeRows[1];
                sizeCell.setAttribute('rowspan', totalRows - 1);
                nextRow.insertBefore(sizeCell, nextRow.firstChild);
            } else if (sizeCell) {
                sizeCell.setAttribute('rowspan', totalRows - 1);
            }

            row.remove();
        }

        let variantCount = 0;

        function addNewVariant() {

            const variantTable = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.classList.add('text-center');

            const sizeID = `newSize${variantCount}`;
            const colorID = `newColor${variantCount}`;
            variantCount++;

            newRow.innerHTML = `
                <tr class="text-center">
                    <td>
                        <input type="text" class="form-control" name="new_product_variants[${sizeID}-${colorID}][size]" placeholder="Capacity">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="new_product_variants[${sizeID}-${colorID}][color]" placeholder="Color">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="new_product_variants[${sizeID}-${colorID}][quantity]" placeholder="Quantity">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="new_product_variants[${sizeID}-${colorID}][price]" placeholder="Price">
                    </td>
                    <td>
                        <input type="file" class="form-control" name="new_product_variants[${sizeID}-${colorID}][image]">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">Xóa</button>
                    </td>
                </tr>
            `;

            variantTable.appendChild(newRow);
        }


    </script>
@endsection
