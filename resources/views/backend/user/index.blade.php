<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{ config('apps.user.title') }} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ config('apps.user.title') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="add-user">
                            <h4 class="card-title">Danh sách thành viên</h4>
                            <button type="button" class="btn btn-gradient-primary">Thêm Thành Viên</button>
                        </div>
                            @include('backend.user.component.filter')
                            @include('backend.user.component.table')
                    </div>
                </div>
            </div>
        </div>
