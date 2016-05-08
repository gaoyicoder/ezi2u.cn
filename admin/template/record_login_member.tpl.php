<?php mymps_admin_tpl_global_head();

$admindir = getcwdOL();

?>



<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Search Log-in Records of Designated User ID(s)</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td>

<form action="?" name="form1" method="get">

     	<input name="keywords" class="text" value="<?=$keywords?>">

        <input name="do" value="<?=$do?>" type="hidden">

        <input name="part" value="login" type="hidden">

        <input type="submit" value="Search" class="gray mini">&nbsp;&nbsp;

		<input type="button" value="Save Only Records of the Latest Two Months" class="mymps mini" onclick="location.href='?do=member&part=login&action=savemonth'">&nbsp;&nbsp;  

		<input type="button" value="Export to Excel" class="mymps mini" onclick="location.href='record.php?do=member&part=login&action=doexcel';">

     </form>

    </td>

  </tr>

</table>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <form name='form1' method='post' action='?do=<?=$do?>&part=<?=$part?>' onSubmit='return checkSubmit();'>

    <input type='hidden' name='action' value='delall'/>

    <input name="url" type="hidden" value="<?=GetUrl()?>">

    <tr class="firstr">

    <td width="30">Select</td>

    <td align="center">User ID</td>

    <td align="center">IP Address</td>

	<td align="center">Geographic Location</td>

	<td align="center">Port</td>

	<td align="center">Browser</td>

	<td align="center">Operating System</td>

    <td align="center">Time Logged-in</td>

	<td align="center">Time Logged-out</td>

    </tr>

  	<tbody onmouseover="addMouseEvent(this);">

    <?

foreach($record AS $k)

{

?>

    <tr align="center" bgcolor="white">

    <td><input type='checkbox' class="checkbox" name='id[]' value='<?=$k[id]?>' id="<?=$k[id]?>"></td>

    <td><a href="javascript:

setbg('<?=MPS_SOFTNAME?>Member Centre',400,110,'../box.php?part=member&userid=<?=$k[userid]?>&admindir=<?=$admindir?>')"><?=$k[userid]?></a></td>

    <td><?=$k[ip]?></td>

	<td><?=$k[ip2area]?></td>

	<td><?=$k[port]?></td>

	<td><?=$k[browser]?></td>

	<td><?=$k[os]?></td>

    <td><em><?=$k[pubdate]?></em></td>

	<td><em><?=$k[outdate]?></em></td>

  </tr>

    <?

}

?>	</tbody>

    <tr bgcolor="#ffffff" height="28">

    <td align="center" style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" class="checkbox" id="checkall" onClick="CheckAll(this.form)"/></td>

    <td colspan="10"><input type="submit" onClick="if(!confirm('Are you sure you want to continue \n\n This cannot be undone!'))return false;" value="Delete by Batches" class="mymps mini" <?php if($do == 'admin'){echo "disabled";}?>/>  

    </td>

    </tr>

    </form>

</table>

</div>

<div class="pagination"><?echo page2()?></div>

<?php mymps_admin_tpl_global_foot();?>

