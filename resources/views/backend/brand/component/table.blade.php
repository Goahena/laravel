<table class="table table-hover">
    <thead>
        <tr>
            {{-- <th scope="col"><input id="checkAll" type="checkbox"></th> --}}
            <th scope="col"><strong>Tên Thương hiệu </strong></th>
            <th scope="col" class="text-end"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if (isset($brands))
            @foreach ($brands as $brand)
                <tr>
                    {{-- <td class="text-center">
                        <input class="checkbox-item" type="checkbox" value="{{ $user->id }}">
                    </td> --}}
                    <td>
                        <div class="info-item"> {{ $brand['brand_name'] }} </div>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('brand.edit', $brand->id) }}">
                            <button type="button" class="btn btn-inverse-info btn-icon">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                        </a>
                        <a href="{{ route('brand.delete', $brand->id) }}">
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