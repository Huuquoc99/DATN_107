
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Product create</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-5">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                                        @error("name")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price regular</label>
                                        <input type="number" class="form-control @error('price_regular') is-invalid @enderror" name="price_regular" id="price_regular" value="{{ old('price_regular') }}">
                                        @error("price_regular")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price sale</label>
                                        <input type="number" class="form-control" name="price_sale" id="price_sale" value="{{ old('price_sale') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="catalogue_id" class="form-label">Catalogues</label>
                                        <select class="form-select @error('catalogue_id') is-invalid @enderror" name="catalogue_id" id="catalogue_id">
                                            <option value="0">Catalogues</option>
                                            @foreach($catalogues as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error("catalogue_id")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Image thumbnail</label>
                                        <input type="file" class="form-control @error('img_thumbnail') is-invalid @enderror" name="img_thumbnail" id="img_thumbnail" value="{{ old('img_thumbnail') }}">
                                        @error("img_thumbnail")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="processor" class="form-label">Processor</label>
                                        <input type="text" class="form-control @error('processor') is-invalid @enderror"  name="processor" id="processor"  >
                                        @error("processor")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="ram" class="form-label">Ram</label>
                                        <input type="text" class="form-control @error('ram') is-invalid @enderror" name="ram" id="ram">
                                        @error("ram")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="sim_type" class="form-label">Sim type</label>
                                        <input type="text" class="form-control @error('sim_type') is-invalid @enderror" name="sim_type" id="sim_type">
                                        @error("sim_type")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="short_description" class="form-label">Short description</label>
                                        <textarea class="form-control" name="short_description" id="short_description" rows="2"></textarea>
                                        @error("short_description")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-7 mt-2">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="sku" class="form-label">SKU</label>
                                            <input type="text" class="form-control" name="sku" id="sku"
                                                   value="{{ strtoupper(\Str::random(8)) }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="screen_size" class="form-label">Screen size</label>
                                            <input type="text" class="form-control" name="screen_size" id="screen_size">
                                            @error("screen_size")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="operating_system" class="form-label">Operating system</label>
                                            <input type="text" class="form-control" name="operating_system" id="operating_system">
                                            @error("operating_system")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="battery_capacity" class="form-label">Battery capacity</label>
                                            <input type="text" class="form-control" name="battery_capacity" id="battery_capacity">
                                            @error("battery_capacity")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="camera_resolution" class="form-label">Camera resolution</label>
                                            <input type="text" class="form-control" name="camera_resolution" id="camera_resolution">
                                            @error("camera_resolution")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="network_connectivity" class="form-label">Network connectivity</label>
                                            <input type="text" class="form-control" name="network_connectivity" id="network_connectivity">
                                            @error("network_connectivity")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="storage" class="form-label">Storage</label>
                                            <input type="text" class="form-control" name="storage" id="storage">
                                            @error("storage")
                                            <p class="text-danger">{{ $message }}</p>
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
                                <label for="content" class="form-label">Description</label>
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
                        <h4 class="card-title mb-0 flex-grow-1">Variant</h4>
                    </div><!-- end card header -->
                    <div class="card-body" style="height: 450px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="text-center">
                                            <th>Capacity</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>SKU</th>
                                            <th>Image</th>
                                        </tr>

                                        @foreach($capacity as $sizeID => $sizeName)
                                            @php($flagRowspan = true)

                                            @foreach($colors as $colorID => $colorName)
                                                <tr class="text-center">

                                                    @if($flagRowspan)
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{ count($colors) }}">{{ $sizeName }}</td>
                                                    @endif
                                                    @php($flagRowspan = false)

                                                    <td style="vertical-align: middle;">
                                                        {{$colorName}}
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="product_variants[{{ $sizeID . '-' . $colorID }}][price]">
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
                            <button type="button" class="btn btn-primary" onclick="addImageGallery()">Create</button>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4" id="gallery_list">
                                    <div class="col-md-4" id="gallery_default_item">
                                        <label for="gallery_default" class="form-label">Image</label>
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
                        <button class="btn btn-primary">Product create <i class="fa-regular fa-plus"></i></button>
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
    </script>
@endsection
