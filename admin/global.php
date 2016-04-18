<?php 
define('IN_MYMPS', true);
define('IN_MANAGE', true);
require_once dirname(__FILE__)."/../include/global.php";
require_once MYMPS_DATA."/config.inc.php";
require_once MYMPS_DATA."/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/admin.class.php";

if($admin_cityid && in_array(CURSCRIPT,array('advertisement','faq','area','category','channel','config','advertisement','database','filemanage','info_type','jswizard','mail','member_tpl','passport','payapi','payrecord','plugin','seoset','site_about','record','city'))){
	exit('Sub-site administrator is not authorized to operate on this column……');
}

if(!$mymps_admin -> mymps_admin_chk_getinfo()){
	write_msg("","index.php?do=login&url=".urlencode(GetUrl()));
} else {
	define('IN_ADMIN' , true);
}

function mylicense( $agree_domain )
{
	if ( empty( $HTTP_HOST ) ){
		if ( mygetenv( "HTTP_HOST" ) ){
			$HTTP_HOST = mygetenv( "HTTP_HOST" );
		}else{
			$HTTP_HOST = '';
		}
	}
	$agree_domain = '.127.0.0.1|localhost|'.$agree_domain;
	$now_domain = getRootdomain(htmlspecialchars( $HTTP_HOST ));
	$now_domain = str_replace('.www.','',$now_domain);
	if ( !in_array( $now_domain, explode( "|", $agree_domain ) )){
		exit('<a href="http://www.mymps.com.cn">mymps Official Website</a><p><a href="http://bbs.mymps.com.cn">mymps BBS</a>');
	}
}

function show_message($nav_path='',$message='',$after_action=''){
	global $here;
	write_admin_record($message);
	$here = MPS_SOFTNAME.'Operation Hinting Window';
	include mymps_tpl('showmessage');
}

function sizeunit($filesize) {
	if($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
	} elseif($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
	} else {
		$filesize = $filesize . ' bytes';
	}
	return $filesize;
}

function write_file($sql,$backup_dir,$filename){
	$re=true;
	if(!@$fp=fopen($backup_dir.$filename,"w+")) {$re=false; echo "Opening File Failed";}
	if(!@fwrite($fp,$sql)) {$re=false; echo "Writing File Failed";}
	if(!@fclose($fp)) {$re=false; echo "Closing File Failed";}
	return $re;
}

function down_file($sql,$filename){
	ob_end_clean();
	header("Content-Encoding: none");
	header("Content-Type: ".(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'application/octetstream' : 'application/octet-stream'));
			
	header("Content-Disposition: ".(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'inline; ' : 'attachment; ')."filename=".$filename);
			
	header("Content-Length: ".strlen($sql));
	header("Pragma: no-cache");
			
	header("Expires: 0");
	echo $sql;
	$e=ob_get_contents();
	ob_end_clean();
}

mylicense('gaoyicoder.com');

function writeable($dir){	
	if(!is_dir($dir)){
		@mkdir($dir, 0777);
	}	
	if(is_dir($dir)){	
		if(is_writable($dir)){
			$writeable = 1;
		}else{
			$writeable = 0;
		}	
	}
	return $writeable;
}

function make_header($table){
	global $d;
	$sql="DROP TABLE IF EXISTS ".$table."\n";
	$d->query("show create table ".$table);
	$d->nextrecord();
	$tmp=preg_replace("/\n/","",$d->f("Create Table"));
	$sql.=$tmp."\n";
	return $sql;
}

function make_record($table,$num_fields){
	global $d;
	$comma="";
	$sql .= "INSERT INTO ".$table." VALUES(";
	for($i = 0; $i < $num_fields; $i++){
		$sql .= ($comma."'".mysql_escape_string($d->record[$i])."'"); 
		$comma = ",";
	}
	$sql .= ")\n";
	return $sql;
}

function import($fname){
	global $d;
	$sqls=file($fname);
	foreach($sqls as $sql)
	{
		str_replace("\r","",$sql);
		str_replace("\n","",$sql);
		$d->query(trim($sql));
	}
	return true;
}

function chk_admin_purview($purview){
	//return;
	global $admin_uname;//笔名
	if(!$GLOBALS['admin_id']) write_msg('You have not yet logged-in, please log-in before continuing! ');
	$data = read_static_cache('admin');
	if($data === false){
		$data = write_admin_cache();
	}
	$admin_uname = $data[$GLOBALS['admin_id']]['uname'];
	!in_array($purview,explode(',',$data[$GLOBALS['admin_id']]['purviews'])) && write_msg("Unfortunately, the member group you are in does cannot operate on <strong><font color=red>".str_replace('purview_','',$purview)."</font></strong> due to lack of authority!","olmsg");
	//!in_array($purview,explode(',',$data[$GLOBALS['admin_id']]['purviews'])) && write_msg($purview);
}

function get_admin_info(){
	if(!$GLOBALS['admin_id']) write_msg('You have not yet logged-in, please log-in before continuing! ');
	$data = read_static_cache('admin');
	if($data === false){
		$res = write_admin_cache();
	} else {
		$res = $data;
	}
	return $res[$GLOBALS['admin_id']];
}

function mymps_admin_tpl_global_head($go=''){
	global $here,$charset;
	include mymps_tpl('inc_head');
}

function mymps_admin_tpl_global_foot(){
	global $mymps_starttime,$mtime,$db;
	$mtime = explode(' ', microtime());
    $totaltime = number_format(($mtime[1] + $mtime[0] - $mymps_starttime), 6);
    $sitedebug = 'Processed in '.$totaltime.' second(s) , '.$db->query_num.' queries';
	echo '<div class="clear" style="height:10px"></div><div class="copyright">Powered by EZI2U <b style="color:#FF6600">'.MPS_VERSION.'</b></a> &copy; , '.$sitedebug.' <a href="javascript:scroll(0,0)" style="margin-left:10px;">Back To Top</a></div></div></div></body></html>';
}

function FileImage($file){
	$ext = FileExt($file);
	if($ext == 'html'||$ext == 'htm'){
		$images='template/images/file_html.gif';
	}elseif($ext == 'gif'||$ext == 'png'){
		$images='template/images/file_gif.gif';
	}elseif($ext == 'bmp'){
		$images='template/images/file_bmp.gif';
	}elseif($ext == 'jpg'||$ext == 'jpeg'){
		$images='template/images/file_jpg.gif';
	}elseif($ext == 'swf'){
		$images='template/images/file_swf.gif';
	}elseif($ext == 'js'){
		$images='template/images/file_script.gif';
	}elseif($ext == 'css'){
		$images='template/images/file_css.gif';
	}elseif($ext == 'txt'){
		$images='template/images/file_txt.gif';
	}else{
		$images='template/images/file_unknow.gif';
	}
	return $images;
}

function is_pic($file){
	$ext = FileExt($file);
	if($ext == 'gif'||$ext == 'jpg'||$ext == 'jpeg'||$ext == 'png' ||$ext == 'bmp'){
		return "yes";
		exit;
	}
	return "no";
}

function getSize($fs){
	if($fs<1024){
		return $fs."Byte";
	}elseif($fs>=1024&&$fs<1024*1024){
		return @number_format($fs/1024, 3)." KB";
	}elseif($fs>=1024*1024 && $fs<1024*1024*1024){
		return @number_format($fs/1024*1024, 3)." M";
	}elseif($fs>=1024*1024*1024){
		return @number_format($fs/1024*1024*1024, 3)." G";
	}
}

function mymps_admin_menu($place='top',$default='siteabout')
{
	global $admin_menu;
	$i=-1;
	foreach($admin_menu as $q => $w){
		if($place == 'top'){
			$i = $i+1;
			$uri=!$w[url]?'#':$w[url];
			$onc=!$w[url]?"onclick=sethighlight('".$i."');togglemenu('".$q."');return false;":'$w[url]';
			$tar=$w[target]?$w[target]:'';
			$mymps_admin_menu .= "<li class=\"$w[style]\"><a href=\"".$uri."\"".$onc." target=".$tar.">".$w[name]."</a></li>";
		}elseif($place == 'left'){
			if(is_array($w[group])){
				foreach($w[group] as $e=>$r){
						$estyle=($q!=$default)?'style="display:none"':"";
						$mymps_admin_menu .= "<dl id=\"".$q."\" ".$estyle.">";
						$mymps_admin_menu .= '<span class="wname">'.$w[name].'</span>';
						
						foreach ($w[group][$e] as $r => $t){
							
							if(is_array($t)){
								$mymps_admin_menu .= "<div><span>".$r."</span>";
								foreach ($w[group][$e][$r] as $y => $u){
								$i = $i+1;
									$mymps_admin_menu .= "<a  
									href=\"javascript:void(0);\" onClick=\"sethighlight('".$i."');parent.framRight.location='".$u."';\"  >".$y."</a>";
								}
								$mymps_admin_menu .= "</div>";
							}
						}
						$mymps_admin_menu .= "</dl>";

				}
			}
		}
	}
	$i=NULL;
	return $mymps_admin_menu;
}

function mymps_admin_purview($purview='')
{
	global $admin_menu;
    foreach($admin_menu as $k => $v){
        if ($k != 'logout'){
			$mymps_admin_purview .="<tr style=\"font-weight:bold; background-color:#dff6ff\"><td colspan=\"2\">".$v[name]."</td></tr>";
			foreach($v[group][element] as $a => $e){
				if ($a != 'Help On System'){
					$mymps_admin_purview .="<tr bgcolor=\"#f5fbff\"><td>".$a."</td><td>";
					foreach($e as $w => $y){
						$mymps_admin_purview .= "<label for=\"purview_".$w."\" style=\"width:110px\"><input type=\"checkbox\" class=\"checkbox\" name=\"purview[]\" id=\"purview_".$w."\" value=\"purview_".$w."\"";
						$mymps_admin_purview .= ((is_array($purview)&&in_array('purview_'.$w,$purview))||empty($purview))? "checked":"";
						$mymps_admin_purview .= ">".$w."</label> ";
					}
				}
			}
			$mymps_admin_purview .="</td></tr>";
		}
	}
	return $mymps_admin_purview;
}

function get_mymps_config_menu()
{
	global $admin_global_class;
	$i = 0;
	foreach($admin_global_class as $k =>$value){
		$mymps .= '<li><a id="i'.$i.'" href="javascript:noneblock(\'h'.$i.'\',\'i'.$i.'\')"';
		$mymps .= $i == 0 ? 'class="current"' : '';
		$mymps .= '>';
		$mymps .= $value;
		$mymps .= '</a></li>';
		$i ++;
    }
	return $mymps;
}

function get_waterimg_position($value=''){
	$mymps .= '<input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="0" ';
	$mymps .= $value == 0 ? 'checked': '';
	$mymps .= '>
          Random
	<table width="300" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%"><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="1"';
	$mymps .= $value == 1 ? 'checked': '';
	$mymps .='>
          Top Left</td>
        <td width="33%"><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="4"';
	$mymps .= $value == 4 ? 'checked': '';
	$mymps .='>
          Top Middle</td>
        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="7"';
	$mymps .= $value == 7 ? 'checked': '';
	$mymps .='>
          Top Right</td>
      </tr>
      <tr>
        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="2"';
	$mymps .= $value == 2 ? 'checked': '';
	$mymps .='>
          Middle Left</td>
        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="5"';
	$mymps .= $value == 5 ? 'checked': '';
	$mymps .='>
          Centre Of Image</td>
        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="8"';
	$mymps .= $value == 8 ? 'checked': '';
	$mymps .='>
          Middle Right</td>
      </tr>
      <tr>
        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="3"';
	$mymps .= $value == 3 ? 'checked': '';
	$mymps .='>
          Bottom Left</td>
        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="6"';
	$mymps .= $value == 6 ? 'checked': '';
	$mymps .='>
          Bottom Middle</td>
        <td><input name = "cfg_upimg_watermark_position" type="radio" class="radio"   value="9"';
	$mymps .= $value == 9 ? 'checked': '';
	$mymps .='>
          Bottom Right</td>
      </tr>
    </table>';
	return $mymps;
}

function get_mymps_config_input()
{
	global $admin_global,$admin_global_class,$config_global;
	$i=0;
	foreach($admin_global_class as $k =>$mymps_v){
		$mymps .= "<div id=\"h".$i."\" class=\"mytable\"";
		$mymps .= ($i == 0)?" ":" style='display:none'";
		$mymps .= "><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"vbm\"><tr class=\"firstr\"><td colspan=\"5\"><div class=\"left\"><a href=\"javascript:collapse_change('".$i."')\">".$mymps_v."</a></div><div class=\"right\"><a href=\"javascript:collapse_change('".$i."')\"><img id=\"menuimg_".$i."\" src=\"template/images/menu_reduce.gif\"/></a></div></td></tr><tbody id=\"menu_".$i."\" style=\"display:\"><tr style=\"font-weight:bold; height:24px; background-color:#f1f5f8\"><td>Related Information</td><td>Value</td><td>Template Invoking Code</td></tr>";
		foreach ($admin_global as $k =>$a){
			if ($a["class"]==$mymps_v){
				$mymps .="<tr bgcolor=\"#ffffff\"><td style=\"width:35%; line-height:22px\">".$a["des"]."</td><td>";
				if(in_array($k,array('SiteDescription','SiteStat','cfg_forbidden_post_ip','cfg_forbidden_reg_ip','cfg_member_regplace','cfg_member_reg_content','cfg_site_open_reason','cfg_disallow_post_tel','cfg_allow_post_area'))){
					$mymps .= "<textarea name=\"".$k."\" style=\"height:100px; width:205px\">".$config_global[$k]."</textarea>";
				}elseif($k == 'cfg_mappoint'){
					$mymps .="<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\" id=\"mappoint\"/>";
					$mymps .='<input type="button" class="gray mini" value="I want To Mark" onclick="javascript:setbg(\'Mark On Map\',500,250,\'../map.php?action=markpoint&width=500&height=250&title=default_map_point&p='.$mymps_global["cfg_mappoint"].'\')"/>';
				}elseif($k == 'SiteLogo'){
					$mymps .="<img src=\"".$config_global[$k]."\" class=\"noborder\"/><br /><br />";
					$mymps .="<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\"/>";
				}elseif($k == 'cfg_upimg_watermark_img'){
					$mymps .="<img src=\"".$config_global[$k]."\" class=\"noborder\"/><br /><br />";
					$mymps .="<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\" id=\"imgsrc\"/>";
					$mymps .='<label><input type="radio" class="radio" onclick=\'document.getElementById("f'.$k.'").style.display = "none";\' name="ifout" value="no" checked="checked" class="radio"/>Remote-sourced Image</label>
<label><input type="radio" class="radio" onclick=\'document.getElementById("f'.$k.'").style.display = "block";\' name="ifout" value="yes" class="radio"/>Upload From Local Source</label>
<iframe src="include/upfile.php?watermark=0" width="450" frameborder="0" scrolling="no" onload="this.height=iFrame1.document.body.scrollHeight" id="f'.$k.'" style="display:none; margin-top:10px"></iframe>';
				}elseif($k == 'cfg_upimg_watermark_position'){
					$mymps .= get_waterimg_position($config_global[$k]);
				}else{
					if($a["type"]=="Boolean"){
						$mymps .="<select name=\"".$k."\"/>";
						$mymps .="<option value=\"1\"";
						$mymps .= ($config_global[$k] == 1)?" selected='selected' style='background-color:#6eb00c; color:white!important;'":"";
						$mymps .=">Yes/on</option>";
						$mymps .="<option value=\"0\"";
						$mymps .= ($config_global[$k] == 0)?" selected='selected' style='background-color:#6eb00c; color:white!important;'":"";
						$mymps .=">No/off</option>";
						$mymps .="</select>";
					}else{
						$mymps .="<input name=\"".$k."\" value=\"".$config_global[$k]."\" class=\"text\"/>";
					}
				}
				$mymps .=($a["type"]=="Boolean")?"</td><td width=30%>&nbsp;</td></tr>":"</td><td width=30%>&lt;?=\$mymps_global[".$k."]?&gt;</td></tr>";
		   }
	   }
	   $mymps .="</tbody></table></div>";
	   $i=$i+1;
    }
	return $mymps;
}

function iszero($str){
	return $str == 0 ? 1 : $str;
}

function getcwdOL(){
	$total = $_SERVER[PHP_SELF];
	$file = explode("/", $total);
	$file = $file[sizeof($file)-1];
	return substr($total, 0, strlen($total)-strlen($file)-1);
}

function fetchtablelist($db_mymps = '') {
	global $db;
	$arr = explode('.', $db_mymps);
	$dbname = $arr[1] ? $arr[0] : '';
	$db_mymps = str_replace('_', '\_', $db_mymps);
	$sqladd = $dbname ? " FROM $dbname LIKE '$arr[1]%'" : "LIKE '$db_mymps%'";
	$tables = $table = array();
	$query = $db->query("SHOW TABLE STATUS $sqladd");
	while($table = $db->fetch_array($query)) {
		$table['Name'] = ($dbname ? "$dbname." : '').$table['Name'];
		$tables[] = $table;
	}
	return $tables;
}
function get_timezone_select($name='cfg_timezone',$value=''){
	$timezoneoptions = array(
		'-12'=>'(GMT -12:00) Eniwetok Island, Kwajalein Atoll..',
		'-11'=>'(GMT -11:00) Midway, Samoa Islands',
		'-10'=>'(GMT -10:00) Hawaii',
		'-9'=>'(GMT -09:00) Alaska',
		'-8'=>'(GMT -08:00) Pacific Time..',
		'-7'=>'(GMT -07:00) Mountain Time..',
		'-6'=>'(GMT -06:00) Central Standard Time..',
		'-5'=>'(GMT -05:00) Eastern Standard Time..',
		'-4'=>'(GMT -04:00) Atlantic Standard Time..',
		'-3.5'=>'(GMT -03:30) Newfoundland',
		'-3'=>'(GMT -03:00) Brasilia, Buenos Aires..',
		'-2'=>'(GMT -02:00) Mid-Atlantic, Ascension Islands,..',
		'-1'=>'(GMT -01:00) Azores Islands, Cape Verde Islands ..',
		'0'=>'(GMT) Casablanca, Dublin, Edinburgh, ..',
		'1'=>'(GMT +01:00) Berlin, Brussel, Kopenhagen..',
		'2'=>'(GMT +02:00) Helsinki, Kaliningrad,..',
		'3'=>'(GMT +03:00) Baghdad, Riyadh, Moscow..',
		'3.5'=>'(GMT +03:30) Tehran',
		'4'=>'(GMT +04:00) Abu Dhabi, Baku..',
		'4.5'=>'(GMT +04:30) Kabul',
		'5'=>'(GMT +05:00) Ekaterinburg, Islamabad,..',
		'5.5'=>'(GMT +05:30) Mumbai, Calcutta, Madeira..',
		'5.75'=>'(GMT +05:45) Kathmandu',
		'6'=>'(GMT +06:00) Alma-Ata, Colombo, Dacca..',
		'6.5'=>'(GMT +06:30) Rangoon',
		'7'=>'(GMT +07:00) Bangkok, Hanoi, Djakarta',
		'8'=>'(GMT +08:00) Kuala Lumpur, Bei Jing, Hong Kong, Singapore..',
		'9'=>'(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo..',
		'9.5'=>'(GMT +09:30) Adelaide, Darwin',
		'10'=>'(GMT +10:00) Canberra, Guan, Melbourne,..',
		'11'=>'(GMT +11:00) Magadan, New Caledonia,..',
		'12'=>'(GMT +12:00) Auckland, Wellington, Fiji,..',
	);
	
	$value = empty($value) ? '8' : $value;
	$m .= '<select name='.$name.'>';
	foreach($timezoneoptions as $key => $val){
		$m  .= '<option value='.$key.' '.($value == $key ? "selected" : "").'>';
		$m  .= $val;
		$m	.= '</option>';
	}
	$m .= '</select>';
	
	return $m;
}
?>
