<div class="main-panel">
    <div class="content-wrapper">
        {{-- @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']]) --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4 class="card-title">{{ $config['method'] == 'create' ? 'Thêm Sản Phẩm' : 'Cập Nhật Sản Phẩm' }}</h4>
                        @php
                            $url =
                                $config['method'] == 'create'
                                    ? route('product.store')
                                    : route('product.update', $product->id ?? '');
                        @endphp
                        <form action="{{ $url }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @if ($config['method'] == 'update')
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label>Tên Giày<code>*</code></label>
                                <input value="{{ old('name', $product->name ?? '') }}" name="name" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <div class="form-group">
                                <label>Loại Giày<code>*</code></label>
                                <select name="shoe_type_id" class="form-control">
                                    <option value="" disabled selected>Chọn loại giày</option>
                                    @foreach ($shoeTypes as $shoeType)
                                        <option value="{{ $shoeType->id }}"
                                            {{ old('shoe_type_id', $product->shoe_type_id ?? '') == $shoeType->id ? 'selected' : '' }}>
                                            {{ $shoeType->shoe_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương Hiệu<code>*</code></label>
                                <select name="brand_id" class="form-control">
                                    <option value="" disabled selected>Chọn thương hiệu</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đơn giá<code>*</code></label>
                                <input value="{{ old('price', $product->price ?? '') }}" name="price" type="text"
                                    class="form-control" placeholder="Nhập giá bán">
                            </div>
                            <div class="form-group">
                                <label>Số lượng<code>*</code></label>
                                <input value="{{ old('quantity', $product->quantity ?? '') }}" name="quantity"
                                    type="text" class="form-control" placeholder="Nhập số lượng">
                            </div>
                            <div class="form-group">
                                <label>Khuyến mãi</label>
                                <select name="promotion_id" class="form-control">
                                    <option value="" disabled selected>Chọn khuyến mãi</option>
                                    @foreach ($promotions as $promotion)
                                        <option value="{{ $promotion->id }}"
                                            {{ old('promotion_id', $product->promotion_id ?? '') == $promotion->id ? 'selected' : '' }}>
                                            {{ $promotion->promotion_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ảnh Giày</label>
                                <div class="row mb-3">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <input type="file" name="image_{{ $i }}" class="file-upload-default" 
                                                    onchange="previewImage(this, 'preview_image_{{ $i }}')">
                                                <div class="input-group-append d-flex">
                                                    <input type="text" class="form-control file-upload-info w-auto" 
                                                        disabled placeholder="Chưa chọn ảnh" id="image_{{ $i }}_name">
                                                    <button class="file-upload-browse btn btn-gradient-primary w-auto" type="button">Upload</button>
                                                </div>
                                            </div>
                                            <!-- Khung hiển thị ảnh preview -->
                                            <div class="mt-2">
                                                <img 
                                                    id="preview_image_{{ $i }}" 
                                                    src="{{ isset($product) && isset($product["image_$i"]) ? asset($product["image_$i"]) : '' }}" 
                                                    alt="Preview Image {{ $i }}" 
                                                    style="max-width: 100%; height: auto; {{ isset($product) && isset($product["image_$i"]) ? '' : 'display: none;' }} border: 1px solid #ccc; padding: 5px;">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="description" rows="6"
                                    placeholder="Nhập mô tả sản phẩm">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Lưu</button>
                            <a href="{{ route('product.index') }}" class="btn btn-light">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateFileName(input, fieldId) {
        const fileName = input.files.length > 0 ? input.files[0].name : "Không có tệp nào được chọn";
        document.querySelector(`#${fieldId}_name`).value = fileName;
    }

    /**
     * Hàm hiển thị preview ảnh khi chọn file
     * @param {HTMLInputElement} input - Input file
     * @param {string} previewId - ID của thẻ img để hiển thị ảnh preview
     */
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result; // Gán URL của file vào src của ảnh
                preview.style.display = 'block'; // Hiển thị ảnh
            };

            reader.readAsDataURL(input.files[0]); // Đọc file ảnh
        } else {
            preview.src = ''; // Xóa ảnh nếu không có file
            preview.style.display = 'none'; // Ẩn ảnh
        }
    }
</script>
