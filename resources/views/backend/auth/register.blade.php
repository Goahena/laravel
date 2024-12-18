<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="brand-logo page-header">
                                    <img src="../../assets/images/logo.svg">
                                    <h4 class="card-title">Đăng Ký Tài Khoản</h4>
                                </div>
                                <form class="form-sample" action="{{ route('auth.storeRegister') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <p class="card-description"> Thông tin tài khoản </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input value="{{ old('email', $user->email ?? '') }}" name="email"
                                                        type="email" class="form-control" placeholder="Nhập Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Mật khẩu</label>
                                                <div class="col-sm-9">
                                                    <input name="password" type="password" class="form-control"
                                                        placeholder="Nhập mật khẩu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Họ và Tên</label>
                                                <div class="col-sm-9">
                                                    <input value="{{ old('name', $user->name ?? '') }}" name="name"
                                                        type="text" class="form-control"
                                                        placeholder="Nhập họ và tên">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nhập lại mật khẩu</label>
                                                <div class="col-sm-9">
                                                    <input name="re_password" type="password" class="form-control"
                                                        placeholder="Nhập lại mật khẩu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="display: none;">
                                            <input type="hidden" name="user_catalogue_id" value="2">
                                        </div>

                                        <div class="col-md-6" style="display: none;">
                                            <input type="hidden" name="publish" value="1">
                                        </div>
                                    </div>

                                    <p class="card-description"> Nhập các thông tin cá nhân </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Số Điện Thoại</label>
                                                <div class="col-sm-9">
                                                    <input value="{{ old('phone', $user->phone ?? '') }}" name="phone"
                                                        type="phone" class="form-control"
                                                        placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Ngày Sinh</label>
                                                <div class="col-sm-9">
                                                    <input
                                                        value="{{ isset($user) ? old('birthday', date('Y-m-d', strtotime($user->birthday))) : old('birthday') }}"
                                                        name="birthday" type="date" class="form-control"
                                                        placeholder="Nhập ngày sinh">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label>Ảnh đại diện</label>
                                                <input type="file" name="image" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info"
                                                        disabled
                                                        value="{{ isset($user) && $user->image ? basename($user->image) : 'Upload Image' }}">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-gradient-primary"
                                                            type="button">Upload</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <div class="col-sm-9">
                                                    <input value="{{ old('address', $user->address ?? '') }}"
                                                        type="text" class="form-control" name="address"
                                                        placeholder="Nhập địa chỉ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea value="{{ old('description', $user->description ?? '') }}" class="form-control" type="text"
                                            name="description" rows="4">{{ isset($user) ? $user->description : '' }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit"
                                            class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                            UP</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
</body>
<script>
    var province_id = '{{ isset($user) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ isset($user) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ isset($user) ? $user->ward_id : old('ward_id') }}'
</script>
<script src="{{ asset('assets/library/location.js') }}"></script>
<script src="{{ asset('assets/js/file-upload.js') }}"></script>

</html>
