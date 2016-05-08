<?php mymps_admin_tpl_global_head();?>

<style>

.ttip{ color:#666; margin-top:5px; text-align:left}

</style>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

<div class="mpstopic-category">

	<div class="panel-tab">

		<ul class="clearfix tab-list">

			<li><a href="?part=bbs" <?php if($part == 'bbs'){?>class="current"<?php }?>>Forum Integrating</a></li>

			<li><a href="?part=qqlogin" <?php if($part == 'qqlogin'){?>class="current"<?php }?>>QQ��¼��� (�й�Ԫ��)</a></li>

		</ul>

	</div>

</div>

</div>



<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Note</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

<li><?php if($part == 'bbs'){?>If a third party system is to be Integrate d into the system, please make sure the configuration is done correctly, otherwise users may not be able to register or log-in Mymps successfully!<?php }else {?>���㿪ͨQQ�ʺ�(�й�Ԫ��,�������ú���ȷ���Ƿ���)��¼���֮ǰ�뵽 <a href="http://opensns.qq.com/login?from=http://connect.opensns.qq.com/apply" target="_blank" style="text-decoration:underline">http://opensns.qq.com/login?from=http://connect.opensns.qq.com/apply</a>Apply to Obtain APPID, APPKEY and CALLBACK Address<?}?></li>

    </td>

  </tr>

</table>

</div>



<form method="post" action="?">

<input name="part" value="<?=$part?>" type="hidden">

<?php if($part == 'bbs'){?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr"><td colspan="2">Configuration<?php echo $here; ?></td></tr>

<tr bgcolor="#ffffff" style="font-weight:bold">

<td width="25%" style=" text-align:right;">

Select Integrating  Service:   &nbsp;&nbsp;

</td>

<td>

<label for="none"><input name="passport_type" type="radio" class="radio" id="none" value="none" onclick='$("uc_div").style.display = "none";' <?php if($selected == 'none'){echo 'checked';}?>>Do Not Integrate Third Party Forum</label> 

<label for="ucenter"><input class="radio" name="passport_type" type="radio" id="ucenter" value="ucenter" onclick='$("uc_div").style.display = "";$("client").innerHTML=$("server").innerHTML="ucenter";' <?php if($selected == 'ucenter'){echo 'checked';}?>>Integrate ucenter1.6</label>

<label for="phpwind"><input class="radio" name="passport_type" type="radio" id="phpwind" value="phpwind" onclick='$("uc_div").style.display = "";$("client").innerHTML=$("server").innerHTML="phpwind";' <?php if($selected == 'phpwind'){echo 'checked';}?>>Integrate phpwind 8.x</label>

</td>

</tr>

<tbody id="uc_div" <?php if($selected == 'none'){echo 'style="display:none"';}?>>

<tr style="background-color:#f1f5f8;">

  <td height=25 style="text-align:right"><b><span id="client"><?php echo $selected; ?></span>App Settings: </b></td>

  <td>&nbsp;</td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height="25" style="text-align:right">Server API URL��</td>

  <td><input name="ucsettings[uc_api]" type=text id="uc_api" value="<?=$ucsettings[uc_api]?>" class="text">

  <font color="red"> *</font><div class="ttip">Please consider making changes only when the address or directory of the server has changed.<br />If it is to be changed, please change in form of http://www.site.com/ucenter (Please do not type a / at the end). </div></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Cipher Code for Communication: </div>

  </td>

  <td><input name="ucsettings[uc_key]" type=text id="uc_key" value="<?=$ucsettings[uc_key]?>" class="text">

    <font color="red"> *</font><div class="ttip">Please use only English letters and numbers and make sure the length is 64 bytes.<br />The cipher code for communication on the app must go with the settings here, or the app will not be able to communicate with UCenter successfully.</div></td>

</tr>

<tr bgcolor=#FFFFFF>

	<td height=25><div align="right">ucenter and mymps are on: </div></td>

    <td>      

    <select name="ucsettings[uc_connect]">

        <option value="mysql" selected="selected"> Same Server </option>

		<option value="NULL" selected="selected"> Different Servers </option>

    </select>

    <font color="red">*</font>    </td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">IP Address of the Local Client App: </div></td>

  <td><input name="ucsettings[uc_appid]" type=text id="uc_appid" value="<?=$ucsettings[uc_appid]?>" class="text"> <font color="red">*</font></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">IP Address of the Local Client: </div>

  </td>

  <td><input name="ucsettings[uc_ip]" type=text id="uc_ip" value="<?=$ucsettings[uc_ip]?>" class="text"><div class="ttip">

This is usually left blank. But should the server failed to create connection to this app due to domain name analysis, please set it as the IP address of the server serving the app.</div></td>

</tr>

<tr style="background-color:#f1f5f8;">

  <td height=25 style="text-align:right"><b><span id="server"><?php echo $selected; ?></span>Database Parameter Settings: </b></td>

  <td>&nbsp;</td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Database Main Frame Name: </div>

    </td>

  <td><input name="ucsettings[uc_dbhost]" type=text id="uc_dbhost" value="<?=$ucsettings[uc_dbhost] ? $ucsettings[uc_dbhost] : 'localhost'?>" class="text">

    <font color="red">*</font><div class="ttip">Default: localhost. If MySQL port is not 3306 (default), please input as follows: 127.0.0.1:6033</div></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Database Name: </div></td>

  <td><input name="ucsettings[uc_dbname]" type=text id="uc_dbname" value="<?=$ucsettings[uc_dbname]?>" class="text">

    <font color="red">*</font></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Database User ID: </div></td>

  <td><input name="ucsettings[uc_dbuser]" type=text id="uc_dbuser" value="<?=$ucsettings[uc_dbuser]?>" class="text">

    <font color="red">*</font></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Database Password: </div></td>

  <td><input name="ucsettings[uc_dbpwd]" type=password id="uc_dbpwd" value="<?=$ucsettings[uc_dbpwd]?>" class="text">

    <font color="red">*</font></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Data Table Prefix: </div></td>

  <td><input name="ucsettings[uc_dbpre]" type=text id="uc_dbpre" value="<?=$ucsettings[uc_dbpre]?>" class="text">

    <font color="red">*</font>

    <div class="ttip">Prefix used in database table on UC server, usually UC_ <br />

      Prefix used in database table on PHPWIND server, usually pw_ </div></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Database Character Library: </div></td>

  <td><input name="ucsettings[uc_charset]" type=text id="uc_charset" value="<?=$ucsettings[uc_charset]?>" class="text">

    <font color="red">*</font><div class="ttip">Please enter coding of the database on server: GBK or UT8.</div></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">UCenter/phpwind Character Coding: </div></td>

  <td><input name="ucsettings[uc_dbcharset]" type=text id="uc_dbcharset" value="<?=$ucsettings[uc_dbcharset]?>" class="text">

    <font color="red">*</font><div class="ttip">Please enter coding of the database on server: GBK or UT8.</div></td>

</tr>

</tbody>

</table>

</div>

<?php } else {?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr"><td colspan="2">����QQ��¼����(�й�Ԫ��)</td></tr>

<tr bgcolor="#ffffff" style="font-weight:bold">

<td width="25%" style=" text-align:right; background-color:#f7f7f7">

�Ƿ���QQ��¼���(�й�Ԫ��)��

</td>

<td style="background-color:#f7f7f7">

<label for="open"><input name="qqsettings[open]" type="radio" class="radio" id="open" value="1" onclick='$("qqdetail").style.display = "";' <?php if($qqsettings['open'] == 1){echo 'checked';}?>>����</label> 

<label for="close"><input class="radio"  name="qqsettings[open]" type="radio" id="close" value="0" onclick='$("qqdetail").style.display = "none";' <?php if(!$qqsettings['open']){echo 'checked';}?>>�ر�</label>

</td>

</tr>

<tbody id="qqdetail" <?php if(!$qqsettings['open']){?>style="display:none;"<?php }?>>

<tr bgcolor=#FFFFFF>

  <td height=25 width="25%" ><div align="right">Obtained Appid: </div></td>

  <td><input name="qqsettings[appid]" type=text id="appid" value="<?=$qqsettings[appid]?>" class="text">

  <font color="red"> *</font></td>

</tr>

<tr bgcolor=#FFFFFF>

  <td height=25><div align="right">Obtained Appkey: </div></td>

  <td><input name="qqsettings[appkey]" type=text id="appkey" value="<?=$qqsettings[appkey]?>" class="text">

    <font color="red"> *</font></td>

</tr>

<tr bgcolor=#FFFFFF>

	<td height=25><div align="right">Callback Address: </div><div class="ttip">QQ��¼�ɹ�����ת�ĵ�ַ����ȷ����ַ��ʵ���ã�����ᵼ�µ�¼ʧ�ܡ�(�й�Ԫ��)</div></td>

    <td>      

    <input name="qqsettings[callback]" type=text id="callback" value="<?=$qqsettings[callback] ? $qqsettings[callback] : $mymps_global[SiteUrl].'/include/qqlogin/qq_callback.php'?>" class="text">

    <font color="red"> *</font></td>

</tr>

</tbody>

</table>

</div>

<?php }?>

<center><input type="submit" value="Submit" class="mymps large" name="passport_submit"/>  </center>

</form>

<?php mymps_admin_tpl_global_foot();?>

