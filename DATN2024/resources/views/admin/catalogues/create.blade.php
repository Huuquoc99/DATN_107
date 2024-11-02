
@extends('admin.layouts.master')

@section('title')
    Catalogue create
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Catalogue create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Catalogue</a></li>
                        <li class="breadcrumb-item active">Calogue create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.catalogues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Catalogue create</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                        @error("name") 
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="mt-4">
                                            @php
                                                $is = [
                                                    'is_active' => ['name' => 'Kích hoạt', 'color' => 'primary'],
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
                                        <label for="cover" class="form-label">Cover</label>
                                        <input type="file" class="form-control" name="cover" id="cover">
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
{{-- 
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
@endsection --}}
