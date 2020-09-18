<?php 
include_once 'database.php';

$settings = $mysqli->query('select * from settings where id = 1')->fetch_assoc();

if(count($settings)){
    $app_name = $settings['app_name'];
    $admin_email = $settings['admin_email'];
}else{ 
    $app_name = 'Service App';
    $admin_email = 'home1build@gmail.com';
}

$config = [
    'app_name' => $app_name,
    'admin_email' => 'home1build@gmail.com',
    'lang' => 'en',
    'dir' => 'ltr',
    'app_url' => 'http://127.0.0.1/WebProject/',
    'upload_dir' => 'uploads' ,
     'admin_assets' => 'http://127.0.0.1/WebProject/admin/template/assets'
];