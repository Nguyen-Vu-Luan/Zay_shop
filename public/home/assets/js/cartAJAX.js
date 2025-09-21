document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function checkEmptyCart() {
        const tbody = document.querySelector('tbody');
        if (!tbody.querySelector('tr')) {
            document.querySelector('.card-body').innerHTML =
                '<p class="text-muted text-center">Giỏ hàng của bạn đang trống.</p>';
        }
    }

    // Xóa tất cả
    document.querySelector('.btn-clear-cart')?.addEventListener('click', function () {
        if (confirm('Bạn có chắc muốn xóa tất cả sản phẩm?')) {
            fetch("/cart/clear", {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    document.querySelector('tbody').innerHTML = '';
                    document.getElementById('selected-total').textContent = '0 VNĐ';
                    checkEmptyCart();
                }
            });
        }
    });

    // Xóa từng sản phẩm
    document.querySelectorAll('.btn-remove-item').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/cart/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    document.querySelector(`tr[data-cart-id="${id}"]`).remove();
                    updateSelectedTotal();
                    checkEmptyCart();
                }
            });
        });
    });

    // Cập nhật số lượng (tăng/giảm)
    function updateQuantityOrSize(id, payload) {
        fetch(`/cart/${id}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify(payload)
        }).then(res => res.json()).then(data => {
            if (data.success) {
                const row = document.querySelector(`tr[data-cart-id="${id}"]`);
                row.querySelector('.quantity-display').textContent = data.quantity;

                const originalEl = row.querySelector('.subtotal-original');
                const discountedEl = row.querySelector('.subtotal-discounted');

                if (originalEl) originalEl.textContent = data.subtotal_original_formatted;
                if (discountedEl) discountedEl.textContent = data.subtotal_discounted_formatted;

                row.querySelector('.cart-checkbox').dataset.price = data.subtotal_discounted;
                updateSelectedTotal();
            }
        });
    }

    document.querySelectorAll('.btn-increase').forEach(btn => {
        btn.addEventListener('click', () => updateQuantityOrSize(btn.dataset.id, { quantity: parseInt(btn.closest('tr').querySelector('.quantity-display').textContent) + 1 }));
    });

    document.querySelectorAll('.btn-decrease').forEach(btn => {
        btn.addEventListener('click', () => updateQuantityOrSize(btn.dataset.id, { quantity: parseInt(btn.closest('tr').querySelector('.quantity-display').textContent) - 1 }));
    });

    // Đổi size
    document.querySelectorAll('.size-select').forEach(select => {
        select.addEventListener('change', function () {
            updateQuantityOrSize(this.dataset.id, { size: this.value });
        });
    });

    // Tính tổng tiền đã chọn
    function updateSelectedTotal() {
        let total = 0;
        document.querySelectorAll('.cart-checkbox:checked').forEach(cb => {
            total += parseFloat(cb.dataset.price);
        });
        document.getElementById('selected-total').textContent = total.toLocaleString() + ' VNĐ';
    }

    document.querySelectorAll('.cart-checkbox').forEach(cb => {
        cb.addEventListener('change', updateSelectedTotal);
    });

    document.getElementById('select-all')?.addEventListener('change', function () {
        document.querySelectorAll('.cart-checkbox').forEach(cb => cb.checked = this.checked);
        updateSelectedTotal();
    });

    updateSelectedTotal();

    // Ngăn submit nếu chưa chọn sản phẩm
    document.getElementById('cart-form')?.addEventListener('submit', function (e) {
        const checked = document.querySelectorAll('.cart-checkbox:checked').length;
        if (checked === 0) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất 1 sản phẩm để thanh toán.');
        }
    });
});
