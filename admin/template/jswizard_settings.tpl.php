<?php mymps_admin_tpl_global_head();?>
<style>
.smalltxt{ font-size:12px!important; color:#999!important; font-weight:100!important}
.altbg1{ background-color:#f1f5f8}
</style>
<script language="javascript" src="js/vbm.js"></script>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?part=settings" class="current">Basic Settings</a></li>
                <li><a href="?">Management of Items to be invoked</a></li>
            </ul>
        </div>
    </div>
</div>
<form method="post" action="?">
<input name="return_url" value="<?php echo GetUrl();?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr"><td colspan="2">Data Invoking</td></tr>
    <tbody style="display: yes; background-color:white">
        <tr>
            <td width="45%" class="altbg1" ><b>Enable Invoking of External Data:</b><br /><span class="smalltxt">Invoking External Data helps you invoke data such as newest categorized post theme or sorting information from<?=$mymps_global['SiteName']?>in regular pages of your site. In this way, even without viewing<?=$mymps_global['SiteName']?>the viewer will still get first-hand information from<?=$mymps_global['SiteName']?>like the updated posts.</span></td><td class="altbg2"><label for="1"><input class="radio" type="radio" name="settingsnew[jsstatus]" value="1" id="1" <?php if($settings[jsstatus] == 1){echo 'checked';} ?> 
            onclick="$Obj('hidden_settings_jsstatus').style.display = '';" > Yes </label> &nbsp; &nbsp; 
            <label for="0"><input class="radio" type="radio" name="settingsnew[jsstatus]" value="0" id="0" onclick="$Obj('hidden_settings_jsstatus').style.display = 'none';" <?php if($settings[jsstatus] == 0){echo 'checked';} ?>> No</label>
            </td>
        </tr>
    <tbody>
    <tbody id="hidden_settings_jsstatus" style="background-color:white; <?php if($settings[jsstatus] == 0){echo 'display:none;';}?>">
    <tr>
        <td width="45%" class="altbg1" ><b>Cache Period for Data Invoking (in Seconds):</b><br /><span class="smalltxt">Due to the fact that some sorting and searching take up much of the system resource, the data invoking program uses cache to realize planned update of data. The default value is 1800, and we recommend that you set the value to be 900. Setting the value to 0 disables this function (and the system will be greatly burdened).</span></td><td class="altbg2"><input type="text" size="50" name="settingsnew[jscachelife]" value="<?=$settings[jscachelife]?>" class="text">
        </td>
    </tr>
    <tr>
        <td width="45%" class="altbg1" ><b>Date Format for Externally-invoked Data:</b><br />
        <span class="smalltxt">Use Y for year, m for month and d for day. Example Y/m/d means 2010/12/31 </span></td><td class="altbg2"><input type="text" size="50" name="settingsnew[jsdateformat]" value="<?=$settings[jsdateformat]?>" class="text">
        </td>
    </tr>
    <tr>
        <td width="45%" class="altbg1" valign="top"><b>Limit On Exterior invokers of Data:</b><br /><span class="smalltxt">In order to prevent excessive invoking of data on<?=$mymps_global['SiteName']?>(this will burden your server greatly), you may take advantage of this setting and limit invoker of data on <?=$mymps_global['SiteName']?>to only those on the list. This means only invokers on the list will be able to invoke data on<?=$mymps_global['SiteName']?> .When listing, please make sure that each URL takes up one line and no asterisk wildcards, http:// or other non-domain-name contents are input in this setting. If you leave the list empty, it means that all websites can invoke data on your site.</span></td>
        <td class="altbg2"><textarea  rows="6" name="settingsnew[jsrefdomains]" id="settingsnew[jsrefdomains]" cols="50"><?php echo $settings[jsrefdomains]?></textarea></td></tr>
    </tbody>
</table>
</div>
<center><input class="mymps large" value="Submit" name="<?=CURSCRIPT?>_submit" type="submit"></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
