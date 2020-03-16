<?php 

$config['admin_login'] = [
    [
        'field'     =>  'admin_user',
        'label'     =>  'Username',
        'rules'     =>  'required',
    ],
    [
        'field'     =>  'admin_pword',
        'label'     =>  'Password',
        'rules'     =>  'required',
    ]
];

$config['admin_reg'] = [
    [
        'field'     =>  'reg_user',
        'label'     =>  'Username',
        'rules'     =>  'required|is_unique[tbl_user.username]',
        'errors'    =>  [
            'is_unique'     =>  'Please refrain from using an existing %s',
        ]
    ],
    [
        'field'     =>  'reg_pass',
        'label'     =>  'Password',
        'rules'     =>  'required',
    ]
];

$config['client_reg'] = [
    [
        'field'     =>  'full_name',
        'label'     =>  'Full Name',
        'rules'     =>  'required',
    ],
    [
        'field'     =>  'date_field',
        'label'     =>  'Birth Date',
        'rules'     =>  'required',
    ],
    [
        'field'     =>  'email_field',
        'label'     =>  'Email',
        'rules'     =>  'required',
    ],
    [
        'field'     =>  'phone_field',
        'label'     =>  'Phone',
        'rules'     =>  'required',
    ],
    [
        'field'     =>  'user_code',
        'label'     =>  'Telesales',
        'rules'     =>  'required',
    ]
];
