<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="?part=intro" <?php if($part == 'intro'){?>class="current"<?php }?>>Detailed Introduction to Advertising Space</a></li>
				<li><a href="?" <?php if($part == 'list'){?>class="current"<?php }?>>List of Advertisements</a></li>
			</ul>
			<ul style="float:right; text-align:right">
				<?php if(!$admin_cityid){?>
				<select name="cityid" onChange="location.href='?page=<?=$page?>&type=<?=$info_level?>&cityid='+(this.options[this.selectedIndex].value)">
				<option value="0">Master Site</option>
				<?php echo get_cityoptions($cityid); ?>
				</select>
				<?}?>
				<select name="type" onChange="location.href='?cityid=<?=$cityid?>&type='+(this.options[this.selectedIndex].value)">
					<option value="">==Filter by Advertisement Type==</option>
					<?php foreach($vbm_adv_type as $k=>$v){?>
					<option value="<?=$k?>" <?php if($k == $type) echo 'selected'; ?>><?=$v[name]?></option>
					<?php }?>
				</select>
			</ul>
		</div>
	</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td>Add Advertisement</td>
</tr>
<tr bgcolor="#ffffff">
<td>
<form method="get" action="?">
<input name="part" value="add" type="hidden"/>
Advertisement Caption:<input style="vertical-align: middle" class="text" type="text" name="title" value="" size="25" maxlength="50"> <?=get_adv_style()?>
 <?=get_adv_option();?>
</form>
</td>
</tr>
</table>
</div>
<form name='form1' method='post' action='adv.php'>
<input name="forward_url" value="<?=GetUrl()?>" type="hidden">
<input name="part" value="<?=$part?>" type="hidden"/>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td width="5%">
<input name="chkall" type="checkbox" onclick="AllCheck('prefix', this.form, 'delids')" class="checkbox"/>Delete?</td>
<td width="5%">Applicable</td>
<td width="8%">Order of Display</td>
<td width="15%">Caption</td>
<td width="12%">Type</td>
<td width="5%">Style</td>
<td width="8%">Starting Time</td>
<td width="8%">Ending Time</td>
<td width="10%">Details</td>
</tr>
<?php foreach($adv as $k =>$value){?>
<tr bgcolor="white">
  <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$value[advid]?>' id="<?=$value[advid]?>"></td>
  <td><input class="checkbox" type="checkbox" name="available[<?=$value[advid]?>]" value="1" <?php if ($value['available'] == 1){echo 'checked';}?>/></td>
  <td><input name="displayorder[<?=$value[advid]?>]" value="<?=$value[displayorder]?>" type="text" class="txt"/></td>
  <td><input name="titlenew[<?=$value[advid]?>]" value="<?=$value[title]?>" type="text" class="text" style="width:100px"/></td>
  <td><a href="?cityid=<?=$cityid?>&type=<?=$value[type]?>"><?=$vbm_adv_type[$value[type]][name]?></a></td>
  <td>
  <?php 
  	$adv_style = ($charset == 'utf-8') ? utf8_unserialize($value[parameters]) : unserialize($value[parameters]);
  	echo $vbm_adv_style[$adv_style[style]];
   ?></td>
  <td><em><?php echo $value[starttime] ? GetTime($value[starttime],'Y-m-d') : '-'; ?></em></td>
  <td><em><?php echo $value[endtime] ? GetTime($value[endtime],'Y-m-d') : '-'; ?></em></td>
  <td><a href="?part=edit&advid=<?=$value[advid]?>">Edit</a> <?php if(!in_array($value[type],array('couplead','floatad'))){?>&nbsp;&nbsp;<a href="
javascript:setbg('Preview Advertisement',550,110,'../box.php?part=advertisementview&id=<?=$value[advid]?>')">Preview</a><?php }?> <?php if($value[type] == 'normalad'){?> &nbsp;&nbsp;<a href="
javascript:setbg('Customized Advertisement Application',550,110,'../box.php?part=advertisement&id=<?=$value[advid]?>')">Apply</a><?}?></td>
</tr>
<?php }?>
</table>
</div>
<center>
<input type="submit" value="Submit" class="mymps large" name="<?=CURSCRIPT?>_submit"/>  
</center>
</form>
<div class="pagination"><?php echo page2();?></div>
<?php mymps_admin_tpl_global_foot();?>
