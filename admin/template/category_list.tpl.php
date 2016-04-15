<?=mymps_admin_tpl_global_head()?>
<form name="form_mymps" action="?part=list" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
      <td>Number</td>
      <td width="60"><input name="chkall" type="checkbox" onclick="AllCheck('prefix', this.form, 'if_viewids')" class="checkbox"/>Apply?</td>
	  <td width="60">Sorting Order</td>
      <td>Name</td>
      <td>Operation</td>
      <td>&nbsp;</td>
    </tr>
<?php
foreach($f_cat AS $cat)
{
?>
  <tr <?php if($cat['level'] == 0){?>bgcolor="#f5fbff" <?}else{?>  bgcolor="#ffffff" <?}?>>
  <td width="40"><?=$cat[catid]?></td>
  <td><input id="<?=$cat[catid]?>" class="checkbox" name="if_viewids[]" value="<?=$cat[catid]?>" type="checkbox" <?if ($cat[if_view] == 2) echo 'checked';?> /></td>
  <td><input name="catorder[<?=$cat[catid]?>]" value="<?=$cat[catorder]?>" class="txt" type="text"/></td>
  <td><li class="margin<?=$cat['level']?> <?php if($cat['parentid'] != '0') echo 'son'?>" style="color:<?=$cat['color']?>"><a href="../category.php?catid=<?php echo $cat['catid']; ?> "<?php if($cat['level'] == 0){?>style="font-weight:bold" <?}?> target="_blank"><?=$cat[catname]?></a></li></td>
  <td><a href="category.php?part=edit&catid=<?=$cat[catid]?>">Edit</a> / <a href="category.php?part=del&catid=<?=$cat[catid]?>" onClick="if(!confirm('Are you sure you want to delete this column?\n\nThis will also delete all its affiliated sub-columns and categorized information!'))return false;">Delete</a>      </td>
  <td width="30">&nbsp;<?php if($cat['level'] == 0){?><a onclick="window.scrollTo(0,0);" style="cursor:pointer" title="To the Top of the Page">TOP</a><?}?></td>
</tr>
<?php
}?>
</table>
</div>
<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>
</form>
<?=mymps_admin_tpl_global_foot()?>
