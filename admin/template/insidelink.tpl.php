<?php mymps_admin_tpl_global_head();?>

<form action="?" method="post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

    	<td colspan="2">Link-in-text Settings</td>

    </tr>

    <tr bgcolor="#ffffff">

        <td width="100"><b>Enable Link-in-text:</td>

        <td>

		<?php foreach($insidelink_forward as $k => $v){?>

		<label for="<?=$k?>"><input class="checkbox" type="checkbox" name="settings[forward][<?=$k?>]" id="<?=$k?>" value="1" <?php if($settings['forward'][$k] == '1') echo 'checked';?>> <?=$v?></label> 

		<?php }?>

		</td>

    </tr>

</table>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td colspan="3">Linked-in-text Settings</td>

    </tr>

    <tr bgcolor="#f5f8ff" style="font-weight:bold">

      <td><input name="chkall" type="checkbox" onclick="AllCheck('prefix', this.form, 'delete')" class="checkbox"/>ɾ?</td>

      <td>Text</td>

      <td>Link URL</td>

    </tr>

    <?php foreach($insidelink as $key => $val){?>

    <tr align="center" bgcolor="white">

        <td width="40"><input class="checkbox" type="checkbox" name="delete[]" value="<?php echo $val['id']; ?>"></td>

        <td  width="240"><input class="text" type="text" name="word[<?php echo $val['id']; ?>]" value="<?php echo $val['word']; ?>"></td>

        <td><input class="text" type="text" name="url[<?php echo $val['id']; ?>]" value="<?php echo $val['url']; ?>"></td>

    </tr>

    <?php }?>

   <tbody id="secqaabody" bgcolor="white">

   <tr align="center">

       <td>Add:<a href="###" onclick="newnode = $('secqaabodyhidden').firstChild.cloneNode(true); $('secqaabody').appendChild(newnode)">[+]</a></td>

       <td><input class="text" type="text" name="newword[]"></td>

       <td><input class="text" type="text" name="newurl[]"></td>

   </tr>

   </tbody>

   

   <tbody id="secqaabodyhidden" style="display:none">

       <tr align="center" bgcolor="white">

       <td>&nbsp;</td>

       <td><input class="text" type="text" name="newword[]"></td>

       <td><input class="text" type="text" name="newurl[]"></td>

       </tr>

   </tbody>

</table>

</div>

<center>

<input class="mymps large" value="Submit" type="submit" name="<?=CURSCRIPT?>_submit"> &nbsp;

</center>

</form>

<div class="pagination"><?php echo page2()?></div>  

<?php mymps_admin_tpl_global_foot();?>

