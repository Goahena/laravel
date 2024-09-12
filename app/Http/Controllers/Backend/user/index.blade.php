
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> {{ config('apps.user.title') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{ config('apps.user.title') }} </li>
            </ol>
        </nav>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách thành viên</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>
                    <input type="checkbox" value="" id="checkAll" class="input-checkbox"/>
                  </th>
                  <th> Ảnh </th>
                  <th> Thông tin thành viên </th>
                  <th> Địa chỉ </th>
                  <th> Tình trạng </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="checkbox" value="" id="checkAll" class="input-checkbox"/>
                  </td>
                  <td class="py-1">
                    <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                  </td>
                  <td>
                    <div class="info-item name">Họ tên: Nguyễn Văn A</div>
                    <div class="info-item email">Email: trung@gmail.com</div>
                    <div class="info-item phone">Số điện thoại: 000000</div>
                  </td>
                  <td>
                    <div class="address-item name">Địa chỉ: Đường a, aa</div>
                    <div class="address-item email">Phường: trung@gmail.com</div>
                    <div class="address-item phone">Quận: 000000</div>
                    <div class="address-item phone">Thành phố: 000000</div>
                  </td>
                  <td>
                    <input type="checkbox" class="form-check-input">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>