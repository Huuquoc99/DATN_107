@extends('admin.layouts.master')

@section('title', 'Trashed')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Trashed</h4>

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
                    <h5 class="card-title mb-0">Trashed list</h5>
                    {{-- <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
                        Create <i class="fa-regular fa-plus"></i>
                    </a> --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive table-data ">

                        @if (session("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session("success")}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Delete at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                            @foreach($trashed as $item)
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
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->deleted_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2  justify-content-center">
                                         
                                         
                                            <form action="{{ route('admin.restore', $item) }}" method="post">
                                                @csrf
                                                <button onclick="return confirm('Are you sure you want to restore?')" type="submit" class="btn btn-danger btn-sm">
                                                    Restore 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $data->links() }} --}}
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

