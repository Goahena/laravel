<div class="card">
    <div class="card-header" style="margin-top:10px">
        <center>
            <h5>DANH MỤC</h5>
        </center>
    </div>
    <div class="card-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <!-- Bộ lọc Số bản ghi -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingPerPage">
                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                            data-mdb-target="#flush-collapsePerPage" aria-expanded="false" aria-controls="flush-collapsePerPage">
                            <i class="fas fa-list-ol"></i>&nbsp; SỐ BẢN GHI
                        </button>
                    </h2>
                    <div id="flush-collapsePerPage" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingPerPage" data-mdb-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                @for ($i = 5; $i <= 80; $i *= 4)
                                    <li class="list-group-item">
                                        <a href="{{ route('store', ['perpage' => $i]) }}" class="text-dark">
                                            {{ $i }} bản ghi
                                        </a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingUserCatalogue">
                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                            data-mdb-target="#flush-collapseUserCatalogue" aria-expanded="false"
                            aria-controls="flush-collapseUserCatalogue">
                            <i class="fas fa-shoe-prints"></i>&nbsp; LOẠI GIÀY
                        </button>
                    </h2>
                    <div id="flush-collapseUserCatalogue" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingUserCatalogue" data-mdb-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($shoetypes->unique('id') as $shoetype)
                                <li class="list-group-item">
                                    <a href="{{ route('store', ['id' => $shoetype->id]) }}" class="text-dark">
                                        {{ $shoetype->shoe_type_name }}
                                    </a>
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
                                @foreach ($brands->unique('id') as $brand)
                                <li class="list-group-item">
                                    <a href="{{ route('store', ['id' => $brand->id]) }}" class="text-dark">
                                        {{ $brand->brand_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        </div>
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
                                <a href="/store/price=0-300000" class="text-dark">
                                    < 300,000 VNĐ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/store/price=300000-500000" class="text-dark">300,000 ~ 500,000
                                    VNĐ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/store/price=500000-700000" class="text-dark">500,000 ~ 700,000
                                    VNĐ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/store/price=700000-1000000" class="text-dark">700,000 ~
                                    1,000,000 VNĐ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/store/price=1000000-1500000" class="text-dark">1,000,000 ~
                                    1,500,000 VNĐ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/store/price=1500000-2000000" class="text-dark">1,500,000 ~
                                    2,000,000 VNĐ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/store/price=2000000-100000000" class="text-dark">> 2,000,000
                                    VNĐ</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- Bộ lọc Tìm kiếm từ khóa -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingKeyword">
                    <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#flush-collapseKeyword" aria-expanded="false" aria-controls="flush-collapseKeyword">
                        <i class="fas fa-search"></i>&nbsp; TÌM KIẾM
                    </button>
                </h2>
                <div id="flush-collapseKeyword" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingKeyword" data-mdb-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form action="{{ route('store') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                                    class="form-control form-control-sm" placeholder="Nhập từ khóa tìm kiếm">
                                <button class="btn btn-success btn-sm" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>