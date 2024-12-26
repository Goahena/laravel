<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title">TÀI KHOẢN</h3>
        </center>
    </div>
    <br>
</div>
<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/trang-chu">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
        </ol>
    </nav>
    <br>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">ĐỔI MẬT KHẨU</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('auth.updatePassword', ['id' => auth()->id()]) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" name="current_password"
                                required />
                        </div>

                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control" name="new_password"
                                required />
                        </div>

                        <div class="form-group">
                            <label>Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" name="new_password_confirmation"
                                required />
                        </div>

                        <!-- Nút Submit -->
                        <div class="password-center mt-4">
                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <button type="button" class="btn btn-info" onclick="history.back()">Quay lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
