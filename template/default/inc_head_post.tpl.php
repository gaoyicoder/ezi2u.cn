<?

	if($s_uid==null)
		$data11='<ul><a href="'.$mymps_global['SiteUrl'].'/'.$mymps_global['cfg_member_logfile'].'?cityid='.$cityid.'" >Login</a></ul><ul class="line"><u></u></ul><ul><a href="'.$mymps_global[SiteUrl].'/'.$mymps_global['cfg_member_logfile'].'?mod=register&cityid='.$cityid.'" >Register</a></ul>';
	else
		$data11='Welcom,'.$s_uid.' &nbsp;<a href="'.$mymps_global['SiteUrl'].'/member/index.php">MemberCenter</a> <a href="'.$mymps_global[SiteUrl].'/'.$mymps_global['cfg_member_logfile'].'?mod=out&url='.$url.'" >Logout</a> ';
?>
<div class="bartop">
	<div class="barcenter">
		<div class="barleft">
			<ul class="barcity"><span><? if($city[cityname]){ ?><?=$city[cityname]?><? }else{ ?>State<? } ?></span> [<a href="<?=$mymps_global[SiteUrl]?>/changecity.php">select</a>]</ul> 
			<ul class="line"><u></u></ul>
			<ul class="barcang"><a href="<?=$mymps_global[SiteUrl]?>/desktop.php" target="_blank" title="Right click and select Save Target As to save a shortcut of the link on desktop.">Save On Desktop</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="barpost"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$cityid?>">Fast</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="bardel"><a href="<?=$mymps_global[SiteUrl]?>/delinfo.php" rel="nofollow">Edit Post</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="barwap"><a href="<?=$mymps_global[SiteUrl]?>/mobile.php">View On Mobile</a></ul>
		</div>
		<div class="barright"><?=$data11?></div>
	</div>
</div>
<div class="clearfix"></div>
<div class="mhead">
	<div class="logo"><a href="<?=$city[domain]?$city[domain]:$mymps_global[SiteUrl]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$mymps_global[SiteLogo]?>" title="<?=$mymps_global[SiteName]?>"/></a></div>
	<div class="font">
		<span>
		<?php 
		if(CURSCRIPT == 'posthistory'){
			echo 'Posting Records';
		}elseif(CURSCRIPT == 'space'){
			echo 'Personal Space';
		}elseif(CURSCRIPT == 'mobile'){
			echo 'Mobile Version';
		}elseif(CURSCRIPT == 'login'){
			echo 'Upgrade Account';
		}elseif(CURSCRIPT == 'delinfo'){
			echo 'Edit/Delete Post';
		}elseif(CURSCRIPT == 'changecity'){
			echo 'State list';
		}else{
			echo 'Make Post';
		}
		?></span>
	</div>
</div>
<div class="cleafix"></div>