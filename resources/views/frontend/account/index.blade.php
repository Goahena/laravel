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
                    <h5 class="card-title">TÀI KHOẢN CỦA TÔI</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('auth.update', ['id' => auth()->id()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-lg-12">
                                <div class="form-group text-center">
                                    <div class="avatar-container">
                                        <img 
                                            id="avatar" 
                                            src="{{ isset($data->image) ? asset($data->image) : asset('assets/images/faces-clipart/pic-1.png') }}" 
                                            alt="Avatar" 
                                            class="avatar-circle"
                                        />
                                        <input 
                                            type="file" 
                                            name="image" 
                                            id="imageUpload" 
                                            class="file-upload-default"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Ảnh đại diện -->

                                <!-- Tên người dùng -->
                                <div class="form-group">
                                    <label>Tên người dùng</label>
                                    <input type="text" class="form-control" name="name" value="{{ $data['name'] }}" required />
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $data['email'] }}" required />
                                </div>

                                <!-- Số điện thoại -->
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $data['phone'] }}" required />
                                </div>
                                <!-- Địa chỉ -->
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="{{ $data['address'] }}" />
                                </div>
                            </div>

                            <!-- Cột bên phải -->
                            <div class="col-lg-6">
                                <!-- Ngày sinh -->
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input 
                                        type="date" 
                                        class="form-control" 
                                        name="birthday" 
                                        value="{{ isset($data) ? old('birthday', date('Y-m-d', strtotime($data->birthday))) : old('birthday') }}" 
                                    />
                                </div>

                                <!-- Tỉnh -->
                                <div class="form-group">
                                    <label>Tỉnh</label>
                                    <select class="form-control province location" name="province_id" data-target="districts">
                                        <option value="0">[Chọn Tỉnh]</option>
                                        @foreach ($provinces ?? [] as $province)
                                            <option value="{{ $province->code }}" 
                                                {{ isset($data) && $data['province_id'] == $province->code ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Quận/Huyện -->
                                <div class="form-group">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control districts location" name="district_id" data-target="wards">
                                        <option value="0">[Chọn Quận/Huyện]</option>
                                        @foreach ($districts ?? [] as $district)
                                            <option value="{{ $district->code }}" 
                                                {{ isset($data) && $data['district_id'] == $district->code ? 'selected' : '' }}>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Phường/Xã -->
                                <div class="form-group">
                                    <label>Phường/Xã</label>
                                    <select class="form-control wards" name="ward_id">
                                        <option value="0">[Chọn Phường/Xã]</option>
                                        @foreach ($wards ?? [] as $ward)
                                            <option value="{{ $ward->code }}" 
                                                {{ isset($data) && $data['ward_id'] == $ward->code ? 'selected' : '' }}>
                                                {{ $ward->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>

                            </div>
                        </div>

                        <!-- Nút Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <button type="button" class="btn btn-info" onclick="history.back()">Quay lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('avatar').addEventListener('click', function () {
        // Khi click vào ảnh sẽ mở input để chọn file
        document.getElementById('imageUpload').click();
    });

    document.getElementById('imageUpload').addEventListener('change', function (event) {
        // Xem trước ảnh sau khi chọn
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('avatar').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    var province_id = '{{ isset($data) ? $data["province_id"] : old('province_id') }}'
    var district_id = '{{ isset($data) ? $data["district_id"] : old('district_id') }}'
    var ward_id = '{{ isset($data) ? $data["ward_id"] : old('ward_id') }}'
</script>