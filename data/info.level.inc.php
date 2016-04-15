<?php
if (!defined('IN_MYMPS')){
    die('FORBIDDEN');
}

$information_level = array();
$information_level[0] = '<font color=red>Under Revision</font>';
$information_level[1] = '<font color=#006acd>Normal</font>';
$information_level[2] = '<font color=green>Recommended</font>';

function GetInfoLevel($level='',$formname='info_level')
{
	global $information_level;
	$mymps .= "<select name='$formname' id='$formname'>";
	$mymps .= "<option value = \"\">Please select information type</option>";
	foreach($information_level as $k=>$v)
	{
	 	if($k==$level) $mymps .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $mymps .= "<option value='$k'>$v</option>\r\n";
	}
	$mymps .= "</select>\r\n";
	return $mymps;
}

//upgrade time
$info_upgrade_time = array();
$info_upgrade_time[1] = '1 Day';
$info_upgrade_time[7] = '7 Days';
$info_upgrade_time[30] = '30 Days';
$info_upgrade_time[90] = '90 Days';
$info_upgrade_time[365] = '365 Days';

function GetUpgradeTime($time='',$formname='upgrade_time')
{
	global $info_upgrade_time;
	$mymps .= "<select name='$formname' id='$formname'>";
	foreach($info_upgrade_time as $k=>$v)
	{
	 	if($k==$time) $mymps .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $mymps .= "<option value='$k'>$v</option>\r\n";
	}
	$mymps .= "</select>\r\n";
	return $mymps;
}

//news level
$news_level = array();
$news_level[1] = '<font color=#006acd>Normal</font>';
$news_level[2] = '<font color=green>Recommended</font>';

function GetNewsLevel($level='',$formname='news_level')
{
	global $news_level;
	$mymps .= "<select name='$formname' id='$formname'>";
	$mymps .= "<option value = \"\">Please select news type</option>";
	foreach($news_level as $k=>$v){
	 	if($k==$level) $mymps .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $mymps .= "<option value='$k'>$v</option>\r\n";
	}
	$mymps .= "</select>\r\n";
	return $mymps;
}

?>
