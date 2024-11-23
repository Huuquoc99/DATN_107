<table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center" style="width:100%">
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
            <td>{{ $item->catalogue ? \Illuminate\Support\Str::limit($item->catalogue->name, 7, '...') : 'No Catalogue' }}</td>
            <td>{{ number_format($item->price_regular, 0, ',', '.') }} VND</td>
            <td>{{ $item->storage }}</td>
            <td>{{ $item->battery_capacity }}</td>
            <td>{!! $item->is_active ? '<span class="badge bg-primary">active</span>' : '<span class="badge bg-danger">no</span>' !!}</td>
            <td>
                <div class="d-flex gap-2  justify-content-center">
                    <a href="{{ route('admin.products.show', $item) }}" class="btn btn-info btn-sm">Info <i class="fa-solid fa-circle-info fa-sm"></i></a>
                    <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-primary btn-sm">Edit <i class="fa-regular fa-pen-to-square fa-sm"></i></a>
                    <form action="{{ route('admin.products.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete?')" type="submit" class="btn btn-danger btn-sm">Del <i class="fa-solid fa-delete-left fa-sm"></i></button>
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

