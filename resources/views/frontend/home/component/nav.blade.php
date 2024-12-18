<button onclick="topFunction()" id="myBtn" title="Go to top"><img style="max-height: 50px" src="{{ URL('frontend_assets/images1/scroll-top.png') }}" height="40"></button>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand me-2" href="/home"><img style="max-width: 194px" src="{{ URL('frontend_assets/images1/logo.png') }}" height="35" alt="PVB SHOP"
                    loading="lazy"></a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <form action="{{ route('store') }}" method="GET"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    @csrf
                    <div class="input-group" style="width:170px;">
                        <input type="text" value="{{ request('keyword') ?: old('keyword') }}" class="form-control bg-light border-0 small" name="keyword"
                            placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <form action="{{ route('store') }}" method="GET" class="form-inline mr-auto w-100 navbar-search">
                            @csrf
                            <div class="input-group" style="width:170px; margin-top:7px">
                                <input type="text" value="{{ request('keyword') ?: old('keyword') }}" class="form-control bg-light border-0 small" name="keyword"
                                    placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </ul>

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtons"
                aria-controls="navbarButtons" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarButtons">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

                <div class="d-flex align-items-center float-right">
                    <a href="/"><button type="button" class="btn btn-link px-3 me-2">TRANG CHỦ</button></a>
                    <a href="/store"><button type="button" class="btn btn-link px-3 me-2">CỬA HÀNG</button></a>
                    <a href="/about-us"><button type="button" class="btn btn-link px-3 me-2">GIỚI
                            THIỆU</button></a>
                    <a href="/payment"><button type="button" class="btn btn-link px-3 me-2">THANH
                            TOÁN</button></a>
                    <a href="/gio-hang" data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                        title="Giỏ hàng của bạn"><i class="fas fa-shopping-cart"></i></a>&emsp;&nbsp;
                    @if (Session::get('LogIn'))
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-mdb-toggle="dropdown" aria-expanded="false">
                                @if (session()->get('check') == 1)
                                {{Session::get('UserName')}}
                                (Quản trị viên)
                                @else
                                {{Session::get('UserName')}}
                                (Khách hàng)
                                @endif
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <li><a class="dropdown-item" href="/tai-khoan">Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Đăng xuất</a></li>
                                    @if (session()->get('check') == 1)
                                        <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Trang Quản lý</a></li>
                                    @endif
                                </form>
                            </ul>
                        </div>
                        <!-- <a href="{{ url('/RestaurantManager/User/trangchu') }}" class="btn btn-primary btn-rounded">CỬA HÀNG CỦA BẠN</a> -->
                    @else
                        <a class="btn btn-outline-primary btn-rounded" href="{{ route('auth.admin') }}">ĐĂNG
                            NHẬP</a>
                        &ensp;
                        <a class="btn btn-primary btn-rounded" href="{{ route('auth.register') }}">ĐĂNG KÝ MIỄN
                            PHÍ</a>
                    @endif

                </div>

            </div>
    </nav>