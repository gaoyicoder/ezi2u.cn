<?php mymps_admin_tpl_global_head();?>

<script type='text/javascript' src='js/calendar.js'></script>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td colspan="5">

    <div class="left">

    <a href="javascript:collapse_change('tip')">Hints</a></div>

    <div class="right"><a href="javascript:collapse_change('tip')"><img id="menuimg_tip" src="template/images/menu_reduce.gif"/></a></div>

</td>

</tr>

<tr>

    <td id="menu_tip" bgcolor="white">

    <?php echo $type ? $vbm_adv_type[$type][notice] : $vbm_adv_type[$edit[type]][notice];?>

    </td>

</tr>

</table>

</div>

<form method="post" name="settings" action="adv.php?advid=<?=$advid?>">

<input name="part" value="adv<?=$part?>" type="hidden"/>

<input name="type" value="<?php echo $type ? $type : $edit[type] ;?>" type="hidden"/>

<input name="oldcityid" value="<?=$edit['cityid']?>" type="hidden">

<?php if($advid){?>

<input name="forward_url" value="<?php echo GetUrl(); ?>" type="hidden">

<?php }?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td colspan="2">

    <div class="left">

    <a href="javascript:collapse_change('float')"><?php echo $type ? $vbm_adv_type[$type][name] : $vbm_adv_type[$edit[type]][name];?></a></div>

    <div class="right"><a href="javascript:collapse_change('float')"><img id="menuimg_float" src="template/images/menu_reduce.gif"/></a></div>

</td>

</tr>



<tbody id="menu_float" style="display: yes">

<?php if(!$admin_cityid){?>

<tr>

	<td width="45%" bgcolor="white" >From Sub-site</td>

	<td>

	<select name="advnew[cityid]">

	<option value="0">Master Site</option>

	<?php echo get_cityoptions($edit[cityid]); ?>

   </select>

	</td>

</tr>

<?}else{?>

<input name="advnew[cityid]" type="hidden" value="<?php echo $admin_cityid; ?>">

<?php }?> 

<tr>

<td width="45%" bgcolor="white" >Manner of Display:<br /><i style="color:#666">Please select the designed manner of display for your advertisement</i></td><td bgcolor="white"><?php echo $style ? get_adv_style($style,'advnew[style]') : get_adv_style($adv_style[style],'advnew[style]') ; ?></td></tr>

<tr><td width="45%" bgcolor="white" >Advertisement Caption(<font color="red">*Required</font>):<br /><i style="color:#666">Note: Advertisement caption is just for recognition, not display.</i></td><td bgcolor="white"><input class="text" type="text" size="50" name="advnew[title]" value="<?php echo $title ? $title : $edit[title] ; ?>" >

</td></tr>

<?php if($type != 'normalad' && $edit['type'] != 'normalad'){?>

<tr><td width="45%" bgcolor="white" >Display Advertisement at(<font color="red">*Required</font>):<br /><i style="color:#666">Choose where your advertisement will be displayed. You may press and hold Ctrl button on your keyboard to select more than one option. If you select All Allowed Pages, no limit will be set for the display of the advertisement.</i></td><td bgcolor="white">

<select name="advnew[targets][]" size="15" multiple="multiple">

<?php if($type == 'infoad' || $edit['type'] == 'infoad'){

	echo get_infoad_target($edit['targets']);

} else {?>

<?php if(in_array($type,array('intercatad','interlistad')) || in_array($edit['type'],array('intercatad','interlistad'))){

	$edit['targets'] = $edit['targets'] ? $edit['targets'] : array();

?>

	<option value="all" <?php if(in_array('all',$edit['targets'])) echo 'selected style="background-color:#6EB00C;color:white"';?>> > All allowed Pages</option>

    <option value=""> </option>

<?}elseif($type == 'indexcatad' || $edit['type'] == 'indexcatad'){?>

<optgroup label="<?=MPS_SOFTNAME?>Site Homepage">

<?}else{

foreach($adv_target as $kad => $vad){?>

<option value="<?=$vad?>" <?php if(is_array($edit['targets'])){

	if(in_array($vad,$edit['targets'])){

		echo 'selected style="background-color:#6EB00C;color:white"'; }

        }?>>&nbsp;&nbsp;> <?=$kad?></option>

<optgroup label="<?=MPS_SOFTNAME?>">

<?php 

	}}

}?>



<?php 

if($type == 'infoad' || $edit['type'] == 'infoad'){

	

} elseif($type == 'indexcatad' || $edit['type'] == 'indexcatad') {

	echo cat_list('category',0,$edit['targets'],true,1);

} else {

	echo cat_list('category',0,$edit['targets']);

}

?>

</optgroup>

</select>



</td></tr>

<?}?>

<?php if($type == 'interlistad' || $edit['type'] == 'interlistad'){?>

<tr><td width="45%" bgcolor="#FFFFFF">Position of Display(<font color="red">*Required</font>):<br /><i style="color:#666">Select to display your advertisement right above or below the post list on column page.</i></td><td bgcolor="white">

<select name="advnew[position]" class="text">

<option value="top" <?php if($adv_style['position'] != 'bottom') echo 'selected';?>>Above</option>

<option value="bottom" <?php if($adv_style['position'] == 'bottom') echo 'selected';?>>Below</option>

</select>

</td></tr>

<?php }?>

<?php if($type == 'floatad' || $edit['type'] == 'floatad'){?>

<tr><td width="45%" bgcolor="#FFFFFF">Height of Flotation(<font color="red">*Required</font>):<br /><i style="color:#666">Distance between your floating advertisement and the bottom of display. Please set according to the height of your floating advertisement. The allowed volume is between 40 and 600 with 200 as default.</i></td><td bgcolor="white"><input type="text" name="advnew[floath]" value="<?php echo $adv_style['floath'] ? $adv_style['floath'] : '200'?>" class="text">

</td></tr>

<?php }?>

<tr><td width="45%" bgcolor="white" >Display starts at (Optional):<br /><i style="color:#666">Set the starting date of display for your advertisement with the format of yyyy-mm-dd. If you leave it blank, it will not be specified.</i></td><td bgcolor="white"><input type="text" id="datepicker1" name="advnew[starttime]" value="<?php echo $edit[starttime] ?  GetTime($edit[starttime]) : ''?>" class="text">

</td></tr><tr><td width="45%" bgcolor="white" >Display ends at (Optional):<br /><i style="color:#666">Set the ending date of display for your advertisement with the format of yyyy-mm-dd. If you leave it blank, it will not be specified.</i></td><td bgcolor="white"><input id="datepicker2" type="text" name="advnew[endtime]" class="text" value="<?php echo $edit[endtime] ?  GetTime($edit[endtime]) : ''?>">

</td></tr>

</table>

</div>



<div id="<?=MPS_SOFTNAME?>">

	<?php echo $style ? get_style_forminput('',$style) : get_style_forminput($edit[code],$adv_style); ?>

</div>



<center><input type="submit" name="<?=CURSCRIPT?>_submit" class="mymps large" value="Submit"/><br /><br /><a href="adv.php?type=<?php echo $type?type:$edit[type]; ?>&cityid=<?=$edit[cityid]?>" class="back">Return<?php echo $type ? $vbm_adv_type[$type][name] : $vbm_adv_type[$edit[type]][name];?>Settings</a><br />

<br /><a href="adv.php?&cityid=<?=$edit[cityid]?>" class="back">Return to Advertisement Management Homepage</a></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

