<?php mymps_admin_tpl_global_head();?>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

				<li><a href="config.php?part=imgcode" <?php if($part == 'imgcode'){?>class="current"<?php }?>>Identifying Code Control</a></li>

				<li><a href="config.php?part=checkask" <?php if($part == 'checkask'){?>class="current"<?php }?>>Identifying Question Settings</a></li>

				<li><a href="config.php?part=badwords" <?php if($part == 'badwords'){?>class="current"<?php }?>>Filtering Settings</a></li>

				<li><a href="config.php?part=commentsettings" <?php if($part == 'commentsettings'){?>class="current"<?php }?>>Commenting Settings</a></li>

			</ul>

		</div>

	</div>

</div>

<form action="?part=badwords" method="post" name="form1">

<input name="action" value="dopost" type="hidden"/>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td colspan="5">

<a name="#Forbidden Content Filtering Settings"></a>

    <div class="left">

    <a href="javascript:collapse_change('10')">Bad/Forbidden Words Filtering Settings</a></div>

    <div class="right"><a href="javascript:collapse_change('10')"><img id="menuimg_10" src="template/images/menu_reduce.gif"/></a></div>

</td>

</tr>

	<tbody id="menu_10" style="display:">

    <tr bgcolor="#f5fbff" >

      <td style="width:100px; line-height:22px">

      Forbidden content in posts, separate with comma when inputting. </td>

      <td colspan="2">

      <textarea name="cfg_badwords0" style=" width:350px; height:120px"><?=$filter[words]?></textarea>

      </td>



    </tr>

   <tr bgcolor="#f5fbff" >

   <td style="width:100px; line-height:22px">

      Replacement Content

      </td>

      <td colspan="2">

       <input name="cfg_badwords1" value="<?=$filter[view]?>" class="text" type="text"/>

      </td>

   </tr>

<tr bgcolor="#f5fbff" >

   <td style="width:35%; line-height:22px">

      Whether or not to put a post under revision upon detected forbidden content.<br />(including categorized information and following comments as well as in-site messages)<br />

<i style="color:red">Note: This setting works when the post revision and comment revision functions are disabled. </i>     </td>

      <td colspan="2">

      <select name="cfg_badwords2" />

      	<option value="1" <?php if($filter[ifcheck] == 1){?>style='background-color:#6EB00C;color:white' selected<?}?>>Yes/On</option>

        <option value="0" <?php if($filter[ifcheck] == 0){?>style='background-color:#6EB00C;color:white' selected<?}?>>No/Off</option>

      </select>

      </td> 

   </tr>

</tbody>

</table>

</div>

<center>

<input class="mymps large" value="Submit" type="submit" > 

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

