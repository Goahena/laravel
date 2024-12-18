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
                            <h4 class="card-title d-none d-sm-block">Danh sách Đơn Hàng</h4>
                        </div>
                        @include('backend.order.component.filter')
                        <div class="table-responsive">
                        @include('backend.order.component.table')
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
