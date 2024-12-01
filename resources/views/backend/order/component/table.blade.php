
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><input id="checkAll" type="checkbox"></th>
            <th scope="col"><strong> Tên người nhận </strong></th>
            <th scope="col"><strong> Địa chỉ nhận </strong></th>
            <th scope="col"><strong> Ngày đặt hàng </strong></th>
            <th scope="col"><strong> Tổng tiền </strong></th>
            <th scope="col"><strong> Trạng thái </strong></th>
            <th scope="col" class="text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr style="cursor: pointer" data-href="{{ route('order.detail', $order->id) }}">
                <td class="text-center">
                    <input class="checkbox-item" type="checkbox" value="{{ $order['id'] }}">
                </td>
                <td>{{ $order['name'] ?? 'Không xác định' }}</td>
                <td>{{ $order['address'] ?? 'Không xác định' }}</td>
                <td>{{ $order['created_at'] ?? 'Không xác định' }}</td>
                <td>{{ $order['total_price'] ?? 'Không xác định' }}</td>
                <td>{{ $order->is_confirmed ? 'Đã Xác Nhận' : 'Chưa Xác Nhận' }}</td>
                <td>
                    <a href="{{ route('order.confirm', $order->id) }}" 
                        {{ $order->is_confirmed ? 'btn-danger' : 'btn-primary' }}">
                        <button type="button" class="btn btn-inverse-info btn-icon">
                            <i class="mdi mdi-table-edit"></i>
                        </button>
                    </a>
                    <a href="{{ route('order.delete', $order->id) }}">
                        <button type="button" class="btn btn-inverse-danger btn-icon">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    // Đánh dấu tất cả checkbox
    document.getElementById('checkAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.checkbox-item');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    const submitBulkAction = (action) => {
        const selectedIds = Array.from(document.querySelectorAll('.checkbox-item:checked')).map(cb => cb.value);
        if (selectedIds.length > 0) {
            document.getElementById('selectedOrders').value = JSON.stringify(selectedIds);
            document.getElementById('bulkAction').value = action;

            const formAction = action === 'confirm'
                ? "{{ route('orders.bulkConfirm') }}"
                : "{{ route('orders.bulkUnconfirm') }}";
            document.getElementById('bulkActionForm').action = formAction;

            document.getElementById('bulkActionForm').submit();
        } else {
            alert('Vui lòng chọn ít nhất một đơn hàng.');
        }
    };
    document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('tr[data-href]');
    rows.forEach(row => {
        row.addEventListener('click', function () {
            // Điều hướng đến URL trong data-href
            window.location.href = this.getAttribute('data-href');
        });
    });
});


    // Sự kiện cho nút "Kích hoạt toàn bộ"
    document.getElementById('bulkConfirmButton').addEventListener('click', (e) => {
        e.preventDefault();
        submitBulkAction('confirm');
    });

    // Sự kiện cho nút "Bỏ kích hoạt toàn bộ"
    document.getElementById('bulkUnconfirmButton').addEventListener('click', (e) => {
        e.preventDefault();
        submitBulkAction('unconfirm');
    });
</script>