<?php include mymps_tpl('inc_head');?>
<script type="text/javascript" src="js/titlealt.js"></script>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
	<td colspan="2">Search Among Categorized Posts</td>
	<?php if(!$admin_cityid){?><td>Filter by Sub-sites</td><?php }?>
</tr>
<tr>
	<td colspan="2" bgcolor="white">
    <form action="?" method="get">
    	<input name="cityid" value="<?=$cityid?>" type="hidden">
    	<input name="keywords" value="<?=$keywords?>" type="text" class="text" style="width:180px">
        <select name="show">
		<option value="idno" <?php if($show == 'idno') echo 'selected'; ?>>Post ID Number</option>
		<option value="catidno" <?php if($show == 'catidno') echo 'selected'; ?>>Category ID Number</option>
		<option value="title" <?php if($show == 'title') echo 'selected'; ?>>Post Caption</option>
		<option value="userid" <?php if($show == 'userid') echo 'selected'; ?>>User ID</option>
		<option value="tel" <?php if($show == 'tel') echo 'selected'; ?>>Phone Number</option>
        </select> 
        <input name="submit" type="submit" value="Search " class="gray mini"/>
    </form>
	</td>
	<?php if(!$admin_cityid){?>
	<td>
	<select name="cityid" onChange="location.href='?page=<?=$page?>&info_level=<?=$info_level?>&keywords=<?=$keywords?>&show=<?=$show?>&upgrade=<?=$upgrade?>&ifred=<?=$ifred?>&ifbold=<?=$ifbold?>&cityid='+(this.options[this.selectedIndex].value)">
	<option value="0">All</option>
	<?php echo get_cityoptions($cityid); ?>
	</select>
	</td>
	<?}?>
</tr>
</table>
</div>
<div class="clear"></div>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
            	<li><a href="information.php" <?php if($info_level=='' && $upgrade != 'index' && $upgrade != 'list' && $upgrade != 'category' && $ifred != '1' && $ifbold != '1'){?>class="current"<?php }?>>All Posts</a></li>
            	<li><a href="information.php?info_level=0" <?php if($info_level==='0'){?>class="current"<?php }?>>Posts Under Revision</a></li>
                <li><a href="information.php?info_level=1" <?php if($info_level==1){?>class="current"<?php }?>>Normal Posts</a></li>
                <li><a href="information.php?info_level=2" <?php if($info_level==2){?>class="current"<?php }?>>Recommended Posts</a></li>
                <li><a href="information.php?upgrade=index" <?php if($upgrade=='index'){?>class="current"<?php }?>>Place at the Top of the Homepage</a></li>
                <li><a href="information.php?upgrade=category" <?php if($upgrade=='category'){?>class="current"<?php }?>>Place at the Top of the Broad Headings</a></li>
				<li><a href="information.php?upgrade=list" <?php if($upgrade=='list'){?>class="current"<?php }?>>Place at the Top of the Sub-headings</a></li>
                <li><a href="information.php?ifred=1" <?php if($ifred==1){?>class="current"<?php }?>>Redden Caption</a></li>
                <li><a href="information.php?ifbold=1" <?php if($ifbold==1){?>class="current"<?php }?>>Overstrike Caption</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="?action=pm" method="post">
<input name="url" type="hidden" value="<?=GetUrl()?>">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm" >
    <tr class="firstr">
    <td width="30">Select</td>
    <td width="40">Thumbnail</td>
	<td width="30">Status</td>
    <td>Post Title</td>
    <td width="50">Place at the Top of the Broad Headings</td>
	<td width="50">Place at the Top of the Sub-headings</td>
    <td width="50">Place at the Top of the Homepage</td>
	<td width="50">Poster</td>
	<td width="60">Place of Posting</td>
	<td width="50">Time of Posting</td>
    <td width="30">Management</td>
  </tr>
<tbody onmouseover="addMouseEvent(this);">
<?php foreach($information AS $row){?>

     <tr bgcolor="white" >
    <td><input type='checkbox' name='id[]' value='<?=$row[id]?>' class='checkbox' id="<?=$row[id]?>"></td>
     <td><?php $row['img_path'] = $row['img_path'] ? $row['img_path'] : '/images/nophoto.gif';?><img src="<?=$row[img_path]?>" width="48" height="36" style="border:1px #dddddd solid; padding:1px"></td>
	<td><?=$row[info_level]?></td>
    <td><?php if($row['img_path']){?><font color="green">[<?=$row['img_count']?>Image]</font> <?php }?><a style="<?php if($row['ifred'] == 1) echo 'color:red;';?><?php if($row['ifbold'] == 1) echo 'font-weight:bold;';?>" href="<?=$row[uri]?>" target="_blank" title="<?=$row[id]?> - <?=$row[title]?>"><?php echo $row[title]; ?></a><a title="Category ID Number:<?=$row[catid]?>" target="_blank" href="<?=$row[uri_cat]?>" style="color:#333; margin-left:10px"><?=$row[catname]?></a><?php if($row[certify] == 1){?> <img title="Verification Information" alt="Verification Information" align="absmiddle" src="../images/company1.gif"><?}?></td>
 
    <td><div class="signin_button"  onmouseover="wsug(event, '<?php echo $row['upgrade_time']; ?>')" onmouseout="wsug(event, 0)"><?=$row[upgrade_type]?></div></td>
    <td><div class="signin_button"  onmouseover="wsug(event, '<?php echo $row['upgrade_time_list']; ?>')" onmouseout="wsug(event, 0)"><?=$row[upgrade_type_list]?></div></td>
    <td><div class="signin_button"  onmouseover="wsug(event, '<?php echo $row['upgrade_time_index']; ?>')" onmouseout="wsug(event, 0)"><?=$row[upgrade_type_index]?></div></td>
	<td><?=$row[contact_who]?>
    </td>
	<td><div class="signin_button"  onmouseover="wsug(event, '<?php echo $row['ip2area'] == 'wap' ? 'For Cell Phone' : $row['ip2area']; ?>')" onmouseout="wsug(event, 0)"><i style="color:#585858"><?php echo $row['ip2area'] == 'wap' ? 'For Cell Phone' : $row['ip']; ?></i></div>
    </td>
	<td><div class="signin_button"  onmouseover="wsug(event, 'Time of Posting: <?php echo GetTime($row['begintime']);?>')" onmouseout="wsug(event, 0)"><font style="color:#585858"><?php echo date("m-d",$row['begintime']);?></font></div></td>
	<td>
     <a href='?action=edit&id=<?=$row[id]?>'>Edit</a>
    </td>
  </tr>
<?}?>
</tbody>
<tr bgcolor="#ffffff" height="28">
    <td style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>
    <td colspan="10">
    <label for="delall"><input type="radio" value="delall" id="delall" name="do_action" class="radio">Delete</label> 
    <label for="refresh"><input type="radio" value="refresh" id="refresh" name="do_action" class="radio">Refresh</label>
    <?php foreach($information_level as $k => $v){?>
    <label for="level<?=$k?>"><input type="radio" value="level.<?=$k?>" id="level<?=$k?>" name="do_action" class="radio">תΪ<?=$v?></label> 
    <?php }?>
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
	<label for="certify_yes"><input type="radio" value="certify_yes" id="certify_yes" name="do_action" class="radio">Pass Verification</label> 
	<label for="certify_no"><input type="radio" value="certify_no" id="certify_no" name="do_action" class="radio">Cancel Verification</label> 
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
    <label for="upgrade"><input type="radio" value="upgrade" id="upgrade" name="do_action" class="radio">Cancel/Place at the Top of the Broad Headings</label> 
	<label for="upgrade_list"><input type="radio" value="upgrade_list" id="upgrade_list" name="do_action" class="radio">Cancel/Place at the Top of the Sub-headings</label> 
    <label for="upgrade_index"><input type="radio" value="upgrade_index" id="upgrade_index" name="do_action" class="radio">Cancel/Place at the Top of the Homepage</label> 
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
    <label for="ifred"><input type="radio" value="ifred" id="ifred" name="do_action" class="radio">Cancel/Redden Caption</label> 
    <label for="ifbold"><input type="radio" value="ifbold" id="ifbold" name="do_action" class="radio">Cancel/Overstrike Caption</label> 
    </td>
</tr>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large"/></center>
</form>
<div class="pagination"><?php echo page2();?></div>
<?php mymps_admin_tpl_global_foot();?>