<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
//��ȫ��ʾ���⣬�����䲻Ҫ�޸�
$safequestions = array();
$safequestions[0] = 'û��ȫ��ʾ����';

//��������ÿ��Ը������Լ�����Ҫ�޸ģ�һ���������ñ���Ĭ��
$safequestions[1] = 'What is your favourite Motto?';
$safequestions[2] = 'What is your hometown called?';
$safequestions[3] = 'What is the name of the primary school you went to?';
$safequestions[4] = 'What is the name of your father?';
$safequestions[5] = 'What is the name of your mother?';
$safequestions[6] = 'Who is your favourite idol?';
$safequestions[7] = 'What is your favourite song?';

//���²�Ҫ�޸�
function GetSafequestion($selid=0,$formname='safequestion')
{
	global $safequestions;
	$safequestions_form = "<select name='$formname' id='$formname'>";
	foreach($safequestions as $k=>$v)
	{
	 	if($k==$selid&&$k!='0') $safequestions_form .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $safequestions_form .= "<option value='$k'>$v</option>\r\n";
	}
	$safequestions_form .= "</select>\r\n";
	return $safequestions_form;
}

?>