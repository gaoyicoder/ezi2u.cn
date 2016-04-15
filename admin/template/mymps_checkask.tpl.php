<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="config.php?part=imgcode" <?php if($part == 'imgcode'){?>class="current"<?php }?>>Identifying Code Control</a></li>
				<li><a href="config.php?part=checkask" <?php if($part == 'checkask'){?>class="current"<?php }?>>Identifying Questions and Answers Settings</a></li>
				<li><a href="config.php?part=badwords" <?php if($part == 'badwords'){?>class="current"<?php }?>>Filtering Settings</a></li>
				<li><a href="config.php?part=commentsettings" <?php if($part == 'commentsettings'){?>class="current"<?php }?>>Comment Settings</a></li>
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
 <li>Identifying questions should be brief and clear, answerable by any ordinary people. We recommend that you regularly update identifying questions to better the effect.</li>
 <li>The identifying question mechanism requires that the member provide correct answer for a<font color=red> randomly-picked question </font>to proceed (posting, etc.). It helps stopping malicious registration and posting. You may select proceedings that you wish to apply Identifying question to.</li>
 <li>Note: Enabling this will complicate some operations, so we recommend that it be enabled only when necessary.</li>
    </td>
  </tr>
</table>
</div>
<div class="clear"></div>
<form action="?part=checkask" method="post">
<input name="action" type="hidden" value="do_post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    	<td colspan="2">Identifying Questions and Answers Settings</td>
    </tr>
    <tr bgcolor="#ffffff">
        <td width="45%"><b>Apply Identifying Questions in:</td>
        <td><label for="whenregister"><input class="checkbox" type="checkbox" name="whenregister" id="whenregister" value="1" <?php if($when['whenregister'] == '1') echo 'checked';?>> Registration</label> <label for="whenpost"><input class="checkbox" type="checkbox" name="whenpost" value="1" <?php if($when['whenpost'] == '1') echo 'checked';?> id="whenpost"> Making Categorized Posts</label></td>
    </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td colspan="3">Identifying Questions and Answers Settings</td>
    </tr>
    <tr bgcolor="#f5f8ff" style="font-weight:bold">
      <td>Delete?</td>
      <td>Questions</td>
      <td>Answers</td>
    </tr>
    <?php foreach($c as $key => $val){?>
    <tr align="center" bgcolor="white">
        <td><input class="checkbox" type="checkbox" name="delete[]" value="<?php echo $val['id']; ?>"></td>
        <td><textarea name="question[<?php echo $val['id']; ?>]" rows="3" cols="60"><?php echo $val['question']; ?></textarea></td>
        <td><input type="text" name="answer[<?php echo $val['id']; ?>]" size="30" maxlength="50" value="<?php echo $val['answer']; ?>"></td>
    </tr>
    <?php }?>
   <tbody id="secqaabody" bgcolor="white">
   <tr align="center">
       <td>Add:<a href="###" onclick="newnode = $('secqaabodyhidden').firstChild.cloneNode(true); $('secqaabody').appendChild(newnode)">[+]</a></td>
       <td><textarea name="newquestion[]" rows="3" cols="60"></textarea></td>
       <td><input type="text" name="newanswer[]" size="30" maxlength="50"></td>
   </tr>
   </tbody>
   
   <tbody id="secqaabodyhidden" style="display:none">
       <tr align="center" bgcolor="white">
       <td>&nbsp;</td>
       <td><textarea name="newquestion[]" rows="3" cols="60"></textarea></td>
       <td><input type="text" name="newanswer[]" size="30" maxlength="50"></td>
       </tr>
   </tbody>
   
   <tr bgcolor="#f5f8ff">
   <td colspan=3>We recommend that you prepare at least 10 sets of identifying questions and answers. The more questions there are, the more effective the mechanism stops malicious registration and posting. The questions can come in HTML code, and the answers should not exceed 50 characters in length.</td>
   </tr>
</table>
</div>
<center>
<input class="mymps large" value="Submit" type="submit" > &nbsp;
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
