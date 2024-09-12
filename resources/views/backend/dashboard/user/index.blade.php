<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{config('apps.user.title')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{config('apps.user.title')}}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách thành viên</h4>
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> <input type="checkbox" class="form-check-input"></th>
                                    <th> First name </th>
                                    <th> Progress </th>
                                    <th> Amount </th>
                                    <th> Deadline </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input">
                                    </td>
                                    <td class="py-1">
                                        <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td>
                                        <div class="info-item name">Họ tên: </div>
                                        <div class="info-item email">Email: </div>
                                        <div class="info-item phone">Số điện thoại</div>
                                    </td>
                                    <td>
                                        <div class="address-item">Địa chỉ: </div>
                                        <div class="address-item">Phường: </div>
                                        <div class="address-item">Quận: </div>
                                        <div class="address-item">Thành phố: </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" checked>
                                            </label>
                                          </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
