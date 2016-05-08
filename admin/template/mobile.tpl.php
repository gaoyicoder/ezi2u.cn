<?php mymps_admin_tpl_global_head();?>

<style>

.vtop{ background-color:#ffffff}

.smalltxt{ font-size:12px!important; color:#999!important; font-weight:100!important}

.altbg1{ background-color:#f1f5f8; width:45%;}

</style>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Hints</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

	<li>The directory of logo file for mobile version of site is <font color="red">/m/template/waplogo.jpg</font>in the root directory. You may replace the image, but always make sure that the name of the image file is waplogo.jpg.

The size of the image is<font color="red">111*26</font></li>

    </td>

  </tr>

</table>

</div>

<form method="post" action="?">

<input name="return_url" value="<?php echo GetUrl();?>" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr"><td colspan="2">Overall Settings for Mobile Version of Site</td></tr>

    <tbody style="display: yes; background-color:white">

        <tr>

            <td class="altbg1" ><b>Mobile Version On:</b><br /><span class="smalltxt">When this is on, users are able to access the mobile version of the site</span></td><td class="altbg2">

			<label for="allowmobile1"><input class="radio" type="radio" name="settings[allowmobile]" value="1" id="allowmobile1" onclick="$('hidden_settings_mobile').style.display = '';" <? if($mobile[allowmobile] == 1) echo 'checked';?>> On</label> &nbsp; &nbsp; 

            <label for="allowmobile0"><input class="radio" type="radio"  name="settings[allowmobile]" value="0" id="allowmobile0" onclick="$('hidden_settings_mobile').style.display = 'none';" <? if(empty($mobile[allowmobile])) echo 'checked';?>> Off</label>

            </td>

        </tr>

    <tbody>

    <tbody id="hidden_settings_mobile" style="background-color:white;<?php if(empty($mobile[allowmobile])) echo 'display:none;'?>">

		<tr>

			<td class="altbg1" ><b>Direct Viewers to Sub-site Selecting Page:</b><br /><span class="smalltxt">If this is on, viewers will be directed to sub-site selection page the first time they visit.</span></td><td class="altbg2"><label for="changecity1"><input class="radio" type="radio" name="settings[changecity]" value="1" id="changecity1" <?php if($mobile[changecity] == 1){echo 'checked';} ?>> On</label> &nbsp; &nbsp; 

			<label for="changecity0"><input value="0" id="changecity0" class="radio" type="radio"  name="settings[changecity]" <?php if(empty($mobile[changecity])){echo 'checked';} ?>> Off</label>

			</td>

		</tr>

		<tr>

			<td class="altbg1" ><b>Automatic Jump For Mobile Browsers:</b><br /><span class="smalltxt">When this is on, the site will automatically direct viewers using mobile browsers to site homepage if they try to view pages other than function pages of the site.<br /><font color="red">But you must make sure beforehand that the file index.html in root directory is deleted!</font></span></td><td class="altbg2"><label for="autorefresh1"><input class="radio" type="radio" name="settings[autorefresh]" value="1" id="autorefresh1" <?php if($mobile[autorefresh] == 1){echo 'checked';} ?>> On</label> &nbsp; &nbsp; 

			<label for="autorefresh0"><input class="radio" type="radio"  name="settings[autorefresh]" value="0" id="autorefresh0" <?php if(empty($mobile[autorefresh])){echo 'checked';} ?>> Off</label>

			</td>

		</tr>

		<tr>

			<td class="altbg1" ><b>Allow Registration Through Mobile Version:</b><br /><span class="smalltxt">When this is on, users can register through the mobile version of the site.<br />But be cautious: registration process on the mobile version will NOT check on the compulsory information providence like the PC version does.</span></td><td class="altbg2"><label for="register1"><input class="radio" type="radio" name="settings[register]" value="1" id="register1" <?php if($mobile[register] == 1){echo 'checked';} ?>> On</label> &nbsp; &nbsp; 

			<label for="register0"><input class="radio" type="radio"  name="settings[register]" value="0" id="register0" <?php if(empty($mobile[register])){echo 'checked';} ?>> Off</label>

			</td>

		</tr>

		<tr>

			<td class="altbg1" ><b>Enable Posting Through Mobile Version:</b><br /><span class="smalltxt">When this is on, users will be able to make post using the mobile version of the site.<br />Please decide with caution.</span></td><td class="altbg2"><label for="post1"><input class="radio" type="radio" name="settings[post]" value="1" id="post1" <?php if($mobile[post] == 1){echo 'checked';} ?>> On</label> &nbsp; &nbsp; 

			<label for="post0"><input class="radio" type="radio"  name="settings[post]" value="0" id="post0" <?php if(empty($mobile[post])){echo 'checked';} ?>> Off</label>

			</td>

		</tr>

		<tr>

			<td class="altbg1" ><b>Identifying Code On/Off:</b><br /><span class="smalltxt">If this is off, then registration, log-in and posting using the mobile version will not ask the user to go though identifying code check.</span></td><td class="altbg2"><label for="authcode1"><input class="radio" type="radio" name="settings[authcode]" value="1" id="authcode1" <?php if($mobile[authcode] == 1){echo 'checked';} ?>> On</label> &nbsp; &nbsp; 

			<label for="authcode0"><input value="0" id="authcode0" class="radio" type="radio"  name="settings[authcode]" <?php if(empty($mobile[authcode])){echo 'checked';} ?>> Off</label>

			</td>

		</tr>

		<tr>

			<td class="altbg1" ><b>Number of Themes Displayed on Each Page:</b><br /><span class="smalltxt">The number of themes displayed on the theme list page. We recommend that it is set to be 10</span></td><td class="altbg2"><input name="settings[mobiletopicperpage]" value="<?php echo $mobile[mobiletopicperpage] ? $mobile[mobiletopicperpage] : 10 ;?>" type="text" class="txt"   />

			</td>

		</tr>

		<tr>

			<td class="altbg1" ><b>Domain Name For Mobile Version:</b><br /><span class="smalltxt">Like http://wap.mymps.com.cn<br />This requires that you bind the designated second-level domain name to a /wap directory</span></td><td class="altbg2"><input name="settings[mobiledomain]" type="text" class="text" value="<?php echo $mobile[mobiledomain]; ?>"/>

			</td>

		</tr>

    </tbody>

</table>

</div>

<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

