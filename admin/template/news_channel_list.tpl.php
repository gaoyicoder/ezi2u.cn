<?=mymps_admin_tpl_global_head()?>

<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">

    <div class="mpstopic-category">

        <div class="panel-tab">

            <ul class="clearfix tab-list">

                <li><a title="Added News Category" href="channel.php" <?php if($part == 'list'){?>class="current"<?php }?>>Added News Category</a></li>

                <li><a title="Add News Category" href="channel.php?part=add" <?php if($part == 'add'){?>class="current"<?php }?>>Add News Category</a></li>

            </ul>

        </div>

    </div>

</div>



<form name="form_mymps" action="?part=list" method="post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td width="40">Number</td>

      <td width="40">Enable?</td>

      <td>Name</td>

      <td width="80">Sorting Order</td>

      <td>Operation</td>

      <td>&nbsp;</td>

    </tr>

<?php

foreach($f_cat AS $cat)

{

?>

	  <tr <?php if($cat[level] == 0){?>bgcolor="#f5fbff" <?}else{?>  bgcolor="#ffffff" <?}?>>

	  <td width="40"><?=$cat[catid]?></td>

      <td><input name="if_viewids[]" value="<?=$cat[catid]?>" type="checkbox" <?if ($cat[if_view] == 2) echo 'checked';?> class="checkbox"/></td>

  <td><li style="margin-left:<?=$cat['level']>1?$cat[level]*3:$cat[level]?>em;" <?php if($cat['parentid'] != '0') echo 'class="son"'?>><a <?php if($cat[level] == 0){?>style="font-weight:bold" <?}?> href="../news.php?catid=<?=$cat[catid]?>" target="_blank"><?=$cat[catname]?></a></li></td>

      <td width="80"><input name="catorder[<?=$cat[catid]?>]" value="<?=$cat[catorder]?>" class="txt"/></td>

	  <td><a href="channel.php?part=edit&catid=<?=$cat[catid]?>">Edit</a> / <a href="channel.php?part=del&catid=<?=$cat[catid]?>" onClick="if(!confirm('Are you sure you want to delete this news column?\n\nThis will also delete all its affiliated sub-columns and articles!'))return false;">Delete</a></td>

      <td width="30"><a onclick="window.scrollTo(0,0);" style="cursor:pointer" title="Back To the Top">TOP</a></td>

    </tr>

<?}?>

</table>

</div>

<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>

</form>

<?=mymps_admin_tpl_global_foot()?>

