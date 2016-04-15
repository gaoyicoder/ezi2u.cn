<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="?part=cache" class="current">Page Cache</a></li>
				<li><a href="?part=cache_sys">Data Cache</a></li>
                <li><a href="optimise.php">System Optimization</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hints</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
 <li>Note: Once cache is enabled, the display of system foreground will not change within the period set.</li>
  <li>If you have not completed initializing installation or configuration of the system, we recommend that you disable cache on all pages.</li>
  <li>Enabling system cache will greatly improve the capacity of the system! The cache period is count by seconds and set manually according to the number of visits during the period. </li>
  <li>Once your site has more than 10,000 visits (数据量过万，不知道指的什么数据，暂且用访问量代替), we strongly recommend that you enable system cache. </li>
    </td>
  </tr>
</table>
</div>
<form action="?part=cache_update" method="post">
<input name="return_url" type="hidden" value="<?=$return_url?>">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Clear Page Cache</td>
  </tr>
  <tr>
	<td class="altbg1" valign="center" style="text-align:center;width:15%"><b>Select Type of Deletion</b></td>
	<td class="altbg2">
	
	<label for="smarty_caches"><input checked="checked" name="updatecache[]" value="tpl_caches" type="checkbox" class="checkbox" id="smarty_caches">Clear Page Cache Files</label><br />
	<label for="smarty_compiles"><input checked="checked" name="updatecache[]" value="tpl_compiles" type="checkbox" class="checkbox" id="smarty_compiles">Clear Template Compilation Files</label><br />

	</td>
  </tr>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large"></center>
</form>
<div class="clear" style="height:10px;"></div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">缓存时间参考值</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td>
    	1 Minute: <font color="red">60Seconds</font> &nbsp;&nbsp; 1/2 Hour: <font color="red">1800Seconds</font> &nbsp;&nbsp; 1 Hour: <font color="red">3600Seconds</font> &nbsp;&nbsp; 3 Hours: <font color="red"><?php echo (3600*3); ?>Seconds</font> &nbsp;&nbsp; 1/2 Day: <font color="red"><?php echo (3600*12); ?>Seconds</font> &nbsp;&nbsp; 1 Day:<font color="red"><?php echo (3600*12*2); ?>Seconds</font> &nbsp;&nbsp; 2 Days: <font color="red"><?php echo (3600*12*2*2); ?>Seconds</font> &nbsp;&nbsp; 1 Week: <font color="red"><?php echo (3600*12*2*7); ?>Seconds</font>
    </td>
  </tr>
</table>
</div>
<form action="?part=cacheupdate" method="post">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td>For Page</td>
      <td>Cache Period</td>
      <td>Cache ON/Off</td>
      <td>Note</td>
    </tr>
    <?foreach ($admin_cache as $k =>$a)
    {
    ?>
<tr bgcolor="#f1f5f8">
      <td align="left">
        <b><?=$admin_cache_array[$k]?> (<?=$k?>)</b>
       </td>
      <td align="left">&nbsp;</td>
      <td align="left"><font style="color:red">Do not enable cache when the type of page display is static.</font></td>
      <td align="left" style="line-height:20px">&nbsp;</td>
    </tr>
    <?
  	  foreach ($a as $q => $w)
      {
          if(is_array($w))
            {
    ?>
    <tr bgcolor="#ffffff">
      <td align="left">
        <?=$w["name"]?> (<?=$q?>)      </td>
      <td align="left" bgcolor="white">
       <input name="<?=$q."_time"?>" value='<?=$cache[$q][time]?>' class="txt"/> <font color="red">Seconds</font>       
      </td>
      <td align="left">
      <label for="<?=$q."0"?>"><input name="<?=$q."_open"?>" type="radio" value="0" id="<?=$q."0"?>" <?if ($cache[$q][open]=='0'){echo "checked";}?> class=radio>Off</label>
      <label for="<?=$q."1"?>"><input name="<?=$q."_open"?>" type="radio" value="1" id="<?=$q."1"?>" <?if ($cache[$q][open]=='1'){echo "checked";}?> class=radio>On</label>
      </td>
      <td align="left" style="line-height:20px" bgcolor="white">
      <?=$w["des"]?>      </td>
    </tr>
    <?}
    }}?>
</table>
</div>
<center>
<input class="mymps large" value="Submit" type="submit" > 
</center>
</form>
<?php echo mymps_admin_tpl_global_foot();?>