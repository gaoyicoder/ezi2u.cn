<?php
if (!defined('IN_MYMPS')){
    die('FORBIDDEN');
}

$ele = array(
	'information'=>'Information',
	'member'=>'Member',
	'certify'=>'Certification ',
	'siteabout'=>'Site Management',
	'plugin'=>'Plugins'
);

$element[information] = array(
	'Information'=>array(
			'table'=>'information',
			'url'=>'information.php'
			),
	'Review'=>array(
			'table'=>'comment',
			'where'=>'WHERE type = \'information\'',
			'url'=>'comment.php?part=information'
			),
	'Report'=>array(
			'table'=>'info_report',
			'url'=>'information.php?part=report'
			)
		);
		
$element[member] = array(
	'Personal'=>array(
			'table'=>'member',
			'where'=>'WHERE if_corp = \'0\'',
			'url'=>'member.php?if_corp=0'
			),
	'Seller'=>array(
			'table'=>'member',
			'where'=>'WHERE if_corp = \'1\'',
			'url'=>'member.php?if_corp=1'
			),
	'Recharge Record'=>array(
			'table'=>'payrecord',
			'url'=>'payrecord.php'
			)
		);

$element[certify] = array(
	'Licence'=>array(
			'table'=>'certification',
			'where'=>'WHERE typeid = \'1\'',
			'url'=>'certification.php?typeid=1'
			),
	'ID'=>array(
			'table'=>'certification',
			'where'=>'WHERE typeid = \'2\'',
			'url'=>'certification.php?typeid=2'
			)
		);
		
$element[siteabout] = array(
	'Announcements'=>array(
			'table'=>'announce',
			'url'=>'announce.php'
			),
	'Help'=>array(
			'table'=>'faq',
			'url'=>'faq.php'
			),
	'Links'=>array(
			'table'=>'flink',
			'url'=>'friendlink.php'
			)
		);
		
$element[plugin] = array(
	'News'=>array(
			'table'=>'news',
			'url'=>'news.php'
			),
	'Coupons'=>array(
			'table'=>'coupon',
			'url'=>'coupon_list.php'
			),
	'Group Purchase'=>array(
			'table'=>'group',
			'url'=>'group_list.php'
			),
	'Sign-up'=>array(
			'table'=>'group_signin',
			'url'=>'group_signin.php'
			),
	'Goods'=>array(
			'table'=>'goods',
			'url'=>'goods_list.php'
			),
	'Order'=>array(
			'table'=>'goods_order',
			'url'=>'goods_order.php'
			)
			
		);
if($mymps_global['cfg_if_corp'] != 1){
	unset($element[plugin]['Coupons'],$element[plugin]['Group Purchase'],$element[plugin]['Goods'],$element[plugin]['Sign-up'],$element[plugin]['Order'],$element[member]['Seller'],$element[certify]['Licence']);
}
?>