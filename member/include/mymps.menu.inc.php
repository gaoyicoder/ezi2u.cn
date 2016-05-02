<?php
!defined('IN_MYMPS') && die('FORBIDDEN');

$member_menu = array();
$member_menu['user']['info']		= 'Posts';
//$member_menu['user']['pay']			= 'Coin';
if($if_corp == 1){
	$member_menu['corp']['avatar']	= 'Avatar';
}else{
	$member_menu['user']['avatar']	= 'Avatar';
}
$member_menu['user']['shoucang']	= 'Favourites';
$member_menu['user']['base']		= 'Contact';
$member_menu['user']['certify']		= 'Verification';
$member_menu['user']['pm']			= 'Messages';
if($if_corp == 1){
	$member_menu['corp']['levelup']	= 'Upgrade';
}else{
	$member_menu['user']['levelup']	= 'Upgrade';
}
$member_menu['user']['password']	= 'Password';

/*corp menu*/
if($mymps_global['cfg_if_corp'] == 1){
	$member_menu['corp']['shop']		= 'Information';
	$member_menu['corp']['comment']		= 'Comments';
	$member_menu['corp']['album']		= 'Albums';
	$member_menu['corp']['document']	= 'Display';
	/*plugin menu*/
	@include MYMPS_DATA.'/caches/pluginmenu_member.php';
	if(is_array($data)){
		foreach($data as $key => $val){
			$key != 'news' && $member_menu['corp'][$key]  = $val;
		}
	}
    $member_menu['corp']['orderrecords']	= '销售记录';
}

function mymps_member_purview($purview='')
{
	global $member_menu;
	$member_menu['corp']['banner']		= 'ShopBanner';
    foreach($member_menu as $k => $v){
		$mymps_member_purview .="<tr bgcolor=\"#f5fbff\"><td>".($k=='user'?'Menu for Individual Member':'Menu for Seller Member')."</td><td>";
		foreach($member_menu[$k] as $w => $y){
			$mymps_member_purview .= "<label for=\"purview_".$w."\" style=\"width:110px\"><input type=\"checkbox\" class=\"checkbox\" name=\"purview[]\" id=\"purview_".$w."\" value=\"purview_".$w."\"";
			$mymps_member_purview .= ((is_array($purview)&&in_array('purview_'.$w,$purview))||empty($purview))? "checked":"";
			$mymps_member_purview .= ">".$y."</label> ";
		}
		$mymps_member_purview .="</td></tr>";
	}
	return $mymps_member_purview;
}

function cur_purviews($purview = ''){
	global $member_menu;
    foreach($member_menu as $k => $v){
		$mymps_member_purview .="<tr><td align=\"center\" width=\"10%\">".($k=='user'?'Menu for Individual Member':'Menu for Seller Member')."</td><td>";
		foreach($member_menu[$k] as $w => $y){
			$mymps_member_purview .= "<label for=\"purview_".$w."\" style=\"width:110px\"><input type=\"checkbox\" class=\"checkbox\" name=\"purview[]\" id=\"purview_".$w."\" value=\"purview_".$w."\"";
			$mymps_member_purview .= ((is_array($purview)&&in_array('purview_'.$w,$purview))||empty($purview))? "checked":"";
			$mymps_member_purview .= ">".$y."</label> ";
		}
		$mymps_member_purview .="</td></tr>";
	}
	return $mymps_member_purview;
}
?>