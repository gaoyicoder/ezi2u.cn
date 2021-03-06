<?php
define('IN_SMT',true);
define('IN_MYMPS', true);
define('CURSCRIPT','space');
require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";
$user   = isset($user) 	 ? checkhtml($user) : '';
$id 	= isset($id) 	 ? intval($id) 		: '';
ifsiteopen();
$where  = "WHERE a.userid = '$user'";
$space	= $db -> getRow("SELECT a.* FROM `{$db_mymps}member` AS a LEFT JOIN `{$db_mymps}area` AS b ON a.areaid = b.areaid $where");
if(!$space || empty($user)) write_msg("The member you requested either does not exist or is yet to pass the revision");
$space['if_corp'] = $mymps_global['cfg_if_corp'] != 1 ? 0 : $space['if_corp'];
$space['storeuri'] = $space['if_corp'] == 1 ? Rewrite('store',array('uid'=>$space['id'])) : '';	
$space['uri'] 	 = Rewrite('space',array('user'=>$user,'part'=>'index'));
$space['prelogo'] = $space['prelogo'] ? $space['prelogo'] : '/images/noavatar_small.gif';
$info 		  	 = mymps_get_info_list(30,1,'',$user);
$loc 		= get_location('space','',$user);
$location 	= $loc['location'];
$page_title = $loc['page_title'];
globalassign();
include MYMPS_TPL.'/spaces/person/index.tpl.php';
is_object($db) && $db->Close();
exit;
?>