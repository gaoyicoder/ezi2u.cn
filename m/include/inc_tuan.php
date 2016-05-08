<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/25/16
 * Time: 8:20 PM
 */
if($iflogin != 1){
    $returnurl = 'index.php?cityid='.$cityid;
    $returnurl = urlencode($returnurl);
    redirectmsg("Unfortunately, tourists are not allowed to buy vouchers, please log-in!","index.php?mod=login&returnurl=".$returnurl);
}

if(!submit_check(CURSCRIPT.'_submit')){

    $info_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']):'';
    $good_id = isset($_REQUEST['good']) ? intval($_REQUEST['good']):'';
    if($info_id && $good_id) {
        $sql_good = "select * from `{$db_mymps}goods` AS g where g.goodsid='".$good_id."'";
        $good = $db->getRow($sql_good);

        $sql_info = "select * from `{$db_mymps}information` AS i where i.id='".$info_id."'";
        $info = $db->getRow($sql_info);

    } else {
        errormsg('Wrong Information ID');
    }
    include mymps_tpl('tuan');
} else {
    $userpwd = isset($_REQUEST['userpwd']) ? mhtmlspecialchars($_REQUEST['userpwd']):'';
    if(!$userpwd) {
        $goodsid = isset($_REQUEST['good']) ? intval($_REQUEST['good']):'';
        $infoid = isset($_REQUEST['id']) ? intval($_REQUEST['id']):'';
        $ordernum = isset($_REQUEST['ordernum']) ? intval($_REQUEST['ordernum']):'';

        $sql_good = "select * from `{$db_mymps}goods` AS g where g.goodsid='".$goodsid."'";
        $good = $db->getRow($sql_good);
        $sql_info = "select * from `{$db_mymps}information` AS i where i.id='".$infoid."'";
        $info = $db->getRow($sql_info);

        include mymps_tpl('tuan_password');
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
            $ordernum = isset($_REQUEST['ordernum']) ? intval($_REQUEST['ordernum']):'';
            $sql_good = "select * from `{$db_mymps}goods` AS g where g.goodsid='".$goodsid."'";
            $good = $db->getRow($sql_good);

            $total_amount = $ordernum*$good['oldprice'];
            $real_amount = $ordernum*$good['nowprice'];

            $dateline = time();
            $useddate = time();
            $ip = GetIP();
            $msg = time();
            $sql_insert_order = "insert into {$db_mymps}goods_order (goodsid, ordernum, oname, mobile, ip, dateline, type, userid, useddate, infoid, totalamount, realamount, msg)
                                VALUES ('".$goodsid."', '".$ordernum."', '".$good['goodsname']."', '".$user['mobile']."', '".$ip."','".$dateline."','1','".$s_uid."','','".$infoid."','".$total_amount."','".$real_amount."','".$msg."')";
            $db -> query($sql_insert_order);

            $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own - '$real_amount' WHERE userid='".$s_uid."'");

            $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own + '$real_amount' WHERE userid='".$good['userid']."'");

            header('Location: '.'index.php?mod=tuan_list&msg=Payment Successful!');

//            include mymps_tpl('tuan_success');

        } else {
            errormsg('错误的id');
        }
    }

}