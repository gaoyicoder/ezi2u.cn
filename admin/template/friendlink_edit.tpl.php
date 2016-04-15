<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="friendlink.php?part=list">Added Related Sites</a></li>
                <li><a href="friendlink.php?part=add">Add Related Site</a></li>
                <?php if(!$admin_cityid){?><li><a href="friendlink.php?do=type" <?php if($do=='type'){?>class="current"<?php }?>>Site Type Management</a></li><?php }?>
				<li><a href="friendlink.php?part=edit&id=<?=$id?>" class="current">Edit Link</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="friendlink.php?part=update&id=<?=$link[id]?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();";>
    <input type="hidden" name="createtime" value="<?=date("Y-m-d H:i:s", time()) 
?>">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="5">
        <div class="left"><a href="javascript:collapse_change('1')">Site Brief</a></div>
        <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
        </td>
      </tr>
      <tbody id="menu_1">
	  <?php if(!$admin_cityid){?>
        <tr bgcolor="#f5fbff">
            <td>From Sub-site: </td>
            <td>
            <select name="cityid">
            <option value="0">Master Site</option>
            <?php echo get_cityoptions($link[cityid]); ?>
           </select>
            </td>
        </tr>
        <?}else{?>
        <input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
        <?php }?> 
	  <tr bgcolor="#f5fbff">
        <td width="19%" height="25">URL: </td>
        <td>
        	<input name="url" type=text class=text id="url" value="<?=$link[url]?>" size="30" />        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Site Name: </td>
        <td>
        	<input name="webname" type=text class=text id="webname" size="30" value="<?=$link[webname]?>"/>        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Site LOGO: </td>
        <td>
        <input name="weblogo" type=text class=text id="weblogo" size="30" value="<?=$link[weblogo]?>"/> <br />Size 80*35<br />
If link in text is displayed, adding URL of Logo will not be necessary.<br />
Logo is not displayed on the category page.
    </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">PR Value</td>
        <td>
		<?=apply_flink_pr($link[pr]);?>	
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">Number of Visitor's IP per Day

</td>
        <td>
        <?=apply_flink_dayip($link[dayip]);?>	    
		</td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Site Brief: </td>
        <td><textarea name="msg" cols="50" rows="5" id="msg"><?=de_textarea_post_change($link[msg])?></textarea></td>
      </tr>
      </tbody>
      </table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
     <tr class="firstr">
        <td colspan="3">
         <div class="left"><a href="javascript:collapse_change('3')">Other Properties</a></div>
         <div class="right"><a href="javascript:collapse_change('3')"><img id="menuimg_3" src="template/images/menu_reduce.gif"/></a></div>
        </td>
      </tr>
      <tbody id="menu_3">
      <tr bgcolor="#f5fbff">
        <td height="25">Site Type: </td>
        <td>
        <select name="typeid" id="typeid">
		<?php echo webtype_option($link[typeid]) ; ?>
        </select>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Link Status: </td>
        <td>
        <label><input class="radio" type='radio' name='ischeck' value="1" <?php if ($link[ischeck]=="1") echo"checked='checked'";?>> Under Revision</label>
        <label><input type='radio' class="radio" name='ischeck' value="2" <? if ($link[ischeck]=="2") echo"checked='checked'";?>> Normal</label>
                </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">Order in Number: </td>
        <td>
<input name="ordernumber" type=text class=txt id="order" value="<?=$link[ordernumber]?>"/>        
(From small to large)        
		</td>
      </tr>
</tbody>
    </table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="2">Position of Display</td></tr>
  <tr bgcolor="#f5fbff">
    <td width="19%" height="25">Display on Site Homepage?</td>
    <td>
    <select name="ifindex" id="ifindex">
    <option value="2" <?php if($link[ifindex] == 2) echo 'selected';?>>Yes</option>
	<option value="1" <?php if($link[ifindex] == 1) echo 'selected';?>>No</option>
    </select>
    </td>
  </tr>
<tr bgcolor="#f5fbff">
    <td height="25">Display in This Category: </td>
    <td>
	<select name="catid">
	<option value="0" <?php if($link[catid] == 0) echo 'selected';?>>Do Not Display in Categories</option>
	<?=cat_list('category',0,$link['catid'],true,1)?>
  </select>
    </td>
  </tr>
      </tbody>
    </table>
</div>
<center><input type="submit" name="submit" value="Submit" class="mymps large" /></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
