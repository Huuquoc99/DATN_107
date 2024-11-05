<table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
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
    <tbody>
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
                @foreach($item->tags as $tag)
                    <span class="badge bg-info">{{ $tag->name }}</span>
                @endforeach
            </td>
            {{-- <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td> --}}
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.show', $item) }}" class="btn btn-info btn-sm">Show <i class="fa-solid fa-circle-info fa-sm"></i></a>
                    <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-primary btn-sm">Edit <i class="fa-regular fa-pen-to-square fa-sm"></i></a>
                    <a href="#" class="btn btn-danger btn-sm remove-product" data-id="{{ $item->id }}">Delete <i class="fa-solid fa-delete-left fa-sm"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $data->links() }}
