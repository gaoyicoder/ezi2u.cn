<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/spaces/person/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_post'); ?>
<div class="body1000">
	<div class="clear15"></div>
	<div id="main" class="wrapper">
		<div class="top_info cfix" style="padding-bottom:20px;">
			<div class="infol">
				<p><span class="tx"><img src="<?=$mymps_global[SiteUrl]?>/<?=$space[prelogo]?>" /></span></p>
			</div>
			<div class="xqxinfo">
				<table>
					<tbody>
						<tr>
							<th>User&nbsp;name</th>
							<td>
								<p class="yhzh_p">
									<strong><?=$space[userid]?></strong>
									<img title="Credit: {$space.credit}" align="absmiddle" src="<?=$mymps_global[SiteUrl]?>/images/credit/<?=$space[credits]?>.gif"> &nbsp;&nbsp;&nbsp;
									<? if($space[storeuri] && $space[if_corp] == 1){?><a target="_blank" title="View<?=$space[userid]?>For The Online Shop" href="<?=$space[storeuri]?>">View My Online Shop&raquo;</a><? }?>
								</p>
							</td>
						</tr>
						<tr>
							<th>Time Of Register</th>
							<td><?=get_format_time($space[jointime])?></td>
						</tr>
						<tr>
							<th class="t">Verification</th>
							<td class="t">
							<p class="rz">
								<? if($space['pre_cretify'] == 1){?><span><b>Real Name Verified</b><i class="nameyz" title="Real Name Verified"></i></span><? }else{?><span><b>Real Name Not Verified</b><i class="nameyzw" title="Real Name Not Verified"></i></span><? }?>
								<? if($space['com_cretify'] == 1){?><span><b>Business Licence Verified</b><i class="zzyz" title="Business Licence Verified"></i></span><? }else{?><span><b>Business Licence Not Verified</b><i class="zzyzw" title="Business Licence Not Verified"></i></span><? }?>
							</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="fabu cfix" >
			<h2 class="balance-h2">My Posts</h2>
			<ul class="ggifno">
			<? foreach($info as $k =>$v){?>
			<li>
					<span class="date"><?=get_format_time($v[begintime])?></span>
					<a href="<?=$v[uri]?>" target="_blank"><?=cutstr($v[title],100)?></a>
					(<?=$v[catname]?>)
			</li>
			<? }?>
			</ul> 
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about'); ?>
</div>
</body>
</html>
