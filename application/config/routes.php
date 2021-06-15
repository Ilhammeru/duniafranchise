<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'error_handler/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['signin'] = 'login/login_form';
$route['signin/user_id/(:num)'] = 'login/login_form_with_name_lock/$1';
$route['signin/attention/user_id/(:num)'] = 'login/login_attention/$1';

$route['lockscreen/user_id/(:num)'] = 'lockscreen/lockscreen_form/$1';
$route['lockscreen/session/destroy'] = 'lockscreen/destroy_session';

$route['dashboard'] = 'dashboard';
$route['dashboard/signout'] = 'dashboard/destroy_session';

$route['role'] = 'role/role_report';
$route['role/new_role'] = 'role/role_add_form';
$route['role/edit/role_id/(:num)'] = 'role/role_edit_form/$1';
$route['role/delete/role_id/(:num)'] = 'role/delete_role/$1';

$route['logs'] = 'logs/logs_report';

$route['log_visitor'] = 'logs/logs_visitor_report';

$route['users'] = 'users/users_report';
$route['users/profile/user_id/(:num)'] = 'users/profile_form/$1';
$route['users/profile/user_id/(:num)/(:any)'] = 'users/profile_form/$1/$2';
$route['users/new_user'] = 'users/users_add_form';
$route['users/edit/user_id/(:num)'] = 'users/users_edit_form/$1';
$route['users/reset_password/user_id/(:num)'] = 'users/reset_password/$1';
$route['users/delete/user_id/(:num)'] = 'users/delete_user/$1';

$route['franchise'] = 'franchise/franchise_report';
$route['franchise/new_franchise'] = 'franchise/franchise_add_form';
//$route['franchise/edit/franchise_id/(:num)'] = 'franchise';
$route['franchise/detail/(:num)'] = 'franchise/franchise_detail/$1';
$route['franchise/delete/franchise_id/(:num)'] = 'franchise/delete_franchise/$1';

$route['article'] = 'article/article_report';
$route['article/new_article'] = 'article/article_add_form';
$route['article/detail/(:num)'] = 'article/article_detail/$1';
$route['article/delete/article_id/(:num)'] = 'article/delete_article/$1';

$route['about_us'] = 'about_us/view';
$route['about_us/edit'] = 'about_us/edit_about_us';

$route['banner'] = 'banner/view';

$route['home'] = 'home';

$route['franchises-list'] = 'webpublic/franchise';

$route['franchises/(:any)'] = 'webpublic/franchise/detail/$1';

$route['news'] = 'webpublic/article';

$route['news/(:any)'] = 'webpublic/article/detail/$1';

$route['home/about_us'] = 'webpublic/about_us/index';

$route['home/search'] = 'home/search/';

$route['error/access_denied'] = 'error_handler/error_access_denied';






