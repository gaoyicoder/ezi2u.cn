<?php mymps_admin_tpl_global_head();?>

<form name="form_mymps" action="?part=list" method="post">

<input name="rename" value="1" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

    <table border="0" cellspacing="0" cellpadding="0" class="vbm">

		<tr class="firstr">

          <td colspan="2">Sub-site Sorting Type on Change City Page</td>

        </tr>

		<tr bgcolor="white">

			<td style="line-height:25px;" colspan="2">

			<label for="pinyin"><input name="cfg_cityshowtype" value="pinyin" type="radio" id="pinyin" <?php if($mymps_global['cfg_cityshowtype'] == 'pinyin') echo 'checked';?>>By Sub-site Initials</label><br />

			<label for="province"><input name="cfg_cityshowtype" value="province" type="radio" id="province" <?php if($mymps_global['cfg_cityshowtype'] == 'province') echo 'checked';?>>By Provinces (�й�Ԫ��)</label>

			</td>

		</tr>

    	<tr class="firstr">

          <td colspan="2">First Visit to Homepage(<font style="text-decoration:underline"><?php echo $mymps_global['SiteUrl']; ?></font>)ʱ��</td>

        </tr>

		<tr bgcolor="white">

          <td style="line-height:25px;" colspan="2">

         <label for="home"><input name="cfg_redirectpage" class="radio" value="home" type="radio" id="home" onclick="document.getElementById('nonecity').style.display='none';document.getElementById('sitecity').style.display='none'" <?php if($mymps_global['cfg_redirectpage'] == 'home') echo 'checked';?>>Master Site Homepage</label> <br />

<i style="margin-left:20px"><?php echo $mymps_global['SiteUrl']; ?></i><br />

          <label for="viewercity"><input name="cfg_redirectpage" class="radio" value="viewercity" type="radio" id="viewercity" onclick="document.getElementById('nonecity').style.display='';document.getElementById('sitecity').style.display='none'">Homepage of the Sub-site for the Location (City) of the Visitor</label><br />

<div id="nonecity" style=" background-color:#f5f5f5; border:1px #eee solid; margin-top:5px; margin-bottom:5px; line-height:25px; padding-left:30px; <?php if(!in_array($mymps_global['cfg_redirectpage'],array('nchome','ncchangecity'))) echo 'display:none';?>">

  If no corresponding sub-site exist<br />

  <label for="nchome"><input name="cfg_redirectpage" class="radio" value="nchome" id="nchome" type="radio" <?php if($mymps_global['cfg_redirectpage'] == 'nchome') echo 'checked';?>>Master Site Homepage</label><br />

  <label for="ncchangecity"><input name="cfg_redirectpage" class="radio" value="ncchangecity" id="ncchangecity" type="radio" <?php if($mymps_global['cfg_redirectpage'] == 'ncchangecity') echo 'checked';?>>Select City Page</label>

</div>

<i style="margin-left:20px">Jump to the sub-site for the location (city) of the visitor according to the browsing IP, like:  http://beijing.mymps.com.cn</i><br />

          <label for="changecity"><input onclick="document.getElementById('nonecity').style.display='none';document.getElementById('sitecity').style.display='none'" name="cfg_redirectpage" class="radio" value="changecity" type="radio" id="changecity" <?php if($mymps_global['cfg_redirectpage'] == 'changecity') echo 'checked';?>>Select City Page</label><br />

<i style="margin-left:20px"><?php echo $mymps_global['SiteUrl']?>/changecity.php</i><br />

		  <label for="citysite"><input onclick="document.getElementById('nonecity').style.display='none';document.getElementById('sitecity').style.display=''" class="radio" value="citysite" type="radio" id="citysite" name="cfg_redirectpage" <?php if(is_numeric($mymps_global['cfg_redirectpage'])) echo 'checked';?>>Automatically direct the visitor to designated sub-site homepage.</label><br />

		  <div id="sitecity" style="<?php if(!is_numeric($mymps_global['cfg_redirectpage'])){?>display:none;<?php }?>  border-top:1px #eee solid; margin-top:5px; padding-top:10px; margin-bottom:5px; line-height:25px; padding-left:15px">

          

		  	<select name="cfg_redirectpagee">

			<?php echo get_cityoptions($mymps_global['cfg_redirectpage']); ?>

			</select>

		  </div>

        </td>

        </tr>

    	<tr class="firstr">

          <td colspan="2">City Sub-site Files Storage Directory</td>

        </tr>

        <tr bgcolor="white">

          <td width="250" style="line-height:25px;"><input name="cfg_citiesdir" class="text" value="<?php echo $mymps_global['cfg_citiesdir'];?>"><br /><i>Example:&nbsp;&nbsp;<b style="color:#006acd">/city</b>&nbsp;&nbsp;Or Leave it Blank.</i>

</td>

          <td bgcolor="#ffffff" style="border-left:1px #eee solid;">

          <div style="line-height:25px;">

          <b style="color:red">Take Beijing as an example: </b><br />

<i>(1).</i>If the input is<font color="#006acd">/city</font>, then the directory that stores the files of Beijing Sub-site is<font color="#006acd">/city/beijing</font>. Upon visiting, sub-site directory is<font color="#006acd"><?=$mymps_global['SiteUrl']?>/city/beijing/</font><br /><i>(2).</i>If left blank, the directory that stores the files of Beijing Sub-site is<font color="#006acd">/beijing</font>. Upon visiting, sub-site directory is<font color="#006acd"><?=$mymps_global['SiteUrl']?>/beijing/</font><br />

<b style="color:red">Another note: </b><br />when sub-site storage directory is left blank, no directory to sub-site should be the same as that to the system.<br />

<?php 

foreach($mympsdirectory as $k){

	echo ' <font color="#006acd">/'.$k.'</font> ';

}

?>

		   </div>

           </td>

        </tr>

    	<tr class="firstr">

          <td colspan="2">For sub-sites, if the following selected module data is empty, they will automatically be replenished by data from the master site.</td>

        </tr>

        <tr bgcolor="white">

          <td style="line-height:25px">

          <?php

          if($mymps_global['cfg_independency']){

          	$independency = explode(',',$mymps_global['cfg_independency']);

          } else {

		  	$independency = array();

		  }

          ?>

		  <select name="independency[]" multiple="multiple" style="width:220px; height:120px;">

		  	<option value="advertisement" <?php if(in_array('advertisement',$independency)) echo 'selected'; ?>>Advertisement /advertisement</option>

			<option value="topnav" <?php if(in_array('topnav',$independency)) echo 'selected'; ?>>Sub Navigation at the Top /topnav</option>

			<option value="focus" <?php if(in_array('focus',$independency)) echo 'selected'; ?>>Focus Picture /focus</option>

			<option value="announce" <?php if(in_array('announce',$independency)) echo 'selected'; ?>>Announcement /announce</option>

			<option value="friendlink" <?php if(in_array('friendlink',$independency)) echo 'selected'; ?>>Related Sites /friendlink</option>

			<option value="telephone" <?php if(in_array('telephone',$independency)) echo 'selected'; ?>>Convenience Lines /telephone</option>

			<option value="lifebox" <?php if(in_array('lifebox',$independency)) echo 'selected'; ?>>Tools /lifebox</option>

		  </select>

          </td>

          <td bgcolor="#ffffff" valign="top" style="border-left:1px #eee solid;">

          <div style="line-height:25px;">

          <b style="color:red">Notes: </b><br />

          <i>(1).</i>Module data could be empty at the starting of the site due to insufficient information.<br />

		  <i>(2).</i>Once selected, data in a certain module will automatically be replenished by data from the master site.<br />

		  <i>(3).</i>If changes do not take place after successful submission, please<a style="text-decoration:underline" href="config.php?part=cache_sys">clear and upload system cache.</a>

          </div>

		  </td>

        </tr>

    </table>

</div>

<center><input name="<?=CURSCRIPT?>_submit" type="submit" value="Submit" class="mymps large"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

