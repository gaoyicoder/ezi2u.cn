<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
//安全提示问题，这两句不要修改
$safequestions = array();
$safequestions[0] = '没安全提示问题';

//下面的设置可以根据你自己的需要修改，一般情况下最好保持默认
$safequestions[1] = 'What is your favourite Motto?';
$safequestions[2] = 'What is your hometown called?';
$safequestions[3] = 'What is the name of the primary school you went to?';
$safequestions[4] = 'What is the name of your father?';
$safequestions[5] = 'What is the name of your mother?';
$safequestions[6] = 'Who is your favourite idol?';
$safequestions[7] = 'What is your favourite song?';

//以下不要修改
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