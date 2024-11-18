@extends('admin.layouts.master')

@section('title')
    Product detail: {{ $product->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product detail</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Table</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="product-detail-imgs">
                                <div class="product-gallery">
                                    <div class="main-image mb-3">
                                        <img id="mainImage" src="{{ Storage::url($product->img_thumbnail) }}" alt="{{ $product->name }}" class="img-fluid">
                                    </div>
                                    <div class="thumbnail-container d-flex flex-wrap justify-content-center">
                                        @foreach($product->galleries as $key => $gallery)
                                            <div class="thumbnail-item {{ $key == 0 ? 'active' : '' }}" data-image="{{ Storage::url($gallery->image) }}">
                                                <img src="{{ Storage::url($gallery->image) }}" alt="Product Image {{ $key + 1 }}" class="img-fluid">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="product-content mt-5">
                                    <h5 class="fs-15 mb-3">Product Description:</h5>
                                    <nav>
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Specification</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="nav-tag-tab" data-bs-toggle="tab" href="#nav-tag" role="tab" aria-controls="nav-tag" aria-selected="false">Tags</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">Status</th>
                                                        <td>
                                                            <div>
                                                                @if($product->is_active)
                                                                    <span class="badge bg-primary">Active</span>
                                                                @endif
                                                                @if($product->is_hot_deal)
                                                                    <span class="badge bg-danger">Hot deal</span>
                                                                @endif
                                                                @if($product->is_good_deal)
                                                                    <span class="badge bg-warning">Good deal</span>
                                                                @endif
                                                                @if($product->is_new)
                                                                    <span class="badge bg-success">New</span>
                                                                @endif
                                                                @if($product->is_show_home)
                                                                    <span class="badge bg-info">Show home</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;">Brands</th>
                                                        <td>
                                                            {{ \Illuminate\Support\Str::limit($product->catalogue ? $product->catalogue->name : 'No Catalogue', 30, '...') }}
                                                        </td>
                                                        

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Screen Size</th>
                                                        <td>{{ $product->screen_size }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Battery</th>
                                                        <td>{{ $product->battery_capacity }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Camera</th>
                                                        <td>{{ $product->camera_resolution }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Processor</th>
                                                        <td>{{ $product->processor }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Ram</th>
                                                        <td>{{ $product->ram }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Storage</th>
                                                        <td>{{ $product->storage }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                            <div>
                                                <p>{!! $product->description !!}</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-tag" role="tabpanel" aria-labelledby="nav-tag-tab">
                                            <div>
                                                <div class="mt-4">
                                                    @foreach($product->tags as $tag)
                                                        <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <div class="row d-flex justify-content-between">
                                    <h4 class="col-10 mt-1 mb-3">{{ $product->name }}</h4>

                                    <div class="col-2 flex-shrink-0">
                                        <div>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-muted">Published : 
                                    <span class="text-body fw-medium">
                                        <span id="invoice-date">{{ $product->created_at->format('d M, Y') }}</span> 
                                        <small class="text-muted" id="invoice-time">{{ $product->created_at->format('h:iA') }}</small>
                                    </span>
                                </div>
                                <div class="text-muted">Updated : 
                                    <span class="text-body fw-medium">
                                        <span id="invoice-date">{{ $product->updated_at->format('d M, Y') }}</span> 
                                        <small class="text-muted" id="invoice-time">{{ $product->updated_at->format('h:iA') }}</small>
                                    </span>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Price</p>
                                                    <h5 class="mb-0">{{ number_format($product->price_regular, 0, ',', '.') }} VND</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                                        <i class="ri-stack-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Available Stock </p>
                                                    <h5 class="mb-0">{{ $totalQuantity }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-primary fs-24">
                                                        <i class="ri-inbox-archive-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Total Revenue</p>
                                                    <h5 class="mb-0">$60,645</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div>
                                        <p class="text-muted">
                                            <i class="bx bx-unlink font-size-20 align-middle text-primary me-1"></i> 
                                            <b>SKU: </b>
                                            {{ $product->sku }}
                                        </p>
                                        <p class="text-muted">
                                            <i class="bx bx-shape-triangle font-size-20 align-middle text-primary me-1"></i> 
                                            <b>Catalogue:</b>
                                            {{ \Illuminate\Support\Str::limit($product->catalogue->name ?? 'N/A', 30, '...') }}
                                        </p>

                                    </div>
                                </div>

                                <div class="mt-2 text-muted">
                                    <h5 class="fs-14">Short description :</h5>
                                    <p>{{$product->short_description}}</p>
                                </div>

                                <div class="product-color">
                                    <h5 class="fs-15">Product Variant:</h5>
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Capacity</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->variants as $variant)
                                            <tr>
                                                <td>{{ $capacity[$variant->product_capacity_id] ?? 'Không xác định' }}</td>
                                                <td>{{ $color[$variant->product_color_id] ?? 'Không xác định' }}</td>
                                                <td>{{ $variant->quantity }}</td>
                                                <td>{{ number_format($variant->price, 0, ',', '.') }} VND</td>
                                                <td>
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($variant->image) }}" style="width: 70px; height: 60px;">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary me-2">
                            <i class="bx bx-edit me-1"></i> Product edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                                <i class="bx bx-trash me-1"></i> Product delete
                            </button>
                        </form>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
