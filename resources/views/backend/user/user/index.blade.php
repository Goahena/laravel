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
                            <h4 class="card-title d-none d-sm-block">Danh sách thành viên</h4>
                            <a href="{{ route('user.create') }}">
                                <button type="button" class="btn btn-gradient-primary">Thêm Thành Viên</button>
                            </a>
                        </div>
                        @include('backend.user.user.component.filter')
                        <div class="table-responsive">
                            @include('backend.user.user.component.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
