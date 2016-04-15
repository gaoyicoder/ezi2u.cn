<?php mymps_admin_tpl_global_head();?>
<script language='javascript'>
	function CheckSubmit()
  {
     if(document.form1.focusorder.value==""){
	     alert("Focus picture order must not be empty!");
	     document.form1.focusorder.focus();
	     return false;
     }
     if(document.form1.words.value==""){
	     alert("Image description must not be empty!");
	     document.form1.words.focus();
	     return false;
     }
     if(document.form1.url.value==""){
	     alert("Jump-to link must not be empty!");
	     document.form1.url.focus();
	     return false;
     }
     if(document.form1.mymps_focus.value==""){
	     alert("Please upload an Image!");
	     document.form1.mymps_focus.focus();
	     return false;
     }
     return true;
 }
</script>
<script language="javascript" src="js/vbm.js"></script>
<form method="POST" name="form1" action="?part=add" enctype="multipart/form-data" onSubmit="return CheckSubmit();">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
            <tbody>
			<?php if(!$admin_cityid){?>
			<tr bgcolor="#f5fbff">
				<td align="right">From Sub-site: </td>
				<td>
				<select name="cityid">
				<option value="0">Master Site</option>
				<?php echo get_cityoptions($cityid); ?>
			   </select>
				</td>
			</tr>
			<?}else{?>
			<input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
			<?php }?>
              <tr bgcolor="#f5fbff" >
                <td width="15%" align="right" valign="top">Select Position: </td>
                <td>
                <select name="typename">
                	<option value="Site Homepage">Site Homepage</option>
                    <option value="News Homepage">News Homepage</option>
                </select>
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%" align="right" valign="top">Image Order: </td>
                <td>
                <input name=focusorder type=text class="text" value="<?=$maxorder?>"/>
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%" align="right" valign="top">Image Description: </td>
                <td>
                <input name=words type=text class="text" />
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%" align="right" valign="top">Jump-to Link: </td>
                <td>
                <input name=url type=text class="text" value="http://"/>
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td align="right" valign="top">Select Image to be Uploaded: </td>
                <td><input type="file" name="mymps_focus" size="45" id="litpic" onchange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  Supported Image Type for Uploading: <?=$mymps_global[cfg_upimg_type]?><br />
Size of Image for Homepage Focus: <?=$mymps_mymps[cfg_focus_limit][$tpl_index[banmian]][index][width]?> * <?=$mymps_mymps[cfg_focus_limit][$tpl_index[banmian]][index][height]?><br />
Size of Image for News Page Focus: <?=$mymps_mymps[cfg_focus_limit][news][width]?> * <?=$mymps_mymps[cfg_focus_limit][news][height]?><br />
</td>
              </tr>
              <tr bgcolor="#f5fbff">
                <td align="right" valign="top">Preview: </td>
                <td><img src="template/images/pview.gif" width="150" id="picview" name="picview" /></td>
              </tr>
            </tbody>
          </table>
</div> 
<center><input class="mymps large" type="submit" value="Upload" name="focus_submit"></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
