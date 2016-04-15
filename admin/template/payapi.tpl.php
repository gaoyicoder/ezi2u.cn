<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr style="font-weight:bold; background-color:#dff6ff">
      <td style="width:10%">Port Name</td>
      <td style="width:40%">Port Description</td>
      <td>On/Off</td>
      <td>Port Type</td>
      <td>Edit</td>
    </tr>
    <?php foreach($payapi as $k =>$value){?>
        <tr bgcolor="#ffffff">
          <td <?php if($value['paytype'] == 'tenpay') echo 'style="font-weight:bold; color:red"'?>><?=$value[payname]?></td>
          <td><em><?=$value[paysay]?></em></td>
          <td><?=$value[isclose] == '0' ? '<font color=green>On</font>' : '<font color=red>Off</font>'?></td>
          <td><?=$value[paytype]?></td>
          <td><a href="?payid=<?=$value[payid]?>">Details</a></td>
        </tr>
    <?}?>
</table>
</div>
<?php if(!empty($payid)){?>
<form action="?" method="post">
<input type="hidden" name="payid" value="<?=$payid?>">
<input name="return_url" value="<?php echo GetUrl(); ?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>" style="margin-top:10px; clear:both">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2">Configure Pay Port</td>
</tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Port Type: </td>
    <td bgcolor="white">
    <input name="paytype" value="<?=$paydetail[paytype]?>" class="text"/>
    </td>
  </tr>
  <?php if($paydetail[paytype] == 'alipay'){?>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Pay Collection Type</td>
    <td bgcolor="white">
    <label for="r1"><input type="radio" name="buytype" value="1" id="r1" <?php if($paydetail[buytype] == 1) echo 'checked';?>>即时到帐收款（因对应支付宝功能因而属于中国元素范畴，建议斟酌）</label>
	<label for="r2"><input type="radio" name="buytype" value="2" id="r2" <?php if($paydetail[buytype] == 2) echo 'checked';?>>双功能收款（因对应支付宝功能因而属于中国元素范畴，建议斟酌）</label>
    </td>
  </tr>
  <?php }?>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Port Name: </td>
    <td bgcolor="white">
    <input name="payname" value="<?=$paydetail[payname]?>" class="text"/>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Port Status: </td>
    <td bgcolor="white">
    <label for="0"><input name="isclose" type="radio" value="0" class="radio" id="0" <?php if($paydetail['isclose'] == '0') echo 'checked'; ?>/>On</label>
    <label for="1"><input name="isclose" type="radio" value="1" class="radio" id="1" <?php if($paydetail['isclose'] == '1') echo 'checked'; ?>/>Off</label>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Port Name: </td>
    <td bgcolor="white">
    <input name="payname" value="<?=$paydetail[payname]?>" class="text"/>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Port Description: </td>
    <td bgcolor="white">
    <textarea name="paysay" style="width:320px; height:100px">
    <?=$paydetail[paysay]?>
    </textarea>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Merchant ID: </td>
    <td bgcolor="white">
    <input name="payuser" value="<?=$paydetail[payuser]?>" class="text"/> 
    <?php if($paydetail['paytype'] == 'tenpay'){?>
    <input type="button" value="立即注册财付通商户号(中国元素)" onclick="javascript:window.open('http://union.tenpay.com/mch/mch_index1.shtml');" class="gray">
    <?php }?>
    </td>
  </tr>
  <?php if($paydetail['paytype'] == 'alipay'){?>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">支付宝帐号：(中国元素)</td>
    <td bgcolor="white">
    <input name="payemail" value="<?=$paydetail[payemail]?>" class="text"/>
    </td>
  </tr>
  <?}?>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Cipher Code: </td>
    <td bgcolor="white">
    <input name="paykey" value="<?=$paydetail[paykey]?>" class="text"/>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Process Fee: </td>
    <td bgcolor="white">
    <input name="payfee" value="<?=$paydetail[payfee]?>" class="txt"/>%
    </td>
  </tr>
</table>
</div>
<center><input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit" class="mymps large"/></center>
  </form>
<?php }?>
<?php mymps_admin_tpl_global_foot();?>
