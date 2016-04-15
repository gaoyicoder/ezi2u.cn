<?php mymps_admin_tpl_global_head();?>
<style>
body{ text-align:center!important;}
.stepstart{ width:959px; height:auto; overflow:auto; margin-left:auto; margin-right:auto; text-align:center; margin-top:80px;}
.tep{ float:left; display:block; border-bottom:5px #dedede solid; color:#999; padding-bottom:10px; width:65px; height:80px; padding-left:10px; padding-right:10px; padding-bottom:40px; vertical-align:middle; text-align:left; cursor:pointer; padding-top:10px;}
.on{ border-bottom:5px #226499 solid; color:#226499;}
.subdiv{ margin-top:70px; margin-bottom:70px; text-align:center}
.chkbox{ text-align:center; margin-left:auto; margin-right:auto; margin-bottom:10px;}
.finished{ margin-top:70px; margin-bottom:70px; color:#226499; font-family:microsoft yahei; font-size:18px;}
.vbm{ text-align:center;}
</style>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
            	<li><a href="config.php?part=cache">Page Cache</a></li>
				<li><a href="config.php?part=cache_sys">Data Cache</a></li>
				<li><a href="optimise.php" class="current">System Optimization</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td>Click to Optimize MyMps System/Clear Redundant Data</td>
  </tr>
  <tr>
  <td>
	<form method="post" action="?">
	<input name="action" value="dopost" type="hidden">
	<div class="stepstart">
		<?php $lastarr = explode(',',$last);foreach($step as $k => $v){?>
			<label for="step<?php echo $k;?>"><div class="tep <?php echo in_array($k,$lastarr) ? 'on' : '';?>"><div class="chkbox"><input id="step<?php echo $k;?>" class="checkbox" name="steporder[<?php echo $k;?>]" value="1" <?php echo (in_array($k,$lastarr) || (empty($last) && $k != '2')) ? 'checked="checked"' : '';?> type="checkbox"></div><?php echo $v;?></div></label>
		<?php }?>
	</div>
	<div class="clear"></div>
	<?php if($finished == 1){?>
	<center class="finished">
	Congratulations, system optimization is complete!
	</center>
	<?}elseif(empty($next) && empty($last)){?>
	<div class="subdiv"><input name="<?php echo CURSCRIPT; ?>_submit" type="submit" value="Submit" class="mymps large"/></div>
	<?}else{?>
	<div class="subdiv">
	&nbsp;&nbsp;
	</div>
	<?php }?>
	</form>
</td>
</tr>
</table>
<div class="clear"></div>
<?php mymps_admin_tpl_global_foot();?>
