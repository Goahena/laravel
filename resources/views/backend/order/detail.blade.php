<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['comfirm']['title']])
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Tên Khách Hàng<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('name', $orders->name ?? '') }}" name="name"
                                        type="text" class="form-control" placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status">Trạng thái:</label>
                                <form method="POST" action="{{ route('order.updateStatus', ['id' => $orders->id]) }}">
                                    @csrf
                                    @method('PATCH') <!-- Chỉ định phương thức PATCH -->
                                    <select name="status" id="status" class="form-control form-control-lg"
                                        onchange="this.form.submit()">
                                        @foreach ($statuses as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $orders->status == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Số Điện Thoại<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('phone', $orders->phone ?? '') }}" name="phone"
                                        type="text" class="form-control" placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Tổng Số Tiền<code>*</code></label>
                                <div>
                                    <input readonly
                                        value="{{ old('total_price', isset($orders->total_price) ? number_format($orders->total_price) : '') }}"
                                        name="total_price" type="text" class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Phương Thức Thanh Toán<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('payment_method', $orders->payment_method ?? '') }}"
                                        name="payment_method" type="text" class="form-control"
                                        placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Thời Gian Đặt<code>*</code></label>
                                <div>
                                    <input readonly
                                        value="{{ isset($orders) ? old('created_at', date('Y-m-d', strtotime($orders->created_at))) : old('created_at') }}"
                                        name="created_at" type="text" class="form-control"
                                        placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Địa Chỉ Nhận<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('address', $orders->address ?? '') }}" name="address"
                                        type="text" class="form-control" placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
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

            reader.onload = function(e) {
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
