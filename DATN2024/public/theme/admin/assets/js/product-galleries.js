document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail-item');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const newImage = this.dataset.image;

            mainImage.src = newImage;

            // Lưu ảnh đã chọn vào localStorage
            localStorage.setItem('selectedImage', newImage);

            // Cập nhật trạng thái active
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
