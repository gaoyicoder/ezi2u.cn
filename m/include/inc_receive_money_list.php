<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/28/16
 * Time: 3:33 PM
 */

if($iflogin != 1){
    $returnurl = 'index.php?cityid='.$cityid;
    $returnurl = urlencode($returnurl);
    redirectmsg("Unfortunately, tourists are not allowed to buy vouchers, please log-in!","index.php?mod=login&returnurl=".$returnurl);
}

$received_money = intval($_REQUEST['received_money'])?intval($_REQUEST['received_money']):0;

$hui_list = $db -> getAll("SELECT gso.*, i.title FROM `{$db_mymps}goods_order` as gso
                                                INNER JOIN `{$db_mymps}information` as i ON gso.infoid = i.id
                                                INNER JOIN `{$db_mymps}member` as m ON m.userid = i.userid
                                                WHERE m.userid = '$s_uid' AND (gso.type=0 OR (gso.type=1 AND gso.useddate!=0)) AND gso.receivedmoney=".$received_money);

if($received_money == 0) {
    $title = "Unexchanged";
} else {
    $title = "Exchanged";
}
include mymps_tpl('receive_money_list');