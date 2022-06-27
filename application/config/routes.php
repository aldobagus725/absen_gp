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
$route['admin/absen/hari_ini'] = "Absen/getAbsenThisDay";
$route['admin/absen/custom_date'] = 'Absen/getAbsenCustomDate';
// Admin
$route['admin/users'] = 'Admin';
$route['admin/users/addForm'] = 'Admin/addForm';
$route['admin/users/set'] = 'Admin/set';
$route['admin/users/edit/(:num)'] = 'Admin/editForm/$1';
$route['admin/users/set/(:num)'] = 'Admin/set/$1';
$route['admin/users/delete/(:num)'] = 'Admin/delete/$1';
$route['admin/users/password/(:num)'] = 'Admin/changePwdForm/$1';
$route['admin/users/changepwd/(:num)'] = 'Admin/changePassword/$1';
// Sektor
$route['admin/sektor'] = 'Sektor';
$route['admin/sektor/addForm'] = 'Sektor/addForm';
$route['admin/sektor/set'] = 'Sektor/set';
$route['admin/sektor/edit/(:num)'] = 'sektor/editForm/$1';
$route['admin/sektor/set/(:num)'] = 'sektor/set/$1';
$route['admin/sektor/delete/(:num)'] = 'Sektor/delete/$1';
// Users_role
$route['admin/role'] = 'UsersRole';
$route['admin/role/addForm'] = 'UsersRole/addForm';
$route['admin/role/set'] = 'UsersRole/set';
$route['admin/role/edit/(:num)'] = 'UsersRole/editForm/$1';
$route['admin/role/set/(:num)'] = 'UsersRole/set/$1';
$route['admin/role/delete/(:num)'] = 'UsersRole/delete/$1';

#Frontend Routes
$route['absen/signin'] = 'Absen/absenGp';
$route['absen/status'] = 'Absen/absen_status';