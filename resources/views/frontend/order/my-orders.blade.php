<div class="card mb-3 shadow-5" style="background-color: #EEEEEE">
    <div class="card-body" style="margin-top:40px">
        <center>
            <h3 class="card-title">Đơn hàng của tôi</h3>
        </center>
    </div>
    <br>
</div>
<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/trang-chu">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
        </ol>
    </nav>
    <br>
    @if ($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
    <table id="ordersTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Tên Đơn Hàng</th>
                <th>Giá Trị</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->name }}</td>
                <td>{{ number_format($order->total_price) }}</td>
                <td>{{ $order->getStatusLabelAttribute() }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">Xem đơn</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @endif
</div>
<script>
    $(document).ready(function () {
        $('#ordersTable').DataTable({
            language: {
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
                zeroRecords: "Không tìm thấy dữ liệu",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ dòng",
                infoEmpty: "Không có dữ liệu để hiển thị",
                infoFiltered: "(lọc từ _MAX_ dòng)",
                paginate: {
                    first: "Đầu",
                    last: "Cuối",
                    next: "Tiếp",
                    previous: "Trước"
                },
            },
            responsive: true,
        });
    });
</script>
