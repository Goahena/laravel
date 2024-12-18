<base href="{{env('APP_URL')}}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/switch-checkbox.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <style>
        a {
            position: relative;
            text-decoration: none;
        }
    
        /* Tooltip styles */
        a.confirm:hover::after {
            content: "Xác nhận";
            position: absolute;
            top: 150%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #d4edda;
            color: #155724;
            padding: 5px;
            border-radius: 5px;
            white-space: nowrap;
            font-size: 12px;
            z-index: 10;
        }
    
        a.unconfirm:hover::after {
            content: "Bỏ xác nhận";
            position: absolute;
            top: 150%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px;
            border-radius: 5px;
            white-space: nowrap;
            font-size: 12px;
            z-index: 10;
        }
    
        a.delete:hover::after {
            content: "Xóa đơn hàng";
            position: absolute;
            top: 150%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f5c6cb;
            color: #721c24;
            padding: 5px;
            border-radius: 5px;
            white-space: nowrap;
            font-size: 12px;
            z-index: 10;
        }
    </style>