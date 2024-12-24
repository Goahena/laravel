<?php

return [
    'module' => [
        [
            'id' => 'user-page',
            'title' => 'Quản lý Thành Viên',
            'icon' => 'mdi mdi-contacts',
            'name' => 'user',
            'subModule' => [
                [
                    'name' => 'index',
                    'title' => 'Quản lý Thành Viên',
                    'route' => 'user.index'
                ],
                [
                    'name' => 'catalogue',
                    'title' => 'Quản lý Nhóm',
                    'route' => 'user.catalogue.index'
                ]
            ]
        ],
        [
            'id' => 'product-pages',
            'title' => 'Quản lý Sản Phẩm',
            'icon' => 'mdi mdi-tshirt-crew',
            'name' => 'product',
            'subModule' => [
                [
                    'name' => 'product',
                    'title' => 'Quản Lý Giày',
                    'route' => 'product.index'
                ],
                [
                    'name' => 'shoetype',
                    'title' => 'Quản lý Loại Giày',
                    'route' => 'shoe-type.index'
                ],
                [
                    'name' => 'brand',
                    'title' => 'Quản Lý Thương Hiệu',
                    'route' => 'brand.index'
                ],
                [
                    'name' => 'promotion',
                    'title' => 'Quản Lý Khuyến Mãi',
                    'route' => 'promotion.index'
                ]
            ]
        ],
        [
            'id' => 'order-pages',
            'title' => 'Quản lý Giao Dịch',
            'icon' => 'mdi mdi-cart',
            'name' => 'order',
            'subModule' => [
                [
                    'name' => 'order',
                    'title' => 'Quản Lý Đơn Hàng',
                    'route' => 'order.index'
                ],
                [
                    'name' => 'revenue',
                    'title' => 'Báo Cáo Doanh Thu',
                    'route' => 'order.revenueReport'
                ]
            ]
        ],
        [
            'id' => 'setting-pages',
            'title' => 'Cấu hình chung',
            'icon' => 'mdi mdi-translate',
            'name' => 'setting',
            'subModule' => [
                [
                    'name' => 'language',
                    'title' => 'Quản Lý Ngôn Ngữ',
                    'route' => 'language.index'
                ]
            ]
        ]
    ]
];
