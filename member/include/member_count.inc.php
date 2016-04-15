<?php
$element = array(

	'Posts'=>array(
			'style'=>'info',
			'url'=>'info.php?part=all',
			'table'=>'information',
			'type'=>''
			),
	
	'Comments'=>array(
			'style'=>'com',
			'url'=>'comment.php',
			'table'=>'member_comment',
			'type'=>'',
			'where'=>' AND commentlevel = 1'
			),
			
	'Messages'=>array(
			'style'=>'pm',
			'url'=>'pm.php',
			'table'=>'member_pm',
			'type'=>'',
			'where'=>' AND if_read = 0'
			),
			
	'Accounts'=>array(
			'style'=>'incomes',
			'url'=>'bank.php',
			'table'=>'member',
			'type'=>'money'
			)
			
);

if($if_corp != 1){
	unset($element['Remarks']);
	unset($element['Comments']);
};

function member_get_count()
{
	global $element,$s_uid,$money_own,$pm_total;
	foreach ($element as $k =>$value){
		if(empty($value[type])){
			$and = $value[where] ? $value[where] : ''; 
			if($value[style] == 'pm'){
				$mymps_member_count .= "<li class=\"".$value[style]."\"><a href=\"".$value[url]."\">".$k."(".$pm_total.")</a></li>";
			} else {
				$mymps_member_count .= "<li class=\"".$value[style]."\"><a href=\"".$value[url]."\">".$k."(".mymps_count($value[table],"WHERE userid = '$s_uid'$and").")</a></li>";
			}
		} else {
			$mymps_member_count .= "<li class=\"".$value[style]."\"><a href=\"".$value[url]."\">".$k."(".$money_own.")</a></li>";
		}
	}
	return $mymps_member_count;
}
?>