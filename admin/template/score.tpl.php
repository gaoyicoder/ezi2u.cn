<?php mymps_admin_tpl_global_head();?>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

<div class="mpstopic-category">

	<div class="panel-tab">

		<ul class="clearfix tab-list">

		<li><a href="score.php" class="current">Score Addition/Deduction Settings</a></li>

		<li><a href="credit.php">Credit Value Addition/Deduction Settings</a></li>

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

 <li>To deduct score, put a - and value to be deducted in front of the item. Example: To deduct one coin input -1. </li>

 <li>To add score, put a + and value to be added in front of the item. Example: To add one coin input +1. </li>

 <li>All changes to score comes after the corresponding actions. Example: Passing verification adds score, but the score will be added only after the verification is recognized successful, not at the initial stage of verification. </li>

    </td>

  </tr>

</table>

</div>

<form action="?" method="post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Member Score Settings</td>

  </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Successful Registration</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][register]" value="<?php echo $score[rank]['register']?>" class="txt"/>

 <i> Initial Value:<font color="red">+10</font></i></td>

 </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Successful Logging-in</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][login]" value="<?php echo $score[rank]['login']?>" class="txt"/>

 <i> Initial Value:<font color="red">+2</font></i></td>

 </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Make Categorized Post</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][information]" value="<?php echo $score[rank]['information']?>" class="txt"/>

 <i> Initial Value:<font color="red">+2</font></i></td>

 </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Issue Coupon</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][coupon]" value="<?php echo $score[rank]['coupon']?>" class="txt"/>

 <i> Initial Value:<font color="red">+2</font></i></td>

 </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Start Group Purchase</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][group]" value="<?php echo $score[rank]['group']?>" class="txt"/>

 <i> Initial Value:<font color="red">+2</font></i></td>

 </tr>

 <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Post Product</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][goods]" value="<?php echo $score[rank]['goods']?>" class="txt"/>

 <i> Initial Value:<font color="red">+2</font></i></td>

 </tr>

  <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Business Licence Verification</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][com_certify]" value="<?php echo $score[rank]['com_certify']?>" class="txt"/>

 <i> Initial Value:<font color="red">+10</font></i></td>

 </tr>

  <tr bgcolor="#f1f5f8">

 <td style="width:35%; line-height:22px">Real-time ID Verification</td>

 <td bgcolor="#ffffff"><input name="score_new[rank][per_certify]" value="<?php echo $score[rank]['per_certify']?>" class="txt"/>

 <i> Initial Value:<font color="red">+10</font></i></td>

 </tr>

</table>

</div>

<center><input name="seoset_submit" value="Submit" class="mymps large" type="submit"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

