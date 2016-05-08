<?php

if(!defined('IN_MYMPS')){

	exit();

}



//------------------ ����ʼ ------------------



//�̻���

$bargainor_id=$payr['payuser'];



//��Կ

$key=$payr['paykey'];



//���ص�ַ

$return_url=$PayReturnUrlQz."/include/payment/tenpay/payend.php";



//֧������,1Ϊ�����

$fee_type=1;



//��������

$bank_type="0";



//------------------ ������� ------------------



//֧�����

$total_fee=$money*100;



//�ύ�����



$strCmdNo="1";	//�Ƹ�֧ͨ��Ϊ"1" (��ǰֻ֧�� cmdno=1)

$strBillDate=date('Ymd');	//�������� (yyyymmdd)

$desc=$productname;	//��Ʒ���

$strBuyerId="";	//QQ����

$strSpBillNo=$ddno?$ddno:$timestamp;//������

msetcookie("checkpaysession",$strSpBillNo,0);	//���ö�����

$strTransactionId=$bargainor_id.$strBillDate.$strSpBillNo;	//���׶�����

$attach=$strSpBillNo;

$spbill_create_ip = $_SERVER["REMOTE_ADDR"];



//md5

$strSignText="cmdno=".$strCmdNo."&date=".$strBillDate."&bargainor_id=".$bargainor_id."&transaction_id=".$strTransactionId."&sp_billno=".$strSpBillNo."&total_fee=".$total_fee."&fee_type=".$fee_type."&return_url=".$return_url."&attach=".$attach."&spbill_create_ip=".$spbill_create_ip."&key=".$key;

$strSign=strtoupper(md5($strSignText));

ToPayMoney($money,$attach,$uid,$s_uid,'tenpay');//д��ȴ�֧����¼

?>

<html>

<title>Pay by ?</title>

<meta http-equiv="Cache-Control" content="no-cache"/>

<body>

<form action="https://www.tenpay.com/cgi-bin/v1.0/pay_gate.cgi" name="dopaypost" id="dopaypost">

<input type=hidden name="cmdno" value="<?echo $strCmdNo; ?>">

<input type=hidden name="date" value="<?echo $strBillDate; ?>">

<input type=hidden name="bank_type" value="<?echo $bank_type; ?>">

<input type=hidden name="desc" value="<?echo $desc; ?>">

<input type=hidden name="purchaser_id" value="<?echo $strBuyerId; ?>">

<input type=hidden name="bargainor_id" value="<?echo $bargainor_id; ?>">

<input type=hidden name="transaction_id" value="<?echo $strTransactionId; ?>">

<input type=hidden name="sp_billno" value="<?echo $strSpBillNo; ?>">

<input type=hidden name="total_fee" value="<?echo $total_fee; ?>">

<input type=hidden name="fee_type" value="<?echo $fee_type; ?>">

<input type=hidden name="return_url" value="<?echo $return_url; ?>">

<input type=hidden name="attach" value="<?echo $attach; ?>">

<input type=hidden name="sign" value="<?echo $strSign; ?>">

<input type=hidden name="spbill_create_ip" value="<?echo $spbill_create_ip; ?>">

<input type="submit" name="submit2" value="�Ƹ�֧ͨ��">

</form>

<script>

document.getElementById('dopaypost').submit();

</script>

</body>

</html>