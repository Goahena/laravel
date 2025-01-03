<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="assets/images/logo.svg">
              </div>
              <h4>Đăng nhập để tiếp tục</h4>
              <form class="pt-3" method="post" action="{{route('auth.login')}}">
                @csrf
                <div class="form-group">
                  <input
                    type="text"
                    name="email"
                    class="form-control form-control-lg"
                    placeholder="Nhập Email"
                    value="{{ old('email') }}"
                  >
                  @if ($errors->has('email'))
                  <span>* {{$errors->first('email')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    name="password"
                    class="form-control form-control-lg"
                    id="exampleInputPassword1"
                    placeholder="Nhập mật khẩu"
                  >
                  @if ($errors->has('password'))
                  <span>* {{$errors->first('password')}}</span>
                  @endif
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">ĐĂNG NHẬP</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input 
                        type="checkbox" 
                        name="remember" 
                        class="form-check-input"
                        {{ old('remember') ? 'checked' : '' }}
                      > 
                      Nhớ mật khẩu 
                    </label>
                  </div>
                  
                  <a href="#" class="auth-link text-black">Quên mật khẩu?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-social-icon btn-google"><i class="mdi mdi-google-plus"></i></button>
                  <button type="button" class="btn btn-social-icon btn-facebook"><i class="mdi mdi-facebook"></i></button>
                  <button type="button" class="btn btn-social-icon btn-twitter"><i class="mdi mdi-twitter"></i></button>
                </div>
                <div class="text-center mt-4 font-weight-light"> Chưa có tài khoản? <a href="{{ route('auth.register') }}" class="text-primary">Đăng ký</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
</body>

</html>