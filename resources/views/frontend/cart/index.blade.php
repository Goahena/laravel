<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title">GIỎ HÀNG</h3>
        </center>
    </div>
    <br>
</div>

<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/trang-chu">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </nav>
    <br>


    <div class="table-responsive">
        <!-- table-hover -->
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên giày</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Khuyến mãi</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Thay đổi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $id => $cart)
                    <tr>
                        <th>
                            <form id="thanh-toan" action="/thanh-toan" method="POST">
                                @csrf
                                <div class="form-check info">
                                    <input class="form-check-input" type="checkbox" value="{{ $id }}"
                                        name="check-cart[]" form="thanh-toan" checked />
                                </div>
                            </form>
                        </th>
                        <td scope="row">
                            <img src="{{ asset($cart['image_1']) }}" alt="..." class="img-fluid rounded-start"
                                width="100px" />
                        </td>
                        <td>{{ $cart['name'] }}</td>

                        <!-- Đơn giá: Giá sau khuyến mãi -->
                        <td>{{ number_format($cart['price']) }} VNĐ</td>

                        <!-- Hiển thị thông tin khuyến mãi -->
                        <td>{{ isset($cart['promotion']) ? $cart['promotion'] : 'Không có khuyến mãi' }}%</td>

                        <form action="/gio-hang/cap-nhat" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="{{ $id }}" />

                            <td>
                                <div class="d-flex">
                                    <div class="btn btn-info px-3 mr-1"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                        style="margin-right:2px">
                                        <i class="fas fa-minus"></i>
                                    </div>

                                    <div class="form-outline" style="width:80px">
                                        <input id="form1" min="1" name="quantity"
                                            value="{{ $cart['quantity'] }}" type="number" autocomplete="off"
                                            class="form-control" />
                                        <label class="form-label" for="form1">Số lượng</label>
                                    </div>&nbsp;

                                    <div class="btn btn-info px-3 mr-1"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </td>

                            <!-- Thành tiền: Tính thành tiền dựa trên giá sau khuyến mãi -->
                            <td><b>{{ number_format($cart['quantity'] * $cart['discounted_price']) }} VNĐ</b></td>

                            <td>
                                <button type="submit" class="btn btn-info">Cập nhật</button>
                                <a href="/gio-hang/xoa/id={{ $id }}"
                                    onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button"
                                    class="btn btn-danger">Xóa</a>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>



        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
    </div>

    <br>
    <br>
    @php
        $tongtien = 0;
    @endphp

    @foreach ($carts as $id => $cart)
        @php
            // Sử dụng discounted_price nếu có, ngược lại dùng price
            $tongtien += $cart['quantity'] * ($cart['discounted_price'] ?? $cart['price']);
        @endphp
    @endforeach

    <!-- Hiển thị tổng tiền -->
    <div class="card">
        <form class="card-header">
            <div class="float-start">
                <h4 class="card-title text-success" style="margin-top: 20px">
                    Tổng tiền: {{ number_format($tongtien) }} VNĐ
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
