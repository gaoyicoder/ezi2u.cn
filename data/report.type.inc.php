<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
$report_type_arr = array();
$report_type_arr[1] = 'Illegal Information';
$report_type_arr[2] = 'Wrong Category';
$report_type_arr[3] = 'False Information';

$report_type_arr[4] = 'Other';

function get_report_type()
{
	global $report_type_arr;
	$mymps .="<select name='report_type'>";
	foreach($report_type_arr as $k => $value)
	{
		$mymps .= "<option value=\"".$k."\">".$value."</option>";
	}
	$mymps .="</select>";
	return $mymps;
}
?>