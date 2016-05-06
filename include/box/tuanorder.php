<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 5/4/16
 * Time: 9:15 PM
 */

!defined('IN_MYMPS') && exit('FORBIDDEN');
require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

$info = isset($_REQUEST['info']) ? intval($_REQUEST['info']) : '';
$ordernum = isset($_REQUEST['ordernum']) ? intval($_REQUEST['ordernum']) : '';
$user = $db -> getRow("SELECT m.userpwd
                FROM `{$db_mymps}goods` AS g INNER JOIN `{$db_mymps}member` AS m ON g.userid = m.userid
                WHERE g.goodsid = '".$id."'");
$md5md5pwd = md5($user['userpwd']);
include MYMPS_ROOT.'/template/box/tuanorder.html';