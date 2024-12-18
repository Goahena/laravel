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
                        <form method="post" action="{{ route('brand.destroy', $brand->id) }}" class="forms-">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label>Tên Giày</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $brand->name }}">
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
