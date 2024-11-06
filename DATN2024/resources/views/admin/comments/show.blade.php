@extends('admin.layouts.master')

@section('title')
Comment detail: {{ $comment->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Comment</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.comments.index') }}">Table</a></li>
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
                                                    <h4 class="mt-1 mb-3">User: {{ $comment->user->name }}</h4>
                                                    <h4 class="mt-1 mb-3">Product: {{ $comment->product->name }}</h4>

                                                    <div class="mt-4">
                                                        @if($comment->is_active == 1)
                                                            <span class="badge bg-primary">Active</span>
                                                        @elseif($comment->is_active == 0)
                                                            <span class="badge bg-danger">No active</span>
                                                        @endif
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <div class="mt-4">{{ $comment->content}}</div>
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
                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-primary me-2">
                            <i class="bx bx-edit me-1"></i> Comment edit
                        </a>
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">
                                <i class="bx bx-trash me-1"></i> Comment delete
                            </button>
                        </form>
                        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
