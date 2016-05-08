<?php 

echo mymps_admin_tpl_global_head();

$admindir = getcwdOL();

?>



<form action="?" method="get">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Search Group Purchase by Requirements</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td style="background-color:#f1f5f8; width:40%">Group Purchase Title</td>

    <td>&nbsp;<input name="gname" class="text" value="<?php echo $gname; ?>"></td>

  </tr>

  <tr bgcolor="#ffffff">

    <td style="background-color:#f1f5f8; width:40%">UserID</td>

    <td>&nbsp;<input name="userid" class="text" value="<?php echo $userid; ?>"></td>

  </tr>

  <tr bgcolor="#ffffff">

    <td style="background-color:#f1f5f8; width:40%">From Category</td>

    <td>&nbsp;<select name="cate_id">

    <option value="">>Do not Limit Category</option>

    <?php echo get_groupclass_select('cate_id',$cate_id,'no'); ?>

    </select></td>

  </tr>

<?php if(!$admin_cityid){?>

  <tr bgcolor="#ffffff">

    <td style="background-color:#f1f5f8; width:40%">District</td>

    <td>&nbsp;<select name="cityid">

    <option value="">>City Sub-site</option>

    <?php echo get_cityoptions($cityid); ?>

    </select></td>

  </tr>

  <? }else{ ?>

  <input name="cityid" value="<?php echo $admin_cityid?>" type="hidden" />

  <? }?>

</table>

</div>

<center><input type="submit" value="Submit" class="mymps large" /></center>

<div class="clear" style="margin-bottom:5px"></div>

</form>

<form action="?part=list" method="post">

<input name="url" type="hidden" value="<?=GetUrl()?>">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm" >

    <tr class="firstr">

    <td width="30">&nbsp;</td>

    <td>Preview Image</td>

    <td>Activity Title</td>

    <td width="100">Starter Seller</td>

    <td>Time of Post</td>

    <td>Sorting</td>

    <td>Sign-up</td>

    <td>Status</td>

    <td>Operation</td>

  </tr>

<tbody onmouseover="addMouseEvent(this);">

<?php foreach($group AS $row){?>

    <tr bgcolor="white" >

    <td><input type='checkbox' name='selectedids[]' value="<?=$row['groupid']?>" class='checkbox' id="<?=$row['groupid']?>"></td>

    <td><img src="<?=$mymps_global['SiteUrl'].$row['pre_picture']?>" width="60"></td>

    <td><a href="../group.php?id=<?=$row[groupid]?>" target="_blank"><?=$row['gname']?></a></td>

    <td><a href="javascript:void(0);" onclick="

setbg('<?=MPS_SOFTNAME?>Member Centre',400,110,'../box.php?part=member&userid=<?=$row[userid]?>&admindir=<?=$admindir?>')"><?=$row[userid]?></a></td>

    <td><em><?php echo GetTime($row['dateline']); ?></em></td>

    <td><?=$row['displayorder']?></td>

    <td>&nbsp;<?=$row['signintotal']?></td>

    <td>

    <?php echo $glevel[$row['glevel']] ?></td>

    <td><a href="?part=edit&id=<?=$row[groupid]?>">Edit</a></td>

  </tr>

<?}?>

</tbody>

<tr bgcolor="#ffffff" height="28">

    <td style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>

    <td colspan="10">

    <?php foreach($glevel as $k => $v){?>

	<label for="glevel<?=$k?>"><input type="radio" value="glevel<?=$k?>" id="glevel<?=$k?>" name="action" class="radio">To<?=$v?></label> 

    <?php }?>

     <hr style="height:1px; border:1px #c5d8e8 solid;"/>

     <label for="delall"><input type="radio" value="delall" id="delall" name="action" class="radio">Delete by Batches</label> 

    </td>

</tr>

</table>

</div>

<center><input type="submit" value="Submit" class="mymps large" name="group_submit"/></center>

</form>

<div class="pagination"><?php echo page2();?></div>

<?php mymps_admin_tpl_global_foot();?>

