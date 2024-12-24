<div class="main-panel">
    <div class="content-wrapper">
        <div class="d-none d-sm-block">
            @include('backend.dashboard.component.breadcrumb', [
                'title' => $config['seo']['index']['title'],
            ])
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="add-user">
                            <h4 class="card-title d-none d-sm-block">Danh sách Đơn Hàng</h4>
                        </div>
                        <form action="{{ route('order.revenueReport') }}" method="GET" class="row g-3 mb-4">
                            {{-- Lọc theo tháng --}}
                            <div class="col-md-3">
                                <label for="month" class="form-label">Lọc theo tháng</label>
                                <select id="month" name="month" class="form-control form-control-lg">
                                    <option value="">Tất cả tháng</option>
                                    @php
                                        $currentMonth = \Carbon\Carbon::now()->month;
                                    @endphp
                                    @for ($i = 1; $i <= $currentMonth; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('month') == $i ? 'selected' : '' }}>Tháng {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Lọc theo năm --}}
                            <div class="col-md-3">
                                <label for="year" class="form-label">Lọc theo năm</label>
                                <select id="year" name="year" class="form-control form-control-lg">
                                    <option value="">Tất cả năm</option>
                                    @php
                                        $currentYear = \Carbon\Carbon::now()->year;
                                        $startYear = $currentYear - 10; // Hiển thị từ 10 năm trước
                                    @endphp
                                    @for ($i = $startYear; $i <= $currentYear; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('year') == $i ? 'selected' : '' }}>Năm {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Lọc từ ngày --}}
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Từ ngày</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>

                            {{-- Lọc đến ngày --}}
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Đến ngày</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="d-flex align-items-end">
                                <button type="submit" class="btn btn-gradient-primary me-2">Thống Kê</button>
                                <a href="{{ route('order.revenueReport') }}" class="btn btn-light">Đặt lại</a>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Loại</th>
                                        <th>Giá trị lọc</th>
                                        <th>Doanh thu (VND)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $week ? 'Doanh thu theo Tuần' : ($month ? 'Doanh thu theo Tháng' : ($startDate && $endDate ? 'Doanh thu theo Ngày' : 'Tất cả doanh thu')) }}
                                        </td>
                                        <td>
                                            @if ($week)
                                                Tuần {{ $week }}
                                            @elseif ($month)
                                                Tháng {{ $month }}
                                            @elseif ($year)
                                                Năm {{ $year }}
                                            @elseif ($month && $year)
                                                Tháng {{ $month }}/{{ $year }}
                                            @elseif ($startDate && $endDate)
                                                {{ $startDate }} - {{ $endDate }}
                                            @else
                                                Tất cả doanh thu
                                            @endif
                                        </td>
                                        <td>{{ isset($orders[0]->revenue) ? number_format($orders[0]->revenue, 0, ',', '.') : '0' }}
                                            VND</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Lắng nghe sự thay đổi trên các ô chọn ngày
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const monthSelect = document.getElementById('month');
        const yearSelect = document.getElementById('year');

        // Kiểm tra nếu người dùng đã chọn ngày
        function resetMonthAndYear() {
            if (startDateInput.value || endDateInput.value) {
                monthSelect.value = '';
                yearSelect.value = '';
            }
        }

        // Lắng nghe sự thay đổi trên ô start_date và end_date
        startDateInput.addEventListener('change', resetMonthAndYear);
        endDateInput.addEventListener('change', resetMonthAndYear);
    });
</script>
