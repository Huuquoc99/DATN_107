@extends('admin.layouts.master')

@section('title', 'Product')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Product list</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
                        Create <i class="fa-regular fa-plus"></i>
                    </a>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <div class="search-wrapper">
                        <div class="input-group" style="width: 250px;">
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                            <span class="input-group-text"><i class="ri-search-line"></i></span>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 15px">
                            <option selected="">Filter</option>
                            <option value="1">Highest price</option>
                            <option value="2">Lowest price</option>
                            <option value="3">Today</option>
                            <option value="4">Yesterday</option>
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive table-data ">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Catalogue</th>
                                <th>Price</th>
                                <th>Storage</th>
                                <th>Battery_capacity</th>
                                <th>Operating_system</th>
                                <th>Active</th>
                                <th>Tags</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @php
                                            $url = $item->img_thumbnail;
                                            if (!Str::contains($url, 'http')) {
                                                $url = \Illuminate\Support\Facades\Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="100px" height="120px">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $item) }}">
                                            {{ $item->name }}
                                        </a>
                                    </td>
                                    <td>{{ $item->catalogue ? $item->catalogue->name : 'No Catalogue' }}</td>
                                    <td>{{ $item->price_regular }}</td>
                                    <td>{{ $item->storage }}</td>
                                    <td>{{ $item->battery_capacity }}</td>
                                    <td>{{ $item->operating_system }}</td>
                                    {{-- <td style="width: 100px">{{ $item->short_description }}</td> --}}
                                    <td>{!! $item->is_active ? '<span class="badge bg-primary">active</span>' : '<span class="badge bg-danger">no</span>' !!}</td>
                                    <td>
                                        @foreach($item->tags as $tag)
                                            <span class="badge bg-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    {{-- <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td> --}}
                                    <td>
                                        <div class="d-flex gap-2  justify-content-center">
                                            <a href="{{ route('admin.products.show', $item) }}" class="btn btn-info btn-sm">
                                                Show
                                                <i class="fa-solid fa-circle-info fa-sm"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-primary btn-sm">
                                                Edit 
                                               <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure you want to delete?')" type="submit" class="btn btn-danger btn-sm">
                                                    Delete 
                                                    <i class="fa-solid fa-delete-left fa-sm"></i>
                                                </button>
                                            </form>
                                            {{--                                            <a class="btn btn-danger btn-sm delete-product " data-id="{{ $item->id }}">Xóa <i class="fa-solid fa-delete-left fa-sm"></i>--}}
                                            {{--                                            </a>--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('style-libs')

@endsection

@section('script-libs')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                product(page);
            })


            function product(page) {
                $.ajax({
                    url: "products/pagination/?page=" + page,
                    success: function (res) {
                        $('.table-data').html(res);
                    }
                })
            }

            $(document).on('keyup', function (e) {
                e.preventDefault();
                let search_string = $('#search').val();
                $.ajax({
                    url: "{{ route('admin.products.search') }}",
                    method: 'get',
                    data: {search_string: search_string},
                    success: function (res) {
                        $('.table-data').html(res);
                    },
                    error: function (res) {
                        if (res.status === 404) {
                            $('.table-data').html('<p class="alert alert-primary">Không tìm thấy kết quả!</p>');
                        }
                    }
                })
            })
        });

    </script>
@endsection

