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
                <td>{{ isset($order['total_price']) ? number_format($order['total_price'], 0, ',', ',') : 'Không xác định' }} VND</td>
                <td>
                    @switch($order->status)
                        @case(0)
                            Chưa xác nhận
                            @break
                        @case(1)
                            Đã xác nhận
                            @break
                        @case(2)
                            Đang vận chuyển
                            @break
                        @case(3)
                            Đã hoàn thành
                            @break
                    @endswitch
                </td>
                <td>
                    <a href="{{ route('order.detail', $order->id) }}">
                        <button type="button" class="btn btn-inverse-info btn-icon">
                            <i class="mdi mdi-table-edit"></i>
                        </button>
                    </a>

                    <a href="{{ route('order.delete', $order->id) }}" class="delete">
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
</script>
