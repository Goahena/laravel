<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <code>
                            <h4>Xác nhận xóa tài khoản</h4>
                        </code>
                        <form method="post" action="{{ route('user.destroy', $user->id) }}" class="forms-">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label>Họ và Tên</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $user->email }}">
                            </div>
                            @php
                                $userCatalogue = ['Chọn nhóm thành viên', 'Quản trị viên', 'Cộng tác viên'];
                                $userCatalogueValues = [null, 1, 2];
                                $key = $user->user_catalogue_id;
                            @endphp
                            <div class="form-group">
                                <label>Nhóm thành viên</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                value="{{ $userCatalogue[$key] }}">
                            </div>
                            <button type="submit" class="btn btn-gradient-danger btn-delete">
                                <i class="mdi mdi-delete"></i>
                            </button>
                            <button class="btn btn-gradient-secondary btn-delete">
                                <i class="mdi mdi-keyboard-return"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
