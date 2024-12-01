// Thêm vào giỏ hàng
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        const productId = this.getAttribute('data-id');

        fetch('/cua-hang/san-pham/them', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                // Cập nhật số lượng sản phẩm trong giỏ hàng nếu cần
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

// Cập nhật giỏ hàng
document.querySelectorAll('.update-cart').forEach(input => {
    input.addEventListener('change', function () {
        const productId = this.getAttribute('data-id');
        const quantity = this.value;

        fetch('/gio-hang/cap-nhat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id: productId, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);

                // Cập nhật lại giá tổng cộng và số lượng trên giao diện
                const priceElement = document.querySelector(`#price-${productId}`);
                if (priceElement) {
                    priceElement.textContent = `${new Intl.NumberFormat('vi-VN').format(data.newPrice)} VNĐ`;
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

// Xóa sản phẩm khỏi giỏ hàng
document.querySelectorAll('.remove-from-cart').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        const productId = this.getAttribute('data-id');

        fetch(`/gio-hang/xoa/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);

                // Xóa sản phẩm khỏi giao diện
                const row = document.querySelector(`#cart-item-${productId}`);
                if (row) {
                    row.remove();
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
