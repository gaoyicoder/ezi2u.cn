<?php mymps_admin_tpl_global_head();?>

<script language="javascript" src="js/vbm.js"></script>

<script language="javascript">

function hide_backup_type(){

	var jumpTest = $Obj('isjump');

	var jtr = $Obj('redirecturltr');

	if(jumpTest.checked){

		jtr.style.display = "";

	} else {

		jtr.style.display = "none";

	}

}

ifcheck = false;

</script>

<style>

.dblist{ line-height:25px;}

.dblist li{ float:left; display:block; width:200px}

</style>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Instruction</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

      <li style="color:#FF6600;">Server Backup Directory is <font color="#006acd"><b><? echo $mymps_global[cfg_backup_dir]?></b></font></li>

      <li>Data Backup allows you to backup all categorized information and settings upon your request, and Backed-up files can be restored using Data Restore. </li>

      <li>Note: We recommend that data backup settings can ONLY be changed by advanced user WHEN NECESSARY. If you have not had a whole and detailed understanding of the database, please apply default settings when backing-up to prevent serious problems such as errors in backup data.

      </li>

      <li>Hexadecimal backup can ensure the completeness of the data, but will require more disk space for backup files.

      </li>

      <li>Compressing backup files helps backup files take less disk space.

      </li>

    </td>

  </tr>

</table>

</div>

<form action="?part=backup&setup=1" method="post">

<input name="action" value="doaction" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

    <td colspan="2">Data Backup Type</td>

    </tr>

    <tr bgcolor="#ffffff">

      <td width="100" class="bd_txt">Database</td>

      <td>

		<label for="mymps"><input id="mymps" name="type" type="radio" class="radio" value="mymps" checked="checked" onClick="hide_backup_type()"> All Data in Mymps</label>

      </td>

      </tr>

    <tr bgcolor="#ffffff">

      <td width="56" class="bd_txt">&nbsp;</td>

      <td>

<label for="isjump"><input name="type" type="radio" class="radio" value="custom" id="isjump" onClick="hide_backup_type()"> Customize Backup Settings</label>

</td>

    </tr>

	<tr bgcolor="#ffffff" id="redirecturltr" style="display:none">

    	<td>

         <input class="checkbox" name="chkall" onclick="CheckAll(this.form)" checked="checked" type="checkbox" id="chkalltables" /><label for="chkalltables"> Select All</label>

        </td>

        <td>

        <ul class="dblist" onmouseover="altStyle(this);">

        <?php foreach($mymps_tables as $key => $val){?>

        <li><label for="list_<?php echo $val['Name'];?>"><input type="checkbox" name="customtables[]" value="<?php echo $val['Name'];?>" class="checkbox" checked="checked" id="list_<?php echo $val['Name'];?>"/> <?php echo $val['Name'];?></label></li>

        <?php }?>

        </ul>

        </td>

     </tr>

    <tr class="firstr">

      <td class="bd_txt" colspan="2">Data Backup Settings</td>

    </tr>

	<tr bgcolor="#ffffff">

    	<td>Format of Table-creating Statement</td>

        <td>

<input class="radio" type="radio" name="sqlcompat" value="" checked>&nbsp;Default<br />

<input class="radio" type="radio" name="sqlcompat" value="MYSQL40">&nbsp;MySQL 3.23/4.0.x<br />

<input class="radio" type="radio" name="sqlcompat" value="MYSQL41">&nbsp;MySQL 4.1.x/5.x</td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td>Compulsory Character Collection</td>

        <td>

<input class="radio" type="radio" name="sqlcharset" value="" checked="checked">&nbsp;Default<br />

<input class="radio" type="radio" name="sqlcharset" value="gbk">&nbsp;GBK<br />

<input class="radio" type="radio" name="sqlcharset" value="utf8">&nbsp;UTF-8</td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td>Hexadecimal Backup</td>

        <td>

<input class="radio" type="radio" name="extendins" value="1" >&nbsp;Yes<br />

<input class="radio" type="radio" name="extendins" value="0" checked>&nbsp;No</td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td>Backup File Name</td>

        <td><input type="text" class="text" name="filename" value="<?php echo $defaultfilename; ?>" />.sql</td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td>Length Limit for Univolume Files</td>

        <td><input type="text" class="txt" name="sizelimit" value="4096" />KB</td>

    </tr>

</table>

</div>

<center><input type="submit" name="backup_submit" value="Submit" class="mymps large"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

