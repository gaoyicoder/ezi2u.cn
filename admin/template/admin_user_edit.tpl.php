<?php mymps_admin_tpl_global_head();?>

<script language='javascript'>

	function checkSubmit()

  {

     if(document.form1.uname.value==""){

	     alert("User name cannot be empty!");

	     document.form1.uname.focus();

	     return false;

     }

     return true;

 }

</script>

<div id="<?=MPS_SOFTNAME?>">

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">

<form name="form1" action="?do=user" method="post" onSubmit="return checkSubmit();">

<input type="hidden" name="part" value="update" />

  <input type="hidden" name="id" value="<?=$id?>" />

  	 <?php if(!$admin_cityid){?>

      <tr>

        <td>From Sub-site<font color="red">(*)</font></td>

        <td><select name="cityid">

        <option value="0">Master Site</option>

        <?php echo get_cityoptions($admin[cityid]); ?>

        </select></td>

      </tr>

	  <?php }?>

   	  <tr>

        <td width="16%" height="30">User Log-in ID<font color="red">(*)</font></td>

        <td width="84%"><input name="userid" class="text" type="text" id="userid" size="16" value="<?=$admin[userid]?>" style="width:200px" /></td>

    </tr>

    	  <tr>

      <td height="30">User Psudonym<font color="red">(*)</font></td>

      <td><input name="uname" class="text" type="text" id="uname" size="16" value="<?=$admin[uname]?>" style="width:200px" />

        &nbsp;Name displayed upon responding messages </td>

    </tr>

    <tr>

    <td height="30">Real Name<font color="red">(*)</font></td>

    <td><input name="tname" class="text" type="text" id="tname" size="16" style="width:200px" value="<?= $admin[tname]?>" />

    &nbsp;Not displayed publicly, just for background recordings </td>

    </tr>

    <tr>

      <td height="30">User Password<font color="red">(*)</font></td>

      <td><input name="pwd" class="text" type="text" id="pwd" size="16" style="width:200px" />

        &nbsp;If left blank then no changes will be made, and only characters among'0-9a-zA-Z.@_-!'can be used</td>

    </tr>

<tr>

            <td height="30">User Group<font color="red">(*)</font></td>

            <td>

			    <select name='typeid' style='width:200px'>

                <?php echo get_admin_group($admin[typeid]);?>

			  </select>

			    <?php if(!$admin_cityid){?>&nbsp;

			    <a href='admin.php?do=group'><u>User Group Settings</u></a><?php }?>

            </td>

          </tr>

    	  <tr>

      <td height="30">Email Address<font color="red">(*)</font></td>

      <td><input name="email" class="text" type="text" id="email" size="16" style="width:200px" value="<?= $admin[email]?>" />

        &nbsp;</td>

    </tr>

    <tr>

      <td height="60">&nbsp;</td>

      <td><input type="submit" name="Submit" value="Save User" class="mymps mini" />

            <input type="button" onClick=history.back() value="Return" class="mymps mini">

      </td>

    </tr>

  </form>

</table>

</div>

<?php mymps_admin_tpl_global_foot();?>

