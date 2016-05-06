<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/25/16
 * Time: 4:14 PM
 */

if($iflogin != 1){

}

if(!submit_check(CURSCRIPT.'_submit')){
    $info_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']):'';
    $good_id = isset($_REQUEST['good']) ? intval($_REQUEST['good']):'';
    if($info_id) {
        $sql_user = "select * from `{$db_mymps}member` AS m where m.userid='".$s_uid."'";
        $user = $db->getRow($sql_user);
        $money_own = $user['money_own'];
        $sql_info = "select * from `{$db_mymps}information` AS i where i.id='".$info_id."'";
        $info = $db->getRow($sql_info);
        if (!$info) {
            errormsg("Can't find the information.");
        }
        $sql_hui = "select g.* from `{$db_mymps}information` AS i INNER JOIN `{$db_mymps}member` as m ON i.userid = m.userid INNER JOIN `{$db_mymps}goods` as g ON m.userid = g.userid
                              WHERE i.id='".$info_id."' and g.type=0 order by g.oldprice";
        $goods_list = $db -> getAll($sql_hui);
        if(!$goods_list) {
            errormsg("该商家没有打折代金券。");
        }

        include mymps_tpl('hui');
    } else {
        errormsg('Wrong Information ID');
    }
} else {
    $userpwd = isset($_REQUEST['userpwd']) ? mhtmlspecialchars($_REQUEST['userpwd']):'';
    if(!$userpwd) {
        $goodsid = isset($_REQUEST['good']) ? intval($_REQUEST['good']):'';
        $infoid = isset($_REQUEST['id']) ? intval($_REQUEST['id']):'';
        $total_amount = isset($_REQUEST['total_amount']) ? floatval($_REQUEST['total_amount']):'';
        $real_amount = isset($_REQUEST['real_amount']) ? floatval($_REQUEST['real_amount']):'';

        $sql_good = "select * from `{$db_mymps}goods` AS g where g.goodsid='".$goodsid."'";
        $good = $db->getRow($sql_good);
        $sql_info = "select * from `{$db_mymps}information` AS i where i.id='".$infoid."'";
        $info = $db->getRow($sql_info);

        include mymps_tpl('hui_password');
    } else {
        //todo 所有post数值的验证
        if(1) {
            $sql_user = "select * from `{$db_mymps}member` AS m where m.userid='".$s_uid."'";
            $user = $db->getRow($sql_user);
            if (md5($userpwd) != $user['userpwd']) {
                errormsg('Wrong Password');
            }
            $goodsid = isset($_REQUEST['good']) ? intval($_REQUEST['good']):'';
            $infoid = isset($_REQUEST['id']) ? intval($_REQUEST['id']):'';

            $sql_good = "select * from `{$db_mymps}goods` AS g where g.goodsid='".$goodsid."'";
            $good = $db->getRow($sql_good);

            $total_amount = isset($_REQUEST['total_amount']) ? floatval($_REQUEST['total_amount']):'';
            $real_amount = isset($_REQUEST['real_amount']) ? floatval($_REQUEST['real_amount']):'';
            $sql_user = "select * from `{$db_mymps}member` AS m where m.userid='".$s_uid."'";
            $dateline = time();
            $useddate = time();
            $user = $db->getRow($sql_user);
            $ip = GetIP();
            $sql_insert_order = "insert into {$db_mymps}goods_order (goodsid, ordernum, oname, mobile, ip, dateline, type, userid, useddate, infoid, totalamount, realamount)
                                VALUES ('".$goodsid."', '0', '".$good['goodsname']."', '".$user['mobile']."', '".$ip."','".$dateline."','0','".$s_uid."','".$useddate."','".$infoid."','".$total_amount."','".$real_amount."')";
            $db -> query($sql_insert_order);
            $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own - '$real_amount' WHERE userid='".$s_uid."'");

            $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own + '$real_amount' WHERE userid='".$good['userid']."'");

            include mymps_tpl('hui_success');
        } else {
            errormsg('错误的id');
        }
    }

}

