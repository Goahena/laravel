<button id="toggleFormBtn" type="button" class="btn btn-inverse-success btn-icon d-sm-none">
    <i class="mdi mdi-menu"></i>
</button>

<!-- Giao diện và form sẽ ẩn trên mobile -->
<div id="userForm" class="d-none d-sm-block">
    <form action="{{ route('product.index') }}">
        <div class="row">
            <div class="col-md-2">
                @php
                    $perpage = request('perpage') ?: old('perpage');
                @endphp
                <div class="user-search">
                    <select name="perpage" class="form-control form-control-sm">
                        @for ($i = 5; $i <= 80; $i *= 4)
                            <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">
                                {{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="product-search">
                    <select name="shoeType" class="form-control form-control-sm">
                        <option value="" selected>Loại Giày</option>
                        @foreach ($shoeTypes as $shoeType)
                            <option value="{{ $shoeType->id }}"
                                {{ old('shoe_type_id', $product->shoe_type_id ?? '') == $shoeType->id ? 'selected' : '' }}>
                                {{ $shoeType->shoe_type_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="product-search">
                    <select name="brand" class="form-control form-control-sm">
                        <option value="" selected>Thương Hiệu</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="product-search">
                    <select name="promotion" class="form-control form-control-sm">
                        <option value="" selected>Loại Khuyến Mãi</option>
                        @foreach ($promotions as $promotion)
                            <option value="{{ $promotion->id }}"
                                {{ old('promotion_id', $product->promotion_id ?? '') == $promotion->id ? 'selected' : '' }}>
                                {{ $promotion->promotion_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="user-search">
                    <input name="keyword" type="text" value="{{ request('keyword') ?: old('keyword') }}"
                        class="form-control form-control-sm" placeholder="Tìm Kiếm Tên Giày">
                    <button type="submit" class="btn btn-inverse-success btn-icon">
                        <i class="mdi mdi-account-search"></i>
                    </button>
                </div>
            </div>
    </form>
    <div class="col-md-1">
        @include('backend.user.user.component.toolbox')
    </div>
</div>
</div>
<script>
    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        var form = document.getElementById('userForm');
        // Toggle class d-none để ẩn/hiện form
        form.classList.toggle('d-none');
    });
</script>
