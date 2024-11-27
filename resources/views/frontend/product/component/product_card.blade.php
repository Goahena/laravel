<div class="col-md-4">
    <div class="card" style="margin-bottom: 25px">
        <a href="/cua-hang/san-pham={{ $product->id }}">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <center>
                    <img src="../../../images2/{{ $product->image_1 }}" class="img-fluid"
                        style="height:306px; width:306px" />
                </center>
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </div>
            <div class="card-body">
                <center>
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text text-success">
                        <b>{{ number_format($product->discount_price, 0, ',', ',') }} VNĐ</b>
                        @if ($product->discount_price < $product->original_price)
                            <del class="card-text text-danger">{{ number_format($product->original_price, 0, ',', ',') }}
                                VNĐ</del>
                        @endif

                    </p>
                </center>
            </div>
        </a>
    </div>
</div>
