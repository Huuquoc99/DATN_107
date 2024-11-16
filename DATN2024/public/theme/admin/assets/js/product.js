document.querySelectorAll('.thumbnail-item').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelector('#mainImage').src = item.dataset.image;
        document.querySelectorAll('.thumbnail-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
    });
});
