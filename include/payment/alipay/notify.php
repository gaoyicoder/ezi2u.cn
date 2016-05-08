<?php

define('IN_MYMPS', true);

define('IN_ADMIN',true);

define('CURSCRIPT','payend');



require_once dirname(__FILE__).'/../../../include/global.php';

require_once MYMPS_DATA.'/config.php';

require_once MYMPS_DATA.'/config.db.php';

require_once MYMPS_INC.'/db.class.php';



$paytype='alipay';

$payr=$db->getRow("SELECT * FROM {$db_mymps}payapi WHERE paytype='$paytype'");

$bargainor_id=$payr['payuser'];//�̻���

$key=$payr['paykey'];//��Կ

$seller_email=$payr['payemail'];//����֧�����ʻ�



$ddno = $_POST['out_trade_no'];//��վ�Ķ�����

$orderid = $_POST['trade_no'];//֧������

$trade_status = $_POST['trade_status'];

$money=$_POST['total_fee'];



if($trade_status=="TRADE_FINISHED" || $trade_status== "TRADE_SUCCESS" || $trade_status == 'WAIT_BUYER_CONFIRM_GOODS'|| $trade_status == 'WAIT_SELLER_SEND_GOODS'){

	include MYMPS_INC.'/pay.fun.php';

	if($trade_status=="TRADE_FINISHED"){

		$paybz='Payment completed';

	} elseif($trade_status=="TRADE_SUCCESS"){

		$paybz='Successfully paid';

	} elseif($trade_status=="WAIT_BUYER_CONFIRM_GOODS"){

		$paybz='Confirming payment';

	}elseif($trade_status=="WAIT_SELLER_SEND_GOODS"){

		$paybz='Successfully recharged';

	}

	UpdatePayRecord($ddno,$paybz);

	echo "success";

} else {

	echo "fail";

}



?>