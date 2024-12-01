<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <code>
                            <h4>Xác Nhận Xóa Đơn Hàng</h4>
                        </code>
                        <form method="post" action="{{ route('order.destroy', $order->id) }}" class="forms-">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label>Tên Khách Hàng</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $order->name }}">
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $order->address }}">
                            </div>
                            <div class="form-group">
                                <label>Đơn Hàng</label>
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Tên Giày</th>
                                            <th>Giá Tiền</th>
                                            <th>Số Lượng</th>
                                            <th>Khuyến Mãi (%)</th>
                                            <th>Tổng Đơn Hàng (VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment['name'] }}</td>
                                                <td>{{ number_format($payment['price']) }}</td>
                                                <td>{{ $payment['quantity'] }}</td>
                                                <td>{{ $payment['promotion'] }}</td>
                                                <td>
                                                    {{ number_format(
                                                        $payment['quantity'] * $payment['price'] - $payment['quantity'] * $payment['price'] * $payment['promotion'] * 0.01,
                                                    ) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-gradient-danger btn-delete">
                                <i class="mdi mdi-delete"></i>
                            </button>
                            <button class="btn btn-gradient-secondary btn-delete">
                                <i class="mdi mdi-keyboard-return"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
