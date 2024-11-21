
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
                    <h4 class="card-title mb-0 flex-grow-1">Variant</h4>
                    <button type="button" class="btn btn-primary btn-sm" onclick="addNewVariant()">Thêm Mới Biến Thể</button>
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
                                        <th>Xóa</th>
                                    </tr>
                                    @foreach($capacity as $sizeID => $sizeName)
                                    @php($flagRowspan = true)
                                    @foreach($colors as $colorID => $colorName)
                                    <tr class="text-center" data-variant="{{ $sizeID . '-' . $colorID }}" data-size="{{ $sizeID }}">
                                        @if($flagRowspan)
                                        <td style="vertical-align: middle;" rowspan="{{ count($colors) }}" class="size-cell-{{ $sizeID }}">{{ $sizeName }}</td>
                                        @endif
                                        @php($flagRowspan = false)

                                        <td>
                                            <div style="width: 40px; height: 40px; background: {{ $colorName }}; border: #0a0c0d 1px solid"></div>
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
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeVariant('{{ $sizeID . '-' . $colorID }}')">Xóa</button>
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

    function addNewVariant() {
        alert(1);
        const variantTable = document.querySelector('#variant-table');
        const newRow = document.createElement('tr');
        newRow.classList.add('text-center');

        newRow.innerHTML = `
            <td>
                <input type="text" class="form-control" name="new_variants[][size]" placeholder="Dung lượng">
            </td>
            <td>
                <input type="text" class="form-control" name="new_variants[][color]" placeholder="Màu sắc">
            </td>
            <td>
                <input type="number" class="form-control" name="new_variants[][quantity]" placeholder="Số lượng">
            </td>
            <td>
                <input type="number" class="form-control" name="new_variants[][price]" placeholder="Giá bán">
            </td>
            <td>
                <input type="text" class="form-control" name="new_variants[][sku]" placeholder="SKU">
            </td>
            <td>
                <input type="file" class="form-control" name="new_variants[][image]">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">Xóa</button>
            </td>
        `;

        variantTable.appendChild(newRow);
    }

</script>
@endsection
