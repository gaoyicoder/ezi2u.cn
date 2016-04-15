<?php
/*站务siteabout*/
$admin_menu[siteabout][name]="Management";
$admin_menu[siteabout][style]="Home";
$admin_menu[siteabout][group][element]['Focus Picture']['Focus List']='focus.php';
$admin_menu[siteabout][group][element]['Focus Picture']['Upload a Picture']='focus.php?part=add';
$admin_menu[siteabout][group][element]['Announcements']['Ann list']='announce.php';
$admin_menu[siteabout][group][element]['Announcements']['Post a Ann']='announce.php?part=add';
$admin_menu[siteabout][group][element]['Related Sites']['Related Sites']='friendlink.php';
$admin_menu[siteabout][group][element]['Related Sites']['Add a Site']='friendlink.php?part=add';
$admin_menu[siteabout][group][element]['Other']['Navigation']='navurl.php';
$admin_menu[siteabout][group][element]['Other']['Useful Tools']='lifebox.php';
$admin_menu[siteabout][group][element]['Other']['Telephone']='telephone.php';

/*信息info*/
$admin_menu[info][name]="Information";
$admin_menu[info][style]="";
$admin_menu[info][group][element]['Information']['Categories']='information.php';
$admin_menu[info][group][element]['Information']['Batch Manage']='infomanage.php';
//$admin_menu[info][group][element]['Information']['Reviews']='comment.php';
$admin_menu[info][group][element]['Information']['Report']='information.php?part=report';

/*会员member*/
$admin_menu[member][name]="Member";
$admin_menu[member][style]="";
$admin_menu[member][group][element]['Member']['Individual']='member.php?if_corp=0';
$admin_menu[member][group][element]['Member']['Seller']='member.php?if_corp=1';
$admin_menu[member][group][element]['Member']['Add a Member']='member.php?part=add';
$admin_menu[member][group][element]['Control Panel']['Authentication']='certification.php?typeid=1';
$admin_menu[member][group][element]['Control Panel']['In-site Messages']='pm.php';

/*系统 sitesys*/
$admin_menu[sitesys][name]="System";
$admin_menu[sitesys][style]="";
$admin_menu[sitesys][group][element]['Administrator']['User List']='admin.php?do=user';

//插件 plugin
$admin_menu[plugin][name]="Plugins";
$admin_menu[plugin][style]="";
$admin_menu[plugin][group][element]['Plugin']=array('Installed Plugins'=>'plugin.php');
@include dirname(__FILE__).'/../../data/caches/pluginmenu_admin.php';
if(is_array($data)){
	foreach($data as $key => $val){
		$admin_menu[plugin][group][element][$key] = $val;
	}
	unset($data);

}

//扩 展extend 
$admin_menu[extend][name]="Extensions";
$admin_menu[extend][style]="";
$admin_menu[extend][group][element]['Payment']['Record']='payrecord.php';
$admin_menu[extend][group][element]['Extensions']['Advertisement']='adv.php';
?>