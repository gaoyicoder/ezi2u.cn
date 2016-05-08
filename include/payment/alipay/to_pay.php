<?php

if(!defined('IN_MYMPS')){

	exit;

}



//------------------ ����ʼ ------------------



$agent="";



$service= $payr['buytype'] == 2 ? "trade_create_by_buyer" : "create_direct_pay_by_user";



//�̻���

$partner=$payr['payuser'];



//��Կ

$paykey=$payr['paykey'];



//����֧�����ʻ�

$seller_email=$payr['payemail'];



//�ַ�����ʽ

$_input_charset = $charset == 'utf-8' ? "UTF-8" : "GBK";



//���ܷ�ʽ

$sign_type="MD5";



//���ص�ַ

$return_url=$PayReturnUrlQz."/include/payment/alipay/payend.php";

$notify_url=$PayReturnUrlQz."/include/payment/alipay/notify.php";



//֧����ʽ

$payment_type=1;



//Ĭ��֧����ʽ

$paymethod="";



//��������

$defaultbank="";



//------------------ ������� ------------------



//֧�����

$price=$money;

$quantity=1;



$out_trade_no=$ddno?$ddno:$timestamp;	//������

msetcookie("checkpaysession",$out_trade_no,0);	//���ö�����



//��Ʒ��Ϣ

$subject=$productname;	//��Ʒ���

$body=$out_trade_no;	//��Ʒ����



//md5

if($payr['buytype'] == 2){

	$parameter=array(

	'service'           => $service,

	'partner'           => $partner,

	'seller_email'      => $seller_email,

	'_input_charset'    => $_input_charset,

	'return_url'        => $return_url,

	'notify_url'        => $notify_url,

	'subject'           => $subject,

	'body'				=> $body,

	'out_trade_no'      => $out_trade_no,

	'price'             => $price,

	'quantity'          => $quantity,

	'payment_type'      => $payment_type,

	'paymethod'			=> $paymethod,

	'defaultbank'		=> $defaultbank,

	'logistics_fee'		=> '0.00',

	'logistics_payment' => 'SELLER_PAY',

	'logistics_type'	=> 'EXPRESS'

	);

 }else{

	$parameter=array(

	'service'           => $service,

	'partner'           => $partner,

	'seller_email'      => $seller_email,

	'_input_charset'    => $_input_charset,

	'return_url'        => $return_url,

	'notify_url'        => $notify_url,

	'subject'           => $subject,

	'body'				=> $body,

	'out_trade_no'      => $out_trade_no,

	'price'             => $price,

	'quantity'          => $quantity,

	'payment_type'      => $payment_type,

	'paymethod'			=> $paymethod,

	'defaultbank'		=> $defaultbank

	);

}

ksort($parameter);

reset($parameter);



$param='';

$sign='';



foreach($parameter AS $key => $val){

	if(strlen($val)==0){

		continue;

	}

	$param.="$key=".urlencode($val)."&";

	$sign.="$key=$val&";

}



$param=substr($param,0,-1);

$sign=md5(substr($sign,0,-1).$paykey);

$gotopayurl='https://www.alipay.com/cooperate/gateway.do?'.$param.'&sign='.$sign.'&sign_type='.$sign_type;

ToPayMoney($money,$out_trade_no,$uid,$s_uid,'alipay');//д��ȴ�֧����¼

?>

<html>

<title>Pay Through ?</title>

<meta http-equiv="Cache-Control" content="no-cache"/>

<body>

<script>

self.location.href='<?=$gotopayurl?>';

</script>

<input type="button" style="font-size: 9pt" value="֧����֧��" name="v_action" onClick="self.location.href='<?=$gotopayurl?>';">

</body>

</html>