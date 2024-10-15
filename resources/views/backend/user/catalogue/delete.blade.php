<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <code>
                            <h4>Xác nhận xóa nhóm thành viên</h4>
                        </code>
                        <form method="post" action="{{ route('user.catalogue.destroy', $userCatalogue->id) }}" class="forms-">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label>Tên Nhóm</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $userCatalogue->name }}">
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
