<table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
       style="width:100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Hình ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Hãng điện thoại</th>
        <th>Giá thường</th>
        <th>Giá sale</th>
        <th>Is Active</th>
        <th>Is Hot Deal</th>
        <th>Is Good Deal</th>
        <th>Is New</th>
        <th>Is Show Home</th>
        <th>Tags</th>
        <th>Ngày tạo</th>
        <th>Ngày cập nhật</th>
        <th></th>
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
                <img src="{{ $url }}" alt="" width="100px">
            </td>
            <td>
                <a href="{{ route('admin.products.edit', $item) }}">
                    {{ $item->name }}
                </a>
            </td>
            <td>{{ $item->catalogue ? $item->catalogue->name : 'No Catalogue' }}</td>
            <td>{{ $item->price_regular }}</td>
            <td>{{ $item->price_sale }}</td>
            <td>{!! $item->is_active ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
            <td>{!! $item->is_hot_deal ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
            <td>{!! $item->is_good_deal ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
            <td>{!! $item->is_new ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
            <td>{!! $item->is_show_home ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
            <td>
                @foreach($item->tags as $tag)
                    <span class="badge bg-info">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.show', $item) }}"
                       class="btn btn-info btn-sm">Xem chi tiết <i class="fa-solid fa-circle-info fa-sm"></i></a>
                    <a href="{{ route('admin.products.edit', $item) }}"
                       class="btn btn-primary btn-sm">Sửa <i class="fa-regular fa-pen-to-square fa-sm"></i></a>
                    <form action="{{ route('admin.products.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Chắc chắn không?')" type="submit"
                                class="btn btn-danger btn-sm">Xóa <i class="fa-solid fa-delete-left fa-sm"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $data->links() }}

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            order: [[0, 'desc']],
            responsive: true,
            dom: 'rtip',
            paging: false,
            info: false,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    })
</script>
