document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.querySelector('.quantity-input');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');

    minusBtn.addEventListener('click', () => {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });

    plusBtn.addEventListener('click', () => {
        let value = parseInt(quantityInput.value);
        quantityInput.value = value + 1;
    });

    quantityInput.addEventListener('change', () => {
        let value = parseInt(quantityInput.value);
        if (value < 1 || isNaN(value)) {
            quantityInput.value = 1;
        }
    });
});

function changeImage(src) {
    // Change main image
    document.getElementById('mainImage').src = src;
    // Update zoom link
    document.querySelector('.zoom-btn').href = src;

    // Update active state of thumbnails
    const thumbs = document.querySelectorAll('.thumb-item');
    thumbs.forEach(thumb => {
        if(thumb.querySelector('img').src === src) {
            thumb.classList.add('active');
        } else {
            thumb.classList.remove('active');
        }
    });
}

// Initialize Fancybox
document.addEventListener('DOMContentLoaded', function() {
    Fancybox.bind('[data-fancybox="gallery"]', {
        loop: true
    });
});

function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-container', {
        // Enable navigation buttons
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // Additional options (optional)
        loop: true, // Enables infinite scrolling
        slidesPerView: 1,
        spaceBetween: 10,
    });
});

$(document).on('click', '.cart-table .remove-cart-v2', function(e) {
    e.preventDefault();
    let deleteId = $(this).data('id');

    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
        text: 'Hành động này không thể khôi phục lại!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, xóa nó!',
        cancelButtonText: 'Không, giữ lại!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/cart/delete/',
                method: 'POST',
                data: { deleteId: deleteId },
                success: function(res) {
                    Swal.fire(
                        'Đã xóa!',
                        'Sản phẩm đã được xóa thành công từ giỏ hàng!',
                        'success'
                    );
                    $('.table-data').html(res);
                },
                error: function(res) {
                    if (res.status === 404) {
                        $('.table-data').html('<p class="alert alert-primary">Không tìm thấy kết quả!</p>');
                    } else {
                        $('.table-data').html('<p class="alert alert-danger">Có lỗi xảy ra! Vui lòng thử lại.</p>');
                    }
                }
            });

            let parentEl = $(this).closest('tr');
            $(parentEl).addClass('_removed');
            setTimeout(() => {
                $(parentEl).remove();
            }, 350);
        }
    });
});

document.getElementById('update-cart').addEventListener('click', function () {
    let cartData = {};
    document.querySelectorAll('.qty-control__number').forEach(input => {
        const productVariantId = input.getAttribute('data-id');
        const quantity = input.value;
        cartData[productVariantId] = quantity;
    });

    fetch(updateCartUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({ cart: cartData })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                    Swal.fire({
                        title: 'Cập nhật thành công!',
                        text: data.message || 'Số lượng sản phẩm trong giỏ hàng đã được cập nhật.',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer: 2000,
                    timerProgressBar: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Thông tin!',
                    text: data.message || 'Cập nhật giỏ hàng thành công!',
                    icon: 'info',
                    confirmButtonText: 'Ok',
                    timer: 2000,
                    timerProgressBar: true,
                }).then(() => {
                    location.reload();
                });
            }
        })
});






