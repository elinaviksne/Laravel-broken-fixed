document.addEventListener('DOMContentLoaded', () => {
    const quantityDisplay = document.getElementById('product-quantity');

    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.dataset.url;
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    quantityDisplay.textContent = data.quantity;
                })
                .catch(err => console.error(err));
        });
    });
});
