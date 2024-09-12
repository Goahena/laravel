<div class="row">
    <div class="col-md-2">
        <div class="user-search">
            <select class="form-control form-control-sm">
                @for($i=1; $i<=180; $i+=20)
                    <option value="{{$i}}">{{$i}} bản ghi</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <div class="user-search">
            <select class="form-control form-control-sm">
                <option value="0" selected="selected">Chọn nhóm Thành Viên</option>
                <option value="1">Quản trị viên</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="user-search">
            <input type="text" class="form-control form-control-sm"
                placeholder="Nhập tên tìm kiếm">
            <button type="button" class="btn btn-inverse-success btn-icon">
                <i class="mdi mdi-account-search"></i>
            </button>
        </div>
    </div>
</div>