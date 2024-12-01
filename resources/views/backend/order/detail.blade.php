<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['comfirm']['title']])
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4 class="card-title"></h4>
                        <form action="{{ route('order.confirm', $orders['id']) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Tên Khách Hàng<code>*</code></label>
                                <input readonly value="{{ old('name', $orders->name ?? '') }}" name="name" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Số Điện Thoại<code>*</code></label>
                                <input readonly value="{{ old('phone', $orders->phone ?? '') }}" name="phone" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ Nhận<code>*</code></label>
                                <input readonly value="{{ old('address', $orders->address ?? '') }}" name="address" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Tổng Số Tiền<code>*</code></label>
                                <input readonly value="{{ old('total_price', $orders->total_price ?? '') }}" name="total_price" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Phương Thức Thanh Toán<code>*</code></label>
                                <input readonly value="{{ old('payment_method', $orders->payment_method ?? '') }}" name="payment_method" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Thời Gian Đặt<code>*</code></label>
                                <input readonly value="{{ isset($orders) ? old('created_at', date('Y-m-d', strtotime($orders->created_at))) : old('created_at') }}" name="created_at" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Trạng Thái<code>*</code></label>
                                <input readonly value="{{ ($orders->is_confirmed == 1) ? 'Đã xác nhận' : 'Chưa xác nhận' }}" name="is_confirmed" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea readonly class="form-control" name="description" rows="6"
                                    placeholder="Nhập mô tả sản phẩm">{{ old('description', $orders->description ?? '') }}</textarea>
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
                            <button type="submit" class="btn btn-gradient-primary me-2">Lưu</button>
                            <a href="{{ route('order.index') }}" class="btn btn-light">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateFileName(input, fieldId) {
        const fileName = input.files.length > 0 ? input.files[0].name : "Không có tệp nào được chọn";
        document.querySelector(`#${fieldId}_name`).value = fileName;
    }

    /**
     * Hàm hiển thị preview ảnh khi chọn file
     * @param {HTMLInputElement} input - Input file
     * @param {string} previewId - ID của thẻ img để hiển thị ảnh preview
     */
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result; // Gán URL của file vào src của ảnh
                preview.style.display = 'block'; // Hiển thị ảnh
            };

            reader.readAsDataURL(input.files[0]); // Đọc file ảnh
        } else {
            preview.src = ''; // Xóa ảnh nếu không có file
            preview.style.display = 'none'; // Ẩn ảnh
        }
    }
</script>
