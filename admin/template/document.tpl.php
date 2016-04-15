<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="document.php?do=document" <?php if($do == 'document'){?>class="current"<?php }?>>Posted Files</a></li>
				<li><a href="document.php" <?php if($do == 'type'){?>class="current"<?php }?>>File Module Management</a></li>
			</ul>
		</div>
	</div>
</div>

<form action="document.php" method="post">
<input name="forward_url" type="hidden" value="<?=GetUrl()?>">
<input name="do" type="hidden" value="docu">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm" >
  <tr class="firstr">
    <td width="50"><input name="checkall" type="checkbox" id="checkall" onclick="CheckAll(this.form)" class="checkbox"/>Delete?</td>
    <td>ID</td>
    <td>File Title</td>
    <td width="100">Member Name</td>
    <td width="100">Author</td>
    <td>Source</td>
    <td>File Status</td>
    <td>Date of Post</td>
  </tr>
<tbody onmouseover="addMouseEvent(this);">
<?php foreach($docu AS $row){?>
    <tr bgcolor="white" >
    <td><input type='checkbox' name='delids[]' value='<?=$row[id]?>' class='checkbox' id="<?=$row[id]?>"></td>
    <td><?=$row[id]?></td>
    <td align="left"  width="120"><a href="../store.php?user=<?=$row[userid]?>&part=document&id=<?=$row[id]?>" target="_blank" title="<?=$row[title]?>"><?=substring($row[title],0,15)?></a></td>
    <td><?=$row[userid]?></td>
    <td><?=$row[author]?></td>
    <td><?=$row[source]?></td>
    <td><?=$row[if_check]?></td>
    <td><em><?=GetTime($row[pubtime])?></em></td>
  </tr>
<?}?>
</tbody>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" name="document_submit"/></center>
</form>
<div class="pagination"><?php echo page2();?></div>
<?php mymps_admin_tpl_global_foot();?>
