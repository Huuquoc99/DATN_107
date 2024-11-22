
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const productId = $('#review-product-id').data('id');

    // Load reviews
    $('#load-more-reviews').on('click', function (e) {
        e.preventDefault();
        const reviewsList = $('#review-product-id');
        const currentPage = parseInt(reviewsList.data('page'));
        console.log('currentPage', currentPage);
        const nextPage = currentPage + 1;

        isLoading = true;
        $(this).text('Loading...');

        $.ajax({
            url: `/products/${productId}/reviews`,
            method: 'GET',
            data: {
                page: nextPage
            },
            success: function (response) {
                if (response.html) {
                    reviewsList.append(response.html);
                    reviewsList.data('page', nextPage);

                    // Ẩn nút load more nếu không còn comment
                    if (!response.hasMore) {
                        $('.load-more-container').hide();
                    }
                }

                $('#load-more-reviews').text('Load More');
                isLoading = false;
            },
            error: function () {
                $('#load-more-reviews').text('Load More');
                isLoading = false;
                alert('Error loading more reviews. Please try again.');
            }
        });
    });
});
