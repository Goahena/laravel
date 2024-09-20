<div class="main-panel">
    <div class="content-wrapper">@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4 class="card-title">Nhập thông tin người dùng</h4>
                        <form action="{{ route('user.store') }}" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Họ và Tên<code>*</code></label>
                                <input value="{{ old('name') }}" name="name" type="text" class="form-control"
                                    placeholder="Nhập họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email address<code>*</code></label>
                                <input value="{{ old('email') }}" name="email" type="email" class="form-control"
                                    placeholder="Nhập Email">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại<code>*</code></label>
                                <input value="{{ old('phone') }}" name="phone" type="phone" class="form-control"
                                    placeholder="Nhập số điện thoại">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Mật khẩu<code>*</code></label>
                                <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Xác nhận mật khẩu<code>*</code></label>
                                <input name="re_password" type="password" class="form-control"
                                    placeholder="Nhập lại mật khẩu">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input value="{{ old('brirthday') }}" name="birthday" type="date"
                                    class="form-control" placeholder="Nhập ngày sinh">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input value="{{ old('image') }}" type="file" name="img[]"
                                    class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input name="image" type="text"
                                        class="form-control file-upload-info input-image" placeholder="Tải ảnh lên"
                                        data-upload="Images">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Tải
                                            lên</button>
                                    </span>
                                </div>
                            </div>
                            @php
                                $userCatalogue = ['[Chọn nhóm thành viên]', '[Quản trị viên]', '[Cộng tác viên]'];
                            @endphp
                            <div class="form-group">
                                <label>Nhóm thành viên<code>*</code></label>
                                <select class="form-control" name="user_catalogue_id">

                                    @foreach ($userCatalogue as $key => $item)
                                        <option @if (old('user_catalogue_id') == $key) selected  @endif value="{{ $key }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Tỉnh</label>
                                <select class="form-control province location" name="province_id"
                                    data-target="districts">
                                    <option value="0">[Chọn Tỉnh]</option>
                                    @if (isset($provinces))
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->code }}">{{ $province->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Quận/Huyện</label>
                                <select class="form-control districts location" name="district_id" data-target="wards">
                                    <option value="0" selected>[Chọn Quận/Huyện]</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Phường/Xã</label>
                                <select class="form-control wards" name="ward_id">
                                    <option value="0" selected>[Chọn Phường/Xã]</option>
                                    @if (isset($wards))
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->code }}">{{ $ward->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input value="{{ old('address') }}" type="text" class="form-control" name="Address"
                                    placeholder="Nhập địa chỉ">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea value="{{ old('description') }}" class="form-control" name="description" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var province_id = '{{ old('province_id') }}'
    var district_id = '{{ old('district_id') }}'
    var ward_id = '{{ old('ward_id') }}'
</script>
