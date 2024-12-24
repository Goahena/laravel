<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title" style="text-transform: uppercase;">SẢN PHẨM {{ $product['name'] }}</h3>
        </center>
    </div>
    <br>
</div>

<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <div class="row">
            <div class="col-md-7">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/trang-chu">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="/cua-hang">Cửa hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
                </ol>
                <br>
            </div>
            @foreach ($carts as $id => $cart)
                @if ($cart['name'] == $product['name'])
                    <div class="col-md-5">
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i>&ensp;Sản phẩm này đã được thêm vào giỏ hàng của bạn!
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </nav>

    <div class="row">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset($product->image_1) }}" alt="..." class="img-fluid rounded-start" />
                    {{-- style="height: 432px" --}}
                    <div class="row ">
                        @if ($product['image_2'])
                            <div class="col border ripple"><img src="{{ asset($product->image_2) }}" alt="..."
                                    class="img-fluid rounded-start" /></div>
                        @else
                            <div class="col border ripple"><img src="{{ asset($product->image_1) }}" alt="..."
                                    class="img-fluid rounded-start" /></div>
                        @endif
                        @if ($product['image_3'])
                            <div class="col ripple"><img src="{{ asset($product->image_3) }}" alt="..."
                                    class="img-fluid rounded-start" /></div>
                        @else
                            <div class="col ripple"><img src="{{ asset($product->image_1) }}" alt="..."
                                    class="img-fluid rounded-start" /></div>
                        @endif
                        @if ($product['image_4'])
                            <div class="col ripple"><img src="{{ asset($product->image_4) }}" alt="..."
                                    class="img-fluid rounded-start" /></div>
                        @else
                            <div class="col ripple"><img src="{{ asset($product->image_1) }}" alt="..."
                                    class="img-fluid rounded-start" /></div>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="float-end">
                            {{-- <script>
                                $(function() {
                                    $("#RateDanhGia").rateYo({
                                        starWidth: "20px",
                                        ratedFill: "#16B5EA",
                                        rating: {{ $purchase_quantity['danh_gia'] }},
                                        readOnly: true,
                                    });
                                });
                            </script>

                            <small class="text-muted float-end">( {{ $purchase_quantity['count_danh_gia'] }} Đánh giá
                                )</small>
                            <div id="RateDanhGia" class="float-end text-info"></div> --}}
                        </div>
                        <h3 class="card-title" style="text-transform: uppercase;">{{ $product['name'] }}</h3>

                        <h4 class="card-text text-success">
                            @php
                                $km = 0;
                                $gtkm = null;
                            @endphp

                            @foreach ($promotions as $promotion)
                                @if ($promotion['id'] == $product['promotion_id'])
                                    @php
                                        $km = sprintf('%d', $product['price'] * 0.01 * $promotion['promotion_value']);
                                        $gtkm = $promotion['promotion_value'];
                                    @endphp
                                @endif
                            @endforeach

                            <b>{{ number_format($product['price'] - $km, 0, ',', ',') }} VNĐ</b>
                            @if ($km != 0)
                                <del class="card-text text-danger">{{ number_format($product['price'], 0, ',', ',') }}
                                    VNĐ</del>
                            @endif



                        </h4>

                        <br>
                        <p class="card-text"><b>Mô tả:</b>{!! $product['description'] !!}</p>
                        <p class="card-text"><b>Loại giày:</b> {{ $product->shoeType->shoe_type_name }}&emsp;<i
                                class="fab fa-squarespace"></i>&emsp; <b>Thương hiệu:</b>
                            {{ $product->brand->brand_name }}
                        </p>

                        <p class="card-text">
                            <b>Số lượng:</b>
                            {{ ($product->available_quantity > 0) ? $product->available_quantity : 'Hết hàng'}}
                        </p>
                        <p class="card-text">
                            <small class="text-muted"></small>
                        </p>
                        <a href="{{ route('them-vao-gio-hang', ['id' => $product->id]) }}" type="button"
                            class="btn btn-info" style="margin-top: 10px">
                            <i class="far fa-heart"></i>
                            &ensp;Thêm vào giỏ hàng
                        </a>

                        <a type="button" href="#ex2-tabs-1" class="btn btn-light">Chi tiết</a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="card mb-3">
            <!-- Tabs navs -->
            <div class="container">
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1"
                            role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Mô tả sản phẩm</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab"
                            aria-controls="ex2-tabs-2" aria-selected="false">Chi tiết sản phẩm</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab"
                            aria-controls="ex2-tabs-3" aria-selected="false">Đánh giá</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->

                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel"
                        aria-labelledby="ex2-tab-1">
                        <br>
                        {!! $product['description'] !!}<br>
                        <p><b>Ngày ra mắt: </b>Ngày 11 tháng 11 năm 2021</p>
                        <p><b>Thiết kế: </b>Yeezy 350</p>
                        <p><b>Mã sản phẩm: </b>{{ $product['id'] }}</p>
                        <br>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">
                        <br>
                        <p>✔️ <b>Mã giày: </b>{{ $product['id'] }}</p>
                        <p>✔️ <b>Tên giày: </b>{{ $product['name'] }}</p>
                        <p>✔️ <b>Loại giày: </b>{{ $product->shoe_type_name }}</p>
                        <p>✔️ <b>Thương hiệu: </b>{{ $product->brand_name }}</p>
                        <p>✔️ <b>Giá gốc: </b>{{ number_format($product['price']) }} VNĐ</p>
                        <p>✔️ <b>Số lượng còn lại: </b>{{ $product['quantity'] }}</p>
                        @if ($gtkm)
                            <p>✔️ <b>Khuyến mãi: </b>{{ $product['promotion_name'] }} (-{{ $gtkm }}%)</p>
                        @endif
                        {{-- <p>✔️ <b>Đánh giá: </b>{{ $product['danh_gia'] }}</p> --}}
                        <br>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">
                        @php
                            $checkk = 0;
                        @endphp


                        <div class="row">

                            <div class="col-md-6">
                                <br>
                                <h5 class="card-title" style="margin-bottom:20px">ĐÁNH GIÁ</h5>

                                {{-- @foreach ($danhgias as $danhgia)
                                    @if ($danhgia->id_user > 4)
                                        @php
                                            $ok = rand(1, 4);
                                        @endphp
                                    @else
                                        @php
                                            $ok = $danhgia->id_user;
                                        @endphp
                                    @endif

                                    <div class="row">
                                        <div class="col-1">
                                            <img class="img-profile rounded-circle" height="40" width="40"
                                                src="/images1/logo-user-{{ $ok - 1 }}.png">
                                        </div>
                                        <div class="col-10">
                                            <small>{{ $danhgia->ten_danh_gia }}</small>
                                            <small class="float-end">{{ $danhgia->updated_at }}</small>
                                            <br>
                                            <p>{{ $danhgia->danh_gia_binh_luan }}</p>
                                        </div>
                                    </div>
                                @endforeach --}}

                                {{-- <div class="pagination pagination-circle justify-content-end">
                                    <center>{{ $danhgias->links() }}</center>
                                </div> --}}


                            </div>
                            {{-- @foreach ($danh_gias as $id => $danh_gia)
                                @if ($danh_gia['name'] == $product['name'])
                                    @php $checkk = 1; @endphp
                                @endif
                            @endforeach --}}
                            {{-- <center> --}}
                            {{-- @if ($checkk == 1)
                                <div class="col-md-6">
                                    <br>
                                    <h5 class="float-start">ĐÁNH GIÁ SẢN PHẨM NÀY</h5>

                                    <div id="rateYo" class=" float-end text-info"></div><br><br>
                                    <form action="/cua-hang/san-pham={{ $product['id'] }}/danh-gia" method="POST">
                                        @csrf
                                        <input type="hidden" class="form-control" name="danh_gia" id="danh_gia"
                                            value="4.5">
                                        <input type="hidden" class="form-control" name="id_user"
                                            value="{{ $data['id'] }}">
                                        <input type="hidden" class="form-control" name="id"
                                            value="{{ $product['id'] }}">

                                        <div class="form-outline mb-4">
                                            <input type="input" class="form-control" name="ten_danh_gia" required
                                                value="{{ $data['ten_nguoi_dung'] }}" />
                                            <label class="form-label">Tên</label>
                                        </div>
                                        <div class="form-outline">
                                            <textarea class="form-control" name="danh_gia_binh_luan" rows="4"></textarea>
                                            <label class="form-label">Bình luận đánh giá</label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-info float-end">Gửi đánh giá</button>
                                    </form>

                                </div>
                            @endif --}}
                            {{-- </center> --}}

                            @if ($checkk == 0)
                                <div class="col-md-6">
                                    <br><br>
                                    <center>
                                        <p class="text-danger">Bạn cần mua sản phẩm này mới có thể đánh giá!</p>
                                    </center>
                                    <br>
                                </div>
                            @endif

                        </div>
                        <br>



                    </div>
                </div>
                <!-- Tabs content -->
            </div>
        </div>
    </div>

    <br>
    <div class="card mb-3 shadow-1">
        <div class="card-body" style="margin-top:40px">
            <center>
                <h3 class="card-title" style="text-transform: uppercase;">SẢN PHẨM TƯƠNG TỰ</h3>
            </center>
        </div>
        <br>
    </div>
    <br>
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sameproducts->chunk(4) as $index => $chunk)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach ($chunk as $sameproduct)
                            <div class="col-md-3">
                                <div class="card" style="margin-bottom: 25px">
                                    <a href="/cua-hang/san-pham={{ $sameproduct->id }}">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <center>
                                                <img src="{{ asset($sameproduct->image_1) }}" class="img-fluid"
                                                    style="height:306px; width:306px" />
                                            </center>
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <h4 class="card-title product-title">{{ $sameproduct->name }}</h4>
                                                <p class="card-text text-success">
                                                    @php
                                                        $km = 0;
                                                        foreach ($promotions as $promotion) {
                                                            if (
                                                                $promotion['promotion_name'] ===
                                                                $sameproduct->promotion_name
                                                            ) {
                                                                $km = sprintf(
                                                                    '%d',
                                                                    $sameproduct->price *
                                                                        0.01 *
                                                                        $promotion['promotion_value'],
                                                                );
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <b>{{ number_format($sameproduct->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($sameproduct->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                </p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls"
            data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls"
            data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>


</div>

<br>
