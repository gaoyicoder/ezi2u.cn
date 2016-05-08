<?php mymps_admin_tpl_global_head();?>

<script type='text/javascript' src='js/vbm.js'></script>

<script type="text/javascript">

function simplevalue(){

	$Obj('banmian_simple').className='txt';

	$Obj('banmian_portal').className='txt';

	$Obj('banmian_classic').className='txt';

	$Obj('banmian_simple').className='txt checked';

	$Obj('indextopinfo').value='<?php echo $defaultset[simple][indextopinfo];?>';

	$Obj('newinfo').value='<?php echo $defaultset[simple][newinfo];?>';

	$Obj('announce').value='<?php echo $defaultset[simple][announce];?>';

	$Obj('faq').value='<?php echo $defaultset[simple][faq];?>';

	$Obj('lifebox').value='<?php echo $defaultset[simple][lifebox];?>';

	$Obj('telephone').value='<?php echo $defaultset[simple][telephone];?>';

	$Obj('goods').value='<?php echo $defaultset[simple][goods];?>';

	$Obj('foreachinfo').value='<?php echo $defaultset[simple][foreachinfo];?>';

	$Obj('news').value='<?php echo $defaultset[simple][news];?>';

}



function portalvalue(){

	$Obj('banmian_simple').className='txt';

	$Obj('banmian_portal').className='txt';

	$Obj('banmian_classic').className='txt';

	$Obj('banmian_portal').className='txt checked';

	$Obj('indextopinfo').value='<?php echo $defaultset[portal][indextopinfo];?>';

	$Obj('newinfo').value='<?php echo $defaultset[portal][newinfo];?>';

	$Obj('announce').value='<?php echo $defaultset[portal][announce];?>';

	$Obj('faq').value='<?php echo $defaultset[portal][faq];?>';

	$Obj('lifebox').value='<?php echo $defaultset[portal][lifebox];?>';

	$Obj('telephone').value='<?php echo $defaultset[portal][telephone];?>';

	$Obj('goods').value='<?php echo $defaultset[portal][goods];?>';

	$Obj('foreachinfo').value='<?php echo $defaultset[portal][foreachinfo];?>';

	$Obj('news').value='<?php echo $defaultset[portal][news];?>';

}



function classicvalue(){

	$Obj('banmian_simple').className='txt';

	$Obj('banmian_portal').className='txt';

	$Obj('banmian_classic').className='txt';

	$Obj('banmian_classic').className='txt checked';

	$Obj('indextopinfo').value='<?php echo $defaultset[classic][indextopinfo];?>';

	$Obj('newinfo').value='<?php echo $defaultset[classic][newinfo];?>';

	$Obj('announce').value='<?php echo $defaultset[classic][announce];?>';

	$Obj('faq').value='<?php echo $defaultset[classic][faq];?>';

	$Obj('lifebox').value='<?php echo $defaultset[classic][lifebox];?>';

	$Obj('telephone').value='<?php echo $defaultset[classic][telephone];?>';

	$Obj('goods').value='<?php echo $defaultset[classic][goods];?>';

	$Obj('foreachinfo').value='<?php echo $defaultset[classic][foreachinfo];?>';

	$Obj('news').value='<?php echo $defaultset[classic][news];?>';

}

</script>

<style>

.smalltxt{ font-size:12px!important; color:#999!important; font-weight:100!important}

.altbg1{ background-color:#f1f5f8}



.blue{ width:70px; height:30px; display:block; background-color:#3592E2; padding-right:10px;}

.green{ width:70px; height:30px; display:block; background-color:#42B712; padding-right:10px;}

.orange{ width:70px; height:30px; display:block; background-color:#F78015; padding-right:10px;}

.red{ width:70px; height:30px; display:block; background-color:#C40000; padding-right:10px;}



.showtpl1{display:block; height:90px; float:left; text-align:center; margin:10px}

.showtpl1 a{ display:block; width:116px; float:left; height:184px;}

.showtpl1 a.checked img{ border:4px #F90 solid;}

.showtpl1 .txt{ margin-top:5px; float:left;}





.showtpl2{display:block; height:90px; float:left; text-align:center; margin:10px 10px 20px 10px;}

.showtpl2 .txt{ margin-top:5px; float:left; border:1px #ddd solid; padding:10px 0;}

.checked{ border:2px #FFB38C solid!important; background-color:#FFF6F0; padding:5px 0 10px 5px;}



.showtpl1 label,.showtpl2 label{ cursor:pointer;}



.showtpl a:hover,.showindex a:hover{ text-decoration:none; cursor:pointer}</style>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

			<li><a href="template.php" class="current">Default Template Settings</a></li>

			<li><a href="file_manage.php">Online Style Edit</a></li>

			</ul>

		</div>

	</div>

</div>

<form method="post" action="?">

<input name="return_url" value="<?php echo GetUrl();?>" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

	<tr class="firstr"><td colspan="2">Site Template Application Settings</td></tr>

	<tr bgcolor="white">

		<td width="20%" class="altbg1" ><b>Template Style Applied for Site</b><br /><span class="smalltxt"></span></td>

		<td class="altbg2">

		<?php foreach($template['fengge']['flag'] as $k => $v){?>

			<div id="index_<?=$k?>" class="showtpl1 <?php if($mymps_global['cfg_tpl_dir'] == $k){?>checked<?php }?>">

			<label for="<?=$k?>">

			<div class="txt"><span class="<?=$k?>"></span><div class="clearfix"></div><input onclick="$Obj('index_blue').className='showtpl1';$Obj('index_green').className='showtpl1';$Obj('index_orange').className='showtpl1';$Obj('index_red').className='showtpl1';$Obj('index_<?=$k?>').className='showtpl1 checked';<?php if($k == 'red'){ echo '$Obj(\'style_normal\').disabled=true;$Obj(\'style_standard\').checked=true';}else{echo '$Obj(\'style_normal\').disabled=false;';}?>" id="<?=$k?>" name="cfg_tpl_dir" type="radio" class="radio" value="<?=$k?>" <?php if($mymps_global['cfg_tpl_dir'] == $k){?>checked="checked"<?php }?>><?=$v?> <br /><font color="#666">(<?=$k?>)</font></div>

			</label>

			</div>

		<?php }?>

		</td>

	</tr>

	<tr bgcolor="white">

		<td width="20%" class="altbg1" ><b>Background Display on Template</b><br /><span class="smalltxt"></span></td>

		<td class="altbg2">

		 	<label for="bodybg_1"><input id="bodybg_1" name="bodybg" type="radio" value="1" <?php if($mymps_global['bodybg'] == '1'){echo ' checked="checked" ';}?>> Yes</label>

			<label for="bodybg_0"><input id="bodybg_0" name="bodybg" type="radio" value="0" <?php if($mymps_global['bodybg'] == '0'){?>checked="checked"<?php }?>> No</label>

		</td>

	</tr>

	<tr bgcolor="white">

		<td width="20%" class="altbg1" ><b>Traditional</b><br /><span class="smalltxt"></span></td>

		<td class="altbg2">

		 	<input id="style_normal" name="head_style" type="radio" value="normal" <?php if($mymps_global['head_style'] == 'normal'){echo ' checked="checked" ';}?> <?php if($mymps_global['cfg_tpl_dir'] == 'red'){echo ' disabled="disabled" ';}?>> ��ͳ��ʽ

			<input id="style_standard" name="head_style" type="radio" value="new" <?php if($mymps_global['head_style'] == 'new'){?>checked="checked"<?php }?>> Flattening

		</td>

	</tr>

	<tr bgcolor="white">

		<td width="20%" class="altbg1" ><b>Page Width</b><br /><span class="smalltxt"></span></td>

		<td class="altbg2">

			<table width="0" border="0" cellspacing="0" cellpadding="0" style="border:1px #C5D8E8 solid; margin:10px 0 10px 10px">

			<tr>

			  <td style="border-right:1px #C5D8E8 solid; border-bottom:none;">Homepage</td>

			  <td style="border-right:1px #C5D8E8 solid; border-bottom:none;">Categories with List Page</td>

			  <td style="border-right:1px #C5D8E8 solid; border-bottom:none;">Content Details Page</td>

			  <td style="border-bottom:none;">Other Pages</td>

			</tr>

			<tr>

			  <td style="border-right:1px #C5D8E8 solid;border-bottom:none;">

			  <select name="screen_index">

			  <option value="standard" <?php if($mymps_global[screen_index] == 'standard') echo 'selected'; ?>>Standard(1000px)</option>

			  <option value="full" <?php if($mymps_global[screen_index] == 'full') echo 'selected'; ?>>Wide(1200px)</option>

			  </select>

			  </td>

			  <td style="border-right:1px #C5D8E8 solid;border-bottom:none;">

			  <select name="screen_cat">

			  <option value="standard" <?php if($mymps_global[screen_cat] == 'standard') echo 'selected'; ?>>Standard(1000px)</option>

			  <option value="full" <?php if($mymps_global[screen_cat] == 'full') echo 'selected'; ?>>Wide(1200px)</option>

			  </select>

			  </td>

			  <td style="border-right:1px #C5D8E8 solid;border-bottom:none;">

			  <select name="screen_info">

			  <option value="standard" <?php if($mymps_global[screen_info] == 'full') echo 'selected'; ?>>Standard(1000px)</option>

			  <option value="full" <?php if($mymps_global[screen_info] == 'full') echo 'selected'; ?>>Wide(1200px)</option>

			  </select>

			  </td>

			  <td style="border-bottom:none;">

			  <select name="screen_search">

			  <option value="standard" <?php if($mymps_global[screen_search] == 'standard') echo 'selected'; ?>>Standard(1000px)</option>

			  <option value="full" <?php if($mymps_global[screen_search] == 'full') echo 'selected'; ?>>Wide(1200px)</option>

			  </select>

			  </td>

			</tr>

			</table>

		</td>

	</tr>

    <tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Application of Homepage Space:</b><br /><span class="smalltxt"></span></td>

		<td class="altbg2">

		<?php foreach($template['banmian']['flag'] as $k => $v){

			if($k == 'simple'){

				$obj = 'onclick="simplevalue();$Obj(\'simple_tpl\').style.display=\'\';$Obj(\'portal_tpl\').style.display=\'none\';"';

			} elseif($k == 'portal') {

				$obj = 'onclick="portalvalue();$Obj(\'simple_tpl\').style.display=\'none\';$Obj(\'portal_tpl\').style.display=\'\';"';

			} elseif($k == 'classic') {

				$obj = 'onclick="classicvalue();$Obj(\'simple_tpl\').style.display=\'none\';$Obj(\'portal_tpl\').style.display=\'none\';"';

			}

		?>

			<div class="showtpl2">

			<label for="<?=$k?>" title="<?php echo $k == 'simple' ? 'Suitable for site masters in charge of Categorized Posts' :($k == 'portal' ? 'Suitable for site masters in charge of local sub-sites' : 'Suitable for site masters in charge of Info on other industries')?>">

			<!--<div class="img"><img src="../images/tpl_preview/<?=$k?>.gif"></div>-->

			<div id="banmian_<?=$k?>" style="padding:15px;" class="txt <?php if($tpl_index[banmian] == $k){?>checked<?php }?>"><?=$v?> <input  <?php echo $obj;?> id="<?=$k?>" name="tpl_index[banmian]" type="radio" class="radio" value="<?=$k?>" <?php if($tpl_index[banmian] == $k){?>checked="checked"<?php }?>><br /><font color="#666">Template File Directory<br />/template/default/index_<font style="color:#cd0000;"><?=$k?></font>.tpl.php</font></div>

			</label>

			</div>

		<?php }?>

		<div class="clear"></div>

		<div id="simple_tpl" style="display:<?php if($tpl_index[banmian] != 'simple'){?>none<?php }?>;">

			<div class="simple_tpl_bg">

				<div class="hd">

					Arrangement of Categories on Homepage(Press and hold CTRL to select multiple items)

				</div>

				<div class="bd">

					<div class="first">

						<select name="tpl_index[smp_cats][first][]" multiple="multiple">

							<?php foreach($cat as $k => $v){?>

							<option value="<?=$v[catid]?>" <?php if(in_array($v[catid],$tpl_index[smp_cats][first])) echo 'selected';?>><?=$v[catname]?></option>

							<?php }?>

						</select><br /><br />

	

	Column 1

					</div>

					<div class="second">

						<select name="tpl_index[smp_cats][second][]" multiple="multiple">

							<?php foreach($cat as $k => $v){?>

							<option value="<?=$v[catid]?>" <?php if(in_array($v[catid],$tpl_index[smp_cats][second])) echo 'selected';?>><?=$v[catname]?></option>

							<?php }?>

						</select><br /><br />

	

	Column 2

					</div>

					<div class="third">

						<select name="tpl_index[smp_cats][third][]" multiple="multiple">

							<?php foreach($cat as $k => $v){?>

							<option value="<?=$v[catid]?>"<?php if(in_array($v[catid],$tpl_index[smp_cats][third])) echo 'selected';?>><?=$v[catname]?></option>

							<?php }?>

						</select><br /><br />

	

	Column 3

					</div>

					<div class="fourth">

						<select name="tpl_index[smp_cats][fourth][]" multiple="multiple">

							<?php foreach($cat as $k => $v){?>

							<option value="<?=$v[catid]?>"<?php if(in_array($v[catid],$tpl_index[smp_cats][fourth])) echo 'selected';?>><?=$v[catname]?></option>

							<?php }?>

						</select><br /><br />

	

	Column 4

					</div>

				</div>

			</div>

			<div class="clear"></div>

			<div class="simple_tpl_bg2">

				<div class="hd">

					Form of Display for Sub-categories

				</div>

				<div class="bd">

					<?php foreach($cat as $k =>$v){?>

						<ul>

						<li class="catname"><?php echo $v[catname]; ?></li> 

						<li class="rad">

						<select name="tpl_index[showstyle][<?=$v[catid]?>]">

							<option value="1" <?php if($tpl_index[showstyle][$v[catid]] == 1) echo 'selected'; ?>>One Column</option> 

							<option value="2" <?php if($tpl_index[showstyle][$v[catid]] == 2) echo 'selected'; ?>>Two Columns</option>

							<option value="3" <?php if($tpl_index[showstyle][$v[catid]] == 3) echo 'selected'; ?>>Three Colimns</option>

						</select>

						</li>

						</ul>

					<?php }?>

				</div>

			</div>

		</div>

		<div id="portal_tpl" style="display:<?php if($tpl_index[banmian] != 'portal'){?>none<?php }?>;">

			<div class="simple_tpl_bg">

				<div class="hd">Designate Module ID��To prevent correspondence failure between templates and modules after manual changes made to categories��</div>

				<div class="bd">

					<table cellpadding="0" cellspacing="0">

						<tr><td>Current <span>Used Goods.</span>Column ID��Default 1��</td><td><input name="tpl_index[portal][ershou]" type="txt" class="txt" value="<?=$tpl_index[portal][ershou]?>"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;Model ID��Default 2��<input name="tpl_index[portal][ershoumod]" type="txt" class="txt" value="<?=$tpl_index[portal][ershoumod]?>"></td></tr>

						<tr><td>Current <span>Real Estate Rentals</span>Column ID��Default 41��</td><td><input name="tpl_index[portal][zufang]" type="text" class="txt" value="<?=$tpl_index[portal][zufang]?>"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;Model ID��Default 19��<input name="tpl_index[portal][zufangmod]" type="txt" class="txt" value="<?=$tpl_index[portal][zufangmod]?>"></td></tr>

						<tr><td>Current <span>Real Estate Sales</span>Column ID��Default 43��</td><td><input name="tpl_index[portal][ershoufang]" type="txt" class="txt" value="<?=$tpl_index[portal][ershoufang]?>"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;Model ID��Default 18��<input name="tpl_index[portal][ershoufangmod]" type="txt" class="txt" value="<?=$tpl_index[portal][ershoufangmod]?>"></td></tr>

						<tr><td>Current <span>Recruitments</span>Column ID��Default 4��</td><td><input name="tpl_index[portal][zhaopin]" type="text" class="txt" value="<?=$tpl_index[portal][zhaopin]?>"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;Model ID��Default 4��<input name="tpl_index[portal][zhaopinmod]" type="txt" class="txt" value="<?=$tpl_index[portal][zhaopinmod]?>"></td></tr>

						<tr><td>Current <span>CVs</span>Column ID��Default 6��</td><td><input name="tpl_index[portal][jianli]" type="text" class="txt" value="<?=$tpl_index[portal][jianli]?>"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;Model ID��Default 6��<input name="tpl_index[portal][jianlimod]" type="txt" class="txt" value="<?=$tpl_index[portal][jianlimod]?>"></td></tr>

					</table>

				</div>

			</div>

			<div class="clear"></div>

			<div class="simple_tpl_bg" style="margin-top:5px;">

				<div class="hd">Option Titles For Categories��To prevent failure of display on option titles after manual changes made to option titles <a href="info_type.php?classid=2" target="_blank">View Option Titles</a>��</div>

				<div class="bd">

					<table cellpadding="0" cellspacing="0">

						<tr><td><span>House Rentals</span>Rent Option Titles��Default mini_rent��</td><td><input style="width:100px;" name="tpl_index[portali][mini_rent]" type="txt" class="text" value="<?=$tpl_index[portali][mini_rent]?>"></td></tr>

						<tr><td><span>Real Estate Sales</span>Area Covering Option Titles��Default acreage��</td><td><input style="width:100px;" name="tpl_index[portali][acreage]" type="txt" class="text" value="<?=$tpl_index[portali][acreage]?>"></td></tr>

						<tr><td><span>Real Estate Sales</span>Real Estate Price Option Titles��Default prices��</td><td><input style="width:100px;" name="tpl_index[portali][prices]" type="txt" class="text" value="<?=$tpl_index[portali][prices]?>"></td></tr>

						<tr><td><span>Recruitments</span>Company Option Title��Default company��</td><td><input style="width:100px;" name="tpl_index[portali][company]" type="txt" class="text" value="<?=$tpl_index[portali][company]?>"></td></tr>

					</table>

				</div>

			</div>

		</div>

		</td>

    </tr>

	<tr class="firstr">

        <td colspan="2">Detailed Settings of Number of Invoked Items on Homepage</td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Maximum Number of Items Displayed at the Top of the Homepage:</b></td>

		<td class="altbg2">

			<input id="indextopinfo" name="tpl_index[indextopinfo]" value="<?=$tpl_index[indextopinfo]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Maximum Number of Items Displayed in Latest Posts:</b></td>

		<td class="altbg2">

			<input id="newinfo" name="tpl_index[newinfo]" value="<?=$tpl_index[newinfo]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Maximum Number of Items Displayed in Site Announcements:</b></td>

		<td class="altbg2">

			<input id="announce" name="tpl_index[announce]" value="<?=$tpl_index[announce]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Maximum Number of Items Displayed in Help Centre:</b></td>

		<td class="altbg2">

			<input id="faq" name="tpl_index[faq]" value="<?=$tpl_index[faq]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Maximum Number of Items Displayed in Site News:</b></td>

		<td class="altbg2">

			<input id="news" name="tpl_index[news]" value="<?=$tpl_index[news]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Items Displayed in Columns:</b></td>

		<td class="altbg2">

			<input id="foreachinfo" name="tpl_index[foreachinfo]" value="<?=$tpl_index[foreachinfo]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Items Displayed in Goods:</b></td>

		<td class="altbg2">

			<input id="goods" name="tpl_index[goods]" value="<?=$tpl_index[goods]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Items Displayed in Convenience Lines:</b></td>

		<td class="altbg2">

			<input id="telephone" name="tpl_index[telephone]" value="<?=$tpl_index[telephone]?>" type="text" class="txt">

        </td>

    </tr>

	<tr bgcolor="white">

        <td width="20%" class="altbg1" ><b>Items Displayed in Useful Tools:</b></td>

		<td class="altbg2">

			<input id="lifebox" name="tpl_index[lifebox]" value="<?=$tpl_index[lifebox]?>" type="text" class="txt">

        </td>

    </tr>

</table>

</div>

<center><input class="mymps large" value="Submit" name="<?=CURSCRIPT?>_submit" type="submit"></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

