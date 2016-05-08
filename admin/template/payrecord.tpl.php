<?php mymps_admin_tpl_global_head();

$admindir = getcwdOL();

?>

<script type='text/javascript' src='js/calendar.js'></script>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Detailed Search</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

    	<form action="payrecord.php" method="get">

        <input name="url" value="<?php echo GetUrl();?>" type="hidden" />

		From Date<input readonly name="starttime" type="text" class="txt" style="width:70px;" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)" value="<?php echo $starttime; ?>"> - <input readonly name="endtime" type="text" class="txt" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)" value="<?php echo $endtime; ?>"> 

		Keyword <input name="keywords" type="text" class="text" value="<?php echo $keywords; ?>">    

        <select name="action" id="action">

            <option value="1" <?php if($action == '1') echo 'selected'; ?>>Order Number</option>

            <option value="2" <?php if($action == '2') echo 'selected'; ?>>Payer</option>

            <option value="3" <?php if($action == '3') echo 'selected'; ?>>Payer IP</option>

			<option value="4" <?php if($action == '4') echo 'selected'; ?>>Remark</option>

          </select> 

		<input name=submit1 type=submit id="submit12" value=Search class="gray">

         </form>

    </td>

  </tr>

</table>

</div>

<div class="clear"></div>

<form action="?part=list" method="post">

<input name="url" type="hidden" value="<?=GetUrl()?>">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr style="font-weight:bold; background-color:#dff6ff">

    <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> Delete?</td>

      <td>Order Number</td>

      <td>Payer</td>

      <td>Amount</td>

      <td>Time of Paying</td>

      <td>Payer IP</td>

      <td>Remark</td>

      <td>Port</td>

    </tr>

    <?php

	$fee = array();

	$list = is_array($list) ? $list : array();

	foreach($list as $list){

	$fee[$list[id]]=$list[money];

	?>

    <tr bgcolor="white">

        <td><input type='checkbox' name='delids[]' value='<?=$list[id]?>' class='checkbox' id="<?=$list[id]?>"></td>

        <td><?=$list[orderid]?></td>

        <td><a href="javascript:void(0);" onclick="setbg('<?=MPS_SOFTNAME?>Member Centre',400,110,'../box.php?part=member&userid=<?=$list[userid]?>&admindir=<?=$admindir?>')"><?=$list[userid]?></a></td>

        <td><em><font color="red"><?=$list[money]?></font></em></td>

        <td><?=GetTime($list[posttime])?></td>

        <td align="left"><?=$list[payip]?></td>

        <td align="left"><?=$list[paybz]?></td>

        <td align="left"><?=$list[type]?></td>

    </tr>

    <?php }?>



</table>

</div>

<center><input type="submit" value="Submit" class="mymps large" name="<?=CURSCRIPT?>_submit"/><div class="clear"></div><div style="color:#888;">Total <font color="red"><?php echo array_sum($fee)/$mymps_global['cfg_coin_fee'];?></font> <?php echo $moneytype; ?> </div></center>

</form>

<div class="pagination"><?=page2()?></div>

<?php mymps_admin_tpl_global_foot();?>

