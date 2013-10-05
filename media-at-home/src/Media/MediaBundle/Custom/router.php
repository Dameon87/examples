<?php
/* Start : Get URL Information */
$url = explode('/', $_SERVER['REQUEST_URI']);
$url = array_filter($url, 'strlen');
$url = array_values($url);
//$subdir = array_shift($url);
/* End : Get URL Information */

if (!empty($url)) {
	if (file_exists(PAGES_DIR."/".$url[0].".tpl")) {
		$page = $url[0];
	} else {
		redirect_to('/index');
	}
} else {
	$page = 'index';
}
	$smarty->assign('page', $page);
