<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/28/16
 * Time: 2:50 PM
 */

if($iflogin != 1){
    $returnurl = 'index.php?cityid='.$cityid;
    $returnurl = urlencode($returnurl);
    redirectmsg("Unfortunately, tourists are not allowed to buy vouchers, please log-in!","index.php?mod=login&returnurl=".$returnurl);
}

$msg = mhtmlspecialchars($_REQUEST['msg']);
$tuan_list = $db -> getAll("SELECT gso.*, i.title FROM `{$db_mymps}goods_order` as gso
                                                INNER JOIN `{$db_mymps}information` as i ON gso.infoid = i.id
                                                WHERE gso.userid = '$s_uid' AND gso.type=1 ORDER BY gso.dateline DESC");
include mymps_tpl('tuan_list');