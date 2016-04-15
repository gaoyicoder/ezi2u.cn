<?php mymps_admin_tpl_global_head();?>
<script type='text/javascript' src='js/calendar.js'></script>
<script language="javascript">
ifcheck = false;
</script>
<form action="infomanage.php?" method="get">
<input name="action" value="viewresult" type="hidden"/>
<input name="return_url" value="<?php echo GetUrl(); ?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Search Post by Requirements</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">Display List of Details</td>
    <td>&nbsp;<input type="checkbox" name="detail"  value="yes" class="checkbox" <?php if($detail == 'yes' || empty($detail)) echo 'checked'; ?>> <font color="red"><br />
    Caution! If you choose not to display list of details, all matching data will be processed IN ONE OPERATION!<br />
    Prudence is needed especially when deleting.</font></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Posted By Guest Or Not:</td>
    <td>&nbsp;<select name="ismember">
    <option value="">>Any</option>
    <option value="no" <?php if($ismember == 'no') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Posted by Guest</option>
    <option value="yes" <?php if($ismember == 'yes') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Posted by Member</option>
    </select></td>
  </tr>
    <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Expired Post Or Not:</td>
    <td>&nbsp;<select name="istimed">
    <option value="">>Any</option>
    <option value="no" <?php if($istimed == 'no') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Valid Post</option>
    <option value="yes" <?php if($istimed == 'yes') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Expired Post</option>
    </select></td>
  </tr>
    <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Post Status:</td>
    <td>&nbsp;<select name="info_level">
    <option value="">>Any</option>
    <option value="0" <?php if($info_level == '0') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Under Revision</option>
    <option value="1" <?php if($info_level == '1') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Normal</option>
	<option value="2" <?php if($info_level == '2') echo 'selected="true" style="background-color:#6eb00c; color:white!important;"'?>>Recommended</option>
    </select></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">From Category</td>
    <td>&nbsp;<select name="catid">
    <option value="">>Any Category</option>
    <?=cat_list('category',0,$catid)?>
    </select></td>
  </tr>
  <?php if(!$admin_cityid){?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">From District</td>
    <td>&nbsp;<select name="cityid">
            <option value="0">All</option>
            <?php echo get_cityoptions(); ?>
           </select></td>
  </tr>
  <?php } else {?>
  	<input name="cityid" value="<?=$admin_cityid?>" type="hidden">
  <?php }?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Period of Posting (Format: yyyy-mm-dd; If no limit is applied, please input 0):</td>
    <td>&nbsp;<input class="txt" readonly type="text" name="starttime" size="10" value="<?php echo $starttime; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"> -
<input class="txt" readonly type="text" name="endtime" size="10" value="<?php echo $endtime; ?>"  onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Poster ID (To input multiple keywords, separate each of them with a comma):</td>
    <td>&nbsp;<input name="userid" class="text" value="<?php echo $userid; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Poster IP (Use * for any possible value, like 127.0.*.*):</td>
    <td>&nbsp;<input name="ip" class="text" value="<?php echo $ip; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Content Keywords (To input multiple keywords, separate each of them with a comma; Determining mark {x} can be applied to Keywords):</td>
    <td>&nbsp;<input name="keywords" class="text" value="<?php echo $keywords; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Minimum Length of Content (This will increase the burden of the server): </td>
    <td>&nbsp;<input name="lengthlimit" class="text" value="<?php echo $lengthlimit; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff" id="searchresult" style="display:none">
  	<td colspan="2">
    	Post List
    </td>
  </tr>
  <?php if($action != 'viewresult'){?>
  <tr class="firstr">
  	<td colspan="2">Please select your desired operation.</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td colspan="2">
    <label for="delinfo"><input name="part" value="delinfo" type="radio" class="radio" id="delinfo" <?php if($part == 'delinfo') echo 'checked';?>/>Delete Post</label> 	
    <label for="delcomment"><input name="part" value="delcomment" type="radio" class="radio" id="delcomment" <?php if($part == 'delcomment') echo 'checked';?>/>Delete Comments on Post</label>
    <label for="delattach"><input name="part" value="delattach" type="radio" class="radio" id="delattach" <?php if($part == 'delattach') echo 'checked';?>/>Delete Image in Post</label>
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
    <label for="refresh1"><input name="part" value="refresh" type="radio" class="radio" id="refresh1" <?php if($part == 'refresh') echo 'checked';?> />Refresh Post (Change time of Posting to Now)</label>
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
<label for="level0"><input name="part" value="level0" type="radio" class="radio" id="level0" <?php if($part == 'level0') echo 'checked';?>/>Put Under Revision</label>
    <label for="level1"><input name="part" value="level1" type="radio" class="radio" id="level1" <?php if($part == 'level1') echo 'checked';?>/>Put to Normal</label>
    <label for="level2"><input name="part" value="level2" type="radio" class="radio" id="level2" <?php if($part == 'level2') echo 'checked';?>/>Put to Recommended</label>
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
<label for="ifred"><input name="part" value="ifred" type="radio" class="radio" id="ifred" <?php if($part == 'ifred') echo 'checked';?>/>Redden Caption</label>
    <label for="ifbold"><input name="part" value="ifbold" type="radio" class="radio" id="ifbold" <?php if($part == 'ifbold') echo 'checked';?>/>Overstrike Caption</label>
    </td>
  </tr>
  <?}else{?>
  	<input name="part" value="<?=$part?>" type="hidden">
  <?}?>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" /></center>
<div class="clear"></div>
</form>
<?php
if($action == 'viewresult'){
?>
<form action="infomanage.php?" method="post">
<input name="step" value="submit" type="hidden">
<input name="return_url" value="<?php echo GetUrl(); ?>" type="hidden" />
<div class="clear"></div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm" >
<tr class="firstr">
  	<td colspan="8">Please select your desired operation.</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td colspan="8">
    <label for="delinfo"><input name="part" value="delinfo" type="radio" class="radio" id="delinfo" <?php if($part == 'delinfo') echo 'checked';?>/>Delete Post</label> 	
    <label for="delcomment"><input name="part" value="delcomment" type="radio" class="radio" id="delcomment" <?php if($part == 'delcomment') echo 'checked';?>/>Delete Comments on Post</label>
    <label for="delattach"><input name="part" value="delattach" type="radio" class="radio" id="delattach" <?php if($part == 'delattach') echo 'checked';?>/>Delete Image in Post</label>
    <label for="delhtml"><input name="part" value="delhtml" type="radio" class="radio" id="delhtml" <?php if($part == 'delhtml') echo 'checked';?>/>Delete HTML Files of Post</label>
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
    <label for="refresh"><input name="part" value="refresh" type="radio" class="radio" id="refresh" <?php if($part == 'refresh') echo 'checked';?>/>Refresh Post (Change time of Posting to Now)</label><hr style="height:1px; border:1px #c5d8e8 solid;"/>
<label for="level0"><input name="part" value="level0" type="radio" class="radio" id="level0" <?php if($part == 'level0') echo 'checked';?>/>Put Under Revision</label>
    <label for="level1"><input name="part" value="level1" type="radio" class="radio" id="level1" <?php if($part == 'level1') echo 'checked';?>/>Put to Normal</label>
    <label for="level2"><input name="part" value="level2" type="radio" class="radio" id="level2" <?php if($part == 'level2') echo 'checked';?>/>Put to Recommended</label>
    <hr style="height:1px; border:1px #c5d8e8 solid;"/>
<label for="ifred"><input name="part" value="ifred" type="radio" class="radio" id="ifred" <?php if($part == 'ifred') echo 'checked';?>/>Redden Caption</label>
    <label for="ifbold"><input name="part" value="ifbold" type="radio" class="radio" id="ifbold" <?php if($part == 'ifbold') echo 'checked';?>/>Overstrike Caption</label>
    </td>
  </tr>
    <tr class="firstr">
    <td style="width:5%"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox" checked="checked"/> </td>
    <td style="width:6%">Poster ID</td>
    <td style="width:16%">Post Title</td>
    <td style="width:30%">Post Content</td>
    <td width="100">Contact</td>
    <td width="100">Post Status</td>
    <td>Time of Posting</td>
    <td>Valid Until</td>
  </tr>
<?php 
foreach($information AS $row){?>
    <tr bgcolor="#ffffff" >
    <td><input type='checkbox' name='optionids[]' value='<?=$row[id]?>' class='checkbox' id="<?=$row[id]?>" checked="checked"></td>
    <td><?=$row[id]?></td>
    <td align="left" style="background:#ffffff"><a href="<?php echo Rewrite('info',array('id'=>$row['id'],'cityid'=>$row['cityid'],'dir_typename'=>$row['dir_typename']));?>" target="_blank" title="<?=$row[title]?>" style="<?php if($row['ifred'] == '1') echo 'color:red;';?> <?php if($row['ifbold'] == '1') echo 'font-weight:bold;';?>"><?=substring($row[title],0,18)?></a></td>
    <td align="left"><em><?=substring(clear_html($row[content]),0,80)?>...</em></td>
    <td><?php echo $row[contact_who] ? $row[contact_who] : '<em>'.$row[userid].'</em>';?></td>
    <td><?=$information_level[$row[info_level]]?></td>
    <td><em><?=GetTime($row[begintime])?></em></td>
    <td><em><?php echo empty($row[endtime]) ? 'Valid in the Long Term' : GetTime($row[endtime]); ?></em></td>
  </tr>
<?}?>
</table>
</div>
<?php if($action == 'viewresult'){?>
<center><input type="submit" value="Submit" class="mymps large" name="<?=CURSCRIPT?>_submit" <?php if($rows_num == 0) echo 'disabled'?>/></center>
</form>
<?php }?>
<div class="pagination"><?php echo page2();?></div>
<?}?>
<?php mymps_admin_tpl_global_foot();?>
