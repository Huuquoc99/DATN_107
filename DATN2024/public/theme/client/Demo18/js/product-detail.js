function checkStock() {
    const productId = document.querySelector('input[name="product_id"]').value;
    const colorId = document.querySelector('input[name="product_color_id"]:checked').value;
    const capacityId = document.querySelector('input[name="product_capacity_id"]:checked').value;

    fetch(`/check-stock/${productId}/${colorId}/${capacityId}`)
        .then(response => response.json())
        .then(data => {
            const stockStatus = document.getElementById('stock-status');
            const addToCartButton = document.querySelector('.btn-addtocart');

            if (data.quantity > 0) {
                stockStatus.textContent = 'Còn hàng.';
                addToCartButton.disabled = false;
            } else {
                stockStatus.textContent = 'Hết hàng.';
                addToCartButton.disabled = true;
            }
        })
        .catch(error => console.error('Error:', error));
}

// Gọi hàm checkStock khi chọn màu sắc hoặc dung lượng
document.querySelectorAll('input[name="product_color_id"], input[name="product_capacity_id"]').forEach(input => {
    input.addEventListener('change', checkStock);
});

document.addEventListener('DOMContentLoaded', checkStock);

$(document).ready(function() {
    $('#button-test').on('click', function() {
        alert('Bạn đã nhấn vào nút!');
    });

    $('input[name="product_color_id"], input[name="product_capacity_id"]').on('change', function() {
        let product_color_id = $('input[name="product_color_id"]:checked').val();
        let product_capacity_id = $('input[name="product_capacity_id"]:checked').val();
        let product_id = $('input[name="product_id"]').val();


        if (!product_color_id || !product_capacity_id || !product_id) {
            alert("Please select both color and capacity options.");
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/product/get-variant-details',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                product_color_id: product_color_id,
                product_capacity_id: product_capacity_id,
                product_id: product_id
            }),
            success: function(response) {
                if (response.price) {
                    $('#product-price').html(response.price + ' VND');

                    $('#regular-price').hide();
                    $('#sale-price').hide();
                }
                if (response.quantity !== undefined) {
                    if (response.quantity > 0) {
                        $('#stock-status').text('Còn hàng.');
                    } else {
                        $('#stock-status').text('Hết hàng.');
                    }
                }
            }
        });
    });
});

document.querySelector('form[name="addtocart-form"]').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Toastify({
                    text: data.message,
                    duration: 3000,
                    backgroundColor: "linear-gradient(to right, #4e7cc7, #2a5ab7)",
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        fontSize: "18px",  // Adjust the font size as needed
                        padding: "15px",   // Add padding to increase the size of the toast
                        borderRadius: "2px", // Optional: rounded corners
                    },
                    stopOnFocus: true
                }).showToast();

                document.querySelector('#cart-count').textContent = data.cartCount;
            } else if (data.error) {
                Toastify({
                    text: data.error,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f44336",
                    style: {
                        fontSize: "18px",  // Adjust the font size as needed
                        padding: "15px",   // Add padding to increase the size of the toast
                        borderRadius: "2px", // Optional: rounded corners
                    },
                    stopOnFocus: true
                }).showToast();
            }

        })
        .catch(error => console.error('Error:', error));
});
