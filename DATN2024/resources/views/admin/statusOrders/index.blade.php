@extends('admin.layouts.master')

@section('title', 'Status order ')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Status order </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                        <li class="breadcrumb-item active">List  </li>
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
                    <h5 class="card-title mb-0">Status Order list</h5>
                    <a href="{{ route('admin.statusOrders.create') }}" class="btn btn-primary mb-3">
                        Create <i class="fa-regular fa-plus"></i>
                    </a>
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Display order</th>
                                <th>Active</th>
                                <th>Create at</th>
                                <th>Update at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listStatusOrder as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            <a href="{{ route('admin.statusOrders.edit', $item) }}">
                                                {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                            </a>
                                        </td>
                                        <td>{{ $item->display_order }}</td>
                                        <td>{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                        <td>
                                            @if($item->created_at)
                                                <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($item->updated_at)
                                                <span id="invoice-date">{{ $item->updated_at->format('d M, Y') }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $item->updated_at->format('h:iA') }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                {{-- <a href="{{ route('admin.statusOrders.show', $item) }}" class="btn btn-info btn-sm">Show 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </a> --}}
                                                <a href="{{ route('admin.statusOrders.edit', $item) }}" class="btn btn-primary btn-sm">Edit 
                                                    <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                                </a>
                                                <form action="{{ route('admin.statusOrders.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure you want to delete?')" type="submit" class="btn btn-danger btn-sm">Delete 
                                                        <i class="fa-solid fa-delete-left fa-sm"></i>
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
                                <p>Showing {{ $listStatusOrder->firstItem() }} to {{ $listStatusOrder->lastItem() }} of {{ $listStatusOrder->total() }} status orders</p>
                            </div>
                            <div>
                                {{ $listStatusOrder->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('style-libs')

@endsection


