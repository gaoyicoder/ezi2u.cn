<?php mymps_admin_tpl_global_head();?>

<form action="?part=template" method="post"/>

<div id="<?=MPS_SOFTNAME?>">

    <table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> Delete?</td>

      <td>Template Theme</td>

      <td>ID Code</td>

      <td>Mail Type</td>

      <td>Template Category</td>

      <td>Time of Edit</td>

      <td>Edit</td>

    </tr>

	<?php foreach($tpl as $tpl){?>

        <tr bgcolor="white">

          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$tpl[template_id]?>' id="<?=$tpl[template_id]?>" <?php if($tpl[is_sys] == 1){?> disabled<?}?>></td>

          <td><?=$tpl[template_subject]?></td>

          <td><?=$tpl[template_code]?></td>

          <td><?php echo $tpl[is_html] == 1 ? 'HTML' : 'Text' ;?></td>

          <td><?php echo $tpl[is_sys] == 1 ? '<font color=red>System Template</font>' : '<font color=#006acd>Customized Template</font>' ;?></td>

          <td><?=GetTime($tpl[last_modify])?></td>

          <td><a href="?part=template&template_id=<?=$tpl[template_id]?>">Details</a></td>

        </tr>

	<?php }?>

    <tr bgcolor="#f5fbff">

      <td><b>Add</b></td>

      <td><input name="add[template_subject]" value="" type="text" class="text"/></td>

      <td><input name="add[template_code]" value="" type="text" class="text"/>

      </td>

      <td>

      <select name="add[is_html]">

      <option value="1">HTML</option>

      <option value="0">Text</option>

      </select></td>

      <td>

      <select name="add[is_sys]">

      <!--<option value="1">System Template</option>-->

      <option value="0">Customized Template</option>

      </select></td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

    </tr>

    </table>

</div>

<center><input type="submit" value="Submit" class="mymps large" name="mail_submit"/>  </center>

</form>

<?php if($template_id){?>

<br />

<form method="post" action="?part=template&edit_id=<?=$edit[template_id]?>">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<input name="edit[template_id]" type="hidden" value="<?=$template_id?>" />

<tr class="firstr">

<td colspan="2">Change Mail Template</td>

</tr>

<tr bgcolor="#ffffff">

<td>

Template Theme

</td>

<td><input class="text" type="text" name="edit[template_subject]" value="<?=$edit[template_subject]?>"></td>

</tr>

<tr bgcolor="#ffffff">

<td>

Template ID Code

</td>

<td><input class="text" type="text" name="edit[template_code]" value="<?=$edit[template_code]?>"><br />

<div style="margin-top:5px">Please do not make any changes unless necessary</div>

</td>

</tr>

<tr bgcolor="#ffffff">

<td>

Mail Type

</td>

<td><select name="edit[is_html]">

      <option value="1" <?php if($edit[is_html] == '1') echo 'selected style="background-color:#6EB00C;color:white"' ;?>>HTML</option>

      <option value="0" <?php if($edit[is_html] == '0') echo 'selected style="background-color:#6EB00C;color:white"' ;?>>Text</option>

      </select>

</td>

</tr>

<tr bgcolor="#ffffff">

<td>

Template Content

</td>

<td><textarea name="edit[template_content]" style="width:400px; height:300px"><?=$edit[template_content]?></textarea></td>

</tr>

</table>

</div>

<center><input type="submit" value="Submit" class="mymps large" name="mail_submit"/>  </center>

</form>

<?php }?>

<?php mymps_admin_tpl_global_foot();?>

