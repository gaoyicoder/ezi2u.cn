<?php

if(!defined('IN_MYMPS')){

	exit;

}

$v_mid=$payr['payuser'];//�̻���

$key=$payr['paykey'];//��Կ

$v_url=$PayReturnUrlQz."/include/payment/chinabank/payend.php";//���ص�ַ

$remark2="[url:=".$PayReturnUrlQz."/include/payment/chinabank/notify.php]";

$v_moneytype="CNY";//����

$v_amount=$money;

$v_oid=date("Ymd")."-".$v_mid."-".date("His");

$ddno=$ddno?$ddno:$timestamp;	//������

msetcookie("checkpaysession",$ddno,0);

$text=$v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key;

$v_md5info=strtoupper(md5($text));

$remark1=$ddno;//��ע�ֶ�1

ToPayMoney($v_amount,$ddno,$uid,$s_uid,'chinabank');//д��ȴ�֧����¼

?>

<html>

<title>Pay Online</title>

<meta http-equiv="Cache-Control" content="no-cache"/>

<body>

<form method="post" name="dopaypost" id="dopaypost" action="https://pay3.chinabank.com.cn/PayGate">

	<input type="hidden" name="v_mid"    value="<?php echo $v_mid;?>">

	<input type="hidden" name="v_oid"     value="<?php echo $v_oid;?>">

	<input type="hidden" name="v_amount" value="<?php echo $v_amount;?>">

	<input type="hidden" name="v_moneytype"  value="<?php echo $v_moneytype;?>">

	<input type="hidden" name="v_url"  value="<?php echo $v_url ;?>">

	<input type="hidden" name="v_md5info"   value="<?php echo $v_md5info;?>">

	<input type="hidden" name="remark1"   value="<?php echo $remark1;?>">

	<input type="hidden" name="remark2"   value="<?php echo $remark2;?>">

	<input type="submit" style="font-size: 9pt" value="Pay Online" name="v_action">

</form>

<script>

document.getElementById('dopaypost').submit();

</script>

</body>

</html>