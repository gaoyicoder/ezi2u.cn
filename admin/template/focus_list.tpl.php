<?php mymps_admin_tpl_global_head();?>
<script type='text/javascript' src='js/vbm.js'></script>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
    <li><a href="?typename=Site Homepage" <?php if($typename=='Site Homepage') echo 'class="current"';?>>Site Homepage</a></li>
    <li><a href="?typename=News Homepage" <?php if($typename=='News Homepage') echo 'class="current"';?>>News Homepage</a></li>
            </ul>
			<?php if(!$admin_cityid){?>
            <ul style="float:right; text-align:right">
               <select name="cityid" onChange="location.href='?typename=<?=$typename?>&cityid='+(this.options[this.selectedIndex].value)">
       	<option value="0">Master Site</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
            </ul>
            <?php }?>
        </div>
    </div>
</div>
<form method='post' action='?part=<?=$part?>'>
<input name="typename" value="<?=$typename?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td width="60"><input name="checkall" type="checkbox" class="checkbox" id="checkall" onClick="CheckAll(this.form)"/> Delete?</td>
    <td align="center">Focus Image Directory</td>
    <td width="200" align="center">Description</td>
    <td width="100" align="center">Add Date</td>
    <td width="100" align="center">Order</td>
    <td width="100" align="center">Edit</td>
  </tr>
<?php foreach($row AS $row){?>
    <tr align="center" bgcolor="white">
    <td><input type='checkbox' name='delids[]' value='<?=$row[id]?>' class="checkbox" id="<?=$row[id]?>"></td>
    <td><a href='javascript:blocknone("pm_<?=$row[id]?>");'><?=$row[pre_image]?></a></td>
    <td><?=$row[words]?></td>
    <td><em><?=GetTime($row[pubdate])?></em></td>
    <td><input name="displayorder[<?=$row[id]?>]" value="<?=$row[focusorder]?>" class="txt"/></td>
    <td>
	  <a href='?part=edit&id=<?=$row[id]?>'>Details</a>
    </td>
  </tr>
  <tr style="background-color:white; display:none" id="pm_<?=$row[id]?>">
    <td>&nbsp;</td>
    <td colspan="5"><img src="<?=$row[pre_image]?>"/></td>
    </tr>
    <? }?>
</table>
</div>
<center style='margin:10px'><input type="submit" value="Submit"  class="mymps large" name="focus_submit"/> </center>
</form>
<div class="pagination"><?php echo page2(); ?></div>
<?php mymps_admin_tpl_global_foot();?>
