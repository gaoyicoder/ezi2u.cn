<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Instruction</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
		<li>
	    Data sheet optimization can rid data files of fragments, making the recording more compacted and accelerating reading/writing process.</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
<div class="mpstopic-category">
	<div class="panel-tab">
		<ul class="clearfix tab-list">
			<li><a href="?part=optimize" <?php if($part == 'optimize'){?>class="current"<?php }?>>Database Optimization</a></li>
			<li><a href="?part=check" <?php if($part == 'check'){?>class="current"<?php }?>>Database Checking</a></li>
			<li><a href="?part=repair" <?php if($part == 'repair'){?>class="current"<?php }?>>Database Restoration</a></li>
			<li><a href="data_replace.php">Database Content Change</a></li>
		</ul>
	</div>
</div>
</div>
<form action="?part=check" method="post">
<input name="action" value="do_action" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td width="70"><label for="chkall"><input name="chkall" id="chkall" class="checkbox"  onclick="AllCheck('prefix', this.form)" checked="checked" type="checkbox" />Check?</label></td><td>Data Sheet</td><td>Type</td><td>Number of Recordings</td><td>Data</td><td>Index</td><td>Fragments</td></tr>
<?php
foreach($tablearray as $tp) {
    $query = $db->query("SHOW TABLE STATUS LIKE '$tp%'", 'SILENT');
    while($table = $db->fetchRow($query)) {
        if($table[$tabletype] == 'MyISAM') {
            $checked = $table[$tabletype] == 'MyISAM' ? 'checked' : 'disabled';
?>
<tr bgcolor="#ffffff"><td><input class="checkbox" type="checkbox" name="optimizetables[]" value="<?=$table[Name]?>" <?=$checked?>></td><td><?=$table[Name]?></td><td><?=$table[$tabletype]?></td><td><?=$table[Rows]?></td><td><?=$table[Data_length]?></td><td><?=$table[Index_length]?></td><td><?=$table[Data_free]?></td></tr>
<?php
        }
    }
}
?>
</table>
</div>

<center><input type="submit" name="check_submit" value="Submit" class="mymps large"/></center>

</form>
<?php mymps_admin_tpl_global_foot();?>
