<?php

define('IN_MYMPS', true);

define('IN_ADMIN',true);

define('CURSCRIPT','payend');



require_once dirname(__FILE__).'/../../../include/global.php';

require_once MYMPS_DATA.'/config.php';

require_once MYMPS_DATA.'/config.db.php';

require_once MYMPS_INC.'/db.class.php';

require_once MYMPS_INC."/member.class.php";

if(!$member_log->chk_in()) write_msg("","../".$mymps_global['cfg_member_logfile']."?url=".urlencode(GetUrl()));



$editor=1;



//������

/*

if(!mgetcookie('checkpaysession')){

	write_msg('�Ƿ�������','olmsg');

}else{

	msetcookie("checkpaysession","",0);

}

*/



//�����¼�

/*

$pay_type = mgetcookie('pay_type');

if($pay_type=='PayToMoney')//��ҳ�ֵ

{

	

}else{

	write_msg('�����Ե����Ӳ�����','olmsg');

}*/



$paytype='tenpay';

$payr=$db->getRow("SELECT * FROM {$db_mymps}payapi WHERE paytype='$paytype'");

$bargainor_id=$payr['payuser'];//�̻���



$key=$payr['paykey'];//��Կ



//----------------------------------------------������Ϣ

import_request_variables("gpc", "frm_");

$strCmdno			= $frm_cmdno;

$strPayResult		= $frm_pay_result;

$strPayInfo			= $frm_pay_info;

$strBillDate		= $frm_date;

$strBargainorId		= $frm_bargainor_id;

$strTransactionId	= $frm_transaction_id;

$strSpBillno		= $frm_sp_billno;

$strTotalFee		= $frm_total_fee;

$strFeeType			= $frm_fee_type;

$strAttach			= $frm_attach;

$strMd5Sign			= $frm_sign;

$strCreateIp		= $frm_spbill_create_ip;



//֧����֤

$checkkey="cmdno=".$strCmdno."&pay_result=".$strPayResult."&date=".$strBillDate."&transaction_id=".$strTransactionId."&sp_billno=".$strSpBillno."&total_fee=".$strTotalFee."&fee_type=".$strFeeType."&attach=".$strAttach."&spbill_create_ip=".$strCreateIp."&key=".$key;

$checkSign=strtoupper(md5($checkkey));

  

/*if($checkSign!=$strMd5Sign){

	write_msg('��֤MD5ǩ��ʧ��.','olmsg');

}*/



if($bargainor_id!=$strBargainorId){

	write_msg('Wrong Merchant Code.','olmsg');

}



if($strPayResult=="0"){



	include MYMPS_INC.'/pay.fun.php';

	

	$orderid=$strSpBillno;	//֧������

	$ddno=$strAttach;	//��վ�Ķ�����

	$money=$strTotalFee/100;

	

	$paybz='Payment completed';

	UpdatePayRecord($ddno,$paybz);//�޸�֧��״̬

	write_msg("You have successfully charged ".($money*$mymps_global['cfg_coin_fee'])." coins into your account",$mymps_global['SiteUrl']."/member/index.php?m=pay&ac=record");



} else {

	write_msg('Payment failed.','olmsg');

}



is_object($db) && $db -> Close();

$mymps_global = NULL;

?>