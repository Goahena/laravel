<table class="table table-striped">
    <thead>
        <tr>
            <th><input type="checkbox"></th>
            <th class="text-center"><strong> Ảnh đại diện </strong></th>
            <th><strong> Thông tin nhân viên </strong></th>
            <th><strong> Địa chỉ </strong></th>
            <th><strong> Trạng thái </strong></th>
            <th class="text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if(isset($users) && is_object($users))
        @foreach($users as $user)
        <tr>
            <td class="text-center">
                <input type="checkbox">
            </td>
            <td class="py-1 text-center">
                <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
            </td>
            <td>
                <div class="info-item name"><strong>Họ tên: </strong>{{$user->name}}</div>
                <div class="info-item email"><strong>Email: </strong>{{$user->email}}</div>
                <div class="info-item phone"><strong>Số điện thoại: </strong>{{$user->phone}}</div>
            </td>
            <td>
                <div class="address-item"><strong>Địa chỉ: </strong>{{$user->address}}</div>
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
        @endforeach
        @endif
    </tbody>
</table>
<div class="user-pagination">{{$users->links('pagination::bootstrap-4')}}</div>