<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
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
                        @php
                            $url = ($config['method'] == 'create') ? route('user.store') : route('user.update', $user->id)
                        @endphp
                        <form action="{{ $url }}" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label>Họ và Tên<code>*</code></label>
                                <input value="{{ old('name', $user->name ?? '') }}" name="name" type="text"
                                    class="form-control" placeholder="Nhập họ và tên">
                            </div>
                            <div class="form-group">
                                <label>Email address<code>*</code></label>
                                <input value="{{ old('email', $user->email ?? '') }}" name="email" type="email"
                                    class="form-control" placeholder="Nhập Email">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại<code>*</code></label>
                                <input value="{{ old('phone', $user->phone ?? '') }}" name="phone" type="phone"
                                    class="form-control" placeholder="Nhập số điện thoại">
                            </div>
                            @if ($config['method'] == 'create')
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Mật khẩu<code>*</code></label>
                                    <input name="password" type="password" class="form-control"
                                        placeholder="Nhập mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Xác nhận mật khẩu<code>*</code></label>
                                    <input name="re_password" type="password" class="form-control"
                                        placeholder="Nhập lại mật khẩu">
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input
                                    value="{{ isset($user) ? old('birthday', date('Y-m-d', strtotime($user->birthday))) : old('birthday') }}"
                                    name="birthday" type="date" class="form-control" placeholder="Nhập ngày sinh">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" name="img[]" class="file-upload-default"
                                    value="{{ old('image', $user->image ?? '') }}">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        value="{{ (isset($user) ? $user->image : 'Upload Image') }}">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                            @php
                                $userCatalogue = ['[Chọn nhóm thành viên]', '[Quản trị viên]', '[Cộng tác viên]'];
                                $userCatalogueValues = [null, 1, 2];
                            @endphp

                            <div class="form-group">
                                <label>Nhóm thành viên<code>*</code></label>
                                <select class="form-control" name="user_catalogue_id">
                                    @foreach ($userCatalogue as $key => $item)
                                        <option value="{{ $userCatalogueValues[$key] }}"
                                            {{ old('user_catalogue_id', isset($user->user_catalogue_id) ? $user->user_catalogue_id : '') == $key ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
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
                                <input value="{{ old('address', $user->address ?? '') }}" type="text" class="form-control" name="address"
                                    placeholder="Nhập địa chỉ">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea value="{{ old('description', $user->description ?? '') }}" class="form-control" type="text" name="description" rows="4">{{ (isset($user) ? $user->description : '') }}</textarea>
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
    var province_id = '{{ (isset($user) ? $user->province_id : old('province_id')) }}'
    var district_id = '{{ (isset($user) ? $user->district_id : old('district_id')) }}'
    var ward_id = '{{ (isset($user) ? $user->province_id : old('ward_id')) }}'
</script>
