
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
            @include('frontend.product.component.filter')
            <br>
        </div>
        <div class="col-xl-9">
            <div class="row">

                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card" style="margin-bottom: 25px">
                            <a href="/store/san-pham={{ $product->id }}">
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


