<?php
//金币充值处理
function ToPayMoney($money,$orderid,$uid,$userid,$mymps_paytype){
	global $db,$db_mymps,$mymps_global,$timestamp;
	$orderid=var_action($orderid);
	if($money){
		if($mymps_global['cfg_coin_fee']) {
			$money = $money * $mymps_global['cfg_coin_fee'];
		}
		$payip	=	GetIP();
		$db -> query("INSERT INTO {$db_mymps}payrecord(id,uid,userid,orderid,money,posttime,paybz,type,payip) values('','$uid','$userid','$orderid','$money','$timestamp','Awaiting payment','$mymps_paytype','$payip');");
	}
}

function UpdatePayRecord($orderid,$paybz){
	global $db,$db_mymps,$mymps_global,$timestamp;
	$orderid=var_action($orderid);
	$r = $db -> getRow("SELECT money,userid,ifadd FROM `{$db_mymps}payrecord` WHERE orderid = '$orderid'");
	$money = $r['money'];
	$userid = $r['userid'];
	$ifadd = $r['ifadd'];
	
	if($money && $userid && $ifadd != 1){
		$db->query("UPDATE `{$db_mymps}member` SET money_own = money_own + ".$money." WHERE userid = '$userid'");
	}
	$db -> query("UPDATE `{$db_mymps}payrecord` SET paybz = '$paybz',ifadd = 1 WHERE orderid = '$orderid';");
}

function PayApiPayMoney($money,$paybz,$orderid,$uid,$userid,$mymps_paytype){
	global $db,$db_mymps,$mymps_global,$timestamp;
	//验证是否重复提交
	$orderid=var_action($orderid);
	$num=$db->getOne("SELECT count(id) FROM {$db_mymps}payrecord WHERE orderid = '$orderid'");
	if($num>0){
		write_msg("You have changed ".$money." Please do not refresh the page repeatedly.",$mymps_global[SiteUrl]."/member/index.php?m=pay&ac=record");
	}else{
		//$money=(float)$money;
		if($money){
			if($mymps_global['cfg_coin_fee']) {
				$money = $money * $mymps_global['cfg_coin_fee'];
			}
			$sql 	=	$db->query("UPDATE `{$db_mymps}member` SET money_own = money_own + ".$money." WHERE userid = '$userid'");
			$payip	=	GetIP();
			$db -> query("INSERT INTO {$db_mymps}payrecord(id,uid,userid,orderid,money,ifadd,posttime,paybz,type,payip) values('','$uid','$userid','$orderid','$money',1,'$timestamp','$paybz','$mymps_paytype','$payip');");
			write_msg("You have successfully charged ".$money." coins into your account",$mymps_global[SiteUrl]."/member/index.php?m=pay&ac=record");
		} else {
			write_msg("Recharging failed. Please contact the administrator for help.",$mymps_global[SiteUrl]."/member/index.php?m=pay&ac=record");
		}
	}
}

//参数处理
function var_action($val){
	if($val!=addslashes($val)){
		exit;
	}
	$val=str_replace(" ","",$val);
	$val=str_replace("%20","",$val);
	$val=str_replace("%27","",$val);
	$val=str_replace("*","",$val);
	$val=str_replace("'","",$val);
	$val=str_replace("\"","",$val);
	$val=str_replace("/","",$val);
	$val=str_replace(";","",$val);
	$val=RepPostStr($val);
	$val=addslashes($val);
	return $val;
}

//处理提交字符
function RepPostStr($val){
	$val=htmlspecialchars($val,ENT_QUOTES);
	return $val;
}
?>
