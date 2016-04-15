<?php mymps_admin_tpl_global_head();?>
<script language='javascript'>
function CheckSubmit()
{
	if(document.form1.url.value=="http://"||document.form1.url.value=="")
	{
   		document.form1.url.focus();
   		alert("The URL cannot be empty!");
   		return false;
	}
	if(document.form1.webname.value=="")
	{
   		document.form1.webname.focus();
   		alert("Site name cannot be empty!");
   		return false;
	}
	return true;
}
</script>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="friendlink.php?part=list" <?php if($part=='list'){?>class="current"<?php }?>>Added Related Sites</a></li>
                <li><a href="friendlink.php?part=add" <?php if($part=='add'){?>class="current"<?php }?>>Add Related Site</a></li>
                <?php if(!$admin_cityid){?><li><a href="friendlink.php?do=type" <?php if($do=='type'){?>class="current"<?php }?>>Site Type Management</a></li><?php }?>
            </ul>
        </div>
    </div>
</div>
<form action="?part=insert" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();";>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<input type="hidden" name="createtime" value="<?=date("Y-m-d H:i:s", time())?>">
<tr class="firstr">
<td colspan="2">Basic Information of Site</td>
</tr>
<?php if(!$admin_cityid){?>
        <tr bgcolor="#f5fbff">
            <td>From Sub-site: </td>
            <td>
            <select name="cityid">
            <option value="0">Master Site</option>
            <?php echo get_cityoptions(); ?>
           </select>
            </td>
        </tr>
        <?}else{?>
        <input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
        <?php }?> 
  <tr bgcolor="#f5fbff">
    <td width="19%" height="25">URL: </td>
    <td width="81%">
        <input name="url" type=text class=text id="url" value="http://" size="30" />
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="25">Site Name: </td>
    <td>
        <input name="webname" type=text class=text id="webname" size="30" />
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="25">Site LOGO: </td>
    <td>
        <input name="weblogo" type=text class=text id="weblogo" size="30"/> <br />Size 80*35<br />
If link in text is displayed, adding URL of Logo will not be necessary.<br />
Logo is not displayed on the category page.
    </td>
  </tr>
<tr class="firstr"><td colspan="2">Display At</td></tr>
  <tr bgcolor="#f5fbff">
    <td height="25">Display on Homepage?</td>
    <td>
    <select name="ifindex" id="ifindex">
    <option value="2">Yes </option>
	<option value="1">No</option>
    </select> 
    </td>
  </tr>
<tr bgcolor="#f5fbff">
    <td height="25">Display in This Category: </td>
    <td>
	<select name="catid">
	<option value="0">Do Not Display in Categories</option>
	<?=cat_list('category',0,0,true,1)?>
  </select>
    </td>
  </tr>
<tr class="firstr"><td colspan="2">Link Type</td></tr>
  <tr bgcolor="#f5fbff">
    <td height="25">Site Type: </td>
    <td>
    <select name="typeid" id="typeid">
<?php 
foreach($links AS $row){
?>
    <option value="<?=$row[id]?>"><?=$row[typename]?></option>
<?php
}
?>
    </select>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="19%" height="25">Position: </td>
    <td width="81%">
    <input name="ordernumber" type=text class=txt id="order" size="10" />
    (The smaller the number, the closer the position is to the top)
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="25">Link Status: </td>
    <td>
    <label for="1"><input type='radio' name='ischeck' value="1" id="1" class="radio"/> Under Revision</label>
    <label for="2"><input type='radio' name='ischeck' value="2" checked id="2" class="radio"/> Normal </label>
    </td>
  </tr>
</table>
</div>
<center><input type="submit" name="submit" value="Submit" class="mymps large"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
