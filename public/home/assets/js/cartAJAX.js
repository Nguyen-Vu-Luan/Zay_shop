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
            fetch("{{ route('cart.clear') }}", {
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


    // Đổi size
    document.querySelectorAll('.size-select').forEach(select => {
        select.addEventListener('change', function () {
            const id = this.dataset.id;
            fetch(`/cart/${id}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ size: this.value })
            });
        });
    });

    // Tăng/giảm số lượng
    function updateQuantity(id, change) {
        const row = document.querySelector(`tr[data-cart-id="${id}"]`);
        const qtyDisplay = row.querySelector('.quantity-display');
        let qty = parseInt(qtyDisplay.textContent) + change;
        if (qty < 1) return;

        fetch(`/cart/${id}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ quantity: qty })
        }).then(res => res.json()).then(data => {
            if (data.success) {
                qtyDisplay.textContent = data.quantity;
                row.querySelector('.subtotal').textContent = data.subtotal_formatted;
                row.querySelector('.cart-checkbox').dataset.price = data.subtotal;
                updateSelectedTotal();
            }
        });
    }

    document.querySelectorAll('.btn-increase').forEach(btn => {
        btn.addEventListener('click', () => updateQuantity(btn.dataset.id, 1));
    });

    document.querySelectorAll('.btn-decrease').forEach(btn => {
        btn.addEventListener('click', () => updateQuantity(btn.dataset.id, -1));
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
});
