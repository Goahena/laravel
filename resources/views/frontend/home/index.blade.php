@include('frontend.home.component.carousel')

<div class="container">
    <br>

    <div class="card mb-3 shadow-1">
        <div class="card-body" style="margin-top:40px">
            <center>
                <h3 class="card-title product-title" style="text-transform: uppercase;">THƯƠNG HIỆU</h3>
            </center>
        </div>
        <br>
    </div>
    <!-- Tabs navs -->
    <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href="#ex3-tabs-1" role="tab"
                aria-controls="ex3-tabs-1" aria-selected="true">Adidas</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab"
                aria-controls="ex3-tabs-2" aria-selected="false">Nike</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3" role="tab"
                aria-controls="ex3-tabs-3" aria-selected="false">Converse</a>
        </li>
    </ul>
    <!-- Tabs navs -->

    <!-- Tabs content -->
    <div class="tab-content" id="ex2-content">
        <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
            <div class="row">
                @php
                    $dem = 0; // Khởi tạo biến đếm
                @endphp

                @foreach ($products as $product)
                    @if ($dem < 4 && $product->brand_name == 'Adidas')
                        <div class="col-md-3">
                            <div class="card" style="margin-bottom: 25px">
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <center>
                                            <img src="{{ asset($product->image_1) }}" class="img-fluid"
                                                style="height:306px; width:306px" />
                                        </center>
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <h4 class="card-title product-title">{{ $product->name }}</h4>
                                            <p class="card-text text-success">
                                                @php
                                                    $km = 0;
                                                    if ($product->promotion_value) {
                                                        $km = $product->price * 0.01 * $product->promotion_value;
                                                    }
                                                @endphp

                                                @if ($km > 0)
                                                    <b>{{ number_format($product->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($product->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                @else
                                                    <b>{{ number_format($product->price, 0, ',', ',') }}
                                                        VNĐ</b>
                                                @endif
                                            </p>
                                        </center>
                                    </div>
                                </a>
                            </div>
                        </div>

                        @php
                            $dem++; // Tăng biến đếm sau mỗi lần hiển thị
                        @endphp
                    @endif
                @endforeach

            </div>
        </div>

        <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
            <div class="row">
                @php
                    $dem = 0; // Khởi tạo biến đếm
                @endphp

                @foreach ($products as $product)
                    @if ($dem < 5 && $product->brand_name == 'Nike')
                        <div class="col-md-3">
                            <div class="card" style="margin-bottom: 25px">
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <center><img src="{{ asset($product->image_1) }}" class="img-fluid"
                                                style="height:306px; width:306px" /> </center>
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <h4 class="card-title product-title">{{ $product->name }}</h4>
                                            <p class="card-text text-success">
                                                @php
                                                    $km = 0;
                                                    if ($product->promotion_value) {
                                                        $km = $product->price * 0.01 * $product->promotion_value;
                                                    }
                                                @endphp

                                                @if ($km > 0)
                                                    <b>{{ number_format($product->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($product->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                @else
                                                    <b>{{ number_format($product->price, 0, ',', ',') }}
                                                        VNĐ</b>
                                                @endif
                                            </p>
                                        </center>
                                    </div>
                                </a>
                            </div>
                        </div>

                        @php
                            $dem++; // Tăng biến đếm
                        @endphp
                    @endif
                @endforeach

            </div>
        </div>
        <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
            <div class="row">
                @if ($dem = 1)
                @endif
                @foreach ($products as $product)
                    @if ($dem < 5 && $product->brand_name == 'Converse')
                        <div class="col-md-3">
                            <div class="card" style="margin-bottom: 25px">
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <center><img src="{{ asset($product->image_1) }}" class="img-fluid"
                                                style="height:306px; width:306px" /></center>
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <h4 class="card-title product-title">{{ $product->name }}</h4>
                                            <p class="card-text text-success">
                                                @php
                                                    $km = 0;
                                                    if ($product->promotion_value) {
                                                        $km = $product->price * 0.01 * $product->promotion_value;
                                                    }
                                                @endphp

                                                @if ($km > 0)
                                                    <b>{{ number_format($product->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($product->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                @else
                                                    <b>{{ number_format($product->price, 0, ',', ',') }}
                                                        VNĐ</b>
                                                @endif
                                            </p>
                                        </center>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @if ($dem = $dem + 1)
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Tabs content -->




    <div class="card mb-3 shadow-1">
        <div class="card-body" style="margin-top:40px">
            <center>
                <h3 class="card-title product-title" style="text-transform: uppercase;">GIÀY NỔI BẬT</h3>
            </center>
        </div>
        <br>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    @if ($dem = 1)
                    @endif
                    @foreach ($featuredshoes as $featuredshoe)
                        @if ($dem < 5)
                            <div class="col-md-3">
                                <div class="card" style="margin-bottom: 25px">
                                    <a href="{{ route('product.details', ['slug' => $featuredshoe->slug]) }}">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <center><img src="{{ asset($featuredshoe->image_1) }}" class="img-fluid"
                                                    style="height:306px; width:306px" /></center>
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <h4 class="card-title product-title">{{ $featuredshoe->name }}</h4>
                                                <p class="card-text text-success">
                                                    @php $km = 0; @endphp <!-- Đặt lại giá trị cho biến $km -->
                                                    @php
                                                        // Lấy khuyến mãi của sản phẩm hiện tại
                                                        $promotion = $promotions->firstWhere(
                                                            'id',
                                                            $featuredshoe->promotion_id,
                                                        );
                                                    @endphp

                                                    @if ($promotion)
                                                        @php
                                                            $km = sprintf(
                                                                '%d',
                                                                $featuredshoe->price *
                                                                    0.01 *
                                                                    $promotion->promotion_value,
                                                            );
                                                        @endphp
                                                        <p>Giảm: {{ number_format($km, 0, ',', ',') }}
                                                            ({{ $promotion->promotion_name }})</p>
                                                    @else
                                                        <p>Không có khuyến mãi</p>
                                                    @endif

                                                    <b>{{ number_format($featuredshoe->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($featuredshoe->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                </p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @if ($dem = $dem + 1)
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    @php $dem = 1; @endphp <!-- Đặt giá trị ban đầu cho biến $dem -->
                    @foreach ($featuredshoes as $featuredshoe)
                        @if ($dem < 5 && $featuredshoe->id > 5)
                            <div class="col-md-3">
                                <div class="card" style="margin-bottom: 25px">
                                    <a href="{{ route('product.details', ['slug' => $featuredshoe->slug]) }}">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <center><img src="{{ asset($featuredshoe->image_1) }}" class="img-fluid"
                                                    style="height:306px; width:306px" /></center>
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <h4 class="card-title product-title">{{ $featuredshoe->name }}</h4>
                                                <p class="card-text text-success">
                                                    @php $km = 0; @endphp <!-- Đặt lại giá trị cho biến $km -->
                                                    @php
                                                        // Lấy khuyến mãi của sản phẩm hiện tại
                                                        $promotion = $promotions->firstWhere(
                                                            'id',
                                                            $featuredshoe->promotion_id,
                                                        );
                                                    @endphp

                                                    @if ($promotion)
                                                        @php
                                                            $km = sprintf(
                                                                '%d',
                                                                $featuredshoe->price *
                                                                    0.01 *
                                                                    $promotion->promotion_value,
                                                            );
                                                        @endphp
                                                        <p>Giảm: {{ number_format($km, 0, ',', ',') }}
                                                            ({{ $promotion->promotion_name }})</p>
                                                    @else
                                                        <p>Không có khuyến mãi</p>
                                                    @endif

                                                    <b>{{ number_format($featuredshoe->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($featuredshoe->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                </p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @php $dem++; @endphp <!-- Tăng $dem lên để kiểm soát số lượng hiển thị -->
                        @endif
                    @endforeach

                </div>
            </div>


            <div class="carousel-item">
                <div class="row">
                    @php $dem = 1; @endphp <!-- Đặt giá trị ban đầu cho biến $dem -->
                    @foreach ($featuredshoes as $featuredshoe)
                        @if ($dem < 5 && $featuredshoe->id > 9)
                            <div class="col-md-3">
                                <div class="card" style="margin-bottom: 25px">
                                    <a href="{{ route('product.details', ['slug' => $featuredshoe->slug]) }}">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <center><img src="{{ asset($featuredshoe->image_1) }}" class="img-fluid"
                                                    style="height:306px; width:306px" /></center>
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <h4 class="card-title product-title">{{ $featuredshoe->name }}</h4>
                                                <p class="card-text text-success">
                                                    @php $km = 0; @endphp <!-- Đặt lại giá trị cho biến $km -->
                                                    @php
                                                        // Lấy khuyến mãi của sản phẩm hiện tại
                                                        $promotion = $promotions->firstWhere(
                                                            'id',
                                                            $featuredshoe->promotion_id,
                                                        );
                                                    @endphp

                                                    @if ($promotion)
                                                        @php
                                                            $km = sprintf(
                                                                '%d',
                                                                $featuredshoe->price *
                                                                    0.01 *
                                                                    $promotion->promotion_value,
                                                            );
                                                        @endphp
                                                        <p>Giảm: {{ number_format($km, 0, ',', ',') }}
                                                            ({{ $promotion->promotion_name }})</p>
                                                    @else
                                                        <p>Không có khuyến mãi</p>
                                                    @endif

                                                    <b>{{ number_format($featuredshoe->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($featuredshoe->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                </p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @php $dem++; @endphp <!-- Tăng $dem lên để kiểm soát số lượng hiển thị -->
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
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



<div class="card mb-3 shadow-1">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title product-title" style="text-transform: uppercase;">GIÀY MỚI NHẤT</h3>
        </center>
    </div>
    <br>
</div>

<div id="carouselExampleControls2" class="carousel slide" data-mdb-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row">
                @php $dem = 1; @endphp
                @foreach ($lastestshoes as $lastestshoe)
                    @if ($dem <= 4)
                        <!-- Hiển thị tối đa 4 sản phẩm -->
                        <div class="col-md-3">
                            <div class="card" style="margin-bottom: 25px">
                                <a href="{{ route('product.details', ['slug' => $lastestshoe->slug]) }}">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <center>
                                            <img src="{{ asset($lastestshoe->image_1) }}" class="img-fluid"
                                                style="height:306px; width:306px" />
                                        </center>
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <h4 class="card-title product-title">{{ $lastestshoe->name }}</h4>
                                            <p class="card-text text-success">
                                                @php
                                                    $km = 0;
                                                    if ($lastestshoe->promotion_value) {
                                                        $km =
                                                            $lastestshoe->price * 0.01 * $lastestshoe->promotion_value;
                                                    }
                                                @endphp

                                                @if ($km > 0)
                                                    <b>{{ number_format($lastestshoe->price - $km, 0, ',', ',') }}
                                                        VNĐ</b>
                                                    <del class="card-text text-danger">{{ number_format($lastestshoe->price, 0, ',', ',') }}
                                                        VNĐ</del>
                                                @else
                                                    <b>{{ number_format($lastestshoe->price, 0, ',', ',') }}
                                                        VNĐ</b>
                                                @endif
                                            </p>
                                        </center>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @php $dem++; @endphp
                    @endif
                @endforeach


            </div>
        </div>


    </div>
</div>
<div class="carousel-item">
    <div class="row">
        @if ($dem = 1)
        @endif
        @foreach ($lastestshoes as $lastestshoe)
            @if ($dem < 5 && $lastestshoe->id > 9)
                <div class="col-md-3">
                    <div class="card" style="margin-bottom: 25px">
                        <a href="{{ route('product.details', ['slug' => $lastestshoe->slug]) }}">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <center><img src="{{ asset($lastestshoe->image_1) }}" class="img-fluid"
                                        style="height:306px; width:306px" /></center>
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                </div>
                            </div>
                            <div class="card-body">
                                <center>
                                    <h4 class="card-title product-title">{{ $lastestshoe->name }}</h4>
                                    <p class="card-text text-success">
                                        @if ($km = 0)
                                        @endif
                                        @foreach ($promotions as $promotion)
                                            @if ($promotion['promotion_name'] == $lastestshoe->promotion_name)
                                                @if ($km = sprintf('%d', $lastestshoe->price * 0.01 * $promotion['promotion_value']))
                                                @endif
                                            @endif
                                        @endforeach

                                        <b>{{ number_format($lastestshoe->price - $km, 0, ',', ',') }}
                                            VNĐ</b>
                                        <del class="card-text text-danger">{{ number_format($lastestshoe->price, 0, ',', ',') }}
                                            VNĐ </del>
                                    </p>
                                </center>
                            </div>
                        </a>
                    </div>
                </div>
                @if ($dem = $dem + 1)
                @endif
            @endif
        @endforeach

    </div>
</div>
</div>
<button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls2"
    data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls2"
    data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>

</div>



<br>
<br>


</div>
@if ($dem = 1)
@endif
@foreach ($products as $product)
    @if ($dem < 5 && $product->brand_id == 'Nike')
        <div class="col-md-3">
            <div class="card" style="margin-bottom: 25px">
                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <center><img src="{{ asset($product->image_1) }}" class="img-fluid"
                                style="height:306px; width:306px" /></center>
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </div>
                    <div class="card-body">
                        <center>
                            <h4 class="card-title product-title">{{ $product->name }}</h4>
                            <p class="card-text text-success">
                                @if ($km = 0)
                                @endif
                                @foreach ($promotions as $promotion)
                                    @if ($promotion['promotion_name'] == $product->promotion_name)
                                        @if ($km = sprintf('%d', $product->price * 0.01 * $promotion['promotion_value']))
                                        @endif
                                    @endif
                                @endforeach

                                <b>{{ number_format($product->price - $km, 0, ',', ',') }} VNĐ</b>
                                <del class="card-text text-danger">{{ number_format($product->price, 0, ',', ',') }}
                                    VNĐ </del>
                            </p>
                        </center>
                    </div>
                </a>
            </div>
        </div>
        @if ($dem = $dem + 1)
        @endif
    @endif
@endforeach
