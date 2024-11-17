@extends('admin.layouts.master')

@section('title', 'Product')

@section('content')

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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-primary">
            {{ session('success') }}
        </div>
    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Products</h5>
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
                        <select id="product-filter" class="form-select " >
                            <option value="">All products</option>

                            <optgroup label="Catalogues">
                                @foreach($catalogues as $item)
                                    <option value="{{ $item->id }}" data-catalogue-id="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </optgroup>
                            <!-- Giá -->
                            <optgroup label="Price">
                                <option value="priceAsc">Price increases gradually</option>
                                <option value="priceDesc">Price decreasing</option>
                            </optgroup>

                            <!-- Thời gian -->
                            <optgroup label="Thời gian">
                                <option value="newest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="lastWeek">Last Week</option>
                                <option value="lastMonth">Last Month</option>
                            </optgroup>
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
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Storage</th>
                                <th>Battery capacity</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td style="width: auto; height: 30px">
                                        @php
                                            $url = $item->img_thumbnail;
                                            if (!Str::contains($url, 'http')) {
                                                $url = \Illuminate\Support\Facades\Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="70px" height="60px">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $item) }}">
                                            {{ \Illuminate\Support\Str::limit($item->name, 10, '...') }}
                                        </a>
                                        
                                    </td>
                                    <td>
                                        {{ $item->catalogue ? \Illuminate\Support\Str::limit($item->catalogue->name, 7, '...') : 'No Catalogue' }}
                                    </td>                                    
                                    <td>{{ number_format($item->price_regular, 0, ',', '.') }} VND</td>
                                    <td>{{ $item->storage }}</td>
                                    <td>{{ $item->battery_capacity }}</td>
                                    <td>{!! $item->is_active ? '<span class="badge bg-primary">active</span>' : '<span class="badge bg-danger">no</span>' !!}</td>
                                    <td>
                                        <div class="d-flex gap-2  justify-content-center">
                                            <a href="{{ route('admin.products.show', $item) }}" class="btn btn-info btn-sm">
                                                Info
                                                <i class="fa-solid fa-circle-info fa-sm"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-primary btn-sm">
                                                Edit
                                               <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure you want to delete?')" type="submit"
                                                        class="btn btn-danger btn-sm">Del <i
                                                        class="fa-solid fa-delete-left fa-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} products</p>
                            </div>
                            <div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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


            $('#product-filter').change(function () {
                let filter = $(this).val();
                let categoryId = $(this).find('option:selected').data('catalogue-id'); // Lấy category_id
                $.ajax({
                    url: "{{ route('admin.products.filter') }}",
                    method: 'get',
                    data: {
                        filter: filter,
                        category_id: categoryId // Gửi category_id lên server
                    },
                    success: function (res) {
                        $('.table-data').html(res);
                    },
                    error: function (res) {
                        $('.table-data').html('<p class="alert alert-primary">Có lỗi xảy ra!</p>');
                    }
                });
            });

            {{--$(document).on('click', '.delete-product', function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    let productId = $(this).data('id');--}}

            {{--    Swal.fire({--}}
            {{--        title: 'Are you sure?',--}}
            {{--        text: "You won't be able to revert this!",--}}
            {{--        icon: 'warning',--}}
            {{--        showCancelButton: true,--}}
            {{--        confirmButtonColor: '#3085d6',--}}
            {{--        cancelButtonColor: '#d33',--}}
            {{--        confirmButtonText: 'Yes, delete it!'--}}
            {{--    }).then((result) => {--}}
            {{--        if (result.isConfirmed) {--}}
            {{--            $.ajax({--}}
            {{--                url: `/products/${productId}`,--}}
            {{--                type: 'DELETE',--}}
            {{--                data: {--}}
            {{--                    _token: '{{ csrf_token() }}'--}}
            {{--                },--}}
            {{--                success: function (response) {--}}
            {{--                    Swal.fire(--}}
            {{--                        'Deleted!',--}}
            {{--                        'Your product has been deleted.',--}}
            {{--                        'success'--}}
            {{--                    );--}}
            {{--                    $(`tr[data-id="${productId}"]`).remove();--}}
            {{--                },--}}
            {{--                error: function (xhr) {--}}
            {{--                    Swal.fire(--}}
            {{--                        'Error!',--}}
            {{--                        'Failed to delete product.',--}}
            {{--                        'error'--}}
            {{--                    );--}}
            {{--                }--}}
            {{--            });--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });

    </script>
@endsection

