<?php mymps_admin_tpl_global_head();?>
<form method="post" name="form1" action="?">
<input name="cityid" value="<?php echo $cityid?>" type="hidden">
<input name="cityedit[olddirectory]" value="<?php echo $city['directory']?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td colspan="2" align="left"><span><a href="area.php" style="text-decoration:underline">Districts With Sub-site</a> &raquo; <?=$city['cityname']?></span></td>
</tr>
<tr>
  <td colspan="5" bgcolor="#f6ffdd">
For multiple sub-sites, if second-level domain is to be applied, It will be required that extensive domain name analysis be employed to direct the second-level domain names to the current server (such as *. mymps.com.cn ). Domain names that are extensively analyzed must begin with * , and after all settings are done, the server must be restarted to enable the second-level domain name.
  </td>
</tr>
<tr bgcolor="#ffffff">
  <td width="15%" valign="top">From Region: </td>
  <td>
  <select name="cityedit[provinceid]">
  <option value="0" <?php if($v['provinceid'] == 0) echo 'selected'; ?>>Individual</option>
  <?php if(is_array($province)){foreach($province as $k => $v){?>
  <option value="<?=$v[provinceid]?>" <?php if($v['provinceid'] == $city['provinceid']) echo 'selected'; ?>><?=$v[provincename]?></option>
  <?php }}?>
  </select></td>
</tr>
<tr bgcolor="#ffffff">
  <td width="15%" valign="top">Sub-site (for City) Name: </td>
  <td><input name="cityedit[cityname]" class="text" type="text" value="<?=$city['cityname']?>">
  <font color="red">*</font>
  <div style="color:#666; margin-top:5px">like: Beijing</div></td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Name of City in English: </td>
  <td><input name="cityedit[citypy]" class="text" type="text" value="<?=$city['citypy']?>"> <font color="red">*</font><div style="color:#666; margin-top:5px">Like:  <font style="text-decoration:underline">beijing</font><br />It must consist only of letters/numbers/underlines, and no special characters are allowed.</div> </td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Initials: </td>
  <td><input name="cityedit[firstletter]" class="txt" type="text" value="<?=$city['firstletter']?>"> 
  <font color="red">*</font>
  <div style="color:#666; margin-top:5px">Like: b</div></td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Directory Name: </td>
  <td><input name="cityedit[directory]" class="text" type="text" value="<?=$city['directory']?>"> <font color="red">*</font>
   <div style="color:#666; margin-top:5px">Like : bj.<br />It must consist only of letters/numbers/underlines, and no special characters are allowed; otherwise the sub-site may not be successfully accessed.<br />
<font color="red">After a sub-site is successfully set up, you can use &nbsp; <b style="color:#006acd; text-decoration:underline"><?php echo $mymps_global['SiteUrl']?><?php echo $mymps_global['cfg_citiesdir']; ?>/bj/</b> &nbsp;to access it.</font></div> </td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Second-level Domain Name: </td>
  <td><input name="cityedit[domain]" class="text" type="text" value="<?=$city['domain']?>"> <font>Please remember to end it with"/"</font><div style="color:#666; margin-top:5px">
  Like : http://bj.mymps.com.cn/
  <br />You may set a second-level domain and bind it to the directory. The binding could only be done on the server with domain name administrator setting the pointer.
  <br /><font color="red">After you have typed in the second-level domain, you may use &nbsp; <b style="color:#006acd; text-decoration:underline">http://bj.mymps.com.cn/</b> &nbsp;to access this sub-site.</font></div></td>
</tr>
<tr bgcolor="#ffffff">
  <td>Mark the Initial Coordinates on the Map: </td>
  <td><input name="cityedit[mappoint]" id="mappoint" type="text" class="text" value="<?=$city['mappoint']?>"/><input name="markmap" type="button" class="gray mini" value="I Want to Mark" onclick="javascript:setbg('Mark on the Map',500,300,'../map.php?action=markpoint&width=500&height=230&title=default_map_point&p=<?=$city['mappoint']?>&cityname=<?=$city[citypy]?>')"/>
  <div style="color:#666; margin-top:5px; line-height:25px;">
	<i>(1).</i>If the marking is not successful, please check your <a href="config.php">Map Marking Port</a>to make sure that the settings are correct.<br />
	<i>(2).</i>If<b> the default 51ditu</b>port is applied, and the added city is within this country, then marking initial coordinate will not be possible (you may simply leave it blank). The system will automatically mark the coordinates <font color="red">(Important).</font>
</div></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Order of Cities: </td>
  <td><input name="cityedit[displayorder]" class="txt" type="text" value="<?=$city['displayorder']?>"></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Favourite Cities? </td>
  <td><input name="cityedit[ifhot]" class="checkbox" type="checkbox" value="1" <?php if($city['ifhot'] == 1) echo 'checked'; ?>></td>
</tr>
<tr class="firstr">
  <td colspan="5">
	SEO Optimization Settings
  </td>
</tr>
<tr bgcolor="#ffffff">
  <td >Title of Sub-site Display: </td>
  <td><input name="cityedit[title]" class="text" type="text" value="<?=$city['title']?>"></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sub-site Keywords: </td>
  <td><textarea name="cityedit[keywords]" style="width:500px; height:100px"><?=$city['keywords']?></textarea></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sub-site Description: </td>
  <td><textarea name="cityedit[description]" style="width:500px; height:100px"><?=$city['description']?></textarea></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit" class="mymps large"/>
&nbsp;&nbsp;
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
