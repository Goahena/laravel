<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title">CHI TIẾT ĐƠN HÀNG</h3>
        </center>
    </div>
    <br>
</div>

<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/my-orders">Đơn hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
        </ol>
    </nav>
    <br>


    <div class="table-responsive">
        <!-- table-hover -->
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Tên</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Khuyến mãi</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr class="align-middle">
                        <td>{{ $payment['name'] }}</td>
                        <td scope="row">
                            <img src="{{ asset($payment['image_1']) }}" alt="..." class="img-fluid rounded-start"
                                width="100px" />
                        </td>                        <td>{{ number_format($payment['price']) }}</td>
                        <td>{{ $payment['quantity'] }}</td>
                        <td>{{ $payment['promotion'] }}%</td>
                        <td>{{ number_format($payment['quantity'] * $payment['price'] * (1 - $payment['promotion'] / 100)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <br>
    <br>

    <!-- Hiển thị tổng tiền -->
    <div class="card">
        <form class="card-header">
            <div class="float-start">
                <h4 class="card-title text-success" style="margin-top: 20px">
                    Tổng tiền: {{ number_format($order->total_price) }} VNĐ
                </h4>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success" style="margin: 15px" form="thanh-toan">Thanh
                    Toán</button>
            </div>
        </form>
    </div>



    <br>
    <br>

</div>
