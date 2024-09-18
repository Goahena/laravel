<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb',['title' => $config['seo']['index']['title']])
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="add-user">
                            <h4 class="card-title">Danh sách thành viên</h4>
                            <a href="{{ route('user.create') }}">
                                <button type="button" class="btn btn-gradient-primary">Thêm Thành Viên</button>
                            </a>
                        </div>
                            @include('backend.user.component.filter')
                            @include('backend.user.component.table')
                    </div>
                </div>
            </div>
        </div>
