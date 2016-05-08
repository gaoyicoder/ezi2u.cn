<?php mymps_admin_tpl_global_head();

$admindir = getcwdOL();

?>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

				<li><a href="pm.php?part=send" <?php if($part == 'send'){?>class="current"<?php }?>>Send message to Multiple Receivers</a></li>

				<li><a href="pm.php?part=outbox" <?php if($part == 'outbox'){?>class="current"<?php }?>>Sent Messages</a></li>

			</ul>

		</div>

	</div>

</div>

<script type='text/javascript' src='js/vbm.js'></script>

<form action="?action=pm" method="post">

<input name="url" type="hidden" value="<?=GetUrl()?>">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm" >

    <tr class="firstr">

    <td width="50"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/> Delete?</td>

    <td>Title</td>

    <td>Sender</td>

    <td>Subject</td>

    <td>Read/Unread</td>

    <td width="120">Time</td>

  </tr>

<?php foreach($pm AS $row){?>

    <tr bgcolor="#ffffff" >

    <td><input type='checkbox' name='delids[]' value='<?=$row[id]?>' class='checkbox'></td>

    <td><a href='javascript:blocknone("pm_<?=$row[id]?>");'>

    <?php

    if($row[if_sys] == 1)echo '<b>[System Notice]</b> '; 

    echo $row[title];

    ?>

    </a></td>

    <td><?=$row[fromuser]?></td>

    <td><a href="

javascript:setbg('<?=MPS_SOFTNAME?>Member Centre',400,110,'../box.php?part=member&userid=<?=$row[touser]?>&admindir=<?=$admindir?>')"><?=$row[touser]?></a></td>

    <td>

    <?php

    if($row[if_read] == 1)echo '<font color=green>Read</font>'; 

    else echo '<font color=red>Unread</font>';

    ?>

    </a></td>

    <td><?=GetTime($row[pubtime])?></td>

  </tr>

   <tr style="background-color:white; display:none" id="pm_<?=$row[id]?>">

     <td>&nbsp;</td>

     <td colspan="5">

     <div class="pm_view">

     <?=$row[content]?>

     </div>

     <div class="lit_manage"><a href="?part=send&id=<?=$row[id]?>">Forward</a> - 

			<a href="?part=del&id=<?=$row[id]?>&url=<?=urlencode(GetUrl())?>">Delete</a></div></td>

    </tr>

<?}?>

</table>

</div>

<center><input type="submit" name="pm_submit" value="Submit" class="mymps large" /></center>

</form>

<div class="pagination"><?php echo page2();?></div>

<?php mymps_admin_tpl_global_foot();?>

