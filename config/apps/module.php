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
                    'route' => 'user.index'
                ]
            ]
        ],
        [
            'id' => 'brand-pages',
            'title' => 'Quản lý Thương Hiệu',
            'icon' => 'mdi mdi-shopping',
            'name' => 'brand',
            'subModule' => [
                [
                    'name' => 'brand',
                    'title' => 'Quản Lý Thương Hiệu',
                    'route' => 'user.index'
                ]
            ]
        ],
        [
            'id' => 'promotion-pages',
            'title' => 'Quản lý Khuyến Mãi',
            'icon' => 'mdi mdi-shopping',
            'name' => 'promotion',
            'subModule' => [
                [
                    'name' => 'promotion',
                    'title' => 'Quản Lý Khuyến Mãi',
                    'route' => 'user.index'
                ]
            ]
        ],
        [
            'id' => 'order-pages',
            'title' => 'Quản lý Đơn Hàng',
            'icon' => 'mdi mdi-shopping',
            'name' => 'order',
            'subModule' => [
                [
                    'name' => 'order',
                    'title' => 'Quản Lý Đơn Hàng',
                    'route' => 'order.index'
                ]
            ]
        ],
        [
            'id' => 'product-pages',
            'title' => 'Quản lý bài viết',
            'icon' => 'mdi mdi-shopping',
            'name' => 'post',
            'subModule' => [
                [
                    'name' => 'post',
                    'title' => 'Quản Lý Bài Viết',
                    'route' => 'user.index'
                ],
                [
                    'name' => 'post',
                    'title' => 'QL Danh Mục Bài Viết',
                    'route' => 'user.catalogue.index'
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
