@extends('admin.layouts.master')

@section('title')
    Banner detail: {{ $banner->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Banner</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banner</a></li>
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
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="product-gallery">
                                                <div class="main-image mb-3">
                                                    <img id="mainImage" src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <h4 class="mt-1 mb-3">{{ $banner->title }}</h4>

                                <div class="mt-4">
                                    @if($banner->is_active == 1)
                                        <span class="badge bg-primary">Active</span>
                                    @elseif($banner->is_active == 0)
                                        <span class="badge bg-danger">No active</span>
                                    @endif
                                    
                                </div>
                                <h6 class="mt-3 mb-3">{{ $banner->description }}</h6>
                                <h6 class="mt-5 mb-3">{{ $banner->link }}</h6>
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
                        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary me-2">
                            <i class="bx bx-edit me-1"></i> Banner edit
                        </a>
                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                                <i class="bx bx-trash me-1"></i> Banner delete
                            </button>
                        </form>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
