<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/28/16
 * Time: 9:02 PM
 */

if($_REQUEST['fi'] === '0') {
    $fi = 0;
    $where = " AND gso.useddate = 0";
} else if($_REQUEST['fi'] === '1') {
    $fi = 1;
    $where = " AND gso.useddate != 0";
} else {
    $fi = 2;
    $where = "";
}

$hui_list = $db -> getAll("SELECT gso.*, i.title FROM `{$db_mymps}goods_order` as gso
                                                INNER JOIN `{$db_mymps}information` as i ON gso.infoid = i.id
                                                INNER JOIN `{$db_mymps}member` as m ON m.userid = i.userid
                                                WHERE m.userid = '$s_uid' AND gso.type=0");

$tuan_list = $db -> getAll("SELECT gso.*, i.title FROM `{$db_mymps}goods_order` as gso
                                                INNER JOIN `{$db_mymps}information` as i ON gso.infoid = i.id
                                                INNER JOIN `{$db_mymps}member` as m ON m.userid = i.userid
                                                WHERE m.userid = '$s_uid' AND gso.type=1".$where . " order by gso.dateline desc");

$hui_num = count($hui_list);
$tuan_num = count($tuan_list);

include mymps_tpl('order_records');