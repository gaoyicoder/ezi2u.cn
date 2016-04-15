<?php
if(!defined('IN_MYMPS')) exit('FORBIDDEN');
/*管理后台发送短消息的默认惩罚，奖励提示内容*/
$info_do_type = array();

$info_do_type['Punishments'] = array(
	"Illegal Content",
	"Not Conforming to Rules",
	"Multiple Post of the Same Info",
	"Too Many Ill Reports"
);
							
$info_do_type['Rewards'] = array(
	"Valued Information",
	"Trustworthy Seller"
);
?>