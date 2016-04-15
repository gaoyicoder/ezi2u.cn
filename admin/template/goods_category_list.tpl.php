<?=mymps_admin_tpl_global_head()?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?part=list" class="current">Voucher Categorization</a></li>
                <li><a href="?part=add">Add Category</a></li>
            </ul>
        </div>
    </div>
</div>
<form name="form_mymps" action="?part=list" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td>Number</td>
      <td width="40">Apply?</td>
      <td>Category Name</td>
      <td width="80">Sorting Order</td>
      <td>Operation</td>
      <td>&nbsp;</td>
    </tr>
<?php
foreach($f_cat AS $cat)
{
?>
  <tr <?php if($cat['level'] == 0){?>bgcolor="#f5fbff" <?}else{?>  bgcolor="#ffffff" <?}?>>
  <td width="40"><?=$cat[catid]?></td>
  <td><input class="checkbox" name="if_viewids[]" value="<?=$cat[catid]?>" type="checkbox" <?if ($cat[if_view] == 2) echo 'checked';?> /></td>
  <td><li style="margin-left:<?=$cat['level']?>em!important; color:<?=$cat['color']?>" <?php if($cat['parentid'] != '0') echo 'class="son"'?>><a href="../goods.php?catid=<?=$cat[catid]?> "<?php if($cat['level'] == 0){?>style="font-weight:bold" <?}?> target="_blank"><?=$cat[catname]?></a></li></td>
  <td width="80"><input name="catorder[<?=$cat[catid]?>]" value="<?=$cat[catorder]?>" class="txt" type="text"/></td>
  <td><a href="goods_category.php?part=edit&catid=<?=$cat[catid]?>">Edit</a> / <a href="goods_category.php?part=del&catid=<?=$cat[catid]?>" onClick="if(!confirm('Are you sure you want to delete this category? \n\n This will also delete all its affiliated sub-categories and vouchers!'))return false;">Delete</a>      </td>
  <td width="30">&nbsp;<?php if($cat['level'] == 0){?><a onclick="window.scrollTo(0,0);" style="cursor:pointer" title="To the Top of the Page">TOP</a><?}?></td>
</tr>
<?}?>
</table>
</div>
<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>
</form>
<?=mymps_admin_tpl_global_foot()?>
