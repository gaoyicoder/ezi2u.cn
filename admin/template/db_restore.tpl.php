<?php mymps_admin_tpl_global_head();?>

<script type='text/javascript' src='js/vbm.js'></script>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Instruction</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

<li>Restoring backup data will meanwhile delete corresponding existing files!!!!</li>

<li>Backup file restoration can only restore files backed-up from the system to be restored.</li>

<li>Restoring from local host requires that the server allows uploading and that the backup file does not exceed the size limit of upload files.</li>

<li>If you import files by volume to File Volume 1 then all other data on the volume will also be imported.</li>

    </td>

  </tr>

</table>

</div>

<form name="cpform" method="post" action="?part=restore&action=dodelete">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td width="50"><input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="CheckAll(this.form)" /><label for="chkall">Delete?</label></td>

<td>File Name</td>

<td>Version</td>

<td>Date</td>

<td>Type</td>

<td>Size</td>

<td>Number of Volumes</td>

<td>&nbsp;</td>

</tr>



<?php

foreach($exportlog as $key => $val) {

    $info = $val[1];

    $info['dateline'] = is_int($info['dateline']) ? GetTime($info['dateline']): 'Unknown';

    $info['size'] = sizecount($exportsize[$key]);

    $info['volume'] = count($val);

    $info['method'] = $info['method'] == 'multivol' ? $lang['db_multivol'] : $lang['db_shell'];

?>

<tr bgcolor="#ffffff">

<td  width="40"><input class="checkbox" type="checkbox" name="delete[]" value="<?=$key?>"></td>

<td><a href="javascript:;" onclick="javascript:blocknone('exportlog_<?=$key?>')"><img id="menuimg_1" src="template/images/menu_add.gif" align="absmiddle"/> <?=$key?></a></td>

<td><?=$info['version']?></td>

<td><?=$info['dateline']?></td>

<td><?=$backuptype[$info['type']]?></td>

<td><?=$info['size']?></td>

<td><?=$info['volume']?></td>

<td><?php echo "<a class=\"act\" href=\"?part=restore&from=server&datafile_server=$info[filename]&action=dorestore\"".($info['version'] != $version ? " onclick=\"return confirm('The version of the system from which the backup files are made is different from the current version of your system.');\"" : '')." class=\"act\">Import</a>"?></td>

</tr>

<tbody id="exportlog_<?=$key?>" style="display:none">

<?php foreach($val as $v) {

 $v['dateline'] = is_int($v['dateline']) ? GetTime($v['dateline']) : 'Unknown';

 $v['size'] = sizecount($v['size']);

?>

<tr bgcolor="#ffffff"><td>&nbsp;</td><td><i style="color:#666"><?=substr(strrchr($v['filename'], "/"), 1)?></i></td><td><i style="color:#666"><?=$v['version']?></i></td><td><i style="color:#666"><?=$v['dateline']?></i></td><td><i style="color:#666"><?=$backuptype[$v['type']]?></i></td><td><i style="color:#666"><?=$v['size']?></i></td><td><i style="color:#666"><?=$v['volume']?>#</i></td><td>&nbsp;</td></tr>

<?

	}

?>

</tbody>

<?

}

?>

</table>

</div>

<center>

  <input type="submit" name="submit" value="Submit" class="mymps large"/>

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

