<table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
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
        <th>Operating system</th>
        <th>Status</th>
        <th></th>
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
                    {{ $item->name }}
                </a>
            </td>
            <td>{{ $item->catalogue ? $item->catalogue->name : 'No Catalogue' }}</td>
            <td>{{ $item->price_regular }}</td>
            <td>{{ $item->storage }}</td>
            <td>{{ $item->battery_capacity }}</td>
            <td>{{ $item->operating_system }}</td>
            <td>{!! $item->is_active ? '<span class="badge bg-primary">active</span>' : '<span class="badge bg-danger">no</span>' !!}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="ri-more-fill"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end" style="">
                        <li><a class="dropdown-item" href="{{ route('admin.products.show', $item) }}"><i
                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                View</a>
                        </li>
                        <li><a class="dropdown-item edit-list" data-edit-id="1"
                               href="{{ route('admin.products.edit', $item) }}"><i
                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                Edit</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item remove-list" href="#" data-id="1"
                               data-bs-toggle="modal" data-bs-target="#removeItemModal"><i
                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                Delete</a>
                        </li>
                    </ul>
                    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                   trigger="loop"
                                                   colors="primary:#f7b84b,secondary:#f06548"
                                                   style="width:100px;height:100px">
                                        </lord-icon>
                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
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
{{ $data->links() }}
