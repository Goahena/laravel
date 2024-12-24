<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title">THANH TOÁN</h3>
        </center>
    </div>
    <br>
</div>

<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/trang-chu">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
        </ol>
    </nav>
    <br>

    @php
        $tongtien = 0;
    @endphp

    @foreach ($payments as $payment)
        @php
            $tongtien += $payment['quantity'] * $payment['price'] - $payment['quantity'] * $payment['price'] * $payment['promotion'] * 0.01;
        @endphp
    @endforeach

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
                <form action="/thanh-toan/hoadon" method="POST">
                    @csrf
                    <div class="card-header">
                        <h5 class="card-title" style="margin-top: 10px">THÔNG TIN NHẬN HÀNG:</h5>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bank_code">Hình thức thanh toán:</label>
                            <select name="payment_method" id="hinh_thuc_thanh_toan" class="form-control">
                                <option value="Sau khi nhận hàng">Thanh toán khi nhận hàng</option>
                            </select>
                        </div>
                        <br>

                        <div class="form-outline">
                            <input type="text" class="form-control" name="name"
                                value="{{ $data['name'] }}" required />
                            <label class="form-label">Tên người nhận</label>
                        </div>
                        <br>
                        <div class="form-outline">
                            <input type="text" class="form-control" name="phone" value="{{ $data['phone'] }}" required />
                            <label class="form-label">Số điện thoại</label>
                        </div>
                        <br>

                        <div class="form-outline">
                            <input type="text" class="form-control" name="address" required />
                            <label class="form-label">Địa chỉ nhận</label>
                        </div>
                        <br>

                        <div class="form-outline">
                            <textarea type="text" class="form-control" name="description"></textarea>
                            <label class="form-label">Ghi chú</label>
                        </div>

                        <input type="hidden" class="form-control" name="total_price" value="{{ $tongtien + 32000 }}" />
                        <input type="hidden" class="form-control" name="status" value="0" />
                       
                        <input type="hidden" name="payments" value="{{ serialize($payments) }}" />

                        <br>
                        <button type="submit" class="btn btn-success btn-block">Thanh Toán</button>

                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title" style="margin-top: 10px">HÓA ĐƠN:</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td scope="row">{{ $payment['name'] }}</td>
                                    <td scope="row">{{ $payment['quantity'] }}</td>
                                    <td>{{ number_format($km = sprintf('%d', $payment['quantity'] * $payment['price'] - $payment['quantity'] * $payment['price'] * $payment['promotion'] * 0.01)) }}
                                        VNĐ</td>
                                </tr>
                            @endforeach

                            <tr>
                                <th scope="row">Phí vận chuyển</th>
                                <th></th>
                                <th>32,000 VNĐ</th>
                            </tr>
                            <tr class="text-success  ">
                                <th scope="row">Tiền phải trả </th>
                                <th></th>
                                <th>{{ number_format($tongtien + 32000) }} VNĐ</th>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



    <br>
    <br>
    <br>


</div>