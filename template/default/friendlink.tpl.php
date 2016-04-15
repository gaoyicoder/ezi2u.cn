<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/aboutus.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/postlink.js"></script>
<title><?=$page_title?></title>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head_about');?>
	<div class="clear"></div>
	<div class="friendlink">
		<div class="links">
			<? foreach($flink as $k => $v){?>
			<div class="link">
				<div class="tit"><?=$v[typename]?></div>
				<div class="clear"></div>
				<div class="imgcont">
					<? if(is_array($v[imglink])){foreach($v[imglink] as $u => $w){
					?>
					<a href="<?=$w[url]?>" target="_blank"><img alt="" src="<?=$w[weblogo]?>"></a>
					<? }}?>
					<div class="clearfix"></div>
				</div>
				<div class="cont">
					<? if(is_array($v[txtlink])){foreach($v[txtlink] as $q => $r){?>
					<a href="<?=$r[url]?>"><?=$r[webname]?></a>
					<? }}?>
				</div>
			</div>
			<div class="clear"></div>
			<? }?>
			<div class="link">
				<div class="tit">Application Procedure</div>
				<div class="clear"></div>
				<div class="contt">
	1. Please create a link to <?=$mymps_global[SiteName]?>on your own site: <br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Text Of Link: <?=$mymps_global[SiteName]?></b> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Link URL: <?=$mymps_global[SiteUrl]?></b><br />
	2. After the link is created, please complete the application information below; <br />
	3. Our staff will then check the related link to our site on your site as well as the contents of your site to make sure your site meets our demand for a related site. Once we deem your site eligible to become our related site, we will display a link to your site on the Related Links (Sites) section on our site.
				</div> 
			</div>
			<div class="clear15"></div>
			<div class="link">
				<div class="tit">Submit Application</div>
				<div class="clear"></div>
				<div class="contt">
					<form name="form1" action="<?=$mymps_global[SiteUrl]?>/about.php?" method="post" onSubmit="return submitForm();">
					<table cellpadding="0" cellspacing="0" class="link_table">
						<tr>
							<td>
								Site Type: 
							</td>
							<td style="height:34px;">
							<select name="typeid">
							<?=$webtype_option?>
							</select>
							</td>
						</tr>
						<tr>
							<td>
								Site Name: 
							</td>
							<td style="height:34px;">
								<input name="webname" type="text" style="width:350px"/></td>
						</tr>
						<tr>
							<td>
								Domain: 
							</td>
							<td style="height:34px;">
								<input id="url" name="url" type="text" value="http://"  style="width:350px"/></td>
						</tr>
						 <tr>
							<td>
								Image: 
							</td>
						   <td style="height:34px;">
								<input id="weblogo" name="weblogo" type="text" value="http://"  style="width:350px"/></td>
						</tr>
						<tr>
							<td height="35">
								Email: 
							</td>
							<td>
								<input id="email" name="email" type="text"  style="width:350px"/></td>
						</tr>
						<tr>
							<td width="68" valign="top">
								Description: 
							</td>
							<td width="348" valign="top" style=" padding-bottom:5px; padding-top:5px;">
								<textarea id="msg" name="msg" style="width:352px; height:100px;"></textarea></td>
						</tr>
						<tr>
							<td height="35">
								Code: 
							</td>
							<td style="height:34px;">
								<input type="text" name="checkcode" class="text" style="width:70px"/> <img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>" alt="Cannot see clearly? Click to Refresh." class="authcode" align="absmiddle" onClick="this.src=this.src+'?'"/></td>
						</tr>
						<tr>
							<td>&nbsp;
								
							</td>
							<td height="45" align="left" valign="middle">
								<input type="submit" name="about_submit" class="submit" value="Submit"/>
							</td>
						</tr>
					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</body>
</html>
