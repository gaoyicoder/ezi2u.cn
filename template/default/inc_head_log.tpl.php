<div class="bartop">
	<div class="barcenter">
		<div class="barleft">
			<ul class="barcity"><span><? if(!$city[cityname]){?>State<? }else{?><?=$city[cityname]?><? }?></span> [<a href="<?=$mymps_global[SiteUrl]?>/changecity.php">select</a>]</ul> 
			<ul class="line"><u></u></ul>
			<ul class="barcang"><a href="<?=$mymps_global[SiteUrl]?>/desktop.php" target="_blank" title="Right click and select Save Target As to save a shortcut of the link on desktop.">Save On Desktop</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="barpost"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>">Fast</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="bardel"><a href="<?=$mymps_global[SiteUrl]?>/delinfo.php" rel="nofollow">Edit Post</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="barwap"><a href="<?=$mymps_global[SiteUrl]?>/mobile.php">View On Mobile</a></ul>
		</div>
		<div class="barright">
			<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=iflogin"></script>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="mhead">
	<div class="logo"><a href="<?=$city[domain]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$mymps_global[SiteLogo]?>" title="<?=$mymps_global[SiteName]?>"/></a></div>
	<div class="navigation">
		<a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?cityid=<?=$city[cityid]?>" <? if($mod == 'login' || !$mod){?>class="current"<? }?>>User Log-in</a>
		<a href="<?=$mymps_global[cfg_member_logfile]?>?mod=register&cityid=<?=$city[cityid]?>" <? if($mod == 'register'){?>class="current"<? }?>>Register Now</a>
		<a href="<?=$mymps_global[cfg_member_logfile]?>?mod=forgetpass&cityid=<?=$city[cityid]?>" <? if($mod == 'forgetpass'){?>class="current"<? }?>>Retrieve PW</a>
	</div>
</div>