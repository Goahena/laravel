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
            'title' => 'Quản lý bài viết',
            'icon' => 'mdi mdi-shopping',
            'name' => 'post',
            'subModule' => [
                [
                    'name' => 'asd',
                    'title' => 'Quản lý bài viết',
                    'route' => 'user.index'
                ],
                [
                    'name' => 'asd',
                    'title' => 'Quản lý nhóm',
                    'route' => 'user.catalogue.index'
                ]
            ]
        ]
    ]
];
