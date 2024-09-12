<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-lg-1"><input type="checkbox"></th>
            <th class="col-lg-1 text-center"><strong> Ảnh đại diện </strong></th>
            <th class="col-lg-4"><strong> Thông tin nhân viên </strong></th>
            <th class="col-lg-4"><strong> Địa chỉ </strong></th>
            <th class="col-lg-1"><strong> Trạng thái </strong></th>
            <th class="col-lg-1 text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @for($i = 0; $i < 5; $i++)
        <tr>
            <td class="text-center">
                <input type="checkbox">
            </td>
            <td class="py-1 text-center">
                <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
            </td>
            <td>
                <div class="info-item name"><strong>Họ tên: </strong></div>
                <div class="info-item email"><strong>Email: </strong></div>
                <div class="info-item phone"><strong>Số điện thoại: </strong></div>
            </td>
            <td>
                <div class="address-item"><strong>Địa chỉ: </strong></div>
                <div class="address-item"><strong>Phường: </strong></div>
                <div class="address-item"><strong>Quận: </strong></div>
                <div class="address-item"><strong>Thành phố: </strong></div>
            </td>
            <td>
                <div class="form-check form-check-success">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> </label>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-inverse-info btn-icon">
                    <i class="mdi mdi-table-edit"></i>
                </button>
                <button type="button" class="btn btn-inverse-danger btn-icon">
                    <i class="mdi mdi-delete"></i>
                </button>
            </td>
        </tr>
        @endfor
    </tbody>
</table>