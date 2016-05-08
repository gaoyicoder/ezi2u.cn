<?php mymps_admin_tpl_global_head();?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

      <tr class="firstr">

      <td colspan="2">

       Basic Information

      </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Product Ordered</td>

        <td bgcolor="white">

        <a href="../goods.php?id=<?php echo $view['goodsid']; ?>" target="_blank"><?php echo $view['goodsname']; ?></a>

        </td>

      </tr>

	  <tr bgcolor="#f5fbff">

        <td>Real Name</td>

        <td bgcolor="white">

        <?php echo $view['oname']; ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Landline Number</td>

        <td bgcolor="white">

        <?php echo $view['tel']; ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Address</td>

        <td bgcolor="white">

        <?php echo $view['address']; ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Cell Phone Number</td>

        <td bgcolor="white">

        <?php echo $view['mobile']; ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>QQ</td>

        <td bgcolor="white">

        <?php echo $view['qq']; ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Amount of Purchase</td>

        <td bgcolor="white">

        <?php echo $view['ordernum']; ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Message</td>

        <td bgcolor="white">

        <?php echo $view['msg']; ?>

        </td>

      </tr>

      <tr class="firstr">

      	<td colspan="2">Affiliated Information</td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Time Of Order</td>

        <td bgcolor="white">

        <?php echo GetTime($view['dateline']); ?>

        </td>

      </tr>

      <tr bgcolor="#f5fbff">

        <td>Ordered From IP</td>

        <td bgcolor="white">

        <?php echo $view['ip']; ?>

        </td>

      </tr>

</table>

</div>

<center><input type="submit" class="mymps large" value="Return" onClick="history.back();"></center>

<?php mymps_admin_tpl_global_foot();?>

