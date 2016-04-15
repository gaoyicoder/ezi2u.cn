<?php mymps_admin_tpl_global_head();?>
<style>
FIELDSET{ float:left; width:44%; margin:10px 10px 5px 5px; height:150px; line-height:25px;}
</style>
<script type='text/javascript' src='js/vbm.js'></script>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hints</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
    <li><?=MPS_SOFTNAME?>As a mark of its leading position, our system is equipped with pseudo-static mode as well as a dynamic/static shifting mechanism in all its modules, making it possible for you to try things out with SEO settings.</li>
	<li>All pseudo-static protocols, stored in the directory <b><font color=red>rewrite</font></b>, will be automatically updated as the following settings changes. To view directories of pseudo-static protocol files for all server categories <a href="javascript:blocknone('biao')"> Click Here.</a></li>
	<li>If you are not well acquainted with pseudo-static protocols as well as their usages, you may refer to this instruction post: <a style="text-decoration:underline" href="http://bbs.mymps.com.cn/thread-149397-1-1.html" target="_blank">http://bbs.mymps.com.cn/thread-149397-1-1.html</a></li>
    <div id="biao" style=" display:none; background-color:#f1f5f8; margin-top:10px">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
		<td><b>Category of Server</b></td>
        <td><b>Pseudo-static Protocol Files/Directories</b></td>
        </tr>
        <tr>
        <td>IIS6</td>
        <td><b>/rewrite/httpd.ini</b></td>
        </tr>
        <tr>
        <td>IIS7</td>
        <td><b>/rewrite/web.config</b></td>
        </tr>
        <tr>
        <td>Apache</td>
        <td><b>/rewrite/.htaccess</b></td>
        </tr>
        <tr>
        <td>Nginx</td>
        <td><b>/rewrite/nginx.conf</b></td>
        </tr>
        </table>
	</div>
    </td>
  </tr>
</table>
</div>
<form action="seoset.php" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">SEO Basic Settings</td>
  </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%; line-height:22px">Site title, displayed after site name in the title tag. Keywords should be properly displayed within (?).</td>
 <td bgcolor="#ffffff"><input name="seo_sitename" value="<?=$seo['seo_sitename']?>" class="text"/></td>
 </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%; line-height:22px">Site Keywords: If more than one is to be displayed, use a comma between each keyword.<br />
Use <font color="red">{city}</font> to replace sub-site name (Effective only when sub-site keywords are not individually set).</td>
 <td bgcolor="#ffffff"><input name="seo_keywords" value="<?=$seo['seo_keywords']?>" class="text"/></td>
 </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%; line-height:22px">Site description, not more than 255 characters.<br />
Use <font color="red">{city}</font> to replace sub-site name (Effective only when sub-site keywords are not individually set).</td>
 <td bgcolor="#ffffff"><textarea name="seo_description" style="height:100px; width:205px"><?=$seo['seo_description']?></textarea></td>
 </tr>
 <tr class="firstr">
  	<td colspan="2">SEO Detailed Settings</td>
  </tr>
 <tr bgcolor="#f5f8ff" style="font-weight:bold">
      <td>Subject Page</td>
      <td>Method of Display</td>
    </tr>
 <tr bgcolor="#f1f5f8">
 <td style="width:35%">Site Management/about.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_about],'seo_force_about')?></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >Category/category.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_category],'seo_force_category')?></font></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >Posts/info.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_info],'seo_force_info')?></td>
 </tr>
 <tr bgcolor="#f1f5f8">
  <td >News/news.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_news],'seo_force_news')?></td>
  <tr bgcolor="#f1f5f8">
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >Space/space.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_space],'seo_force_space')?></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td >Seller/store.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_store],'seo_force_store')?></td>
 </tr>
  <tr bgcolor="#f1f5f8">
  <td>Yellow Page of Sellers/corp.php</td>
 <td bgcolor="#ffffff"><?=GetSeoType($seo[seo_force_yp],'seo_force_yp')?></td>
 </tr>
</table>
</div>
<center><label for="updatefile"><input id="updatefile" name="updatefile" value="1" type="checkbox" checked="checked">Update Pseudo-static Protocol Files</label></center>
<center><input name="seoset_submit" value="Submit" class="mymps large" type="submit"/></center>
</form>
<div class="clear" style="margin-top:5px"></div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
 <tr class="firstr">
  	<td colspan="2">Introduction to Pseudo-static Protocols</td>
 </tr>
 <tr>
    <td colspan="2" bgcolor="#f6ffdd">
    Pseudo-static Protocol Files for IIS is in the directory of  /rewrite/httpd.ini ; Pseudo-static Protocol Files for Apache is in the directory of /rewrite/.htaccess . Should you have any inquiries, please contact an official customer service staff for help.
    </td>
 </tr>
 <tr>
 	<td bgcolor="#ffffff" colspan="2">
     <FIELDSET><LEGEND>IIS.Introduction to Second-level Domain Name Pseudo-static Settings for all Sub-sites</LEGEND> 
     For sub-sites with individual second-level domain name for each, you will have to extensive-analyse the domain name to current server IP. Example: When the individual second-level domain name is *.mymps.com ,you will have to extensive-analyse it to current server IP.
     </FIELDSET>
      <FIELDSET><LEGEND>Apache.Introduction to Second-level Domain Name Pseudo-static Settings for all Sub-sites</LEGEND>
         1£ºFor sub-sites with individual second-level domain name for each, you will have to extensive-analyse the domain name to current server IP.<br />
      2£ºCategories -> Sub-site Categories -> Built Sub-site -> Apply Second-level Domain Name to All Sub-sites
      <br />
3£º<input class="mymps mini" value="Create Apache Pseudo-static Protocol" onclick="location.href='?action=makeapacherewrite'" type="button" alt="Click to create apache pseudo-static protocol files" title="Click to create apache pseudo-static protocol files"><br />
4£ºTo change apache Setting files, add the following code to the last line:
<br />Include <?php echo str_replace('/','\\',MYMPS_ROOT);?>\apache.txt 
</FIELDSET>
     <FIELDSET><LEGEND>IIS.Introduction to Second-level Directory Pseudo-static Settings for all Sub-sites</LEGEND>
     Pseudo-static Protocol Files for IIS: /rewrite/httpd.ini
     <br />1: For virtual main frame users, the directory to be used in adding pseudo-state protocol is /rewrite/rewrite.dll
     <br />2: For VPN or individual server users, add ISAPI, the directory is the program  /rewrite/rewrite.dll
     </FIELDSET>
      <FIELDSET><LEGEND>Apache.Introduction to Second-level Directory Pseudo-static Settings for all Sub-sites</LEGEND> 
      Pseudo-static Protocol Files for Apache: /rewrite/.htaccess
      </FIELDSET>
    </td>
 </tr> 
 </table>
</div>
<?php mymps_admin_tpl_global_foot();?>
