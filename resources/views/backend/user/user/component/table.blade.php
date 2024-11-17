<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><input id="checkAll" type="checkbox"></th>
            <th scope="col" class="text-center"><strong> Ảnh đại diện </strong></th>
            <th scope="col"><strong> Thông tin thành viên </strong></th>
            <th scope="col"><strong> Nhóm thành viên </strong></th>
            <th scope="col"><strong> Trạng thái </strong></th>
            <th scope="col" class="text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if (isset($users) && is_object($users))
            @foreach ($users as $user)
                <tr>
                    <td class="text-center">
                        <input class="checkbox-item" type="checkbox" value="{{ $user->id }}">
                    </td>
                    <td class="py-1 text-center">
                        <img src="{{ isset($user->image) ? asset($user->image) : asset('assets/images/faces-clipart/pic-1.png') }}"
                            alt="image" />
                    </td>
                    <td>
                        <div class="info-item"><strong>Họ tên: </strong>{{ $user->name }}</div>
                        <div class="info-item"><strong>Email: </strong>{{ $user->email }}</div>
                        <div class="info-item"><strong>Số điện thoại: </strong>{{ $user->phone }}</div>
                    </td>
                    <td>
                        @php
                            $userCatalogue = ['Chọn nhóm thành viên', 'Quản trị viên', 'Cộng tác viên'];
                            $userCatalogueValues = [null, 1, 2];
                            $key = $user->user_catalogue_id;
                        @endphp
                        <strong>Nhóm thành viên: </strong>
                        <div class="userCatalogue-item">{{ $user->user_catalogues->name }}</div>
                    </td>
                    <td class="switch-{{ $user->id }}">
                        <div class="form-check form-switch">
                            <input class="form-check-input status js-switch-{{$user->id}}" data-field="publish" data-model="User" data-modelid="{{ $user->id }}" value="{{$user->publish}}" {{ ($user->publish==1) ? 'checked' : ''}} type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}">
                            <button type="button" class="btn btn-inverse-info btn-icon">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                        </a>
                        <a href="{{ route('user.delete', $user->id) }}">
                            <button type="button" class="btn btn-inverse-danger btn-icon">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="user-pagination">{{ $users->links('pagination::bootstrap-4') }}</div>
