<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['comfirm']['title']])
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="add-user">
                        <h4 class="card-title d-none d-sm-block">Thông tin đơn hàng</h4>
                        <a href="{{ route('order.exportInvoice', ['id' => $orders->id]) }}">
                            <button type="button" class="btn btn-gradient-primary">Xuất hóa đơn</button>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Tên Khách Hàng<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('name', $orders->name ?? '') }}" name="name"
                                        type="text" class="form-control" placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status">Trạng thái:</label>
                                <form method="POST" action="{{ route('order.updateStatus', ['id' => $orders->id]) }}">
                                    @csrf
                                    @method('PATCH') <!-- Chỉ định phương thức PATCH -->
                                    <select name="status" id="status" class="form-control form-control-lg"
                                        onchange="this.form.submit()">
                                        @foreach ($statuses as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $orders->status == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Số Điện Thoại<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('phone', $orders->phone ?? '') }}" name="phone"
                                        type="text" class="form-control" placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Tổng Số Tiền<code>*</code></label>
                                <div>
                                    <input readonly
                                        value="{{ old('total_price', isset($orders->total_price) ? number_format($orders->total_price) : '') }}"
                                        name="total_price" type="text" class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Phương Thức Thanh Toán<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('payment_method', $orders->payment_method ?? '') }}"
                                        name="payment_method" type="text" class="form-control"
                                        placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Thời Gian Đặt<code>*</code></label>
                                <div>
                                    <input readonly
                                        value="{{ isset($orders) ? old('created_at', date('Y-m-d', strtotime($orders->created_at))) : old('created_at') }}"
                                        name="created_at" type="text" class="form-control"
                                        placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelectGender">Tỉnh</label>
                                <select class="form-control form-control-lg province location" name="province_id_disabled" disabled>
                                    <option value="" disabled selected>Không có dữ liệu</option> <!-- Mục không chọn sẵn -->
                                    @if (isset($provinces) && $provinces->isNotEmpty())
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->code }}" 
                                                @if ((isset($orders) && $orders->province_id == $province->code) || old('province_id') == $province->code) selected @endif>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="0" selected>Không có dữ liệu</option> <!-- Hiện khi không có dữ liệu -->
                                    @endif
                                </select>
                                
                                <!-- Hidden field to submit province_id -->
                                <input type="hidden" name="province_id" value="{{ $orders->province_id ?? old('province_id', 0) }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelectGender">Quận/Huyện</label>
                                <select class="form-control form-control-lg districts location" name="district_id_disabled" disabled>
                                    @if (isset($districts) && $districts->isNotEmpty())
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->code }}" 
                                                @if ((isset($orders) && $orders->district_id == $district->code) || old('district_id') == $district->code) selected @endif>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="0" selected>Không có dữ liệu</option>
                                    @endif
                                </select>
                                <!-- Hidden field to submit district_id -->
                                <input type="hidden" name="district_id" value="{{ $orders->district_id ?? old('district_id', 0) }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelectGender">Phường/Xã</label>
                                <select class="form-control form-control-lg wards location" name="ward_id_disabled" disabled>
                                    @if (isset($wards) && $wards->isNotEmpty())
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->code }}" 
                                                @if ((isset($orders) && $orders->ward_id == $ward->code) || old('ward_id') == $ward->code) selected @endif>
                                                {{ $ward->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="0" selected>Không có dữ liệu</option>
                                    @endif
                                </select>
                                <!-- Hidden field to submit ward_id -->
                                <input type="hidden" name="ward_id" value="{{ $orders->ward_id ?? old('ward_id', 0) }}">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label>Địa chỉ<code>*</code></label>
                                <div>
                                    <input readonly value="{{ old('address', $orders->address ?? '') }}" name="address"
                                        type="text" class="form-control" placeholder="Nhập tên giày">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Đơn Hàng</label>
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Tên Giày</th>
                                        <th>Giá Tiền</th>
                                        <th>Số Lượng</th>
                                        <th>Khuyến Mãi (%)</th>
                                        <th>Tổng Đơn Hàng (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment['name'] }}</td>
                                            <td>{{ number_format($payment['price']) }}</td>
                                            <td>{{ $payment['quantity'] }}</td>
                                            <td>{{ $payment['promotion'] }}</td>
                                            <td>
                                                {{ number_format(
                                                    $payment['quantity'] * $payment['price'] - $payment['quantity'] * $payment['price'] * $payment['promotion'] * 0.01,
                                                ) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
