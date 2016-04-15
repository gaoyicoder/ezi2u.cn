<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css">
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/information.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/information_comment.css">
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script language="javascript">var current_domain="<?=$mymps_global[SiteUrl]?>";</script>
<script src="<?=$mymps_global[SiteUrl]?>/template/global/messagebox.js" type="text/javascript"></script>
<meta name="keywords" content="<? if(is_array($info[extra])){?><? foreach($info[extra] as $k => $v){?><? if($v[value]){?><?=$v[title]?><?=$v[value]?>,<? }?><? }}?><?=$info[title]?>"/>
<meta name="description" content="<?=cutstr(clear_html($info[content]),200)?>"/>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_info]?>">
<? include mymps_tpl('inc_head');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="location"><?=$location?></div>
	<div class="clear"></div>
	<div class="wrapper">
	  <div class="information_hd">
        <div class="information_title">&nbsp;&nbsp;<?=$info[contact_who]?>CV</div>
	    <div class="information_time"> <span class="viewhits">Views: <font id="hit" color="red"><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=information&id=<?=$info[id]?>"></script></font> Time(s)</span>
			<span class="begintime">Time Of Post: <?=get_format_time($info[begintime])?></span>
			<span>
			<a href="javascript:setbg('Top A Post',538,248,'<?=$mymps_global[SiteUrl]?>/box.php?part=upgrade&id=<?=$info[id]?>');" style="color:red">Top</a>
			<a rel="nofollow" href="javascript:setbg('Save Post To Favourites',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=shoucang&infoid=<?=$info[id]?>')">Favourites</a>
			<a rel="nofollow" href="javascript:setbg('Delete Post',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=delinfo&id=<?=$info[id]?>')" title="Be warned: You cannot restore a deleted item!">Delete</a>
			<a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?action=edit&id=<?=$info[id]?>" target="_blank">Edit</a>
			<a class="report" href="javascript:setbg('Report Post',470,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=report&id=<?=$info[id]?>&infotitle=<?=$info[title]?>');">Report</a>
			</span> 
		</div>
      </div>
	  <div class="clearfix"></div>
	<div class="resume">
	
	<div class="inter_resume"> 
	
		<p class="pline">
			<? if(is_array($info[extra])){foreach($info[extra] as $k => $v){?>
			<?=$v[title]?>：<?=$v[value]?><span class="line"></span>
			<? }}?>
		</p>
		
		<p>
		<? if($info[contactview] == 1){?>
		<? if($info[usecoin] > 0){?>
			<a href="javascript:void(0);" onclick="setbg('View Contact Details: ',550,320,'<?=$mymps_global[SiteUrl]?>/box.php?part=seecontact&infoid=<?=$info[id]?>&if_view=<?=$info[contactview]?>')" class="viewcontacts">&nbsp;&nbsp;</a>
		<? }else{?>
			<div class="pdetails">
				<? if($info[userid]){?>
				<span>From User: </span><?=$info[userid]?> <? if($member[if_corp] == 1){?><img src="<?=$mymps_global[SiteUrl]?>/template/default/images/user2.gif" align="absmiddle" title="Seller"/><? }?><br />
				<? }?>
				<span>Contact: </span><?=$info[contact_who]?> <? if($info[ip2area] == 'wap'){?><font class="font" color="green">Post Via Mobile Phone</font><? }else{?><font class="font"><?=$info[ip]?></font> <font class="font" color="green"><?=$info[ip2area]?></font><? }?><br>
				<span>Address: </span><?=$info[web_address]?><br>
				<span>Contact Phone Number: </span><font class="tel"><?=$info[telephone]?></font> <font class="font"><a rel="nofollow" href="<?=$info[posthistory]?>" target="_blank">View Posting Records</a></font><br>
				<? if($info[qq]){?><span>联系QQ(中国元素,建议斟酌)：</span><?=$info[qq]?><br><? }?>				
				<? if($info[email]){?><span>Email Address: </span><?=$info[email]?><? }?>
			</div>
		<? }?>
		<? }else{?>
			<div class="guoqi" style="margin-top:15px;">This post is expired, so the contact details are automatically hidden.</div>
		<? }?>
		</p>
	
		<p class="p">个人介绍</p>
		<div class="pdetail">
		<!--信息介绍页内广告-->
		<? if($advertisement[type][infoad]){?>
		<div class="infoaddiv">
		<? if(is_array($advertisement[type][infoad])){foreach($advertisement[type][infoad] as $k => $v){?>
		<div class="infoad"><?=$adveritems[$v]?></div>
		<? }}?>
		</div>
		<div class="clear"></div>
		<? }?>
		<?=$info[content]?>
		</div>
		<? if(is_array($info[image])){?>
		<p class="p">My Photos</p>
		<div id="photo_list">
			<ul id="photoGroups">
			<? foreach($info[image] as $k => $v){?>
			<li><img src="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" height="115" title="<?=$v[title]?>" alt="<?=$v[title]?>" /></li>
			<? }?>
			</ul>
			<script type="text/javascript">
			$(function(){
			$("#photoGroups img").lightbox();
			});
			</script>
		</div>
		<div class="clear"></div>
		<? }?>
	</div> 
	
	</div>

	<div class="clear"></div>
	<? include mymps_tpl('inc_foot');?>
</div>
</div>
</body>
</html>