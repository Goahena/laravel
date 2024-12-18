<table class="table table-hover">
    <thead>
        <tr>
            {{-- <th scope="col"><input id="checkAll" type="checkbox"></th> --}}
            <th scope="col"><strong> Tên Khuyến Mãi </strong></th>
            <th scope="col"><strong> Giá Trị </strong></th>
            <th scope="col"><strong> Ngày Tạo </strong></th>
            <th scope="col"><strong> Trạng Thái </strong></th>
            <th scope="col" class="text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if (isset($promotions))
            @foreach ($promotions as $promotion)
                <tr>
                    {{-- <td class="text-center">
                        <input class="checkbox-item" type="checkbox" value="{{ $user->id }}">
                    </td> --}}
                    <td>
                        <div class="info-item"> {{ $promotion['promotion_name'] }} </div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $promotion['promotion_value'] }} %</div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $promotion['created_at'] ?? 'Không xác định' }}</div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $promotion['status'] ?? 'Không xác định' }}</div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('promotion.edit', $promotion->id) }}">
                            <button type="button" class="btn btn-inverse-info btn-icon">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                        </a>
                        <a href="{{ route('promotion.delete', $promotion->id) }}">
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