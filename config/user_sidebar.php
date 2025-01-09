<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'bx bxs-home',
        'route' => 'user.dashboard',
    ],
    [
        'title' => 'Profile Settings',
        'icon' => 'bx bxs-cog',
        'submenu' => [
            [
                'title' => 'Personal Information',
                'icon' => 'bx bxs-contact',
                'route' => 'user.profile.index',
            ],
            [
                'title' => 'Change Password',
                'icon' => 'bx bx-key',
                'route' => 'user.profile.changePassword',
            ],
        ],
    ],
    [
        'title' => 'Logout',
        'icon' => 'bx bx-power-off',
        'route' => 'user.logout',
        'confirm' => 'Are you sure you want to log out'
    ],
];
