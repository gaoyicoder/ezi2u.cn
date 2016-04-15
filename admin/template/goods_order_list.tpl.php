<?php 
echo mymps_admin_tpl_global_head();
$admindir = getcwdOL();
?>

<script type='text/javascript' src='js/calendar.js'></script>
<form action="?" method="get">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Search Order by Requirements</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">Contact</td>
    <td>&nbsp;<input name="oname" class="text" value="<?php echo $oname; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">Seller Member ID</td>
    <td>&nbsp;<input name="userid" class="text" value="<?php echo $userid; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Date of Order (Format: yy-mm-dd):</td>
    <td>&nbsp;<input name="begindate" style="width:80px;" class="text" value="<?php echo $begindate; ?>" readonly="readonly" id="datepicker1"> - <input name="enddate" style="width:80px;"  class="text" value="<?php echo $enddate; ?>" id="datepicker2" readonly="readonly"></td>
  </tr>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" /></center>
<div class="clear" style="margin-bottom:5px"></div>
</form>
<form action="?part=list" method="post">
<input name="url" type="hidden" value="<?=GetUrl()?>">
<input name="action" value="delall" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm" >
    <tr class="firstr">
	<td width="50">
	<input type="checkbox" name="chkall" onclick="AllCheck('prefix', this.form, 'selectedids')" class="checkbox"/>Delete?</td>
    <td>Contact</td>
    <td>Seller Member ID</td>
    <td>Ordered Product</td>
    <td width="100">Telephone Number</td>
    <td>Date of Order</td>
    <td>IP</td>
    <td>Amount</td>
    <td>Operation</td>
  </tr>
<tbody onmouseover="addMouseEvent(this);">
<?php foreach($goods AS $row){?>
    <tr bgcolor="white" >
    <td><input type='checkbox' name='selectedids[]' value="<?=$row['id']?>" class='checkbox' id="<?=$row['id']?>"></td>
    <td><?=$row['oname']?></td>
    <td><a href="javascript:void(0);" onclick="
setbg('<?=MPS_SOFTNAME?>Member Centre',400,110,'../box.php?part=member&userid=<?=$row[userid]?>&admindir=<?=$admindir?>')"><?=$row[userid]?></a></td>
    <td><a href="../goods.php?id=<?=$row['goodsid']?>" target="_blank"><?=$row['goodsname']?></a></td>
    <td><?=$row['tel']?></td>
    <td><em><?php echo GetTime($row['dateline']); ?></em></td>
    <td><?=$row['ip']?></td>
    <td>&nbsp;<?=$row['ordernum']?></td>
    <td><a href="?part=view&id=<?=$row[id]?>">Details</a></td>
  </tr>
<?}?>
</tbody>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" name="<?=CURSCRIPT?>_submit"/></center>
</form>
<div class="pagination"><?php echo page2();?></div>
<?php mymps_admin_tpl_global_foot();?>
