<?=mymps_admin_tpl_global_head();?>
<script type="text/javascript" src="/template/global/messagebox.js"></script>
<div class="ccc2">
<ul>
      <form action="?" method="get">
      <input name="part" value="<?=$part?>" type="hidden">
         Keyword
 		<input name="keywords" type="text" class="text" size="40" value="<?php echo $keywords; ?>">
        <label for="c0"><input name="comment_level" class="radio" type="radio" value="0" <?php if($_GET[comment_level]==0){echo "checked";}?> id=c0>Under Revision </label>
        <label for="c1"><input name="comment_level" class="radio" type="radio" value="1" <?php if($_GET[comment_level]==1){echo "checked";}?> id=c1>Normal </label>
         <input type="submit" class="gray mini" value="Search Comment">
       </form>
	</ul>
</div>
<form name='form1' method='post' action='?part=<?=$part?>' onSubmit='return checkSubmit();'>
<input name="url" type="hidden" value="<?=GetUrl()?>">
<input name="action" type="hidden" value="delall" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="30">Select</td>
      <td width="30">Number</td>
      <td>Commenter</td>
      <td>Comment Subject</td>
	  <td>Comment Content</td>
      <td width="150">Comment Date</td>
      <td width="30">Status</td>
      <td width="60">Delete Comment</td>
    </tr>
    <tbody  onmouseover="addMouseEvent(this);">
	<?php foreach($comment AS $v){?>
    <tr align="center" bgcolor="white">
      <td><input type='checkbox' name='id[]' value='<?=$v[id]?>' class='checkbox' id="<?=$v[id]?>"></td>
      <td><?=$v[id]?></td>
	  <td><?=$v[userid]?></td>
	  <td><?=$v[title]?>&nbsp;</td>
	  <td><?=$v[content]?>&nbsp;</td>
	  <td><?=$v[pubtime]?></td>
      <td><?=$v[comment_level]?></td>
      <td><a href="?part=<?=$part?>&action=del&id=<?=$v[id]?>" onClick="return confirm('Are you sure you want to delete this comment? If you are not, please click on Cancel.')">Delete</a></td>
    </tr>
<?php }?>
    </tbody>
    <tr bgcolor="#ffffff" height="28">
    <td align="center" style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>
    <td colspan="10">
    <label for="delall"><input class="radio" type="radio" value="delall" id="delall" name="action">Delete by Batches</label> 
    <label for="level0"><input class="radio" type="radio" value="level0" id="level0" name="action">Put Comment Under Revision</label> 
    <label for="level1"><input class="radio" type="radio" value="level1" id="level1"name="action">Put Comment to Normal</label> 
    </td>
    </tr>

</table>
</div>
<center>
<input type="submit" onClick="if(!confirm('Confirm?'))return false;" value="Submit" class="mymps large"/></center>
</form>
<div class="pagination"><?=page2()?></div>
<?=mymps_admin_tpl_global_foot();?>
