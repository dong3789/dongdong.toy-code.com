<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['join'] = '/main/join';
$route['join_proc'] = '/main/join_proc';

$route['login'] = '/main/login';
$route['login_proc'] = '/main/login_proc';
$route['logout'] = '/main/logout';

$route['admin'] = '/admin/index';
$route['admin_proc'] = '/admin/admin_proc';
$route['controlBoard'] = 'admin/member_posts';
$route['controlBoard/(:any)'] = 'admin/member_posts/$1';
$route['controlComments'] = 'admin/member_comments';
$route['controlComments/(:any)'] = 'admin/member_comments/$1';

$route['posts'] = '/board/posts';
$route['posts/(:any)'] = '/board/posts/$1';
$route['posts_comment'] = '/board/posts_comment';
$route['post_edit/(:any)'] = '/board/post_edit/$1';
$route['posts_del/(:any)'] = 'board/posts_del/$1';

$route['myPosts'] = '/board/getMyPosts';
$route['mypage'] = '/main/mypage';
$route['mypage_proc'] = '/main/mypage_proc';

$route['writePosts'] = '/board/writePosts';
$route['post_proc'] = '/board/post_proc';
$route['postDetail/(:any)'] = '/board/postDetail/$1';

$route['searchPw'] = '/main/searchMy';
$route['secession'] = '/main/secession';
$route['secessionList'] = '/admin/secessionList';
$route['secessionList/(:any)'] = '/admin/secessionList/$1';
