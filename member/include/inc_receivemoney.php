<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/28/16
 * Time: 9:02 PM
 */

if($_REQUEST['fi'] === '0') {
    $fi = 0;
    $where = " AND gso.receivedmoney = 0";
} else if($_REQUEST['fi'] === '1') {
    $fi = 1;
    $where = " AND gso.receivedmoney != 0";
} else {
    $fi = 2;
    $where = "";
}



$tuan_list = $db -> getAll("SELECT gso.*, i.title FROM `{$db_mymps}goods_order` as gso
                                                INNER JOIN `{$db_mymps}information` as i ON gso.infoid = i.id
                                                INNER JOIN `{$db_mymps}member` as m ON m.userid = i.userid
                                                WHERE m.userid = '$s_uid' AND (gso.type=0 OR (gso.type=1 AND gso.useddate!=0)) ".$where . " order by gso.dateline desc");
$tuan_num = count($tuan_list);

include mymps_tpl('receive_money');