<?php

!defined('WAP') && exit('FORBIDDEN');

define('CURSCRIPT','member');



$userid = isset($_GET['userid']) ? mhtmlspecialchars($_GET['userid']) : '';

/*if(!$row = $db -> getRow("SELECT * FROM `{$db_mymps}member` WHERE userid = '$userid'")){

	errormsg('The user you requested either does not exist or have not yet passed the revision!');

}*/

$row = $db -> getRow("SELECT * FROM `{$db_mymps}member` WHERE userid = '$s_uid'");

$row['prelogo'] = $row['prelogo'] ? $row['prelogo'] : '/images/noavatar_small.gif';

$row['prelogo'] = $mymps_global['SiteUrl'].$row['prelogo'];



include mymps_tpl('member');

?>