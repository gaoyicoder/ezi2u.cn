<?php mymps_admin_tpl_global_head();?>
<style>
a.letter{margin:1px 5px; font-weight:bold; font-size:14px; text-decoration:underline}
</style>
<script language=javascript>
function chkform(){
	if(document.form.areaname.value==""){
		alert('Please type in district name(s), and separate each district with | !');
		document.form.areaname.focus();
		return false;
	}
}

function getpinyin(t){
	if(t != ''){
		url='include/get_pinyin.php?t='+t;
		target='iframe_t';
		document.getElementById('form_t').action=url;
		document.getElementById('form_t').target=target;
		document.getElementById('form_t').submit();
	}
}

function getpinyinhead(t){
	if(t != ''){
		url='include/get_pinyin.php?ishead=1&t='+t;
		target='iframe_t';
		document.getElementById('form_t').action=url;
		document.getElementById('form_t').target=target;
		document.getElementById('form_t').submit();
	}
}
</script>
<script type="text/javascript" src="js/vbm.js"></script>
<div class="ccc2">
	<ul>
    <div style=" float:left; height:32px; width:49%">
    <input value="Click to create directories to all sub-sites. &raquo;" class="mymps mini" onclick="location.href='area.php?part=makealldir'">
    <input value="Click to delete directories to all sub-sites. &raquo;" class="gray mini" onclick="location.href='area.php?part=delalldir'" style="margin-left:25px;">
    </div>
    <div style=" float:right; height:32px; width:400px">
    <input value="Apply second-level domain names to all sub-sites&raquo;" class="mymps mini" onclick="if(!confirm('This requires server/cloud hosting/VPS'))return false;location.href='area.php?part=usedomain'">
    <input value="Cancel second-level domain names for all sub-sites&raquo;" class="gray mini" onclick="location.href='area.php?part=usenodomain'" style="margin-left:25px;"></a></div>
    </ul>
</div>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?" class="current">Added Sub-sites/Districts</a></li>
				<li><a href="province.php">Region/State Management</a></li>
            </ul>
			<ul style="float:right; text-align:right">
				<form method="get" action="?">
					<select name="type">
						<option value="cityid" <?php if($type == 'cityid') echo 'selected'; ?>>Sub-site Number</option>
						<option value="cityname" <?php if($type == 'cityname') echo 'selected'; ?>>Sub-site Name</option>
						<option value="directory" <?php if($type == 'directory') echo 'selected'; ?>>Storage Directory Name</option>
						<option value="provincename" <?php if($type == 'provincename') echo 'selected'; ?>>From Region</option>
					</select> 
					
					<input name="keywords" type="text" class="text" style="width:100px;" value="<?=$keywords?>">    Number of Records Shown on Every Page:<input name="showperpage" type="text" class="txt" value="<?=$showperpage ? $showperpage : ''?>">
					<input type="submit" value="Search" class="gray mini">
				</form>
			</ul>
        </div>
    </div>
</div>

<div id="h0">

<?php if(empty($cityid) && empty($areaid)){?>

<form name="form_mymps" action="?part=list" method="post">
<input name="url" type="hidden" value="<?=GetUrl()?>">
<div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
        <tr class="firstr">
          <td width="40">&nbsp;</td>
          <td width="40">Number</td>
          <td>Sub-site Name</td>
          <td>Storage Directory</td>
          <td>Domain Name</td>
          <td width="80">Sort</td>
          <td>Operation</td>
        </tr>
    <?php 
    if(is_array($list)){
    foreach($list AS $area)
    {
    ?>
        <tr bgcolor="#ffffff">
        <a name="<?=$area[firstletter]?>"></a>
          <td width="40"><label><input name="actiondir[<?=$area[cityid]?>]" value="<?=$area[directory]?>" type="checkbox" class="checkbox" <?php if(empty($area[directory])) echo 'disabled';?>/></label></td>
          <td width="40"><label><?=$area[cityid]?></label></td>
          <td width="80" style="<?php if($area['ifhot'] == '1') echo 'color:red; text-decoration:underline'; ?>"><label><b><?=$area[cityname]?></b></label></td>
          <td align="left"><?=$mymps_global['cfg_citiesdir']?>/<?=$area[directory]?></td>
          <td align="left"><a href="<?=$area[domain] ? $area[domain] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$area[directory]?>" target="_blank" style="text-decoration:underline"><?=$area[domain] ? $area[domain] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$area[directory]?></a></td>
          <td width="40"><input name="updatecity_displayorder[<?=$area[cityid]?>]" value="<?=$area[displayorder]?>" class="txt" type="text"/></td>
          <td><a href="?part=list&cityid=<?=$area[cityid]?>">Subordinate Districts</a> / <a href="?part=edit&cityid=<?=$area[cityid]?>">Edit Sub-site</a> / <a onClick="if(!confirm('Are you sure you want to delete this sub-site? This will also delete all its affiliated districts, sections, categorized information, members, advertisements, announcements and announcement settings.'))return false;" href="?part=del&cityid=<?=$area[cityid]?>">Delete Sub-site</a></td>
        </tr>
    <?
    }
    } else {
    ?>
        <tr bgcolor="#ffffff">
          <td colspan="9" bgcolor="#ffffff"><div class="nodata">District <span><?php echo $curareaname?></span>No Categories for Subordinate Districts.</div></td>
        </tr>
    <?}?>
        <tr bgcolor="white">
            <td>
            <input name="chkall" type="checkbox" onclick="AllCheck('prefix', this.form, 'action')" class="checkbox" id="createdir"/>
            </td>
            <td  colspan="7">
			<label for="action_delcity"><input onclick="javascript:alert('Please note with caution: this will delete all affiliated information such as posts, news and sellers, and all deleted information cannot be restored!')" type="radio" class="radio" id="action_delcity" name="action" value="delcity">Delete Sub-site</label>
            <label for="action_deldir"><input type="radio" class="radio" id="action_deldir" name="action" value="deldir">Delete Sub-site Directory</label>
            <label for="action_mkdir"><input type="radio" class="radio" id="action_mkdir" name="action" value="mkdir">Create Sub-site Directory</label>
            
            </td>
        </tr>
		<tr bgcolor="white">
			<td colspan="8" style="text-align:center">
			<input name="<?=CURSCRIPT?>_submit" type="submit" value="提交" class="mymps large"/>
			</td>
		</tr>
    </table>
</div>
<center></center>
</form>
<div class="pagination"><?=page2()?></div>

<?php } elseif($areaid) {?>
<div>
Current Position: <span><a href="area.php">Sub-site for City</a> &raquo; <a href="?cityid=<?=$cityid?>"><?php echo $cityname; ?></a> &raquo; <?php echo $currentname; ?></span>
</div>
<div class="clear"></div>
<form action="?" method="post">
<input name="areaid" value="<?php echo $areaid; ?>" type="hidden">
<input name="cityname" value="<?php echo $cityname; ?>" type="hidden" />
<input name="cityid" value="<?php echo $cityid; ?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
	<table border="0" cellspacing="0" cellpadding="0" class="vbm">
        <tr class="firstr">
          <td width="40"><label><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/>Delete?</label></td>
          <td width="60%">Street/Road Name</td>
          <td>Sort</td>
        </tr>
    <?php 
    if($list){
    foreach($list AS $area)
    {
    ?>
        <tr bgcolor="#ffffff">
        <td width="40"><label><input type='checkbox' name='deletestreetid[]' value='<?=$area[streetid]?>' class='checkbox'></label></td>
          <td align="left"><input name="updatestreet_streetname[<?=$area[streetid]?>]" value="<?=$area[streetname]?>" class="txt" style="width:100px"> </td>
          <td><input name="updatestreet_displayorder[<?=$area[streetid]?>]" value="<?=$area[displayorder]?>" class="txt" type="text"/></td>
        </tr>
    <?
    }
    } else {
    ?>
        <tr bgcolor="#ffffff">
          <td colspan="5" bgcolor="#ffffff"><div class="nodata">District <span><?php echo $currentname; ?></span>No subordinate street/road added.<br />
<br />Return to<a href="?cityid=<?=$cityid?>">the Previous Page</a></div></td>
        </tr>
    <?}?>
    </table>
</div>
<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large" onClick="if(!confirm('Deleting it will also delete all information concerning its subordinate street/road. Do you wish to continue?'))return false;"/></center>
</form>
<div class="clear"></div>
<form method="post" name="form" action="?">
<input name="newstreet[areaid]" value="<?=$areaid?>" type="hidden">
<input name="cityname" value="<?php echo $cityname; ?>" type="hidden" />
<input name="cityid" value="<?php echo $cityid; ?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td colspan="2" align="left">Affiliate Street <span><?=$currentname?></span>to District</td>
</tr>
<tr bgcolor="#ffffff">
  <td width="8%">Street Name: </td>
  <td>
  <textarea rows="3" name="newstreet[streetname]" cols="50"></textarea><br />
<div style="margin-top:3px">The system supports adding streets by batches. To do it, separate each street with space.<br />
<font color="red">Example: Street1 Street2 Street3 Street4 Street5</font></div></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sort Streets: </td>
  <td><input name="newstreet[displayorder]" class="txt" type="text" value="0"></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="提交" class="mymps large"/>
&nbsp;&nbsp;
</center>
</form>
<?php } elseif($cityid) {?>
<div>Current Position: <span><a href="area.php">Sub-site for City</a> &raquo; <?php echo $currentname; ?></span></div>
<div class="clear"></div>
<form action="?" method="post">
<input name="cityid" value="<?=$cityid?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
        <tr class="firstr">
          <td width="5%"><label><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/>Delete?</label></td>
          <td>Name</td>
          <td>Sort</td>
          <td>Operate</td>
        </tr>
    <?php 
    if($list){
    foreach($list AS $area)
    {
    ?>
        <tr bgcolor="#ffffff">
        <td><label><input type='checkbox' name='deleteareaid[]' value='<?=$area[areaid]?>' class='checkbox'></label></td>
          <td align="left"><input name="updatearea_areaname[<?=$area[areaid]?>]" value="<?=$area[areaname]?>" class="txt" style="width:100px"> </td>
          <td><input name="updatearea_displayorder[<?=$area[areaid]?>]" value="<?=$area[displayorder]?>" class="txt" type="text"/></td>
          <td><a href="?part=list&areaid=<?=$area[areaid]?>&cityid=<?=$cityid?>&cityname=<?=$currentname?>">Subordinate Street/Road</a></td>
        </tr>
    <?
    }
    } else {
    ?>
        <tr bgcolor="#ffffff">
          <td colspan="5" bgcolor="#ffffff"><div class="nodata">For this Sub-site,  <span><?php echo $currentname; ?></span>no districts has been affiliated to it.<br />
<br />Return to<a href="area.php">the Previous Page</a></div></td>
        </tr>
    <?}?>
    </table>
</div>
<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>
</form>
<div class="clear" style="margin-top:5px"></div>
<form method=post name="form" action="?">
<input name="newarea[cityid]" value="<?=$cityid?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td colspan="2" align="left">Add District  <span><?=$currentname?></span>for Sub-site</td>
</tr>
<tr bgcolor="#ffffff">
  <td width="8%">District Name: </td>
  <td>
  <textarea rows="3" name="newarea[areaname]" cols="50"></textarea><br />
<div style="margin-top:3px">The system supports adding districts by batches. To do it, separate each district with Space.<br />
<font color="red">Example:  District 1|District 2|Disterict 3|District 4|District 5</font></div></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sort Districts: </td>
  <td><input name="newarea[displayorder]" class="txt" type="text" value="1"></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit" class="mymps large"/>
&nbsp;&nbsp;
</center>
</form>
<?php }?>
</div>
<?php mymps_admin_tpl_global_foot();?>
