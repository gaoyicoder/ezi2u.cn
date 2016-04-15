<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/corp.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/corp.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/hover_bg.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/dropdown.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
<? include mymps_tpl('inc_head');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="location"><?=$location?></div>
	<div class="clear"></div>
	<div class="corporation_content">
		<div class="content_left">
		<div class="cate_seller">
		<div class="bd">
		
			<ul>
				<? $i=1;foreach($ypcategory as $k =>$v){?>
				<li class="item">
				<a href="javascript:void(<?=$v[corpid]?>);" class="rights" onclick="showHide(this,'items<?=$v[corpid]?>');"><?=$v[corpname]?></a>
				<ul id="items<?=$v[corpid]?>" style="display:
				<? if($catid > 0){?>
					<? if($v[corpid] == $cur[parentid]|| $v[corpid] == $catid){?><? }else{?>none<? }?>
				<? }else{?>
					<? if($i==1){?><? }else{?>none<? }?>
				<? }?>
				;">
				<li><a href="<?=$v[uri]?>">ALL</a></li>
				<? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>
				<li><a href="<?=$w[uri]?>" <? if($catid == $w[corpid]){?>class="current"<? }?>><?=$w[corpname]?></a></li>
				<? }}?>
				</ul>
				</li>
				<? $i=$i+1;}?>
		
			</ul>
		
		</div>
		
		</div>

			<div class="clear"></div>
			<div class="joinus">
				<ul>
					<a href="<?=$mymps_global[cfg_member_logfile]?>?mod=register&action=store&cityid=<?=$cityid?>" target="_blank" class="joinshop">Register My Shop Now</a>
					<center>Own a Website for Institution Display Now</center>
				</ul>
			</div>
		</div>
		<div class="content_right">
			<div class="hot_corporations">
				<div class="hd cfix"><span class="hdl">Recommended</span><span class="hdr">Inquiry Telephone Number: <?=$mymps_global[SiteTel]?></span></div>
				<div class="clearfix"></div>
				<div class="bd cfix">
				<ul>
					<? if(is_array($hotmember)){
					foreach($hotmember as $k =>$v){?>
					<li><span class="imga"><a href="<?=$v[uri]?>" class="f13" target="_blank" title="<?=$v[tname]?>"><img src="<?=$mymps_global[SiteUrl]?><?=$v[prelogo]?>" alt="<?=$v[tname]?>"></a></span><span class="txt"><a href="<?=$v[uri]?>" target="_blank"><?=$v[tname]?></a></span></li>
					<? }
					}else{?>
					<li>No Recommended</li>
					<? }?>
				</ul>
				</div>
			</div>
			<? if(is_array($area_list)){?>
			<div class="clear"></div>
			<div class="area_select">
				Search By District: 
				<? foreach($area_list as $k =>$v){?>
				<a href="<?=$v[uri]?>" <? if($v[select] == 1){?>class="currenta"<? }?>><?=$v[areaname]?></a>
				<? }?>
			</div>
			<? }?>
			<div class="clearfix"></div>
			<div class='section'>
				<ul class='sep'>
				<? if(is_array($member)){foreach($member as $k =>$v){?>
				<li class='hover media cfix <? if($member[levelid] == 3){?>vip<? }?>'>
				<a href='<?=$member[uri]?>' target='_blank' class='media-cap'><img src='<? if(!$v[prelogo]){?><?=$mymps_global[SiteUrl]?>/images/nophoto.gif<? }else{?><?=$mymps_global[SiteUrl]?><?=$v[prelogo]?><? }?>' alt=''></a>
				<div class='media-body'>
				<div class='media-body-title'>
					<div class='pull-rights'>
						<a class="see" href="<?=$v[uri]?>" target="_blank">Enter Shop</a> <!--<a class="dianping" target="_blank" href="<?=$v[uri_comment]?>">I Want to Comment</a>-->
					</div>
					<a href='<?=$v[uri]?>' target='_blank'><?=$v[tname]?></a> &nbsp;&nbsp;<img src="<?=$mymps_global[SiteUrl]?>/images/credit/<?=$v[credits]?>.gif" align="absmiddle" alt="Credits: <?=$v[credit]?>"> 
				</div>
				<div class='typo-small'><? if($v[per_certify] == 1){ ?><img src="<?=$mymps_global[SiteUrl]?>/images/person1.gif" alt="ID Verification Passed" align="absmiddle"/><? }else{?><img src="<?=$mymps_global[SiteUrl]?>/images/person0.gif" alt="ID Verification Failed" align="absmiddle"/><? }?> <? if($v[com_certify] == 1){?><img src="<?=$mymps_global[SiteUrl]?>/images/company1.gif" alt="Business Licence Verification Passed" align="absmiddle"/><? }else{?><img src="<?=$mymps_global[SiteUrl]?>/images/company0.gif" alt="Business Licence Verification Failed" align="absmiddle"/><? }?></div>
				<div class='typo-smalls'>Address: <?=$v[address]?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=$v[uri_contactus]?>" target="_blank">View On Map</a></div>
				</div>
				</li>
				<? }}else{?>
				<li class="media">No corresponding Shop Found! But have no worries, try another category! ^_^</li>
				<? }?>
				<div class="clearfix"></div>				
				</ul>
			</div>
			<div class="clear"></div>
			<div class="pagination2"><?=$pageview?></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot');?>
</div>
</body>
</html>
