<div class="toolbox">
    <div data-bs-toggle="dropdown">
        <button type="submit" class="btn btn-inverse-success btn-icon">
            <i class="mdi mdi-settings"></i>
        </button>
    </div>
    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
        <form id="bulkActionForm" method="POST">
            @csrf
            <input type="hidden" name="order_ids" id="selectedOrders">
            <input type="hidden" name="action" id="bulkAction">
        <a href="#" id="bulkConfirmButton" class="dropdown-item">
            <i class="mdi mdi-check-all me-2 text-info"></i> Xác nhận </a>
        <div class="dropdown-divider"></div>
        <a href="#" id="bulkUnconfirmButton" class="dropdown-item">
            <i class="mdi mdi-close-circle-outline text-primary"></i> Hủy xác nhận </a>
        </form>
    </div>
</div>