<?php mymps_admin_tpl_global_head();?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

	<td>Retrieve Announcement</td>

    <td style="text-align:right">

    <?php if(!$admin_cityid){?>

    Select Sub-site��<select name="cityid" onChange="location.href='?part=all&page=<?=$page?>&cityid='+(this.options[this.selectedIndex].value)">

       	<option value="0">Master Site</option>

        <?php echo get_cityoptions($cityid); ?>

       </select>

    <? }?>

    &nbsp;

    </td>

</tr>

<tr>

	<td colspan="2" bgcolor="white">

      <form action="announce.php?part=all" method="get">

      Title 

        <input name="title" class="text" type="text" size="30" value="<?php echo $title; ?>"> 

        Author 

        <input name="author" class="text" type="text" size="15" value="<?php echo $author; ?>"><input type="submit" value="Retrieve Announcement" class="gray mini"> &nbsp;&nbsp;<input type="button" class="mymps mini" onClick="location.href='announce.php?part=add'" value="Post Announcement">

       </form>

	</td>

</tr>

</table>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <form name='form1' method='post' action='announce.php' onSubmit='return checkSubmit();'>

    <input type='hidden' name='part' value='delall'/>

    <input type="hidden" name="url" value="<?=GetUrl()?>" />

    <tr class="firstr">

      <td width="30">Select</td>

      <td width="30">Number</td>

      <td>Announcement Title</td>

      <td>Announcement Author</td>

      <td>Start From</td>

      <td>End By</td>

      <td>Add Date</td>

      <td>Operate</td>

    </tr>

    <tbody onmouseover="addMouseEvent(this);">

	<?php if(is_array($announce)){foreach($announce AS $announce){?>

	<tr bgcolor="#ffffff">

   	  <td><input type='checkbox' class="checkbox" name='id[]' value='<?=$announce[id]?>' id="<?=$announce[id]?>"></td>

	  <td><label><?=$announce[id]?></label></td>

	  <td align="left"><a href="../about.php?part=announce#<?=$announce[id]?>" target="_blank"><?=$announce[title]?></a></td>

      <td align="left"><?=$announce[author]?></td>

      <td align="left"><em><?=GetTime($announce[begintime])?></em>&nbsp;</td>

      <td align="left"><em><?=GetTime($announce[endtime])?></em>&nbsp;</td>

      <td align="left"><?=GetTime($announce[pubdate])?></td>

	  <td align="center"><a href="announce.php?part=edit&id=<?=$announce[id]?>">Edit</a> / <a href="announce.php?part=delete&id=<?=$announce[id]?>&url=<?=GetUrl()?>" onClick="if(!confirm('Are you sure you wish to delete it?\n\nDeleted items cannot be restored!'))return false;">Delete</a>

	  </td>

	</tr>

	<?}}?>

    </tbody>

    <tr bgcolor="#ffffff" height="28">

    <td align="center" style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>

    <td colspan="10">

<input type="submit" onClick="if(!confirm('ȷ��Ҫ������\n\n�˲��������Իָ���'))return false;" value="����ɾ��" class="mymps mini"/>      

    </td>

    </tr>

  </form>

</table>

</div>

<div class="pagination"><?php echo page2()?></div>  

<?php mymps_admin_tpl_global_foot();?>

