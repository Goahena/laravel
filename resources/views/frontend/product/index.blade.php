<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title">CỬA HÀNG</h3>
        </center>
    </div>
    <br>
</div>

<div class="container">
    <br>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cửa hàng</li>
        </ol>
    </nav>

    <br>
    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header" style="margin-top:10px">
                    <center>
                        <h5>DANH MỤC</h5>
                    </center>
                </div>
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <i class="fas fa-shoe-prints"></i>&nbsp; LOẠI GIÀY
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-mdb-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($products as $product)
                                            <li class="list-group-item">
                                                <a href="/cua-hang/loaigiay={{ $product->shoeType->shoe_type_name }}"
                                                    class="text-dark">{{ $product->shoeType->shoe_type_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <i class="fas fa-trademark"></i>&nbsp; THƯƠNG HIỆU
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-mdb-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($products as $product)
                                            <li class="list-group-item">
                                                <a href="/cua-hang/thuonghieu={{ $product->brand->brand_name }}"
                                                    class="text-dark">{{ $product->brand->brand_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    <i class="fas fa-dollar-sign"></i><i class="fas fa-dollar-sign"></i>&nbsp; GIÁ CẢ
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-mdb-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=0-300000" class="text-dark">
                                                < 300,000 VNĐ</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=300000-500000" class="text-dark">300,000 ~ 500,000
                                                VNĐ</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=500000-700000" class="text-dark">500,000 ~ 700,000
                                                VNĐ</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=700000-1000000" class="text-dark">700,000 ~
                                                1,000,000 VNĐ</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=1000000-1500000" class="text-dark">1,000,000 ~
                                                1,500,000 VNĐ</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=1500000-2000000" class="text-dark">1,500,000 ~
                                                2,000,000 VNĐ</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/cua-hang/gia=2000000-100000000" class="text-dark">> 2,000,000
                                                VNĐ</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>


        </div>


        <div class="col-xl-9">
            <div class="row">

                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card" style="margin-bottom: 25px">
                            <a href="/cua-hang/san-pham={{ $product->id }}">
                                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                    <center><img src="{{ asset($product->image_1) }}"" class="img-fluid"
                                            style="height:306px; width:306px" /></center>
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <h4 class="card-title">{{ $product->name }}</h4>
                                        <p class="card-text text-success">
                                            @if ($km = 0)
                                            @endif
                                            @if ($km = sprintf('%d', $product->price * 0.01 * $product->promotions->promotion_value))
                                            @endif

                                            <b>{{ number_format($product->price - $km, 0, ',', ',') }} VNĐ</b>
                                            @if ($km != 0)
                                                <del class="card-text text-danger">{{ number_format($product->price, 0, ',', ',') }}
                                                    VNĐ </del>
                                            @endif
                                        </p>
                                    </center>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="product-pagination">{{ $products->links('pagination::bootstrap-4') }}</div>
            </div>

            <br>

        </div>
    </div>

</div>


