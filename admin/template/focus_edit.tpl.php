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
     if(document.form1.vbm_img.value==""){
	     alert("Please upload an Image!");
	     document.form1.vbm_img.focus();
	     return false;
     }
     return true;
 }
</script>
<script language="javascript" src="js/vbm.js"></script>
<form method="POST" name="form1" action="focus.php?part=<?=$part?>" enctype="multipart/form-data"  onSubmit="return CheckSubmit();">
<input name="image" value="<?=$row[image]?>" type="hidden">
<input name="pre_image" value="<?=$row[pre_image]?>" type="hidden">
<input name=id type=hidden value="<?=$row[id]?>"/>
<input name="typename" value="<?=$row[typename]?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
            <tbody>
			<?php if(!$admin_cityid){?>
			 <tr bgcolor="#f5fbff" >
                <td width="15%" align="right" valign="top">From Sub-site: </td>
                <td>
                <select name="cityid">
                	<option value="0">Master Site</option>
					<?php echo get_cityoptions($row[cityid]); ?>
                </select>
                </td>
                </tr>
			 <?php } else {?>
			 <input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
			 <?php }?>
              <tr bgcolor="#f5fbff" >
                <td width="15%" align="right">Source Image Directory: </td>
                <td>
                <input name=image type=text class="text" style='background-color:#CCCCCC' value="<?=$row[image]?>" readonly="readonly"/> Unchangeable
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%" align="right">Original Image</td>
                <td>
                <img src="<?=$row[pre_image]?>"/>
                </td>
              </tr>
            <tr bgcolor="#f5fbff">
                <td align="right" valign="top">Select Image to be Uploaded: </td>
                <td><input type="file" name="mymps_focus" size="45" id="litpic" onchange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  Supported Image Type for Uploading: <?=$mymps_global[cfg_upimg_type]?><br />
Size of Image for Homepage Focus: <?=$mymps_mymps[cfg_focus_limit][$tpl_index[banmian]][index][width]?> * <?=$mymps_mymps[cfg_focus_limit][$tpl_index[banmian]][index][height]?><br />
Size of Image for News Page Focus: <?=$mymps_mymps[cfg_focus_limit][news][width]?> * <?=$mymps_mymps[cfg_focus_limit][news][height]?><br />
</td>
              </tr>
             <tr bgcolor="#f5fbff" >
        <td align="right" valign="top">Preview: </td>
        <td><img src="template/images/pview.gif" width="150" id="picview" name="picview" /></td>
      </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%">Image Order: </td>
                <td>
                <input name=focusorder type=text class="text" value="<?=$row[focusorder]?>"/>
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%">Image Description: </td>
                <td>
                <input name=words type=text class="text" value="<?=$row[words]?>"/>
                </td>
              </tr>
              <tr bgcolor="#f5fbff" >
                <td width="15%">Jump-to Link: </td>
                <td>
                <input name=url type=text size=35 style='width:250px' value="<?=$row[url]?>"/>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr bgcolor="#f5fbff" >
                <td height="45">&nbsp;</td>
                <td height="45">
                <input value="Update" type="submit" class="mymps mini" name="<?=CURSCRIPT?>_submit">
                <input type="reset" onClick=history.back() value="Return" class="mymps mini">
                </td>
              </tr>
            </tfoot>
          </table>
</div>           
</form>
<?php mymps_admin_tpl_global_foot();?>
