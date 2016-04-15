<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','changecity');
$cities = $mymps_global['cfg_cityshowtype'] == 'province' ? get_changeprovince_cities() : get_changecity_cities();
$hotcities = get_hot_cities();
//waptemplate(CURSCRIPT);
include mymps_tpl(CURSCRIPT);
?>