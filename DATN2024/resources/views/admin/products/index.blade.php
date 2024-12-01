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
                        <select id="product-filter" class="form-select ">
                            <option value="">All products</option>

                            <optgroup label="Catalogues">
                                @foreach($catalogues as $item)
                                    <option value="{{ $item->id }}" data-catalogue-id="{{ $item->id }}">
                                        {{ \Illuminate\Support\Str::limit($item->name, 20, '...') }}
                                    </option>
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
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


                        <table id="example"
                               class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
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
                                            if (!$url || !Str::contains($url, 'http')) {
                                                if ($url) {
                                                    $url = \Illuminate\Support\Facades\Storage::exists($url)
                                                        ? \Illuminate\Support\Facades\Storage::url($url)
                                                        : null;
                                                }
                                            }
                                            if (!$url) {
                                                $url = asset('theme/admin/assets/images/default-avatar.png');
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
                                        <div class="dropdown">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="ri-more-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.products.show', $item) }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item edit-list" data-edit-id="1"
                                                       href="{{ route('admin.products.edit', $item) }}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item remove-list" href="#" data-id="{{ $item->id }}" data-product-name="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#removeItemModal">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Modal -->
                                            <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mt-2 text-center">
                                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                                <div class="mt-4 pt-2 fs-15 mx-sm-5">
                                                                    <h4>Are you sure ?</h4>
                                                                    <p class="text-muted mx-4 mb-0">Do you want to delete <strong id="product-name"></strong>?</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                <form id="delete-form" action="{{ route('admin.products.destroy', $item) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn w-sm btn-danger">Yes, Delete It!</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="gridjs-footer">
                            <div class="gridjs-pagination">
                                <div class="gridjs-pages">
                                    <button tabindex="0" role="button" title="Previous" aria-label="Previous"
                                            class="{{ $data->onFirstPage() ? 'disabled' : '' }}"
                                            onclick="navigateToPage({{ $data->currentPage() - 1 }})">
                                        Previous
                                    </button>

                                    @foreach(range(1, $data->lastPage()) as $page)
                                        <button tabindex="0" role="button"
                                                class="{{ $data->currentPage() == $page ? 'gridjs-currentPage' : '' }}"
                                                title="Page {{ $page }}" aria-label="Page {{ $page }}"
                                                onclick="navigateToPage({{ $page }})">
                                            {{ $page }}
                                        </button>
                                    @endforeach

                                    <button tabindex="0" role="button" title="Next" aria-label="Next"
                                            class="{{ $data->hasMorePages() ? '' : 'disabled' }}"
                                            onclick="navigateToPage({{ $data->currentPage() + 1 }})">
                                        Next
                                    </button>
                                </div>
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
        document.querySelectorAll('.gridjs-pages button').forEach(button => {
            button.addEventListener('click', function () {
                if (!button.classList.contains('disabled')) {
                    let page = parseInt(button.innerText);
                    if (!isNaN(page)) {
                        window.location.href = `?page=${page}`;
                    }
                }
            });
        });

        function navigateToPage(page) {
            if (page < 1 || page > {{ $data->lastPage() }}) return;

            window.location.href = `?page=${page}`;
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            $('#search').on('keyup', function (e) {
                e.preventDefault();
                let search_string = $(this).val();
                let filter = $('#product-filter').val();
                let categoryId = $('#product-filter').find('option:selected').data('catalogue-id');
                loadProducts(1, search_string, filter, categoryId);
            });

            $('#product-filter').change(function () {
                let filter = $(this).val();
                let categoryId = $(this).find('option:selected').data('catalogue-id');
                let search_string = $('#search').val();
                loadProducts(1, search_string, filter, categoryId);
            });

            function loadProducts(page = 1, search_string = '', filter = '', categoryId = '') {
                $.ajax({
                    url: "{{ route('admin.products.filter') }}",
                    method: 'get',
                    data: {
                        page: page,
                        search_string: search_string,
                        filter: filter,
                        category_id: categoryId
                    },
                    success: function (res) {
                        $('.table-data').html(res);
                    },
                    error: function (res) {
                        $('.table-data').html('<p class="alert alert-primary">Errors</p>');
                    }
                });
            }
        });
    </script>
@endsection

