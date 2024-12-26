<div class="card">
    
    <form method="GET" action="{{ route('product.search') }}" class="p-4 border rounded-3 shadow-sm">
        <div class="card-header" style="margin-top:10px">
            <center>
                <h5>DANH MỤC</h5>
            </center>
        </div>
        <br>
        <div class="mb-3">
            <!-- Thương hiệu -->
            <label for="brand_id" class="form-label">Thương hiệu</label>
            <select name="brand_id" id="brand_id" class="form-select">
                <option value="">Tất cả thương hiệu</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @if (request('brand_id') == $brand->id) selected @endif>
                        {{ $brand->brand_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <!-- Loại giày -->
            <label for="shoe_type_id" class="form-label">Loại giày</label>
            <select name="shoe_type_id" id="shoe_type_id" class="form-select">
                <option value="">Tất cả loại giày</option>
                @foreach ($shoetypes as $shoetype)
                    <option value="{{ $shoetype->id }}" @if (request('shoe_type_id') == $shoetype->id) selected @endif>
                        {{ $shoetype->shoe_type_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <!-- Tìm kiếm theo giá -->
            <label for="price" class="form-label">Tìm theo giá</label>
            <select name="price" id="price" class="form-select">
                <option value="">Lựa chọn tầm giá</option>
                <option value="0-300000" @if (request('price') == '0-300000') selected @endif>
                    < 300,000 VNĐ</option>
                <option value="300000-500000" @if (request('price') == '300000-500000') selected @endif>300,000 ~ 500,000 VNĐ
                </option>
                <option value="500000-700000" @if (request('price') == '500000-700000') selected @endif>500,000 ~ 700,000 VNĐ
                </option>
                <option value="700000-1000000" @if (request('price') == '700000-1000000') selected @endif>700,000 ~ 1,000,000 VNĐ
                </option>
                <option value="1000000-1500000" @if (request('price') == '1000000-1500000') selected @endif>1,000,000 ~ 1,500,000
                    VNĐ</option>
                <option value="1500000-2000000" @if (request('price') == '1500000-2000000') selected @endif>1,500,000 ~ 2,000,000
                    VNĐ</option>
                <option value="2000000-100000000" @if (request('price') == '2000000-100000000') selected @endif>> 2,000,000 VNĐ
                </option>
            </select>
        </div>

        <div class="mb-3">
            <!-- Từ khóa -->
            <label for="keyword" class="form-label">Từ khóa</label>
            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm"
                value="{{ request('keyword') }}">
        </div>

        <div class="mb-3">
            <!-- Số bản ghi mỗi trang -->
            <label for="perpage" class="form-label">Số bản ghi mỗi trang</label>
            <select name="perpage" id="perpage" class="form-select">
                <option value="5" @if (request('perpage') == '5') selected @endif>5</option>
                <option value="10" @if (request('perpage') == '10') selected @endif>10</option>
                <option value="15" @if (request('perpage') == '15') selected @endif>15</option>
                <option value="20" @if (request('perpage') == '20') selected @endif>20</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
    </form>

</div>
