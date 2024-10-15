<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb',['title' => $config['seo']['index']['title']])
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="add-user">
                            <h4 class="card-title">Danh sách thành viên</h4>
                            <a href="{{ route('user.catalogue.create') }}">
                                <button type="button" class="btn btn-gradient-primary">Thêm Nhóm Thành Viên</button>
                            </a>
                        </div>
                            @include('backend.user.catalogue.component.filter')
                            @include('backend.user.catalogue.component.table')
                    </div>
                </div>
            </div>
        </div>
