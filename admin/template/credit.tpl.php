<?php mymps_admin_tpl_global_head();?>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

<div class="mpstopic-category">

	<div class="panel-tab">

		<ul class="clearfix tab-list">

		<li><a href="score.php">Score Addition/Deduction Settings</a></li>

		<li><a href="credit.php" class="current">Credit Addition/Deduction Settings</a></li>

		<li><a href="credit_set.php">Credit Level Management</a></li>

		</ul>

	</div>

</div>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Instructions</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

 <li>To deduct, put a - before the  value to deduct. Example: to deduct 1 credit, please input -1. </li>

 <li>To add, put a + before the value to add. Example: to add 1 credit, please input +1. </li>

    </td>

  </tr>

</table>

</div>

<form action="?" method="post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Automatic Credit Change Settings</td>

  </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Business Licence Verification passed, change credit</td>

 <td bgcolor="#ffffff"><input name="credit_new[rank][com_certify]" value="<?php echo $credit[rank]['com_certify']?>" class="txt"/> <i> Initial Value:<font color="red">+50</font></i></td>

 </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Real-time ID Verification passed, change credit.</td>

 <td bgcolor="#ffffff"><input name="credit_new[rank][per_certify]" value="<?php echo $credit[rank]['per_certify']?>" class="txt"/> <i> Initial Value:<font color="red">+50</font></i></td>

 </tr>

  <tr class="firstr">

  	<td colspan="2">Manual Credit Change Settings</td>

  </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Change to credit with every coin spent</td>

 <td bgcolor="#ffffff"><input name="credit_new[rank][coin_credit]" value="<?php echo $credit[rank]['coin_credit']?>" class="txt"/> <i> Initial Value:<font color="red">+10</font></i></td>

 </tr>

</table>

</div>

<center><input name="seoset_submit" value="Submit" class="mymps large" type="submit"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

