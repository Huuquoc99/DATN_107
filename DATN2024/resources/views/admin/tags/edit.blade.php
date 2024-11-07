
@extends('admin.layouts.master')

@section('title')
    Thêm mới Tag
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới tag</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tag</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="tag_id" id="" value="{{ $tag->id }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                    </div><!-- end card header -->
                    <div class="col-6">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $tag->description }}">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="" name="status" @if($tag->status ) checked @endif value="1">
                                Status
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
                        <button class="btn btn-primary">Sửa <i class="fa-regular fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

