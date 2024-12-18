<button id="toggleFormBtn" type="button" class="btn btn-inverse-success btn-icon d-sm-none">
    <i class="mdi mdi-menu"></i>
</button>

<!-- Giao diện và form sẽ ẩn trên mobile -->
<div id="userForm" class="d-none d-sm-block">
    <form action="{{ route('shoe-type.index') }}">
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
            <div class="col-md-4"></div>
            <div class="col-md-5">
                <div class="user-search">
                    <input name="keyword" type="text" value="{{ request('keyword') ?: old('keyword') }}"
                        class="form-control form-control-sm" placeholder="Tìm Kiếm Tên Loại Giày">
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
