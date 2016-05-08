<?php

if (!defined('IN_MYMPS')){

    die('FORBIDDEN');

}



$ele = array(

	'information'=>'Information',

	'member'=>'Member',

	'siteabout'=>'Site Management',

	'plugin'=>'Plugins'

);



$element[information] = array(

	'Information'=>array(

			'table'=>'information',

			'url'=>'information.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			)

		);

		

$element[member] = array(

	'Personal'=>array(

			'table'=>'member',

			'where'=> 'WHERE if_corp = \'0\'',

			'url'=>'member.php?if_corp=0'

			),

	'Seller'=>array(

			'table'=>'member',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid' AND if_corp = '1'" : 'WHERE if_corp = \'1\'',

			'url'=>'member.php?if_corp=1'

			)

		);

		

$element[siteabout] = array(

	'Announcements'=>array(

			'table'=>'announce',

			'url'=>'announce.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			),

	'Links'=>array(

			'table'=>'flink',

			'url'=>'friendlink.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			)

		);

		

$element[plugin] = array(

	'News'=>array(

			'table'=>'news',

			'url'=>'news.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			),

	'Coupons'=>array(

			'table'=>'coupon',

			'url'=>'coupon_list.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			),

	'Group Purchase'=>array(

			'table'=>'group',

			'url'=>'group_list.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			),

	'Goods'=>array(

			'table'=>'goods',

			'url'=>'goods_list.php',

			'where'=>$admin_cityid ? "WHERE cityid = '$admin_cityid'" : ''

			)

			

		);

?>