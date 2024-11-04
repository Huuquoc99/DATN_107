
// $(document).on('click', '.remove-product', function(e) {
//     e.preventDefault();
//     let productId = $(this).data('id');
//
//     Swal.fire({
//         title: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
//         text: "Sản phẩm sẽ bị xóa vĩnh viễn!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Có, xóa nó!',
//         cancelButtonText: 'Không, giữ lại!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 data: {productId:productId},
//                 url: '/admin/products/' + productId,
//                 method: 'DELETE',
//                 success: function(res) {
//                     $('#product-list').html(res);
//                     Swal.fire(
//                         'Đã xóa!',
//                         'Sản phẩm đã được xóa thành công.',
//                         'success'
//                     );
//                 },
//                 error: function(res) {
//                     Swal.fire(
//                         'Có lỗi xảy ra!',
//                         'Không thể xóa sản phẩm này.',
//                         'error'
//                     );
//                 }
//             });
//         }
//     });
// });
