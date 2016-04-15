<?php mymps_admin_tpl_global_head();?>
<script language=javascript>
function chkform(){
	if(document.form.areaname.value==""){
		alert('The system supports adding districts by batches. To do it, separate each district with | .');
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
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?part=area_city_add" class="current">Add A Sub-site</a></li>
				<li><a href="?part=area_city_add&action=batch">Add Sub-site by Batches</a></li>
            </ul>
        </div>
    </div>
</div>
<div style="display:none;">
    <iframe width=0 height=0 src='' id="iframe_t" name="iframe_t"></iframe> 
    <form method="post" target="iframe_t" id="form_t"></form>
</div>
<form method=post onSubmit="return chkform()" name="form" action="?">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td colspan="2" align="left">Add Sub-site for City</td>
</tr>
<tr>
  <td colspan="5" bgcolor="#f6ffdd">
For multiple sub-sites, if second-level domain is to be applied, It will be required that extensive domain name analysis be employed to direct the second-level domain names to the current server (such as *. mymps.com.cn ). Domain names that are extensively analyzed must begin with * , and after all settings are done, the server must be restarted to enable the second-level domain name.
  </td>
</tr>
<tr bgcolor="#ffffff">
  <td width="15%" valign="top">From Region: </td>
  <td>
  <select name="citynew[provinceid]">
  <option value="0">Individual</option>
  <?php if(is_array($province)){foreach($province as $k => $v){?>
  <option value="<?=$v[provinceid]?>"><?=$v[provincename]?></option>
  <?php }}?>
  </select></td>
</tr>

<tr bgcolor="#ffffff">
  <td width="15%" valign="top">City Name </td>
  <td><input name="citynew[cityname]" id="newcityname" onBlur="getpinyinhead(this.value);" class="text" type="text"> <font color="red">*</font><div style="color:#666; margin-top:5px">like: Berjing</div></td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Sub-site Storage Directory Name: </td>
  <td><input id="newdirectory" onBlur="document.getElementById('newfirstletter').value=this.value.substring(0,1);document.getElementById('newdomain').value='http://'+this.value+'<?php echo str_replace('http://www','',$mymps_global[SiteUrl]).'/'; ?>';getpinyin(document.getElementById('newcityname').value);" name="citynew[directory]" class="text" type="text" value=""> <font color="red">*</font><div style="color:#666; margin-top:5px">Из: <font style="text-decoration:underline">bj</font>, must consist only of letters/numbers/underlines. No special characters are allowed; otherwise the sub-site may not be successfully accessed.<br />
<font color="red">After a sub-site is successfully set up, you can use &nbsp; <b style="color:#006acd; text-decoration:underline"><?php echo $mymps_global['SiteUrl']?><?php echo $mymps_global['cfg_citiesdir']; ?>/bj/</b> &nbsp; to access it.</font></div> </td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Initials of the Name of the City: </td>
  <td><input id="newcitypy" name="citynew[citypy]" class="text" type="text" value=""> <font color="red">*</font><div style="color:#666; margin-top:5px">Из: <font style="text-decoration:underline">beijing</font>, must consist only of letters/numbers/underlines, and no special characters are allowed.</div> </td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Name Initials:  </td>
  <td><input id="newfirstletter" name="citynew[firstletter]" class="txt" type="text"> <font color="red">*</font><div style="color:#666; margin-top:5px">: <font style="text-decoration:underline">b</font></div></td>
</tr>
<tr bgcolor="#ffffff">
  <td valign="top">Second-level Domain Name:  </td>
  <td><input id="newdomain" name="citynew[domain]" class="text" type="text" value=""> 
 <div style="color:#666; margin-top:5px">Please remember to end it with "<font color="red">/</font>"
  : <font style="text-decoration:underline">http://beijing.mymps.com.cn/</font>
  <br /><font color="red">If you do not wish to enable second-level domain, please leave it blank.</font>
  <br />After you have typed in the second-level domain, you may use &nbsp; <b style="color:#006acd; text-decoration:underline">http://beijing.mymps.com.cn/</b> &nbsp; to access this sub-site.</div></td>
</tr>
<tr bgcolor="#ffffff">
  <td>Mark the Initial Coordinates on the Map: </td>
  <td><input name="citynew[mappoint]" value="" class="text" id="mappoint"/><input type="button" class="gray mini" value="I want to Mark" onClick="javascript:setbg('Mark On Map',500,300,'../map.php?action=markpoint&width=500&height=230&title=default_map_point&cityname='+document.getElementById('newdirectory').value+'&p=')"/>
    <div style="color:#666; margin-top:5px; line-height:25px;">
	<i>(1).</i>If the marking is not successful, please check your<a href="config.php">Map Marking Port</a>to make sure that the settings are correct.<br />
	<i>(2).</i>If<b>51ditu</b>port is applied, and the added city is within this country, then marking initial coordinate will not be possible (you may simply leave it blank). The system will automatically mark the coordinates<font color="red">(Important)</font>
</div></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Order of the Cities: </td>
  <td><input name="citynew[displayorder]" class="txt" type="text" value="<?=$db -> getOne("SELECT MAX(displayorder) FROM `{$db_mymps}city`")?>"></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Favourite Cities? </td>
  <td><input name="citynew[ifhot]" class="checkbox" type="checkbox" value="1"></td>
</tr>
<tr class="firstr">
  <td colspan="5">
	SEO Optimization Settings
  </td>
</tr>
<tr bgcolor="#ffffff">
  <td >Title of Sub-site Display:  </td>
  <td><input name="citynew[title]" class="text" type="text" value=""></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sub-site Keywords:  </td>
  <td><textarea name="citynew[keywords]" style="width:500px; height:100px"></textarea></td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sub-site Description:  </td>
  <td><textarea name="citynew[description]" style="width:500px; height:100px"></textarea></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit" class="mymps large"/>
&nbsp;&nbsp;
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
