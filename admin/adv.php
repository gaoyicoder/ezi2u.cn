<?php
define('CURSCRIPT','advertisement');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once dirname(__FILE__)."/include/adv.inc.php";

$part = $part ? $part : 'list';
$cityid = isset($cityid) ? intval($cityid) : 0;

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

if(!submit_check(CURSCRIPT.'_submit')) {
	
	chk_admin_purview("purview_Advertisement");
	if($part == 'intro'){	
		$here = 'Detailed Introduction On Advertisement Spaces';
	}elseif($part == 'add') {
		$here = 'Add Advertisement';
	} elseif($part == 'edit') {
		$here = 'Edit Advertisement';
		(!$edit = $db -> getRow("SELECT * FROM `{$db_mymps}advertisement` WHERE advid = ".$advid)) && write_msg('The current advertisement does not exist!');
		$edit['targets'] = explode("\t", $edit['targets']);
		$adv_style = ($charset == 'gb2312') ? unserialize($edit[parameters]) : utf8_unserialize($edit[parameters]);
	} else {
		$here 		= 'Advertisement Management';
		$where		= $type ? " AND type = '$type'" : '';
		$where 	   .= $admin_cityid ? " AND cityid = '$admin_cityid'" : " AND cityid = '$cityid'";
		$rows_num	= mymps_count(CURSCRIPT,"WHERE 1".$where);
		$param		= setParam(array("part","type","cityid"));
		$adv		= array();
		
		$adv 		= page1("SELECT * FROM `{$db_mymps}advertisement` WHERE 1 $where ORDER BY displayorder ASC");
	}
	
	include ($part == 'add' || $part == 'edit') ? mymps_tpl(CURSCRIPT) : mymps_tpl(CURSCRIPT.'_'.$part);

} else {
	
	if($part == 'list'){
		
		if(is_array($titlenew)){
			foreach($titlenew as $key => $value){
				$db -> query("UPDATE `{$db_mymps}advertisement` SET title = '$value',displayorder='$displayorder[$key]',available='$available[$key]' WHERE advid = '$key'");
			}
		}
		
		if(is_array($delids)){
			foreach($delids as $kids => $vids){
				mymps_delete("advertisement","WHERE advid = ".$vids);
			}
		}
	}else{
		$advnew['starttime'] = $advnew['starttime'] ? strtotime($advnew['starttime']) : 0;
		$advnew['endtime'] = $advnew['endtime'] ? strtotime($advnew['endtime']) : 0;
		if(!$advnew['title']) {
			write_msg('Advertisement title cannot be empty!');
		} elseif(strlen($advnew['title']) > 50) {
			write_msg('Advertisement title is too long; please shorten it to within 25 characters!');
		} elseif($advnew['endtime'] && ($advnew['endtime'] <= time() || $advnew['endtime'] <= $advnew['starttime'])) {
			write_msg('Ending time should be prior to neither the current time nor the starting time.');
		} elseif(($advnew['style'] == 'code' && !$advnew['code']['html'])
			|| ($advnew['style'] == 'text' && (!$advnew['text']['title'] || !$advnew['text']['link']))
			|| ($advnew['style'] == 'image' && (!$advnew['image']['url'] || !$advnew['image']['link']))
			|| ($advnew['style'] == 'flash' && (!$advnew['flash']['url'] || !$advnew['flash']['width'] || !$advnew['flash']['height']))) {
			write_msg('The advertisement parameter submitted is invalid!');
		}
		if($part == 'advadd') {
			$db->query("INSERT INTO {$db_mymps}advertisement (available, type)
				VALUES ('1', '$type')");
			$advid = $db->insert_id();
		} else {
			$type = $db->getOne("SELECT type FROM {$db_mymps}advertisement WHERE advid='$advid'");
		}
		foreach($advnew[$advnew['style']] as $key => $val) {
			$advnew[$advnew['style']][$key] = stripslashes($val);
		}
	
		$targetsarray = array();
		if(is_array($advnew['targets'])) {
			foreach($advnew['targets'] as $target) {
				if(in_array($target, array( 'index','all')) || preg_match("/^\d+$/", $target)) {
					$targetsarray[] = $target;
				}
			}
		}
		
		$advnew['targets'] = implode("\t", $targetsarray);
		$advnew['displayorder'] = isset($advnew['displayorder']) ? implode("\t", $advnew['displayorder']) : '';
		switch($advnew['style']) {
			case 'code':
				$advnew['code'] = $advnew['code']['html'];
				break;
			case 'text':
				$advnew['code'] = '<a href="'.$advnew['text']['link'].'" target="_blank" '.($advnew['text']['size'] ? 'style="font-size: '.$advnew['text']['size'].'"' : '').'>'.$advnew['text']['title'].'</a>';
				break;
			case 'image':
				$advnew['code'] = '<a href="'.$advnew['image']['link'].'" target="_blank"><img src="'.$advnew['image']['url'].'"'.($advnew['image']['height'] ? ' height="'.$advnew['image']['height'].'"' : '').($advnew['image']['width'] ? ' width="'.$advnew['image']['width'].'"' : '').($advnew['image']['alt'] ? ' alt="'.$advnew['image']['alt'].'"' : '').' border="0"></a>';
				break;
			case 'flash':
				$advnew['code'] = '<embed width="'.$advnew['flash']['width'].'" height="'.$advnew['flash']['height'].'" src="'.$advnew['flash']['url'].'" type="application/x-shockwave-flash"></embed>';
				break;
		}
		
		if($type == 'floatad') {
			$sourcecode = $advnew['code'];
			$advnew['floath'] = $advnew['floath'] >= 40 && $advnew['floath'] <= 600 ? intval($advnew['floath']) : 200;
			$advnew['code'] = str_replace(array("\r\n", "\r", "\n"), '<br />', $advnew['code']);
			$advnew['code'] = addslashes($advnew['code'].'<br /><span style="text-align:center; display:block; width:40px"><a href="javascript:void();" onMouseOver="this.style.cursor=\'pointer\'" onClick="closeBanner();">Close</a></span>');
			$advnew['code'] = 'theFloaters.addItem(\'floatAdv1\',6,\'document.documentElement.clientHeight-'.$advnew['floath'].'\',\'<div style="position: absolute; right: 6px; top: 25px;">'.$advnew['code'].'</div>\');';
		} elseif($type == 'couplead') {
			$advnew['code'] = addslashes($advnew['code'].'<br /><span style="text-align:center; display:block; width:40px"><a href="javascript:void();" onMouseOver="this.style.cursor=\'pointer\'" onClick="closeBanner();">Close</a></span>');
			$advnew['code'] = 'theFloaters.addItem(\'coupleAdL\',6,0,\'<div style="position: absolute; left: 6px; top: 42px;">'.$advnew['code'].'</div>\');theFloaters.addItem(\'coupleAdR\',\'document.body.clientWidth-6\',0,\'<div style="position: absolute; right: 6px; top: 42px;">'.$advnew['code'].'</div>\');';
		} elseif($type == 'intercat') {
			$advnew['position'] = is_array($advnew['position']) && !in_array('0', $advnew['position']) ? $advnew['position'] : '';
		}
		
		if($advnew['style'] == 'code') {
			$advnew['parameters'] = addslashes(serialize(array_merge(array('style' => $advnew['style']), array('html' => $advnew['code']), array('position' => $advnew['position']), array('displayorder' => $advnew['displayorder']), ($sourcecode ? array('sourcecode' => $sourcecode) : array()), ($advnew['floath'] ? array('floath' => $advnew['floath']) : array()))));
		} else {
			$advnew['parameters'] = addslashes(serialize(array_merge(array('style' => $advnew['style']), $advnew[$advnew['style']], array('html' => $advnew['code']), array('position' => $advnew['position']), array('displayorder' => $advnew['displayorder']), ($advnew['floath'] ? array('floath' => $advnew['floath']) : array()))));
		}
		
		$advnew['code'] = addslashes($advnew['code']);
		
		$query = $db->query("UPDATE {$db_mymps}advertisement SET title='$advnew[title]', targets='$advnew[targets]', parameters='$advnew[parameters]', code='$advnew[code]', starttime='$advnew[starttime]', endtime='$advnew[endtime]', cityid='$advnew[cityid]' WHERE advid='$advid'");
	
	}
	
	clear_cache_files('adv_index');
	clear_cache_files('adv_category');
	clear_cache_files('adv_info');
	clear_cache_files('adv_other');
	clear_cache_files('city_'.$cityid);
	clear_cache_files('city_'.$oldcityid);
	updateadvertisement();
	
	write_msg('Advertisement settings successfully changed!',$forward_url ? $forward_url : 'adv.php','write_record');

}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = $part = $adv = NULL;
exit();

function get_style_forminput($code='',$array=''){
	$title = is_array($array) ? $array['title'] : '';
	$url  = is_array($array) ? $array['url'] : '';
	$link  = is_array($array) ? $array['link'] : '';
	$size  = is_array($array) ? $array['size'] : '';
	$width  = is_array($array) ? $array['width'] : '';
	$height  = is_array($array) ? $array['height'] : '';
	$alt  = is_array($array) ? $array['alt'] : '';
	
	$vbm_style_form = array(
		'code' => '
			<table border="0" cellspacing="0" cellpadding="0" class="vbm">
			<tr class="firstr"><td colspan="2">HTML Code</td></tr>
			<tr><td width="45%" bgcolor="white" valign="top">HTML Code Of Advertisement:<br /><i style="color:#666">Please enter the HTML code of the advertisement to be displayed</i></td><td bgcolor="white"><textarea  rows="10" name="advnew[code][html]" id="advnew[code][html]" cols="50">'.$code.'</textarea></td></tr>
			</table>',
		'text' => '
			<table border="0" cellspacing="0" cellpadding="0" class="vbm">
			<tr class="firstr"><td colspan="2">Text Advertisement</td></tr>
			<tr><td width="45%" bgcolor="white" >Text Content(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the content to be displayed by the Text Advertisement.</i></td><td bgcolor="white"><input class="text" type="text" size="50" name="advnew[text][title]" value="'.$title.'" >
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white" >Link Text To(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the URL that the Text Advertisement is linked to.</i></td><td bgcolor="white"><input class="text" type="text" size="50" name="advnew[text][link]" value="'.$link.'" >
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white" >Text Size(Optional):<br /><i style="color:#666">Please enter the size of font for the text in advertisement. You may use pt, px or em as measurement.</i></td>
			<td bgcolor="white"><input class="text" type="text" size="50" name="advnew[text][size]" value="'.$size.'" >
			</td>
			</tr>
			</table>',
		'image' => '
			<table border="0" cellspacing="0" cellpadding="0" class="vbm">
			<tr class="firstr"><td colspan="2">Image Advertisement</td></tr>
			<tr><td width="45%" bgcolor="white" >URL Of Image(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the URL from which the Image will be invoked</i></td><td bgcolor="white">
	<input name="advnew[image][url]" id=imgsrc type="text" class="text" value="'.$url.'"/> 
	<label><input type="radio" onclick=\'document.getElementById("iframe").style.display = "none";\' name="ifout" value="no" checked="checked" class="radio"/>Remote-Sourced Image</label>
	<label><input type="radio" onclick=\'document.getElementById("iframe").style.display = "block";\' name="ifout" value="yes" class="radio"/>Upload From Local Source</label>
	<iframe src="include/upfile.php?watermark=0&adv=1" width="450" frameborder="0" scrolling="no" onload="this.height=iFrame1.document.body.scrollHeight" id="iframe" style="display:none; margin-top:10px"></iframe>
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white" >Link Image To(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the URL that the Image Advertisement is linked to.</i></td>
			<td bgcolor="white"><input class="text" type="text" size="50" name="advnew[image][link]" value="'.$link.'" >
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white" >Image Width(Optional):<br /><i style="color:#666">Please enter the width of the Image Advertisement, using pixel as the measurement.</i></td>
			<td bgcolor="white"><input class="text" type="text" size="50" name="advnew[image][width]" value="'.$width.'" ></td>
			</tr>
			<tr><td width="45%" bgcolor="white" >Image Height(Optional):<br /><i style="color:#666">Please enter the height of the Image Advertisement, using pixel as the measurement.</i></td><td bgcolor="white"><input class="text" type="text" size="50" name="advnew[image][height]" value="'.$height.'" >
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white" >Text Affiliated To Image(Optional):<br /><i style="color:#666Please enter the text message displayed as the mouse cursor stays on the advertisement.</i></td><td bgcolor="white"><input class="text" type="text" size="50" name="advnew[image][alt]" value="'.$alt.'" >
			</td>
			</tr>
			</table>',
		'flash' => '
			<table border="0" cellspacing="0" cellpadding="0" class="vbm">
			<tr class="firstr"><td colspan="2">Flash Advertisement</td></tr>
			<tr><td width="45%" bgcolor="white" >URL of Flash Advertisement(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the URL from which the Flash Advertisement will be invoked</i></td>
			<td bgcolor="white"><input class="text" type="text" size="50" name="advnew[flash][url]" value="'.$url.'" >
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white">Flash Width(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the width of the Flash Advertisement, using pixel as the measurement.</i></td>
			<td bgcolor="white"><input class="text" type="text" size="50" name="advnew[flash][width]" value="'.$width.'" >
			</td>
			</tr>
			<tr>
			<td width="45%" bgcolor="white" >Flash Height(<font color="red">*Required</font>):<br /><i style="color:#666">Please enter the height of the Flash Advertisement, using pixel as the measurement.</i></td>
			<td bgcolor="white"><input class="text" type="text" size="50" name="advnew[flash][height]" value="'.$height.'" >
			</td>
			</tr>
			</table>'
	);
	foreach($vbm_style_form as $ktypeform => $vform){
        $mymps .= '<div id="style_'.$ktypeform.'" style="';
		if(is_array($array)){
			$mymps .= ($array[style] == $ktypeform) ? 'display:yes' : 'display:none';
		} else {
			$mymps .= ($array == $ktypeform) ? 'display:yes' : 'display:none';
		}
		$mymps .= '" class="maintablediv">';
        $mymps .= $vform;
        $mymps .= '</div>';
    }
	return $mymps;
}

function get_adv_style($style='',$formname='style'){
	global $vbm_adv_style;
	$vbm_adv_style_form = "<select name='$formname' id='$formname' style=\"vertical-align: middle\" onchange=\"var styles, key;styles=new Array('code','text','image','flash'); for(key in styles) {var obj=$('style_'+styles[key]); obj.style.display=styles[key]==this.options[this.selectedIndex].value?'':'none';}\">";
	foreach($vbm_adv_style as $k=>$v)
	{
	 	if($k==$style&&$k!='') $vbm_adv_style_form .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $vbm_adv_style_form .= "<option value='$k'>$v</option>\r\n";
	}
	$vbm_adv_style_form .= "</select>\r\n";
	return $vbm_adv_style_form;
}

function get_adv_option($type='',$formname='type'){
	global $vbm_adv_type;
	$vbm_adv_type_form = "<select name='$formname' id='$formname' onchange=\"if(this.options[this.selectedIndex].value) {this.form.submit()}\" style=\"vertical-align: middle\">";
	$vbm_adv_type_form .= "<option value='' selected>Please Select Type Of Advertisement</option>\r\n";
	foreach($vbm_adv_type as $k=>$v)
	{
	 	if($k==$type&&$k!='') $vbm_adv_type_form .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v[name]</option>\r\n";
	 	else $vbm_adv_type_form .= "<option value='$k'>$v[name]</option>\r\n";
	}
	$vbm_adv_type_form .= "</select>\r\n";
	return $vbm_adv_type_form;
}

function get_infoad_target($selected){
	$category_cache = get_categories_tree('','category');
	$option .= "<option value='all' ";
	$option .= $selected[0] == 'all' ? " selected " : "";
	$option .= ">All</option>";
	foreach($category_cache as $k => $v){
		$option .= "<optgroup label='$v[catname]'>";
		if($v[children]){
			foreach($v[children] as $child){
				$option .= "<option value=$child[catid]";
				$option .= (is_array($selected) && in_array($child[catid],$selected)) ? " selected" : "";
				$option .= ">$child[catname]</option>";
			}
		}
		$option .= "</optgroup>";
	}
	return $option;
}
?>
