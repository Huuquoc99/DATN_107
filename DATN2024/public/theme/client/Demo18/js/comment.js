function checkContentLength(content, minLength = 1, maxLength = 500) {
    return content.trim().length >= minLength && content.trim().length <= maxLength;
}

function containsSpamKeywords(content) {
    const spamKeywords = [
        'viagra',
        'buy now',
        'click here',
        'http://',
        'https://',
        'cmn',
        'dm',
        'quá rẻ',
        'cheap',
        'earn money',
        'make money fast'
    ];

    const lowercaseContent = content.toLowerCase();
    return spamKeywords.some(keyword => lowercaseContent.includes(keyword));
}

let reviewSubmitCount = 0;
const MAX_SUBMIT_LIMIT = 3;
const RESET_TIME = 60000; // 1 phút

function canSubmitReview() {
    if (reviewSubmitCount >= MAX_SUBMIT_LIMIT) {
        Toastify({
            text: "Too many reviews. Please wait before submitting again.",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#f44336",
            close: true
        }).showToast();
        return false;
    }
    reviewSubmitCount++;

    setTimeout(() => {
        reviewSubmitCount = 0;
    }, RESET_TIME);

    return true;
}


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

    // Add new review
    $('form[name="customer-review-form"]').submit(function (e) {
        e.preventDefault();
        var userId = $('#summit-create-review').data('id');
        if (!userId) {
            $('#customerForms').addClass('aside_visible');
            $('.page-overlay').addClass('page-overlay_visible');
            return;
        }

        var rating = $('#form-input-rating').val();
        var review = $('#form-input-review').val();

        // Kiểm tra độ dài nội dung
        if (!checkContentLength(review)) {
            Toastify({
                text: "Review must be between 5 and 50 characters",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336",
                close: true
            }).showToast();
            return;
        }

        // Kiểm tra từ khóa spam
        if (containsSpamKeywords(review)) {
            Toastify({
                text: "Your review contains inappropriate content",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336",
                close: true
            }).showToast();
            return;
        }

        // Kiểm tra số lần submit
        if (!canSubmitReview()) {
            return;
        }

        let currentCount = parseInt($('#review-count').text());

        $.ajax({
            url: `/comments`,
            method: 'POST',
            data: {
                rate: rating || null,
                content: review,
                product_id: productId
            },
            success: function (response) {
                $('#review-count').text(currentCount + 1);
                console.log('New review:', response);
                const {html} = response;
                const newReview = $(html);
                $('#review-product-id').prepend(newReview);

                // Reset form
                $('#form-input-review').val('');
                $('.form-rating').removeClass('is-selected')
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Check if there is an error message in the response
                    const error = xhr.responseJSON.error;
                    if (error) {
                        alert(error); // Display the error message (you could also display it in a specific div on your page)
                    }
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });

    $('.star-rating__star-icon').click(function () {
        var index = $(this).index() + 1;
        $('#form-input-rating').val(index);
        $('#form-input-rating-update').val(index);
        $('.star-rating__star-icon').each(function (i) {
            $(this).attr('fill', i < index ? '#FFD700' : '#ccc');
        });
    });

    $('#close-modal-review-update').on('click', function (event) {
        event.preventDefault();

        $('#modal-update-review').css('opacity', '0');
        $('#modal-update-review').css('display', 'none');
        $('.page-overlay').removeClass('page-overlay_visible');
    });
});

// update review
$('#modal-update-review').on('submit', function (event) {
    event.preventDefault();


    var rating = $('#form-input-rating-update').val();
    var review = $('#form-input-review-update').val();
    var reviewId = $('#modal-update-review').data('id');
    console.log('reviewId', reviewId)


    $.ajax({
        url: '/comments/' + reviewId,
        method: 'PUT',
        data: {
            rate: rating,
            content: review
        },
        success: function (response) {
            $('#modal-update-review').css('opacity', '0');
            $('#modal-update-review').css('display', 'none');
            $('.page-overlay').removeClass('page-overlay_visible');
            const {html} = response;
            const updatedReview = $(html);
            $(`.review-item[data-id="${reviewId}"]`).replaceWith(updatedReview);
        },
        error: function (error) {
            alert('Unable to update review.');
        }
    });
});

$('#review-product-id').on('click', '.delete-review', function (e) {
    e.preventDefault();
    var reviewId = $(this).data('id');
    var reviewItem = $(this).closest('.review-item');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let currentCount = parseInt($('#review-count').text());

            $.ajax({
                url: '/comments/' + reviewId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    reviewItem.remove();
                    $('#review-count').text(currentCount - 1);

                    // Hiển thị thông báo thành công bằng Toastify
                    Toastify({
                        text: "Review deleted successfully!",
                        duration: 3000,
                        gravity: "top", // Hiển thị ở đầu
                        position: "right", // Hiển thị bên phải
                        backgroundColor: "#4caf50", // Màu nền thành công
                        close: true
                    }).showToast();
                },
                error: function (error) {
                    console.error('Error:', error);

                    Toastify({
                        text: "Could not delete review. Please try again.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f44336", // Màu nền lỗi
                        close: true
                    }).showToast();
                }
            });
        }
    });
});

// detail review
$('#review-product-id').on('click', '.edit-review', function (e) {
    e.preventDefault();
    $('#modal-update-review').addClass('.modal-update-review-display')

    var reviewId = $(this).data('id');

    $.ajax({
        url: '/comments/' + reviewId,
        method: 'GET',
        success: function (response) {
            var {comment} = response;
            $('#form-input-rating-update').val(comment.rate);
            $('#form-input-review-update').val(comment.content);
            $('#modal-update-review').attr('data-id', comment.id);

            $('#modal-update-review').css('opacity', '1');
            $('#modal-update-review').css('display', 'block');
            $('.page-overlay').addClass('page-overlay_visible');

            $('.star-rating__star-icon').each(function () {
                if ($(this).data('value') <= comment.rate) {
                    $(this).addClass('is-selected');
                } else {
                    $(this).removeClass('is-selected');
                }
            });
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
});
