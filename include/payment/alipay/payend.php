<?php

define('IN_MYMPS', true);

define('IN_ADMIN',true);

define('CURSCRIPT','payend');



require_once dirname(__FILE__).'/../../../include/global.php';

require_once MYMPS_DATA.'/config.php';

require_once MYMPS_DATA.'/config.db.php';

require_once MYMPS_INC.'/db.class.php';

require_once MYMPS_INC."/member.class.php";

if(!$member_log->chk_in()) write_msg("",$mymps_global['SiteUrl']."/".$mymps_global['cfg_member_logfile']."?url=".urlencode(GetUrl()));



$editor=1;



//������

/*if(!mgetcookie('checkpaysession')){

	write_msg('�Ƿ�������','olmsg');

}else{

	msetcookie("checkpaysession","",0);

}*/



//�����¼�

$pay_type = mgetcookie('pay_type');

/*

if($pay_type=='PayToMoney')//��ҳ�ֵ

{

	

}else{

	write_msg('�����Ե����Ӳ�����','olmsg');

}*/



$paytype='alipay';

$payr=$db->getRow("SELECT * FROM {$db_mymps}payapi WHERE paytype='$paytype'");

$bargainor_id=$payr['payuser'];//�̻���

$key=$payr['paykey'];//��Կ



$seller_email=$payr['payemail'];//����֧�����ʻ�



//----------------------------------------------������Ϣ



if(!empty($_POST)){

	foreach($_POST as $key => $data){

		$_GET[$key]=$data;

	}

}



$get_seller_email=rawurldecode($_GET['seller_email']);



//֧����֤

ksort($_GET);

reset($_GET);



$sign='';

foreach($_GET AS $key=>$val){

	if($key!='sign'&&$key!='sign_type'&&$key!='code'){

		$sign.="$key=$val&";

	}

}

/*

$sign=md5(substr($sign,0,-1).$paykey);



if($sign!=$_GET['sign']){

	write_msg('��֤MD5ǩ��ʧ��.','olmsg');

}

*/



if($_GET['trade_status']=="TRADE_FINISHED" || $_GET['trade_status']== "TRADE_SUCCESS" || $_GET['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS'|| $_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS'){

	include MYMPS_INC.'/pay.fun.php';

	

	$orderid=$_GET['trade_no'];	//֧������

	$ddno=$_GET['out_trade_no'];	//��վ�Ķ�����

	$money=$_GET['total_fee'];

	

	if($_GET['trade_status']=="TRADE_FINISHED"){

		$paybz='Payment completed';

	} elseif($_GET['trade_status']=="TRADE_SUCCESS"){

		$paybz='Successfully paid';

	} elseif($_GET['trade_status']=="WAIT_BUYER_CONFIRM_GOODS"){

		$paybz='Confirming payment';

	} elseif($_GET['trade_status']=="WAIT_SELLER_SEND_GOODS"){

		$paybz='Successfully recharged';

	}



	UpdatePayRecord($ddno,$paybz);//�޸�֧��״̬

	write_msg("You have successfully charged ".($money*$mymps_global['cfg_coin_fee'])." coins into your account",$mymps_global['SiteUrl']."/member/index.php?m=pay&ac=record");

	//PayApiPayMoney($money,$paybz,$orderid,$uid,$s_uid,$paytype);

}



is_object($db) && $db -> Close();

$mymps_global = NULL;

?>