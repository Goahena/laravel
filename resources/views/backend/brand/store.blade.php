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
                                    ? route('brand.store')
                                    : route('brand.update', $brand->id ?? '');
                        @endphp
                        <form action="{{ $url }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @if ($config['method'] == 'update')
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label>Tên Giày<code>*</code></label>
                                <input value="{{ old('name', $brand->name ?? '') }}" name="name" type="text"
                                    class="form-control" placeholder="Nhập tên giày">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Lưu</button>
                            <a href="{{ route('brand.index') }}" class="btn btn-light">Hủy</a>
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
