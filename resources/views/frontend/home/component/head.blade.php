<meta charset="UTF-8">    
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>PVB SHOP</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ URL('images1/icon-logo.png') }}">

<!-- Link -->
{{-- <link rel="stylesheet" href="{{ asset('frontend_assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/vinhuy.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/sb-admin-2.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/sb-admin-2.min.css') }}"> --}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

<!-- Link -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script src="{{ URL('js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- Custom CSS -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0"
    nonce="gCULMMol"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<!-- Custom CSS -->

<style>
    #myBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 99;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 100%;
        background-color: #FBFBFB;
        padding: 5px
    }

    #myBtn:hover {
        background-color: #16B5EA;
    }

    .product-title {
        white-space: nowrap;
        overflow: hidden;
        /* Ẩn phần vượt quá */
        text-overflow: ellipsis;
        /* Hiển thị dấu ba chấm nếu văn bản bị cắt */
    }

    .product-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        /* Tùy chỉnh khoảng cách phía trên */
    }
    .avatar-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-bottom: 20px;
    }
    .avatar-circle {
        display: inline-block;
        border-radius: 50%;
        object-fit: cover;
        width: 100px; /* hoặc chỉnh kích thước theo nhu cầu */
        height: 100px;
        cursor: pointer;
        transition: box-shadow 0.3s;
    }
    .avatar-circle:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    .file-upload-default {
        display: none;
    }
</style>
