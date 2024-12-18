<table class="table table-hover">
    <thead>
        <tr>
            {{-- <th scope="col"><input id="checkAll" type="checkbox"></th> --}}
            <th scope="col"><strong> Hình ảnh </strong></th>
            <th scope="col"><strong> Tên giày </strong></th>
            <th scope="col"><strong> Loại giày </strong></th>
            <th scope="col"><strong> Thương hiệu </strong></th>
            <th scope="col"><strong> Đơn giá </strong></th>
            <th scope="col"><strong> Khuyến mãi </strong></th>
            <th scope="col" class="text-center"><strong> Thao tác </strong></th>
        </tr>
    </thead>
    <tbody>
        @if (isset($products))
            @foreach ($products as $product)
                <tr>
                    {{-- <td class="text-center">
                        <input class="checkbox-item" type="checkbox" value="{{ $user->id }}">
                    </td> --}}
                    <td class="py-1 text-center">
                        <img src="{{ asset($product['image_1']) }}"
                            alt="image" />
                    </td>
                    <td>
                        <div class="info-item"> {{ $product['name'] }} </div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $product->shoeType->shoe_type_name ?? 'Không xác định' }}</div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $product->brand->brand_name ?? 'Không xác định' }}</div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $product['price'] }}</div>
                    </td>
                    <td>
                        <div class="userCatalogue-item">{{ $product->promotions->promotion_name ?? 'Không xác định' }}</div>
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}">
                            <button type="button" class="btn btn-inverse-info btn-icon">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                        </a>
                        <a href="{{ route('product.delete', $product->id) }}">
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