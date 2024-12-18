<table class="table table-hover">
    <thead>
        <tr>
            {{-- <th scope="col"><input id="checkAll" type="checkbox"></th> --}}
            <th scope="col"><strong> Tên Loại giày </strong></th>
            <th scope="col"><strong> Ngày Tạo </strong></th>
            <th scope="col"><strong> Trạng Thái </strong></th>
            <th scope="col" class="text-center"><strong> Thao Tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if (isset($shoeTypes))
            @foreach ($shoeTypes as $shoeType)
                <tr>
                    {{-- <td class="text-center">
                        <input class="checkbox-item" type="checkbox" value="{{ $user->id }}">
                    </td> --}}
                    <td>
                        <div class="info-item"> {{ $shoeType['shoe_type_name'] }} </div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $shoeType['created_at']  ?? 'Không xác định' }}</div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $shoeType->promotions->promotion_name ?? 'Không xác định' }}</div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('shoe-type.edit', $shoeType->id) }}">
                            <button type="button" class="btn btn-inverse-info btn-icon">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                        </a>
                        <a href="{{ route('shoe-type.delete', $shoeType->id) }}">
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