<?=mymps_admin_tpl_global_head()?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a id="i0" href="area.php">Added Sub-site/District <font color="#ff3300"><?=$totalnum?></font></a></li>
				<li><a href="province.php" class="current">省份/直辖市(中国元素) Management</a></li>
            </ul>
        </div>
    </div>
</div>
<form name="form_mymps" action="?" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="40">Delete?</td>
      <td width="80">Sorting Order</td>
      <td>省份/直辖市名称(中国元素)</td>
    </tr>
	<tr>
		<td colspan="3" bgcolor="#f6ffdd" style="color:red">
		Unless necessary, please do not alter settings considering province/city. (?)
		</td>
	</tr>
<?php
if(is_array($province)){foreach($province AS $province)
{
?>
  <tr bgcolor="#ffffff">
  <td width="60"><input class="checkbox" name="delete[]" value="<?=$province[provinceid]?>" type="checkbox"/></td>
  <td width="80"><input name="displayorder[<?=$province[provinceid]?>]" value="<?=$province[displayorder]?>" class="txt" type="text"/></td>
  <td><input name="provincename[<?=$province[provinceid]?>]" class="text" type="text" value="<?=$province[provincename]?>"></td>
</tr>
<? }}?>
<tbody id="secqaabody" bgcolor="white">
<tr align="center">
   <td>Add:<a href="###" onclick="newnode = $('secqaabodyhidden').firstChild.cloneNode(true); $('secqaabody').appendChild(newnode)">[+]</a></td>
   <td><input type="text" name="newdisplayorder[]" class="txt"></td>
   <td><input type="text" name="newprovincename[]" class="text"></td>
</tr>
</tbody>

<tbody id="secqaabodyhidden" style="display:none">
   <tr align="center" bgcolor="white">
   <td>&nbsp;</td>
   <td><input type="text" name="newdisplayorder[]" class="txt"></td>
   <td><input type="text" name="newprovincename[]" class="text"></td>
   </tr>
</tbody>
</table>
</div>
<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>
</form>
<?=mymps_admin_tpl_global_foot()?>
