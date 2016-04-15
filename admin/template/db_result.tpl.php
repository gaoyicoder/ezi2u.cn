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
			<li><a href="?part=repair" <?php if($part == 'repair'){?>class="current"<?php }?>>Database Repairing</a></li>
			<li><a href="data_replace.php">Database Content Change</a></li>
		</ul>
	</div>
</div>
</div>
<?php if($part == 'optimize'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td>Data Sheet</td><td>Type</td><td>Number of Recordings</td><td>Data</td><td>Index</td><td>Fragments</td></tr>
<?php

foreach($tablearray as $tp) {
    $query = $db->query("SHOW TABLE STATUS LIKE '$tp%'", 'SILENT');
    while($table = $db->fetchRow($query)) {
        if(is_array($optimizetables) && in_array($table['Name'], $optimizetables)) {
            if($part == 'optimize') {
				$db->query("OPTIMIZE TABLE $table[Name]");
			} elseif($part == 'check'){
				$db->query("CHECK TABLE $table[Name]");
			} elseif($part == 'repair'){
				$db->query("REPAIR TABLE $table[Name]");
			}
        }
?>
<tr bgcolor="#ffffff"><td><?=$table[Name]?></td><td><?=$table[$tabletype]?></td><td><?=$table[Rows]?></td><td><?=$table[Data_length]?></td><td><?=$table[Index_length]?></td><td><?=$table[Data_free]?></td></tr>
<?php
         $totalsize += $table['Data_length'] + $table['Index_length'];
    }
}
?>
<tr bgcolor="#ffffff">
	<td colspan="7"><?=sizecount($totalsize)?></td>
</tr>
</table>
</div>
<?php }elseif($part == 'check'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td>Checking</td><td>Data Sheet</td><td>Type</td><td>Number of Recordings</td><td>Data</td><td>Index</td></tr>
<?php

foreach($tablearray as $tp) {
    $query = $db->query("SHOW TABLE STATUS LIKE '$tp%'", 'SILENT');
    while($table = $db->fetchRow($query)) {
        if(is_array($optimizetables) && in_array($table['Name'], $optimizetables)) {
            $db->query("CHECK TABLE $table[Name]");
       
?>
<tr bgcolor="#ffffff"><td><font color="green">³É¹¦</font></td><td><?=$table[Name]?></td><td><?=$table[$tabletype]?></td><td><?=$table[Rows]?></td><td><?=$table[Data_length]?></td><td><?=$table[Index_length]?></td></tr>
<?php
	 }
    }
}
?>
</table>
</div>
<?php }elseif($part == 'repair'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td>Repairing</td><td>Data Sheet</td><td>Type</td><td>Number of Recordings</td><td>Data</td><td>Index</td></tr>
<?php

foreach($tablearray as $tp) {
    $query = $db->query("SHOW TABLE STATUS LIKE '$tp%'", 'SILENT');
    while($table = $db->fetchRow($query)) {
        if(is_array($optimizetables) && in_array($table['Name'], $optimizetables)) {
            $db->query("REPAIR TABLE $table[Name]");
        
?>
<tr bgcolor="#ffffff"><td><font color="green">Success</font></td><td><?=$table[Name]?></td><td><?=$table[$tabletype]?></td><td><?=$table[Rows]?></td><td><?=$table[Data_length]?></td><td><?=$table[Index_length]?></td></tr>
<?php
		}
    }
}
?>
</table>
</div>
<?php }?>
<?php mymps_admin_tpl_global_foot();?>
