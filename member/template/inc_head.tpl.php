<?php if($box != 1){?>

<div class="toolbar">

    <div class="clearfix toolbar-inner">

        <div class="quicklink">

            <ul id="mymps_website_links" class="accesslink">

				<a href="../index.php?cityid=<?=$cityid?>" target="_blank">Return<?php echo $mymps_global['SiteName']?>Homepage</a>

            </ul>

        </div>

        <div class="userbar">

            <a class="username" href="index.php"><?php echo $s_uid; ?></a>

            <a href="index.php?m=pm" style="margin-top:1px">Messages<?php if($pm_total > 0){?><span class="counts"><?=$pm_total?></span><?php }?></a>

            <a href="../<?php echo $mymps_global['cfg_member_logfile']?>?mod=out" style="margin-top:1px">Exit</a>

        </div>

    </div>

</div>

<div class="header">

    <div class="clearfix header-inner">

        <div class="brand">

            <h1><a href="<?php echo $mymps_global[SiteUrl]?>/index.php?cityid=<?=$cityid?>" title="<?php echo $mymps_global[SiteName]?>" target="_blank"><img src="<?php echo $mymps_global[SiteUrl]?><?php echo $mymps_global[SiteLogo]?>" height="50"/></a></h1>

            <h2><a href="?">Member Centre</a></h2>

        </div>

    </div>

</div>



<div class="clearfix siteportalnav">

    <ul>

        <?php if($mymps_global['head_style'] == 'new'){?><li><a href="../index.php?cityid=<?=$cityid?>" target="_blank"><span><strong>Site Homepage</strong></span></a></li><?php }?>

		<li class="usercenter"><a <?php if($type == 'user'){?>class="current"<?php }?> href="index.php?type=user"><span><strong>Member Centre</strong></span></a></li>

        <?php if($if_corp == 1 && $mymps_global[cfg_if_corp] == 1){?><li><a <?php if($type == 'corp'){?>class="current"<?php }?> href="index.php?type=corp&m=shop"><span><strong><font color="<?php echo $mymps_global['head_style'] == 'new' ? "" : "red";?>">Shop Management</font></strong></span></a></li><?php }?>

    </ul>

</div>



<div class="subnav">

    <div class="clearfix subnav-inner">

        <div class="crumbnav">

             <?php echo $location; ?>

        </div>

    </div>

</div>



<?php }?>