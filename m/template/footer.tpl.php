<!--
<div class="help" style="background-color:#F2F2F2">

<a href="index.php?mod=delete&cityid=<?=$cityid?>" rel="nofollow">Delete Posts</a>

<a href="index.php?mod=about&cityid=<?=$cityid?>" rel="nofollow">Contact</a>

</div>
-->


<div class="footer" style="background-color:#F2F2F2">

	<p class="footer_01">
<!--
		<a href="index.php?mod=index&cityid=<?=$cityid?>" class="footer_hover" rel="nofollow">Mobile</a>

		<a href="<?=$mymps_global[SiteUrl]?>/index.php?view=pc&cityid=<?=$cityid?>" rel="nofollow">Desktop</a>
-->

	</p>

	<p class="footer_02"><?=$mymps_global['SiteName']?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$mymps_global['SiteBeian']?>&nbsp;&nbsp;</p>

	<p class="footer_02" style="display:none"><?=$mymps_global['SiteStat']?></p>

</div>



<div id="contactbar">

	<a href="index.php?cityid=<?=$cityid?>" class="bottom_index<?php echo in_array(CURSCRIPT,array('index')) ? '_on' : ''; ?>"></a>

	<a href="index.php?mod=history&cityid=<?=$cityid?>" class="bottom_history<?php echo CURSCRIPT == 'history' ? '_on' : ''; ?>"></a>

	<a href="index.php?mod=member&cityid=<?=$cityid?>" class="bottom_member<?php echo in_array(CURSCRIPT,array('login','member')) ? '_on' : ''; ?>"></a>

	<a href="index.php?mod=post&cityid=<?=$cityid?>" class="bottom_post<?php echo CURSCRIPT == 'post' ? '_on' : ''; ?>"></a>

</div>

