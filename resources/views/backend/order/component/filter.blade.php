<button id="toggleFormBtn" type="button" class="btn btn-inverse-success btn-icon d-sm-none">
    <i class="mdi mdi-menu"></i>
</button>

<!-- Giao diện và form sẽ ẩn trên mobile -->
<div id="userForm" class="d-none d-sm-block">
    <div class="row">
        <div class="col-md-2">
            <form action="{{ route('order.index') }}">
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
        <div class="col-md-2"></div>
        <div class="col-md-3">
            <div class="order-search">
                <select name="status" class="form-control form-control-sm">
                    <option value="" selected>Tất cả đơn hàng</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Chưa xác nhận</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Đang giao hàng</option>
                    <option value="3" {{ request('status') === '3' ? 'selected' : '' }}>Đã hoàn thành</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="user-search">
                <select name="sort_by" class="form-control form-control-sm">
                    <option value="" selected>Sắp xếp theo</option>
                    <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Đơn hàng cũ hơn</option>
                    <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Đơn hàng mới hơn
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-inverse-success btn-icon">
                <i class="mdi mdi-account-search"></i>
            </button>
        </div>

        </form>
        <div class="col-md-1">
            @include('backend.order.component.toolbox')
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
