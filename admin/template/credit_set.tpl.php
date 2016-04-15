<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
			<li><a href="score.php">Score Addition/Deduction Settings</a></li>
			<li><a href="credit.php">Credit Addition/Deduction Settings</a></li>
			<li><a href="credit_set.php" class="current">Credit Level Management</a></li>
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
 		<li>You may change the image in directory /images/credit, to introduce icons that go with the style of your site.</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>" style="margin-top:10px;">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Real-time Member Credit Cache Update</td>
  </tr>
 <tr bgcolor="#ffffff">
    	<td> 
        <li><input type="button" class="gray mini" onclick="location.href='?ac=update_credits';this.disabled='true'" value="Update Member Credit Icon"></li>
        </td>
        <td><div style="color:#333">
			1. The changed member credit level icon will be applied only when you click on Update Member Credit Icon after you have changed the following credit settings.
<br />
2. If there are many members on your site, the operation may take a longer while.
<br />
3. If no following credit/score settings are changed, we do not recommend you to change member credit icon.
		</div></td>
    </tr>
</table>
</div>
<form action="?" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="5">Credit Level</td></tr> 
<tr bgcolor="#f5f8ff" style="font-weight:bold"><td>Credit Level</td><td>Credit Level Above</td><td>Credit Level Below</td><td>Level Icon</td></tr> 
<?php for($i=1;$i<16;$i++){?>
<tr align="center" bgcolor="white"><td><?php echo $i; ?></td><td><input type="text" class="txt" name="credit_setnew[rank][<?php echo $i; ?>]" value="<?php echo $credit_set[rank][$i]?>"></td><td><?php echo $credit_set[rank][$i+1]?>&nbsp;</td><td><img src="../images/credit/<?php echo $i; ?>.gif" border="0"></td> 
<?php }?>
</table>
</div>
<center><input name="seoset_submit" value="Submit" class="mymps large" type="submit"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
