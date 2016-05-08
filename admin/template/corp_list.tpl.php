<?php mymps_admin_tpl_global_head();?>

<form name="form_mymps" action="?part=list" method="post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr style="background: #e1f2fc; font-weight: bold; text-align:center">

      <td width="40">Number</td>

      <td>Category Name</td>

      <td width="80">Category Sorting</td>

      <td>Operation</td>

    </tr>



<?php 

if(is_array($corp)){foreach($corp AS $corp)

{

?>

	  <tr <?php if($corp[level] == 0){?>bgcolor="#f5fbff" <?}else{?>  bgcolor="#ffffff" <?}?>>

	  <td width="40"><label><?=$corp[corpid]?></label></td>

	  <td width="60%" align="left">

      <li style="margin-left:<?=$corp[level]?>em;" <?php if($corp['parentid'] != '0') echo 'class="son"'?>><a href="../corporation.php?catid=<?=$corp[corpid]?>" <?php if($corp[level] == 0){?>style="font-weight:bold" <?}?> target="_blank"><?=$corp[corpname]?></a></li></td>

      <td width="40"><input name="corporder[<?=$corp[corpid]?>]" value="<?=$corp[corporder]?>" class="txt" type="text"/></td>

	  <td><a href="corp.php?part=edit&corpid=<?=$corp[corpid]?>">Edit</a> / <a href="corp.php?part=del&corpid=<?=$corp[corpid]?>" onClick="if(!confirm('Are you sure you want to delete this seller category?\n\nThis will also delete all sub-categories affiliated to it!'))return false;">Delete</a></td>

	</tr>

<?

} }

?>

</table>

</div>

<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

