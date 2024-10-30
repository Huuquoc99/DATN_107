@extends('admin.layouts.master')

@section('title')
    Chi tiết sản phẩm: {{ $product->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
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
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                                                <div class="product-img">
                                                    <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                            </div>
                                            @foreach($product->galleries as $index => $gallery)
                                                <div class="tab-pane fade" id="product-{{ $index + 2 }}" role="tabpanel">
                                                    <div class="product-img">
                                                        <img src="{{ Storage::url($gallery->image) }}" alt="" class="img-fluid mx-auto d-block">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-3 col-4">
                                        <div class="nav flex-column nav-pills" role="tablist">
                                            <a class="nav-link active" id="product-1-tab" data-bs-toggle="pill" href="#product-1" role="tab">
                                                <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                            </a>
                                            @foreach($product->galleries as $index => $gallery)
                                                <a class="nav-link" id="product-{{ $index + 2 }}-tab" data-bs-toggle="pill" href="#product-{{ $index + 2 }}" role="tab">
                                                    <img src="{{ Storage::url($gallery->image) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <h4 class="mt-1 mb-3">{{ $product->name }}</h4>

                                <h5 class="mb-4">Giá:
                                    @if($product->price_sale)
                                        <span class="text-muted me-2"><del>${{ number_format($product->price_regular, 2) }}</del></span>
                                        <b>${{ number_format($product->price_sale, 2) }}</b>
                                    @else
                                        <b>${{ number_format($product->price_regular, 2) }}</b>
                                    @endif
                                </h5>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted"><i class="bx bx-unlink font-size-16 align-middle text-primary me-1"></i> SKU: {{ $product->sku }}</p>
                                            <p class="text-muted"><i class="bx bx-shape-triangle font-size-16 align-middle text-primary me-1"></i> Danh mục: {{ $product->catalogue->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted"><i class="bx bx-cog font-size-16 align-middle text-primary me-1"></i> Material: {{ $product->material }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-color">
                                    <h5 class="font-size-15">Màu sắc và dung lượng:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Màu</th>
                                            <th>Dung lượng</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Mã</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->variants as $variant)
                                            <tr>
                                                <td>{{ $color[$variant->product_color_id] ?? 'Không xác định' }}</td>
                                                <td>{{ $capacity[$variant->product_capacity_id] ?? 'Không xác định' }}</td>
                                                <td>{{ $variant->quantity }}</td>
                                                <td>{{ $variant->price }}</td>
                                                <td>{{ $variant->sku }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    @if($product->is_active)
                                        <span class="badge bg-primary">Đang kích hoạt</span>
                                    @endif
                                    @if($product->is_hot_deal)
                                        <span class="badge bg-danger">Là sản phẩm hot</span>
                                    @endif
                                    @if($product->is_good_deal)
                                        <span class="badge bg-warning">Sản phẩm ưu đãi</span>
                                    @endif
                                    @if($product->is_new)
                                        <span class="badge bg-success">Sản phẩm mới</span>
                                    @endif
                                    @if($product->is_show_home)
                                        <span class="badge bg-info">Sản phẩm hiển thị trang chủ</span>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-3">Tags:</h5>
                                    @foreach($product->tags as $tag)
                                        <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="mt-5">
                        <h5 class="mb-3">Thông tin chi tiết :</h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="row" style="width: 400px;">Mô tả ngắn</th>
                                    <td>{{ $product->short_description }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mô tả dài</th>
                                    <td>
                                        {!!$product->description!!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
