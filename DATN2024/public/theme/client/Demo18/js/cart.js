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

