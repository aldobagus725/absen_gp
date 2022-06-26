<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Absen';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// login for admin
$route['admin/login'] = 'Authentication/viewLoginAdmin';
// Logout Admin
$route['admin/logout'] = 'Authentication/logoutAdmin';

# Route for Backend
//Dashboard
$route['admin/dashboard'] = 'dashboard';
$route['admin/dashboard'] = 'admin';
//Default admin route
$route['admin'] = 'dashboard';
//Laporan - utk melihat jumlah kehadiran
$route['admin/laporan'] = 'report';
//Admins
$route['admin/admins'] = 'Admin';
$route['admin/admins/add'] = 'Admin/set';
$route['admin/admins/update/(:num)'] = 'Admin/update/$1';
$route['admin/admins/delete/(:num)'] = 'Admin/delete/$1';
$route['admin/admins/changepass/(:num)'] = 'Admin/changePassword/$1';
// Sektor
$route['admin/sektor'] = 'Sektor';
$route['admin/sektor/addForm'] = 'Sektor/addForm';
$route['admin/sektor/set'] = 'Sektor/set';
$route['admin/sektor/edit/(:num)'] = 'sektor/editForm/$1';
$route['admin/sektor/set/(:num)'] = 'sektor/set/$1';
$route['admin/sektor/delete/(:num)'] = 'Sektor/delete/$1';
// UsersRole
$route['admin/role'] = 'UsersRole';
$route['admin/role/add'] = 'UsersRole/set';
$route['admin/role/add/(:num)'] = 'UsersRole/set/$1';
$route['admin/role/delete/(:num)'] = 'UsersRole/delete/$1';

#Frontend Routes
$route['absen/signin'] = 'Absen/absenGp';
$route['absen/status'] = 'Absen/absen_status';