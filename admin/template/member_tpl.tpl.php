<?php mymps_admin_tpl_global_head();?>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

				<li><a href="member_tpl.php" class="current">Personal Space Template</a></li>

				<li><a href="member_comment.php">Comment on Personal Space</a></li>

			</ul>

		</div>

	</div>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Hints</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

  <li>In default settings, All templates come with five text navigation items at the bottom (can be changed in template): About Us - Site Announcements - Help Centre - Related Sites - Messages.</li>

  <li>You may add other bottom navigation items here. The added items will be shown along with the existing items.</li>

    </td>

  </tr>

</table>

</div>

<form name='form1' method='post' action='?'>

<input name="forward_url" value="<?=GetUrl()?>" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

    <table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> Delete?</td>

      <td>Template Name</td>

      <td>Template Directory/Mark</td>

      <td>Order of Display</td>

      <td>Enable/Disabled</td>

      <td>Time of Change</td>

      <td>Edit</td>

    </tr>

    <tr bgcolor="#dff6ff">

      <td>&nbsp;</td>

      <td>Individual Member Template</td>

      <td>/template/spaces/person</td>

      <td colspan="4" >&nbsp;</td>

      </tr>

    <?php foreach($list as $k =>$value){?>

        <tr bgcolor="white">

          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$value[id]?>' id="<?=$value[id]?>"></td>

          <td><?=$value[tpl_name]?></td>

          <td><?=$value[tpl_path]?></td>

          <td><input name="displayorder[<?=$value[id]?>]" value="<?=$value[displayorder]?>" type="text" class="txt"/></td>

          <td><?=$if_view[$value[if_view]]?></td>

          <td><?=GetTime($value[edittime])?></td>

          <td><a href="?part=edit&id=<?=$value[id]?>">Add</a></td>

        </tr>

    <?}?>

    <tr bgcolor="#f5fbff">

      <td align="center"><b>����</b></td>

      <td><input name="add[tpl_name]" value="" type="text" class="text"/></td>

      <td><input name="add[tpl_path]" value="" type="text" class="text"/></td>

      <td><input name="add[displayorder]" value="" type="text" class="txt"/></td>

      <td><select name="add[if_view]">

      <?=get_ifview_options('2')?>

      </select></td>

      <td>&nbsp;</td>

      <td>&nbsp;</td>

    </tr>

    </table>

</div>

<center>

<input type="submit" value="Submit" class="mymps large" name="<?=CURSCRIPT?>_submit"/>  

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

