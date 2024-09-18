<div class="main-panel">
    <div class="content-wrapper">@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nhập thông tin người dùng</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Họ và Tên<code>*</code></label>
                                <input name="name" type="text" class="form-control" placeholder="Nhập họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email address<code>*</code></label>
                                <input name="email" type="email" class="form-control" placeholder="Nhập Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Mật khẩu<code>*</code></label>
                                <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input name="birthday" type="datetime" class="form-control"
                                    placeholder="Nhập ngày sinh">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input name="avatar" type="text" class="form-control file-upload-info" disabled
                                        placeholder="Tải ảnh lên">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Tải
                                            lên</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nhóm thành viên<code>*</code></label>
                                <select class="form-control" name="user_agent">
                                    <option value="0" selected>[Chọn nhóm thành viên]</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Thành phố</label>
                                <select class="form-control province" name="province_id">
                                    <option value="0">[Chọn thành phố]</option>
                                    @if (isset($provinces))
                                        @foreach ($provinces as $province)
                                            <option value="{{$province->code}}">{{$province->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Quận/Huyện</label>
                                <select class="form-control districts" name="district_id">
                                    <option value="0" selected>[Chọn Quận/Huyện]</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Phường/Xã</label>
                                <select class="form-control" name="ward_id">
                                    <option value="0" selected>[Chọn Phường/Xã]</option>
                                    @if (isset($wards))
                                        @foreach ($wards as $ward)
                                            <option value="{{$ward->code}}">{{$ward->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" name="Address" placeholder="Nhập địa chỉ">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="description" rows="4"></textarea>
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
