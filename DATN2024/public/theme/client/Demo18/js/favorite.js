function toggleFavorite(productId) {
    axios.post('/toggle-favorite', { product_id: productId })
        .then(response => {
            const favoriteButton = document.querySelector(`[data-product-id="${productId}"]`);

            if (response.data.is_favorite) {
                favoriteButton.classList.add('text-red-500');
                favoriteButton.innerHTML = '❤️';
            } else {
                favoriteButton.classList.remove('text-red-500');
                favoriteButton.innerHTML = '🤍';
            }

            Toastify({
                text: response.data.message +
                    '<a href="#" style="color: #fff; text-decoration: underline;"><i>View list.</i></a>',
                duration: 3000,
                gravity: "top",
                position: "right",
                escapeMarkup: false,
                backgroundColor: response.data.is_favorite
                    ? "linear-gradient(to right, #00b09b, #96c93d)"
                    : "linear-gradient(to right, #ff5f6d, #ffc371)",
                close: true
            }).showToast();

            document.querySelector("a[href='#']").addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = '/account/favorites';
            });
        })
        .catch(error => {
            if (error.response.status === 401) {
                Toastify({
                    text: 'You need to login to perform this action. ' +
                        '<a href="#" style="color: #fff; text-decoration: underline;"><i>Login here.</i></a>',
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)", // Màu nền
                    escapeMarkup: false,
                    close: true
                }).showToast();

                document.querySelector("a[href='#']").addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = '/login';
                });

            }
        });
}


function removeFavorite(productId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('/remove-favorite', { product_id: productId })
                .then(response => {
                    const productCard = document.querySelector(`[data-product-id="${productId}"]`).closest('.product-card-wrapper');

                    productCard.classList.add('removed');
                    setTimeout(() => {
                        productCard.remove();
                    }, 300);

                    Toastify({
                        text: response.data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        close: true
                    }).showToast();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
}

