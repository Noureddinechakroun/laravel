document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {
        const method = form.querySelector('input[name="_method"]');
        if (method && method.value.toUpperCase() === 'DELETE') {
            form.addEventListener('submit', function (event) {
                if (!confirm('Are you sure you want to delete this item?')) {
                    event.preventDefault();
                }
            });
        }
    });

    const imageInput = document.querySelector('input[name="path_image"]');
    if (imageInput) {
        const preview = document.createElement('div');
        preview.className = 'image-preview';
        imageInput.insertAdjacentElement('afterend', preview);

        function refreshPreview() {
            const value = imageInput.value.trim();
            preview.innerHTML = '';

            if (!value) {
                preview.textContent = 'Image preview will appear here';
                return;
            }

            const img = document.createElement('img');
            img.src = value;
            img.alt = 'Car preview';
            img.onerror = function () {
                preview.textContent = 'Image not found. Example: /images/cars/car.jpg';
            };
            preview.appendChild(img);
        }

        imageInput.addEventListener('input', refreshPreview);
        refreshPreview();
    }
});
