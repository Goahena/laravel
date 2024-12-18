<div class="main-panel">
    <div class="content-wrapper">
        <div class="d-none d-sm-block">
            @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="add-user">
                            <h4 class="card-title d-none d-sm-block">Danh sách Sản Phẩm</h4>
                            <a href="{{ route('promotion.create') }}">
                                <button type="button" class="btn btn-gradient-primary">Thêm Sản Phẩm</button>
                            </a>
                        </div>
                        @include('backend.promotion.component.filter')
                        <div class="table-responsive">
                        @include('backend.promotion.component.table')
                            
                            <div class="user-pagination">{{ $promotions->links('pagination::bootstrap-4') }}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
