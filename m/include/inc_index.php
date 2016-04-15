<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','index');

$categories = get_categories_tree(0,'category');

if($preview == 'yes'){
	include mymps_tpl('index_preview');
} else {
	include mymps_tpl('index');
}
?>