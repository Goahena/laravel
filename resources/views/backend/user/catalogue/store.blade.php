<div class="main-panel">
    <div class="content-wrapper">
        @include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
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
                        <h4 class="card-title">Nhập tên nhóm</h4>
                        @php
                            $url = ($config['method'] == 'create') ? route('user.catalogue.store') : route('user.catalogue.update', $userCatalogue->id)
                        @endphp
                        <form action="{{ $url }}" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label>Họ và Tên<code>*</code></label>
                                <input value="{{ old('name', $userCatalogue->name ?? '') }}" name="name" type="text"
                                    class="form-control" placeholder="Nhập tên nhóm">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea value="{{ old('description', $userCatalogue->description ?? '') }}" class="form-control" type="text" name="description" rows="4">{{ (isset($userCatalogue) ? $userCatalogue->description : '') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>