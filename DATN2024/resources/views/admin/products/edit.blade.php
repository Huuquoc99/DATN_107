
@extends('admin.layouts.master')

@section('title')
    Product
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> Table</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Product edit</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-5">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $product->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" value="{{ $product->price_regular }}" class="form-control @error('price_regular') is-invalid @enderror" name="price_regular" id="price_regular">
                                        @error('price_regular')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" value="{{ $product->price_sale }}" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" id="price_sale">
                                        @error('price_sale')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="catalogue_id " class="form-label">Catalogues</label>
                                        <select type="text" class="form-select @error('catalogue_id') is-invalid @enderror" name="catalogue_id" id="catalogue_id">
                                            @foreach($catalogues as $id => $name)
                                                <option
                                                    value="{{ $id }}" {{ $product->catelogue_id == $id ? 'selected' : '' }}>
                                                    {{ \Illuminate\Support\Str::limit($name, 60, '...') }}
                                                </option>

                                            @endforeach
                                        </select>
                                        @error('catalogue_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Image</label>

                                        <input type="file" class="form-control mb-3 @error('img_thumbnail') is-invalid @enderror" name="img_thumbnail" id="img_thumbnail">
                                        @if($product->img_thumbnail)
                                            <img src="{{ \Storage::url($product->img_thumbnail) }}"
                                                 alt="{{ $product->name }}" class="img-thumbnail mb-2"
                                                 style="max-width: 200px;">
                                        @endif
                                        @error('img_thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="processor" class="form-label">Processor</label>
                                        <input type="text" class="form-control @error('processor') is-invalid @enderror" name="processor" id="processor" value="{{ $product->processor }}">
                                        @error('processor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="ram" class="form-label">Ram</label>
                                        <input type="text" class="form-control @error('ram') is-invalid @enderror" name="ram" id="ram" value="{{ $product->ram }}">
                                        @error('ram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="short_description" class="form-label">Short description</label>
                                        <textarea class="form-control" name="short_description" id="short_description" rows="2">{{ $product->short_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-7 mt-2">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="sku" class="form-label">SKU</label>
                                            <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" value="{{ $product->sku }}">
                                            @error('sku')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="screen_size" class="form-label">Screen size</label>
                                            <input type="text" class="form-control @error('screen_size') is-invalid @enderror" name="screen_size" id="screen_size" value="{{ $product->screen_size }}">
                                            @error('screen_size')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="operating_system" class="form-label">Operating system</label>
                                            <input type="text" class="form-control @error('operating_system') is-invalid @enderror" name="operating_system" id="operating_system" value="{{ $product->operating_system }}">
                                            @error('operating_system')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="battery_capacity" class="form-label">Battery capacity</label>
                                            <input type="text" class="form-control @error('battery_capacity') is-invalid @enderror" name="battery_capacity" id="battery_capacity" value="{{ $product->battery_capacity }}">
                                            @error('battery_capacity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="camera_resolution" class="form-label">Camera resolution</label>
                                            <input type="text" class="form-control @error('camera_resolution') is-invalid @enderror" name="camera_resolution" id="camera_resolution" value="{{ $product->camera_resolution }}">
                                            @error('camera_resolution')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="network_connectivity" class="form-label">Network connectivity</label>
                                            <input type="text" class="form-control @error('network_connectivity') is-invalid @enderror" name="network_connectivity" id="network_connectivity" value="{{ $product->network_connectivity }}">
                                            @error('network_connectivity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="storage" class="form-label">Storage</label>
                                            <input type="text" class="form-control @error('storage') is-invalid @enderror" name="storage" id="storage" value="{{ $product->storage }}">
                                            @error('storage')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="sim_type" class="form-label">Sim type</label>
                                            <input type="text" class="form-control @error('sim_type') is-invalid @enderror" name="sim_type" id="sim_type" value="{{ $product->sim_type }}">
                                            @error('sim_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-5">
                                            <div class="row">
                                                @php
                                                    $is = [
                                                        'is_active' => ['name' => 'Active', 'color' => 'primary'],
                                                        'is_hot_deal' => ['name' => 'Hot deal', 'color' => 'danger'],
                                                        'is_good_deal' => ['name' => 'Good deal', 'color' => 'warning'],
                                                        'is_new' => ['name' => 'New', 'color' => 'success'],
                                                        'is_show_home' => ['name' => 'Show home', 'color' => 'info'],
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

                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="content"
                                          rows="2">{!! $product->description !!}</textarea>
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
                        <h4 class="card-title mb-0 flex-grow-1">Variant</h4>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addNewVariant()"><i class="fa-solid fa-plus fa-xl"></i></button>

                    </div><!-- end card header -->
                    <div class="card-body" style="height: 450px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="variant-table">
                                        <tr class="text-center">
                                            <th>Capacity</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th></th>
                                        </tr>

                                        @php
                                            $variants = [];
                                            $product->variants->map(function ($item) use (&$variants) {
                                                $key = $item->product_capacity_id . '-' . $item->product_color_id;

                                                $variants[$key] = [
                                                    'quantity' => $item->quantity,
                                                    'image' => $item->image,
                                                    'price' => $item->price,
                                                ];
                                            });
                                        @endphp

                                        @foreach($capacities as $capacityID => $capacityName)
                                            @php
                                                $hasDataInCapacity = false;
                                                $visibleColorsInCapacity = [];

                                                foreach($colors as $colorID => $colorName) {
                                                    $key = $capacityID . '-' . $colorID;
                                                    if (
                                                        isset($variants[$key]) &&
                                                        (
                                                            !empty($variants[$key]['quantity']) ||
                                                            !empty($variants[$key]['price']) ||
                                                            !empty($variants[$key]['image'])
                                                        )
                                                    ) {
                                                        $hasDataInCapacity = true;
                                                        $visibleColorsInCapacity[] = $colorID;
                                                    }
                                                }
                                            @endphp

                                            @if($hasDataInCapacity)
                                                @php($flagRowspan = true)
                                                @foreach($colors as $colorID => $colorName)
                                                    @php($key = $capacityID . '-' . $colorID)
                                                    @if(in_array($colorID, $visibleColorsInCapacity))
                                                        <tr class="text-center" data-variant="{{ $capacityID . '-' . $colorID }}" data-size="{{ $capacityID }}">
                                                            @if($flagRowspan)
                                                                <td style="vertical-align: middle;" rowspan="{{ count($visibleColorsInCapacity) }}" class="size-cell-{{ $capacityID }}">
                                                                    {{ $capacityName }}
                                                                </td>
                                                            @endif
                                                            @php($flagRowspan = false)
                                                            <td>
                                                                <div>{{ $colorName }}</div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                       value="{{ isset($variants[$key]['quantity']) ? $variants[$key]['quantity'] : 0 }}"
                                                                       name="product_variants[{{ $key }}][quantity]">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                       value="{{ isset($variants[$key]['price']) ? $variants[$key]['price'] : 0 }}"
                                                                       name="product_variants[{{ $key }}][price]">
                                                            </td>
                                                            <td>
                                                                <input type="file" class="form-control" name="product_variants[{{ $key }}][image]">
                                                                <input type="hidden" class="form-control"
                                                                       value="{{ isset($variants[$key]['image']) ? $variants[$key]['image'] : '' }}"
                                                                       name="product_variants[{{ $key }}][current_image]">
                                                            </td>
                                                            <td>
                                                                @if(isset($variants[$key]['image']) && $variants[$key]['image'])
                                                                    <img src="{{ Storage::url($variants[$key]['image']) }}" width="100px" height="100px">
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
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
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Create</button>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                @if(count($product->galleries) > 0)
                                    @foreach($product->galleries as $item)
                                        <div class="col-md-4" id="storage_{{ $item->id }}_item">
                                            <label for="gallery_default" class="form-label">Image</label>
                                            <div>
                                                <div class="d-flex">
                                                    <input type="file" class="form-control me-3" name="product_galleries[]" id="gallery_default">
                                                    <button type="button" class="btn btn-danger"
                                                            onclick="removeImageGallery('storage_{{ $item->id }}_item', '{{ $item->id }}', '{{ $item->image }}')">
                                                        <span class="bx bx-trash"></span>
                                                    </button>
                                                </div>
                                                <img class="mt-3" src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}" width="100px" alt="">
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
                            <div id="delete_galleries"></div>
                        </div>

                    </div>
                </div>
            </div>
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


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">More information</h4>
                    </div>
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
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary">Product edit
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

@section('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('tr.no-data').forEach(function(row) {
                row.style.display = 'none';
            });
        });

        CKEDITOR.replace('content')

        let variantCount = 0;

        function addNewVariant() {

            const sizeID = `newSize${variantCount}`;
            const colorID = `newColor${variantCount}`;
            variantCount++;

            const newRow = `
            <tr class="text-center">
                <td style="vertical-align: middle;">
                     <input type="text" class="form-control" name="new_product_variants[${sizeID}-${colorID}][size]" placeholder="Capacity">
                 </td>
               <td style="vertical-align: middle;">
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
                <td></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeVariant(this)">Xóa</button>
                </td>
            </tr>
                   `;

            document.querySelector('tbody').insertAdjacentHTML('beforeend', newRow);
        }

        function handleCapacityChange(select) {
            const row = select.closest('tr');
            const newCapacityInput = row.querySelector('.new-capacity-input');

            if (select.value === 'new') {
                newCapacityInput.style.display = 'block';
            } else {
                newCapacityInput.style.display = 'none';
            }
        }

        function handleColorChange(select) {
            const row = select.closest('tr');
            const newColorInput = row.querySelector('.new-color-input');

            if (select.value === 'new') {
                newColorInput.style.display = 'block';
            } else {
                newColorInput.style.display = 'none';
            }
        }

        function removeVariant(button) {
            if(confirm('Bạn có chắc chắn muốn xóa biến thể này?')) {
                button.closest('tr').remove();
            }
        }




        function removeVariant(variantId) {
            const row = document.querySelector(`tr[data-variant="${variantId}"]`);
            if (!row) return;

            const capacityID = row.getAttribute('data-size');
            const sizeRows = document.querySelectorAll(`tr[data-size="${capacityID}"]`);
            const totalRows = sizeRows.length;

            if (totalRows === 1) {
                row.remove();
                return;
            }

            const currentIndex = Array.from(sizeRows).indexOf(row);
            const sizeCell = document.querySelector(`.size-cell-${capacityID}`);

            if (currentIndex === 0 && sizeCell) {
                const nextRow = sizeRows[1];
                sizeCell.setAttribute('rowspan', totalRows - 1);
                nextRow.insertBefore(sizeCell, nextRow.firstChild);
            } else if (sizeCell) {
                sizeCell.setAttribute('rowspan', totalRows - 1);
            }

            row.remove();
        }

        function addImageGallery() {
            const randomId = 'gallery_' + Math.random().toString(36).substr(2, 9);

            const newGalleryHtml = `
        <div class="col-md-4" id="${randomId}_item">
            <label class="form-label">Image</label>
            <div class="d-flex">
                <input type="file"
                       class="form-control me-3"
                       name="product_galleries[]"
                       onchange="previewImage(this)"
                       accept="image/*">
                <button type="button"
                        class="btn btn-danger"
                        onclick="removeImageGallery('${randomId}_item')">
                    <span class="bx bx-trash"></span>
                </button>
            </div>
            <div class="mt-2">
                <img class="preview-image mt-3" src="" width="100px" style="display:none;">
            </div>
        </div>
    `;

            document.getElementById('gallery_list').insertAdjacentHTML('beforeend', newGalleryHtml);
        }

        function removeImageGallery(itemId, galleryId = null, imagePath = null) {
            const element = document.getElementById(itemId);
            if (element) {
                element.remove();
            }

            if (galleryId && imagePath) {
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_galleries[]';
                deleteInput.value = galleryId;

                document.getElementById('delete_galleries').appendChild(deleteInput);
            }

            const galleryList = document.getElementById('gallery_list');
            if (galleryList.children.length === 0) {
                addDefaultGalleryItem();
            }
        }

        function addDefaultGalleryItem() {
            const defaultHtml = `
        <div class="col-md-4" id="gallery_default_item">
            <label for="gallery_default" class="form-label">Image</label>
            <div class="d-flex">
                <input type="file"
                       class="form-control"
                       name="product_galleries[]"
                       id="gallery_default"
                       onchange="previewImage(this)"
                       accept="image/*">
            </div>
            <div class="mt-2">
                <img class="preview-image mt-3" src="" width="100px" style="display:none;">
            </div>
        </div>
    `;
            document.getElementById('gallery_list').innerHTML = defaultHtml;
        }

        function previewImage(input) {
            const previewImg = input.parentElement.nextElementSibling.querySelector('.preview-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
            }
        }

    </script>
@endsection
