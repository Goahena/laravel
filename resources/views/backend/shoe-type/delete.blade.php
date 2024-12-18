<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <code>
                            <h4>Xác nhận xóa tài khoản</h4>
                        </code>
                        <form method="post" action="{{ route('product.destroy', $product->id) }}" class="forms-">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label>Tên Giày</label>
                                <input readonly type="text" class="form-control form-control-lg"
                                    value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <!-- Image 1 -->
                                        @if (isset($product['image_1']))
                                            <img class="product-img-del" src="{{ asset($product['image_1']) }}" alt="Image 1" />
                                        @else
                                            <span>Chưa có ảnh 1</span>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-danger btn-delete">
                                <i class="mdi mdi-delete"></i>
                            </button>
                            <button class="btn btn-gradient-secondary btn-delete">
                                <i class="mdi mdi-keyboard-return"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
