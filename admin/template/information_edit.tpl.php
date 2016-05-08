<?php mymps_admin_tpl_global_head();?>

<style>

.mymps_td td{ background-color:#ffffff}

.upload_img{width:100%; height:auto; padding:30px 60px}

.upload_img input{margin-top:5px}

.upload_img ul{float:left; margin:10px; text-align:center; }

.upload_img .preview{height:125px; border:1px #ccc solid; width:125px }

.upload_img .preview img {width:120px;}

.upload_img ul{margin-top:0; padding-top:0;}

.upload_img li{margin:0 0 10px 0}

.upload_img .img_input{width:130px;height:22px}

tr{ background-color:#f5fbff}

</style>

<script type="text/javascript">

document.domain = '<?php echo str_replace("http://www.","",$mymps_global[SiteUrl]); ?>';

</script>

<div style="display:none;">

    <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 

    <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 

    <form method="post" target="iframe_area" id="form_area"></form>

</div>

<form action="?action=edit" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();";>

	<input name="catid" value="<?=$post[catid]?>" type="hidden" />

    <input name="do" value="post" type="hidden">

    <input name="id" value="<?=$post[id]?>" type="hidden">

    <input name="ismember" value="<?=$post[ismember]?>" type="hidden">

    <input name="userid" value="<?=$post[userid]?>" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

<table width="100%" cellspacing="0" cellpadding="0" class="vbm">

      <tr class="firstr">

        <td colspan="5">

        <div class="left"><a href="javascript:collapse_change('1')">Basic Information</a></div>

        <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>

        </td>

      </tr>

      <tbody id="menu_1" class="mymps_td">

	  <tr>

        <td width="100" height="25"><font color=red>(*)</font>Post Category: </td>

        <td>

        <select name="catid">

        <?=cat_list('category',0,$post[catid])?>

        </select>

		<Caution: If you are to make changes to a category concerning the application of a different Post Model, please don't do so.>

        </td>

      </tr>

      <tr>

        <td height="25"><font color=red>(*)</font>From District: </td>

        <td>

		<?php echo select_where_option('',$post['cityid'],$post['areaid'],$post['streetid']);?>

        </td>

      </tr>

      <tr>

        <td height="25"><font color=red>(*)</font>Post Caption: </td>

        <td>

        	<input type="text" name="title" class="text" value="<?=$post[title]?>"/></td>

      </tr>

	  <?php if(is_array($post[mymps_extra_value])){

	  	foreach($post[mymps_extra_value] as $k => $v){

	  ?>

	  <tr>

        <td height="25"><?php echo $v['required'] == 1 ? '<font color=red>(*)</font>' : '';?><?php echo $v['title'];?>��</td>

        <td>

        	<?php echo $v['value'];?></td>

      </tr>

	  <?php }

	  }?>

      <?php if($cat[if_mappoint] == 1){?>

      <tr>

        <td height="25">Map Coordinates: </td>

        <td><input name="mappoint" id="mappoint" type="text" class="text" value="<?=$post[mappoint]?>" style="width:125px"/><input name="markmap" type="button" value="Click to Mark" class="gray" onclick="javascript:setbg('Map Mark',500,500,'../map.php?action=markpoint&width=500&height=500&p=<?=$post[mappoint]?>')"></td>

      </tr>

      <?}?>

      <tr>

        <td height="25">Valid Until: </td>

        <td>

        <?=$post[GetInfoLastTime]?>

        </td>

      </tr>

      </tbody>

      </table>

	  <div class="mymps_td" style="margin-top:3px">

	  <?=$acontent?>

	  </div>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table width="100%" cellspacing="0" cellpadding="0" class="vbm">

      <tr class="firstr">

      <td colspan="3">

        <div class="left"><a href="javascript:collapse_change('2')">Contact</a></div>

        <div class="right"><a href="javascript:collapse_change('2')"><img id="menuimg_2" src="template/images/menu_reduce.gif"/></a></div>

       </td>

      </tr>

      <tbody id="menu_2" class="mymps_td">

      <tr>

        <td height="25" width="100"><font color=red>(*)</font>Contact: </td>

        <td>

        	<input type="text" name="contact_who" class="text" value="<?=$post[contact_who]?>"/>        </td>

      </tr>

      <tr>

        <td height="25"><font color=red>(*)</font>Cell Phone/Landline Number: </td>

        <td>

        	<input type="text" name="tel" class="text" value="<?=$post[tel]?>"/>        </td>

      </tr>

      <tr>

        <td height="25" width="200"><font color=red>(*)</font>Address: </td>

        <td>

        	<input type="text" name="web_address" class="text" value="<?=$post[web_address]?>"/>        </td>

      </tr>

      <tr>

        <td height="25">Email Address: </td>

        <td>

        	<input type="text" class="text" value="<?=$post[email]?>" name="email"/>        </td>

      </tr>

 <!--     <tr>

        <td height="25">QQ�� (�й�Ԫ��)</td>

        <td>

        	<input type="text" class="text" value="<?=$post[qq]?>" name="qq"/>        </td>

      </tr>-->

      </tbody>

      </table>

</div>

<?php if($post[upload_img]){?>

<div id="<?=MPS_SOFTNAME?>">

<table width="100%" cellspacing="0" cellpadding="0" class="vbm">

     <tr class="firstr">

        <td colspan="3">

         <div class="left"><a href="javascript:collapse_change('3')">Relative Images</a></div>

         <div class="right"><a href="javascript:collapse_change('3')"><img id="menuimg_3" src="template/images/menu_reduce.gif"/></a></div>

        </td>

      </tr>

      <tbody id="menu_3" class="mymps_td">

      <tr class="mymps_td">

      <td colspan="2">

		<?=$post[upload_img]?>

      </td>

      </tr>

      </tbody>

    </table>

</div>

<?php }?>

<div id="<?=MPS_SOFTNAME?>">

<table width="100%" cellspacing="0" cellpadding="0" class="vbm">

     <tr class="firstr">

        <td colspan="3">

         <div class="left"><a href="javascript:collapse_change('4')">Other Settings</a></div>

         <div class="right"><a href="javascript:collapse_change('4')"><img id="menuimg_4" src="template/images/menu_reduce.gif"/></a></div>

        </td>

      </tr>

      <tbody id="menu_4" class="mymps_td">

        <?=$post[manage_pwd]?>

        <tr>

        <td height="25" width="150">Post Status: </td>

        <td>

        	<?=GetInfoLevel($post[info_level])?>

        </td>

        </tr>

        <tr>

        <td height="25" width="150">Redden Caption: </td>

        <td>

        	<select name="ifred">

            	<option value="1" 

                <?php if($post[ifred] == 1){echo "style=\"background-color:#6EB00C;color:white\" selected";}?>

                >Redden</option>

                <option value="0" 

                <?php 

                if($post[ifred] == 0){echo "style=\"background-color:#6EB00C;color:white\" selected";}

                ?>>Do not Redden</option>

            </select>

        </td>

        </tr>

        <tr>

        <td height="25" width="150">Overstrike Caption: </td>

        <td>

        	<select name="ifbold">

            	<option value="1" 

                <?php 

                if($post[ifbold] == 1){echo "style=\"background-color:#6EB00C;color:white\" selected";}

                ?>>Overstrike</option>

                <option value="0" 

                <?php 

                if($post[ifbold] == 0){echo "style=\"background-color:#6EB00C;color:white\" selected";}

                ?>>Do not Overstrike</option>

            </select>

        </td>

        </tr>

        <tr>

        <td height="25">Place at the Top of the Broad Headings or Not: </td>

        <td>

        	<?=$post[upgrade_type]?> <?=GetUpgradeTime($post[upgrade_time])?>If you do not wish to place post at the top, you may ignore this option.

        </td>

        </tr>

        <tr>

		<tr>

        <td height="25">Place at the Top of the Sub-headings or Not: </td>

        <td>

        	<?=$post[upgrade_type_list]?> <?=GetUpgradeTime($post[upgrade_time_index],'upgrade_time_index')?>If you do not wish to place post at the top, you may ignore this option.

        </td>

        </tr>

        <tr>

        <td height="25">Place at the Top of the Homepage or Not: </td>

        <td>

        	<?=$post[upgrade_type_index]?> <?=GetUpgradeTime($post[upgrade_time_index],'upgrade_time_index')?>If you do not wish to place post at the top, you may ignore this option.

        </td>

        </tr>

        <tr>

        <td height="25">发布时间：<br /><em><?php echo GetTime($post['begintime']); ?></em></td>

        <td>

        <label for="refresh"><input name="refresh" value="1" type="checkbox" class="checkbox" id="refresh">刷新?</label>

        </td>

        </tr>

      </tbody>

    </table>

</div>

<center><input type="button" onclick="window.open('../information.php?id=<?=$post[id]?>')" target=_blank value="Preview" class="gray mini" />

&nbsp;

<input type="submit" name="mymps" value="Change" class="mymps mini" />

&nbsp;&nbsp;<input type="button" onClick="location.href='?'" value="Return" class="mymps mini"> 

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

