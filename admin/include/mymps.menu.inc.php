<?php
/*站务siteabout*/
$admin_menu[siteabout][name]="Management";
$admin_menu[siteabout][style]="Home";
$admin_menu[siteabout][group][element]['Focus Picture']['Focus List']='focus.php';
$admin_menu[siteabout][group][element]['Focus Picture']['Upload a Picture']='focus.php?part=add';
$admin_menu[siteabout][group][element]['About Us']['Column Settings']='site_about.php?part=list';
$admin_menu[siteabout][group][element]['Announcements']['Ann list']='announce.php';
$admin_menu[siteabout][group][element]['Announcements']['Post a Ann']='announce.php?part=add';
$admin_menu[siteabout][group][element]['Help Centre']['Problems']='faq.php';
$admin_menu[siteabout][group][element]['Help Centre']['Ask for Help']='faq.php?part=add';
$admin_menu[siteabout][group][element]['Related Sites']['Related Sites']='friendlink.php';
$admin_menu[siteabout][group][element]['Related Sites']['Add a Site']='friendlink.php?part=add';
$admin_menu[siteabout][group][element]['Other']['Navigation']='navurl.php';
$admin_menu[siteabout][group][element]['Other']['Useful Tools']='lifebox.php';
$admin_menu[siteabout][group][element]['Other']['Telephone']='telephone.php';

/*信息info*/
$admin_menu[info][name]="Information";
$admin_menu[info][style]="";
$admin_menu[info][group][element]['Information']['Categories']='information.php';
$admin_menu[info][group][element]['Information']['Delete Repeated']='test_same.php';
$admin_menu[info][group][element]['Information']['Batch Manage']='infomanage.php';
$admin_menu[info][group][element]['Information']['Reviews']='comment.php';
$admin_menu[info][group][element]['Information']['Report']='information.php?part=report';
$admin_menu[info][group][element]['Module']['Module Manage']='info_type.php?part=mod';
$admin_menu[info][group][element]['Module']['Field Manage']='info_type.php';

/*会员member*/
$admin_menu[member][name]="Member";
$admin_menu[member][style]="";
$admin_menu[member][group][element]['Member']['Individual']='member.php?if_corp=0';
$admin_menu[member][group][element]['Member']['Seller']='member.php?if_corp=1';
$admin_menu[member][group][element]['Member']['Add a Member']='member.php?part=add';
$admin_menu[member][group][element]['Control Panel']['Group Category']='member.php?do=group';
$admin_menu[member][group][element]['Control Panel']['Authentication']='certification.php?typeid=1';
$admin_menu[member][group][element]['Control Panel']['Member Files']='document.php?do=document';
$admin_menu[member][group][element]['Control Panel']['In-site Messages']='pm.php';
$admin_menu[member][group][element]['Control Panel']['Template Review']='member_tpl.php';
$admin_menu[member][group][element]['Member Log']['Log-in Record']='record.php?do=member&part=login';
$admin_menu[member][group][element]['Member Log']['Payment Record']='payrecord.php';
$admin_menu[member][group][element]['Member Log']['Purchase Record']='record.php?do=member&part=money&type=use';

/*行业 category*/
$admin_menu[category][name]="Category";
$admin_menu[category][style]="";
$admin_menu[category][group][element]['Category']['Category Info']='category.php';
$admin_menu[category][group][element]['Category']['Add a Category']='category.php?part=add';
$admin_menu[category][group][element]['Sub-sites']['Built State-site']='area.php';
$admin_menu[category][group][element]['Sub-sites']['Add State-site']='area.php?part=area_city_add';
$admin_menu[category][group][element]['Sub-sites']['Add District']='area.php?part=area_add';
$admin_menu[category][group][element]['Sub-sites']['Add Section']='area.php?part=area_street_add';
$admin_menu[category][group][element]['Sellers']['Sellers']='corp.php';
$admin_menu[category][group][element]['Sellers']['Add a Category']='corp.php?part=add';

/*系统 sitesys*/
$admin_menu[sitesys][name]="System";
$admin_menu[sitesys][style]="";
$admin_menu[sitesys][group][element]['Administrator']['User List']='admin.php?do=user';
$admin_menu[sitesys][group][element]['Administrator']['User Group']='admin.php?do=group';
$admin_menu[sitesys][group][element]['Administrator']['Admin Record']='record.php?do=admin&part=login';
$admin_menu[sitesys][group][element]['Database']['Backup']='database.php?part=backup';
$admin_menu[sitesys][group][element]['Database']['Restore']='database.php?part=restore';
$admin_menu[sitesys][group][element]['Database']['Maintenance']='database.php?part=optimize';
$admin_menu[sitesys][group][element]['Configurations']['System']='config.php';
$admin_menu[sitesys][group][element]['Configurations']['State-site']='city.php';
$admin_menu[sitesys][group][element]['Configurations']['Template']='template.php';
$admin_menu[sitesys][group][element]['Configurations']['SEO Pseudo']='seoset.php';
$admin_menu[sitesys][group][element]['Configurations']['Verify Filtered']='config.php?part=imgcode';
$admin_menu[sitesys][group][element]['Configurations']['Credit Level']='score.php';
$admin_menu[sitesys][group][element]['Configurations']['Cache']='config.php?part=cache_sys';
/*$admin_menu[sitesys][group][element]['Key Configurations']['Optimizing Tools']='optimise.php';*/
$admin_menu[sitesys][group][element]['Configurations']['Link-in-text']='insidelink.php';
$admin_menu[sitesys][group][element]['Configurations']['Accessory']='file_manage.php?part=upload';
$admin_menu[sitesys][group][element]['Configurations']['Mobile Settings']='mobile.php';



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
$admin_menu[extend][group][element]['Mail Settings']['Mail Server']='mail.php?part=setting';
$admin_menu[extend][group][element]['Mail Settings']['Mail Template']='mail.php?part=template';
$admin_menu[extend][group][element]['Mail Settings']['Sent Record']='mail.php?part=sendlist';
$admin_menu[extend][group][element]['Payment']['Payment Port']='payapi.php';
$admin_menu[extend][group][element]['Extensions']['Advertisement']='adv.php';
$admin_menu[extend][group][element]['Extensions']['Invoking Data']='jswizard.php';
$admin_menu[extend][group][element]['Extensions']['Integrated Settings']='passport.php';
$admin_menu[extend][group][element]['Help']['System']='config.php?part=phpinfo';

?>