
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
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-5">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                                        @error("name")
                                            <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                <p class="text-danger">{{ $message }}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" value="{{ $product->price_regular }}" class="form-control" name="price_regular" id="price_regular">
                                        @error("price_regular")
                                            <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                <p class="text-danger">{{ $message }}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" value="{{ $product->price_sale }}" class="form-control" name="price_sale" id="price_sale">
                                        @error("price_sale")
                                            <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                <p class="text-danger">{{ $message }}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @enderror
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
                                        <label for="img_thumbnail" class="form-label">Image</label>

                                        <input type="file" class="form-control mb-3" name="img_thumbnail" id="img_thumbnail">
                                        @if($product->img_thumbnail)
                                            <img src="{{ \Storage::url($product->img_thumbnail) }}"
                                                 alt="{{ $product->name }}" class="img-thumbnail mb-2"
                                                 style="max-width: 200px;">
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <label for="processor" class="form-label">Processor</label>
                                        <input type="text" class="form-control" name="processor" id="processor" value="{{ $product->processor }}">
                                        @error("processor")
                                            <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                <p class="text-danger">{{ $message }}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="ram" class="form-label">Ram</label>
                                        <input type="text" class="form-control" name="ram" id="ram" value="{{ $product->ram }}">
                                        @error("ram")
                                            <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                <p class="text-danger">{{ $message }}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
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
                                            <input type="text" class="form-control" name="sku" id="sku" value="{{ $product->sku }}">
                                            @error("sku")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="screen_size" class="form-label">Screen size</label>
                                            <input type="text" class="form-control" name="screen_size" id="screen_size" value="{{ $product->screen_size }}">
                                            @error("screen_size")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="operating_system" class="form-label">Operating system</label>
                                            <input type="text" class="form-control" name="operating_system" id="operating_system" value="{{ $product->operating_system }}">
                                            @error("operating_system")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="battery_capacity" class="form-label">Battery capacity</label>
                                            <input type="text" class="form-control" name="battery_capacity" id="battery_capacity" value="{{ $product->battery_capacity }}">
                                            @error("battery_capacity")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="camera_resolution" class="form-label">Camera resolution</label>
                                            <input type="text" class="form-control" name="camera_resolution" id="camera_resolution" value="{{ $product->camera_resolution }}">
                                            @error("camera_resolution")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="network_connectivity" class="form-label">Network connectivity</label>
                                            <input type="text" class="form-control" name="network_connectivity" id="network_connectivity" value="{{ $product->network_connectivity }}">
                                            @error("network_connectivity")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="storage" class="form-label">Storage</label>
                                            <input type="text" class="form-control" name="storage" id="storage" value="{{ $product->storage }}">
                                            @error("storage")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert" >
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="sim_type" class="form-label">Sim type</label>
                                            <input type="text" class="form-control" name="sim_type" id="sim_type" value="{{ $product->sim_type }}">
                                            @error("sim_type")
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-5">
                                            <div class="row">
                                                @php
                                                    $is = [
                                                        'is_active' => ['name' => 'Active', 'color' => 'primary'],
                                                        'is_hot_deal' => ['name' => 'Hot deal', 'color' => 'danger'],
                                                        'is_good_deal' => ['name' => 'Good deal', 'color' => 'warning'],
                                                        'is_new' => ['name' => 'Color', 'color' => 'success'],
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
                                                        <div style="width: 40px; height: 40px; background: {{ $colorName }}; border: #0a0c0d 1px solid"></div>
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
                                                            <img src="{{ \Storage::url($variants[$key]['image']) }}" width="100px" height="40px">
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
                        <button type="button" class="btn btn-primary" onclick="addImageGallery()">Create</button>
                    </div><!-- end card header -->
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

                            {{--Thằng này dùng để lưu ảnh xóa--}}
                            <div id="delete_galleries"></div>
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
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label ">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control me-3" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
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
