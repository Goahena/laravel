<?php

return [
    'module' => [
        [
            'id' => 'user-page',
            'title' => 'Quản lý Thành Viên',
            'icon' => 'mdi mdi-shopping',
            'subModule' => [
                [
                    'title' => 'Quản lý Thành Viên',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'Quản lý Nhóm',
                    'route' => 'user.catalogue.index'
                ]
            ]
        ],
        [
            'id' => 'product-pages',
            'title' => 'Quản lý bài viết',
            'icon' => 'mdi mdi-shopping',
            'subModule' => [
                [
                    'title' => 'Quản lý bài viết',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'Quản lý nhóm',
                    'route' => 'user.catalogue.index'
                ]
            ]
        ]
    ]
];
