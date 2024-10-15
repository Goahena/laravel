<table class="table table-striped">
    <thead>
        <tr>
            <th><input id="checkAll" type="checkbox"></th>
            <th><strong> Tên Nhóm </strong></th>
            <th><strong> Mô Tả </strong></th>
            <th><strong> Trạng thái </strong></th>
            <th class="text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if (isset($userCatalogues) && is_object($userCatalogues))
            @foreach ($userCatalogues as $userCatalogue)
                <tr>
                    <td class="text-center">
                        <input class="checkbox-item" type="checkbox" value="{{ $userCatalogue->id }}">
                    </td>
                    <td>
                        <div class="info-item"><strong>Họ tên: </strong>{{ $userCatalogue->name }}</div>
                    </td>
                    <td>
                        <div class="info-item">{{ $userCatalogue->description }}</div>
                    </td>
                        <td class="switch-{{ $userCatalogue->id }}">
                            <div class="form-check form-switch">
                                <input class="form-check-input status js-switch-{{$userCatalogue->id}}" data-field="publish" data-model="UserCatalogue" data-modelid="{{ $userCatalogue->id }}" value="{{$userCatalogue->publish}}" {{ ($userCatalogue->publish) ? 'checked' : ''}} type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                            </div>
                        </td>
                    <td>
                        <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}">
                            <button type="button" class="btn btn-inverse-info btn-icon">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                        </a>
                        <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}">
                            <button type="button" class="btn btn-inverse-danger btn-icon">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="user-pagination">{{ $userCatalogues->links('pagination::bootstrap-4') }}</div>
