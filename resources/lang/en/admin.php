<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'activated' => 'Activated',
            'email' => 'Email',
            'first_name' => 'First name',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            'last_name' => 'Last name',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'user' => [
        'title' => 'Users',
        'test' => '',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'city' => 'City',
            'type_id' => 'Type',
            
        ],
    ],

    'task-category' => [
        'title' => 'Categories',

        'actions' => [
            'index' => 'Task Categories',
            'create' => 'New Task Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent',
            
        ],
    ],

    'section' => [
        'title' => 'Sections',

        'actions' => [
            'index' => 'Sections',
            'create' => 'New Section',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'task-section' => [
        'title' => 'Task Sections',

        'actions' => [
            'index' => 'Task Sections',
            'create' => 'New Task Section',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'order' => [
        'title' => 'Orders',

        'actions' => [
            'index' => 'Orders',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'section_id' => 'Section',
            'category_id' => 'Category',
            'short_description' => 'Short description',
            'full_description' => 'Full description',
            'execution_date' => 'Execution date',
            'start_execution_time' => 'Start execution time',
            'end_execution_time' => 'End execution time',
            'price' => 'Price',
            'by_user' => 'By user',
            
        ],
    ],

    'order' => [
        'title' => 'Orders',

        'actions' => [
            'index' => 'Orders',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'section_id' => 'Section',
            'category_id' => 'Category',
            'short_description' => 'Short description',
            'full_description' => 'Full description',
            'execution_date' => 'Execution date',
            'start_execution_time' => 'Start execution time',
            'end_execution_time' => 'End execution time',
            'price' => 'Price',
            'by_user' => 'By user',
            'price_negotiable' => 'Price negotiable',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];