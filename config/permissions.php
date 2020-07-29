<?php

return[
  'Admin' =>[
      'super_admin',
      'admin',
      'user'
  ],

    'permissions' => [
        'create',
        'read',
        'update',
        'delete'
    ],

    'models' => [
        'users',
        'Admin',
        'categories',
        'courses',
        'settings'
    ]
];
