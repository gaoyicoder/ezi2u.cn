<?php 
define('IN_SMT', true);
define('IN_MYMPS', true);
define('CURSCRIPT','posthistory');

require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";

ifsiteopen();
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";

if(!is_file(MYMPS_DATA."/install.lock")) write_msg('','install/index.php');

if(!$tel) write_msg('The phone number you wish to search for cannot be empty!','olmsg');
$tel_decode = addslashes(base64_decode($tel));

$info = mymps_get_info_list('20',1,'','','','','','',true,$tel_decode);
$numtotal = $db -> getOne("SELECT COUNT(id) FROM `{$db_mymps}information` WHERE tel = '$tel_decode'");
$numtotal = $numtotal < 20 ? $numtotal : 20;

$loc 		= get_location('posthistory','','View Posting Records');
$page_title = $loc['page_title'];

globalassign();
include mymps_tpl(CURSCRIPT);

is_object($db) && $db->Close();
exit();
?>