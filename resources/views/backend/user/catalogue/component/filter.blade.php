<form action="{{ route('user.catalogue.index') }}">
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4">
            <div class="user-search">
                <input name="keyword" type="text" value="{{ request('keyword') ?: old('keyword') }}"
                    class="form-control form-control-sm" placeholder="Nhập tên tìm kiếm">
                <button type="submit" class="btn btn-inverse-success btn-icon">
                    <i class="mdi mdi-account-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-1">
            @include('backend.user.catalogue.component.toolbox')

        </div>
    </div>
</form>
