<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Success!</title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<link href="<?=$mymps_global[SiteUrl]?>/template/global/button.css" type="text/css" rel="stylesheet" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script language="javascript">var current_domain = '<?=$mymps_global[SiteUrl]?>';</script>
<script language="javascript" src="<?=$mymps_global[SiteUrl]?>/template/global/messagebox.js"></script>

</head>
<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_post');?>
<div class="body1000">
	<div class="clear15"></div>
	<div class="wrapper" id="main">
		<div class="step3">
		<span><font class="number">1</font> Select Post Category</span>
		<span><font class="number">2</font> Enter Content Of Post</span>
		<span class="cur"><font class="number">3</font> Post Successful</span>
		</div>
        <div class="fbd">
        <div class="c_border">
        <center id="infobox">
        <ul>
        <div id="mr">
			<? if(empty($ok[level])){?>
			<h2 class="h">The post will be displayed after it passes the revision!</h2>
            <p>The post ID numbered <strong><?=$ok[id]?></strong> &nbsp; that is made by you is now<b style=color:red>under revision</b> and will be displayed after it passes the revision by an administrator!<br /><br /><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$city[cityid]?>">Make Another Post&raquo;</a><br /><a href="<?=$city[domain]?>">Return To Site Homepage</a></p>
            <? }else{?>
			<h1 class="h">Post successfully made!</h1>
            <p>Your post  <a target="_blank"  href="<?=$ok[info_uri]?>" class="mrtitle"><b><?=$ok[title]?></b></a> &nbsp;has successfully been made</p>
            <p><b><font color="#FF0000">Notice: </font></b> This post will be displayed on Channel List Page in 3 minutes! <a href="<?=$city[domain]?>">Click To Return To Site Homepage&raquo;</a></p>
            <p style="padding:15px 0 0;">
            <a class="button a xxl" href="javascript:setbg('Top Categorized Post',538,248,'<?=$mymps_global[SiteUrl]?>/box.php?part=upgrade&id=<?=$ok[id]?>');" style="width:190px; margin-left:50px"><span><i></i>Top This Post Now</span></a>
            <a class="button c xxl" href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$city[cityid]?>"><span><i></i>Make Another Post&raquo;</span></a></p>
            <? }?>
        </div>
        </ul>
        </center>
        </div>
        
        </div>
	</div>
	<div class="clear"></div>
    <? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
