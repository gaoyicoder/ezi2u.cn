<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
/*��Ϣ�����ĳ���ʱ��������ѡ��*/
//ע�ⵥλΪ�죬һ����Ϊ7��һ������Ϊ30���Դ�����
//һ������£��뱣����Ĭ�ϣ����޸�
$info_lasttime = array();

$info_lasttime[0] = 'Valid in the long term';//������Ϊ��Ϣ�������޸�ʱ�Ƿ���������Ч������Ը����Լ������ɾ���������벻Ҫ�޸�

$info_lasttime[7] 	= 'Valid for 1 week';
$info_lasttime[30] 	= 'Valid for 1 month';
$info_lasttime[60] 	= 'Valid for 2 months';
$info_lasttime[365] = 'Valid for 1 year';


//���²�Ҫ�޸�
function GetInfoLastTime($lasttime='',$formname='endtime'){
	global $info_lasttime;
	$info_lasttime_form = "<select name='$formname' id='$formname' class='input' require=\"true\" datatype=\"limit\" msg=\"Please set a valid period for the information\">";
	$info_lasttime_form .= "<option value=''>Please set a valid period</option>";
	foreach($info_lasttime as $k=>$v){
	 	if($k==$lasttime&&$k!='') $info_lasttime_form .= "<option value='$k' selected>$v</option>\r\n";
	 	else $info_lasttime_form .= "<option value='$k'>$v</option>\r\n";
	}
	$info_lasttime_form .= "</select>\r\n";
	return $info_lasttime_form;
}

?>