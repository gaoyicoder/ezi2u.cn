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
		<div class="information_title">&nbsp;&nbsp;<?=$info[title]?></div>
		<div class="information_time">
			<span class="viewhits">Views: <font id="hit" color="red"><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=information&id=<?=$info[id]?>"></script></font></span>
			<span class="begintime">Time Of Post: <?=get_format_time($info[begintime])?></span>
			<span class="manage">
			<a href="javascript:setbg('Top A Post',538,248,'<?=$mymps_global[SiteUrl]?>/box.php?part=upgrade&id=<?=$info[id]?>');" style="color:red">Top</a>
			<a rel="nofollow" href="javascript:setbg('Save Post To Favourites',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=shoucang&infoid=<?=$info[id]?>')">Favourites</a>
			<a rel="nofollow" href="javascript:setbg('Delete Post',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=delinfo&id=<?=$info[id]?>')" title="Be warned: You cannot restore a deleted item!">Delete</a>
			<a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?action=edit&id=<?=$info[id]?>" target="_blank">Edit</a>
			<a class="report" href="javascript:setbg('Report Post',470,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=report&id=<?=$info[id]?>&infotitle=<?=$info[title]?>');">Report</a>
			&nbsp;&nbsp;
			</span>
		</div>
	</div>
	
	<div class="clearfix"></div>
	<div class="information_bd">
			
			<div class="zp"> 

				<div class="inter_zp"> 

				<div class="view_hd">
				<div><a href="#" class="currentr"><span></span>Job Information</a></div>
				</div>



				<div class="view_hd">
				<div><a href="#" class="currentr"><span></span>Job Description</a></div>
				</div>

				<div class="pdetail">
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
				<div class="clear"></div>
				
				<? if(is_array($info[image])){?>
				<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.lightbox.js"></script>
				<script type="text/javascript">
					$(function() {
						$('#gallery a').lightBox();
					});
				</script>
				<div class="view_hd">
				<div><a href="" class="currentr"><span></span>Images</a></div>
				</div>
				<div class="clear"></div>
				<div class="photo_list" id="gallery">
					<ul id="photoGroups">
					<? foreach($info[image] as $k => $v){?>
					<li><a href="<?=$mymps_global[SiteUrl]?><?=$v[path]?>"><img src="<?=$mymps_global[SiteUrl]?><?=$v[prepath]?>" height="115" title="<?=$v[title]?>" alt="<?=$v[title]?>" /></a></li>
					<? }?>
					</ul>
				</div>
				<div class="clear"></div>
				<? }?>
				
				<div class="view_hd">
				<div><a href="" class="currentr"><span></span>Contact Details</a></div>
				</div>
				
				<div class="pdetail">
				<? if($info[contactview] == 1){?>
					<? if($info[usecoin] > 0){?>
					<center style="margin:50px auto 20px auto;">
					<a href="javascript:void(0);" onclick="setbg('View Contact Details',550,320,'<?=$mymps_global[SiteUrl]?>/box.php?part=seecontact&infoid=<?=$info[id]?>&if_view=<?=$info[contactview]?>')" class="viewcontacts">&nbsp;&nbsp;</a>
					</center>
					<? }else{?>
						<? if($info[userid]){?>
						<span>From User: </span><?=$info[userid]?> <? if($member[if_corp] == 1){?><img src="<?=$mymps_global[SiteUrl]?>/template/default/images/user2.gif" align="absmiddle" title="Seller"/><? }?><br />
						<? }?>
						<span>Contact: </span><?=$info[contact_who]?> <? if($info[ip2area] == 'wap'){?><font class="font" color="green">Post Via Mobile Phone</font><? }else{?><font class="font"><?=$info[ip]?></font> <font class="font" color="green"><?=$info[ip2area]?></font><? }?><br>
						<span>Address: </span><?=$info[web_address]?><br>
						<span>Contact Phone: </span><font class="tel"><?=$info[telephone]?></font> <font class="font"><a rel="nofollow" href="<?=$info[posthistory]?>" target="_blank">View Posting Records</a></font><br>
						<? if($info[qq]){?><!--<span>Facebook:</span>--><?=$info[qq]?><br><? }?>				
						<? if($info[email]){?><span>Email Address: </span><?=$info[email]?><? }?>
					<? }?>
				<? }else{?>
					<div class="guoqi">This post is expired, so the contact details are automatically hidden.</div>
				<? }?>
				</div> 
				
					<? if($info[mappoint]){?>
					<div class="view_hd">
					<div><a href="#" class="currentr"><span></span>Geographic Location</a></div>
					</div>

                     <div class="pdetail">

                         <iframe src="<?=$mymps_global[SiteUrl]?>/map.php?title=<?=$info[title]?>&isshow=1&p=<?=$info[mappoint]?>&width=1000&height=405" height="405" width="1000" frameborder="0" scrolling="no"></iframe>

                     </div>

					<div class="view_hd">
					<div><a href="#" class="currentr"><span></span>Reviews On Company</a></div>
					</div>

					<div class="pdetail">
					<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/comment.js"></script>
					<div id="ajaxcomment"><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/comment.php?part=information&id=<?=$info[id]?>"></script></div>

					</div>
					<? }?>


			</div>

		</div>

    </div>

	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot');?>
</div>
</div>
</body>
</html>