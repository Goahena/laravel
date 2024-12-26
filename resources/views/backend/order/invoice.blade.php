<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Hóa đơn mua hàng</h1>
    <p><strong>Tên khách hàng:</strong> {{ $order->name }}</p>
    <p><strong>Điện thoại:</strong> {{ $order->phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
    <p><strong>Thời gian đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
    <hr>

    @if(!empty($payments))
    <table>
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Khuyến mãi (%)</th>
                <th>Giá sau giảm</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $key => $payment)
                <tr>
                    <td>
                        <img src="{{ asset($payment['image_1']) }}" alt="{{ $payment['name'] }}" width="100">
                    </td>
                    <td>{{ $payment['name'] }}</td>
                    <td>{{ number_format($payment['price'], 0, ',', '.') }} VNĐ</td>
                    <td>{{ $payment['quantity'] }}</td>
                    <td>{{ $payment['promotion'] }}%</td>
                    <td>{{ number_format($payment['discounted_price'], 0, ',', '.') }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Không có thông tin thanh toán.</p>
@endif

    <h3>Tổng tiền: {{ number_format($order->total_price) }} VNĐ</h3>
</body>
</html>
