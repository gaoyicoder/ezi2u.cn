<?php 
define('CURSCRIPT','information');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_DATA."/info.level.inc.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$do_action == 'upgrade' && $info_upgrade_time['-1'] = 'Cancel Placement at the Top of the Broad Headings';
$do_action == 'upgrade_list' && $info_upgrade_time['-1'] = 'Cancel Placement at the Top of the Broad Headings';
$do_action == 'upgrade_index' && $info_upgrade_time['-1'] = 'Cancel Placement at the Top of the Homepage';

$action = $action ? $action : 'list' ;

switch ($part){
	case 'report':
		require_once MYMPS_DATA."/report.type.inc.php";
		if($action == 'list'){
			chk_admin_purview("purview_Report");
			$here 	= "List Of Reported Posts";
			$page 	= empty($page) ? 1 : intval($page);
			$type 	= $_GET['report_type'];
			$where 	.= $type ? "WHERE report_type = '$type'" : '';
			$rows_num = mymps_count("info_report",$where);
			$param	= setParam(array("part","type"));
			$report = array();
			$page1  = page1("SELECT * FROM `{$db_mymps}info_report` $where ORDER BY pubtime DESC");
			
			foreach($page1 as $k => $row){
				$arr['id']         = $row['id'];
				$arr['infoid']     = $row['infoid'];
				$arr['infotitle']  = $row['infotitle'];
				$arr['content']    = $row['content'];
				$arr['type']   	   = "<a href=?part=report&report_type=".$row['report_type'].">".$report_type[$row['report_type']]."</a>";
				$arr['pubtime']    = GetTime($row['pubtime']);
				$arr['ip']  	   = $row['ip'];
				$report[]     	   = $arr;
			}
			
			include(mymps_tpl("info_report"));
			
		} elseif ($action == 'del'){
			mymps_delete("info_report","WHERE id='$id'");
			write_msg("Report record".$id."has successfully been deleted!",$url,"MYMPS_record");
		} elseif ($action == 'delall'){
			write_msg("Report record".mymps_del_all("info_report",$id)."has successfully been deleted!",$url,"Mymps");
		}
	break;
	
	default:
		if($action == 'delall'){
			require_once MYMPS_MEMBER."/include/common.func.php";
			
			empty($id) && write_msg('Deletion failed, please return and retry!');
			foreach (explode(',',$id) as $a => $w){
			
				$get_row = $db -> getRow("SELECT a.*,b.modid FROM `{$db_mymps}information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid = b.catid WHERE a.id = '$w'");
				if($get_row['modid'] > 1) mymps_delete("information_".$get_row[modid],"WHERE id = '$w'");
				if(!empty($get_row['img_path'])){
					$del = $db->getAll("SELECT path,prepath FROM `{$db_mymps}info_img` WHERE infoid='$w'");
					foreach ($del as $k => $v){
						@unlink(MYMPS_ROOT.$v[path]) ;
						@unlink(MYMPS_ROOT.$v[prepath]);
					}
					mymps_delete("info_img","WHERE infoid = '$w'");
				}
				
				/*删除信息评论*/
				mymps_delete("comment","WHERE type = 'information' AND typeid = '$w'");
				
				if($get_row[ismember] == 1){
					$userid = $get_row['userid'];
					$if_money == 1 &&  $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own {$money_num} WHERE userid = '$userid'");
					if($if_pm == 1){
						$title = 'The post title you have made has been deleted!';
						$msg = "Your post <b>".$get_row[title]."</b> has been deleted. Possible reason:  <b>".$msg."</b>";
						$msg .= ($if_money == 1)?"<br />Change In Number Of Coins:<b style=color:red>".$money_num."</b>":'';
						$result = sendpm($admin_id,$userid,$title,$msg,1);
					}
				}
				
			}
			
			mymps_delete("information"," WHERE id IN ($id)") && write_msg("Categorized post successfully deleted!",$url,"mymps");
			
		} elseif($action == 'upgrade_index') {
			//首页置顶
			empty($id) && write_msg('You have not yet selected any post title!');
			switch($upgrade_time){
				case '-1':
					$db -> query("UPDATE `{$db_mymps}information` SET upgrade_type_index = '1',upgrade_time_index='' WHERE id IN($id)");
					$cz='Cancel Placing at the Top of the Homepage';
				break;
				default:
					$upgrade_time = $upgrade_time*3600*24+$timestamp;
					$db -> query("UPDATE `{$db_mymps}information` SET upgrade_type_index = '2',upgrade_time_index='$upgrade_time' WHERE id IN($id)");
					$cz='Place at the Top of the Homepage';
				break;
			}
			write_msg('Operation on post title'.$cz.'by batches has been successful!',$url,'write_record');
		} elseif($action == 'upgrade') {
			//大类置顶
			empty($id) && write_msg('You have not yet selected any post title!');
			switch($upgrade_time){
				case '-1':
					$db -> query("UPDATE `{$db_mymps}information` SET upgrade_type = '1',upgrade_time='' WHERE id IN($id)");
					$cz='Cancel Placing at the Top of the Broad Headings';
				break;
				default:
					$upgrade_time = $upgrade_time*3600*24+$timestamp;
					$db -> query("UPDATE `{$db_mymps}information` SET upgrade_type = '2',upgrade_time='$upgrade_time' WHERE id IN($id)");
					$cz='Place at the Top of the Broad Headings';
				break;
			}
			write_msg('Operation on post title'.$cz.'by batches has been successful!',$url,'write_record');
			
		} elseif($action == 'upgrade_list') {
			//小类置顶
			empty($id) && write_msg('You have not yet selected any post title!');
			switch($upgrade_time){
				case '-1':
					$db -> query("UPDATE `{$db_mymps}information` SET upgrade_type_list = '1',upgrade_time_list='' WHERE id IN($id)");
					$cz='Cancel Placing at the Top of the Broad Headings';
				break;
				default:
					$upgrade_time = $upgrade_time*3600*24+$timestamp;
					$db -> query("UPDATE `{$db_mymps}information` SET upgrade_type_list = '2',upgrade_time_list='$upgrade_time' WHERE id IN($id)");
					$cz='Place at the Top of the Broad Headings';
				break;
			}
			write_msg('Operation on post title'.$cz.'by batches has been successful!',$url,'write_record');
			
		} elseif($action == 'ifred'){
			//信息标题套红
			empty($id) && write_msg('You have not yet selected any post title!');
			$set = $ifred == 1 ? "SET ifred = '1'" : "SET ifred = '0'";
			$db -> query("UPDATE `{$db_mymps}information` $set WHERE id IN($id)");
			write_msg('Operation Successful!',$url,'write_record');
		
		} elseif($action == 'ifbold'){
			//信息标题加粗
			empty($id) && write_msg('You have not yet selected any post title!');
			$set = $ifbold == 1 ? "SET ifbold = '1'" : "SET ifbold = '0'";
			$db -> query("UPDATE `{$db_mymps}information` $set WHERE id IN($id)");
			write_msg('Operation Successful!',$url,'write_record');
			
		}  elseif($action == 'certify_yes'){
			//通过认证
			empty($id) && write_msg('You have not yet selected any post title!');
			$db -> query("UPDATE `{$db_mymps}information` SET certify = '1' WHERE id IN($id)");
			write_msg('Operation Successful!',$url,'write_record');
		
		}  elseif($action == 'certify_no'){
			//取消认证
			empty($id) && write_msg('You have not yet selected any post title!');
			$db -> query("UPDATE `{$db_mymps}information` SET certify = '0' WHERE id IN($id)");
			write_msg('Operation Successful!',$url,'write_record');
		
		} elseif($action == 'refresh'){
			//信息刷新
			empty($id) && write_msg('You have not yet selected any post title!');
			foreach (explode(',',$id) as $kids => $vids){
				$activetime  = $db -> getOne("SELECT activetime FROM `{$db_mymps}information` WHERE id = '$vids'");
				$endtime = $activetime == 0 ? 0 : $activetime*3600*24+$timestamp;
				$db -> query("UPDATE `{$db_mymps}information` SET begintime = '$timestamp',endtime='$endtime' WHERE id = '$vids'");
			}
			write_msg('Categorized Post Successfully Refreshed!',$url,'write_record');
		} elseif ($action == "list"){
		
			chk_admin_purview("purview_Categories");
			
			$admindir = getcwdOL();
			
			$showperpage = intval($showperpage);
			
			$where = "WHERE 1";
			if($show != ''){
				switch($show){
					case 'title':
						$where .= " AND a.title LIKE '%".$keywords."%'";
					break;
					case 'idno':
						$keywords = intval($keywords);
						$where .= " AND a.id = '$keywords'";
					break;
					case 'catidno':
						$keywords = intval($keywords);
						$where .= " AND ".get_children(intval($keywords));
					break;
					case 'userid':
						$where .= " AND a.userid LIKE '%".$keywords."%'";
					break;
					case 'tel':
						$where .= " AND a.tel LIKE '%".$keywords."%'";
					break;
				}
			}
			
			$where .= $info_level != '' ? " AND a.info_level = '".$info_level."'" : '';
			
			switch($info_level){
				case '0':
					$here = 'Under Revision ';
				break;
				case '1':
					$here = 'Normal ';
				break;
				case '2':
					$here = 'Recommended ';
				break;
			}
			
			if($upgrade != ''){
				switch($upgrade){
					case 'category':
						$where .= " AND a.upgrade_type = '2'";
						$here  .= "Place at the Top of the Broad Headings ";
					break;
					case 'list':
						$where .= " AND a.upgrade_type_list = '2'";
						$here  .= "Place at the Top of the Broad Headings ";
					break;
					case 'index':
						$where .= " AND a.upgrade_type_index = '2'";
						$here  .= "Place at the Top of the Homepage ";
					break;
				}
			}
			
			if($ifred != ''){
				$where .= " AND a.ifred = '1'";
				$here  .= "Redden Title ";
			}
			
			if($certify != ''){
				$where .= " AND a.certify = '1'";
				$here  .= "Certification ";
			}
			
			if($ifbold != ''){
				$where .= " AND a.ifbold = '1'";
				$here  .= "Bold Title ";
			}
			
			$here .= "List Of Categorized Posts";
			$where .= $admin_cityid ? " AND a.cityid = '$admin_cityid'" : ($cityid ? " AND a.cityid = '$cityid'" : '');
			
			$rows_num 	 = $db -> getOne("SELECT COUNT(a.id) FROM `{$db_mymps}information` AS a $where");
			$param		 = setParam(array("part","cityid","show","keywords","info_level","upgrade","ifred","ifbold","certify"));
			$information = array();
			
			$idin = get_page_idin("id","SELECT a.id FROM `{$db_mymps}information` AS a $where ORDER BY a.id DESC");
			$page1 = $idin ? $db -> getAll("SELECT a.* FROM `{$db_mymps}information` AS a WHERE a.id in ($idin) ORDER BY a.id DESC") : array();
			
			foreach($page1 as $k =>$row){
				$arr['id']     		 = $row['id'];
				$arr['uri']			 = Rewrite('info',array('dir_typename'=>$row['dir_typename'],'cityid'=>$row['cityid'],'id'=>$row['id']));
				$arr['uri_cat']		 = '?keywords='.$row[catid].'&show=catidno';
				$arr['levelid']      = $row['levelid'];
				$arr['ip']      	 = $row['ip'];
				$arr['certify']      = $row['certify'];
				$arr['ip2area']      = $row['ip2area'];
				$arr['contact_who']  = ($row['ismember']==1)?"<a href=\"javascript:void(0);\" onclick=\"setbg('Ezi2u Member Centre',400,110,'../box.php?part=member&userid=$row[userid]&admindir=$admindir')\">".$row[userid]."</a>":$row['contact_who'];
				$arr['title']   	 = $row['title'];
				$arr['catid']  		 = $row['catid'];
				$arr['catname']  	 = $row['catname'];
				$arr['img_path']  	 = $row['img_path'];
				$arr['img_count']	 = $row['img_count'];
				$arr['ifred']  		 = $row['ifred'];
				$arr['ifbold']  	 = $row['ifbold'];
				$arr['begintime']    = $row['begintime'];
				$arr['ip']           = $row['ip'];
				$arr['info_level']   = $information_level[$row[info_level]];
				
				if($row['upgrade_time'] >= $timestamp){
					if($row['upgrade_type']>1){
						$arr['upgrade_type'] = '<font color=red>Top</font> ';
						$arr['upgrade_time'] = '<font color=red>Place at the top of the broad headings</font><br />until'.date('Y-m-d',$row['upgrade_time']);
					} else {
						$arr['upgrade_type'] = '<font color=#585858>No</font>';
					}
				} else {
					$arr['upgrade_type'] = '<font color=#585858>No</font>';
					$arr['upgrade_time'] = '';
				}
				
				if($row['upgrade_time_list'] >= $timestamp){
					if($row['upgrade_type_list']>1){
						$arr['upgrade_type_list'] = '<font color=red>Top</font> ';
						$arr['upgrade_time_list'] = '<font color=red>Place at the top of the broad headings</font><br />until'.date('Y-m-d',$row['upgrade_time_list']);
					} else {
						$arr['upgrade_type_list'] = '<font color=#585858>No</font>';
					}
				} else {
					$arr['upgrade_type_list'] = '<font color=#585858>No</font>';
					$arr['upgrade_time_list'] = '';
				}
				
				if($row['upgrade_time_index'] >= $timestamp){
					if($row['upgrade_type_index']>1){
						$arr['upgrade_type_index'] = '<font color=red>Top</font> ';
						$arr['upgrade_time_index'] = '<font color=red>Place at the top of the homepage</font><br />until'.date('Y-m-d',$row['upgrade_time_index']);
					} else {
						$arr['upgrade_type_index'] = '<font color=#585858>No</font>';
					}
				}else{
					$arr['upgrade_type_index'] = '<font color=#585858>No</font>';
					$arr['upgrade_time_index'] = '';
				}
				
				$information[]      = $arr;
			}
			include(mymps_tpl("information_list"));
			$idin = NULL;
			
		} elseif ($action == 'edit'){
		
			switch($do){
				
				case 'post':
					require_once(MYMPS_INC."/upfile.fun.php");
					mymps_check_upimage("mymps_img_");
					
					if(empty($cityid)) write_msg('Please select sub-site you wish to post to!');
					$content	= $mymps_global['cfg_post_editor'] == 1 ? $content : textarea_post_change($content) ;
					$begintime    = $timestamp;
					$activetime	  = $endtime ? intval($endtime) : '';
					$endtime 	  = $endtime == 0 ?0:(($endtime*3600*24)+$begintime);
					$upgrade_type = intval($upgrade_type);
					$upgrade_type_list = intval($upgrade_type_list);
					$upgrade_type_index = intval($upgrade_type_index);
					$upgrade_time = ($upgrade_type==1)?'':(($upgrade_time*3600*24)+$begintime);
					$upgrade_time_list = ($upgrade_type==1)?'':(($upgrade_time_list*3600*24)+$begintime);
					$upgrade_time_index = ($upgrade_type_index==1)?'':(($upgrade_time_index*3600*24)+$begintime);
					$mappoint 	  = trim($mappoint);
					
					if(empty($contact_who)) write_msg("Please enter name of contact!");
					$sql = NULL;
					if(is_array($extra)){
						$modid = $db->getOne("SELECT modid FROM `{$db_mymps}category` WHERE catid = '$catid'");
						if($modid > 1){
							foreach($extra as $k =>$v){
								$sql .= is_array($v) ? "`".$k ."` = '".implode(',',$v)."',": "`".$k ."` = '$v',";
							}
							$sql = $sql ? substr($sql,0,-1) : NULL;
							if($sql){
								$db->query("UPDATE `{$db_mymps}information_{$modid}` SET {$sql} WHERE id = '$id'");
								$sql = NULL;
							}
						}
					}
					$manage_pwd = ($is_member == 0&&$manage_pwd) ? "manage_pwd='".md5($manage_pwd)."'," : "";
					$refreshtime = $refresh == 1 ? "begintime = '$timestamp'," : "begintime = '".strtotime($begintimestr)."',";
					
					$userid = empty($userid) ? "" : "userid='$userid',";
					
					$d = $db->getRow("SELECT catname,dir_typename FROM `{$db_mymps}category` WHERE catid = '$catid'");
					$sql = "UPDATE `{$db_mymps}information` SET {$manage_pwd} {$refreshtime} {$userid} title = '$title',content = '$content',catid = '$catid',catname = '$d[catname]',dir_typename = '$d[dir_typename]', cityid = '$cityid', areaid = '$areaid', streetid = '$streetid', activetime = '$activetime', endtime = '$endtime', ismember = '$ismember' , info_level = '$info_level' , qq = '$qq' , email = '$email' , tel = '$tel' , contact_who = '$contact_who' , web_address = '$web_address' , upgrade_type = '$upgrade_type' ,upgrade_type_list = '$upgrade_type_list' ,upgrade_type_index = '$upgrade_type_index' , upgrade_time = '$upgrade_time', upgrade_time_list = '$upgrade_time_list', upgrade_time_index = '$upgrade_time_index', ifred = '$ifred', ifbold = '$ifbold',mappoint = '$mappoint' WHERE id = '$id'";
					
					$db->query($sql);
					if(is_array($_FILES)){
						for($i=0;$i<count($_FILES);$i++){
							$name_file = "mymps_img_".$i;
							if($_FILES[$name_file]['name']){
								$destination="/information/".date('Ym')."/";
								$mymps_image=start_upload($name_file,$destination,$mymps_global[cfg_upimg_watermark],$mymps_mymps[cfg_information_limit][width],$mymps_mymps[cfg_information_limit][height]);
								if($row = $db -> getRow("SELECT path,prepath FROM `{$db_mymps}info_img` WHERE infoid = '$id' AND image_id = '$i'")){
									@unlink(MYMPS_ROOT.$row[path]);
									@unlink(MYMPS_ROOT.$row[prepath]);
									$db->query("UPDATE `{$db_mymps}info_img` SET image_id = '$i' , path = '$mymps_image[0]' , prepath = '$mymps_image[1]' , uptime = '$timestamp' WHERE image_id = '$i' AND infoid = '$id'");
								}else{
									$db->query("INSERT INTO `{$db_mymps}info_img` (image_id,path,prepath,infoid,uptime) VALUES ('$i','$mymps_image[0]','$mymps_image[1]','$id','$timestamp')");	
								}
							}
						}
						$mymps_image[1] && $db -> query("UPDATE `{$db_mymps}information` SET img_path = '$mymps_image[1]' WHERE id = '$id'");
					}
					
					if(is_array($delinfoimg)){
						foreach($delinfoimg as $key => $val){
							if($val == 'on'){
								$infoimgrow = $db -> getRow("SELECT id,path,prepath FROM `{$db_mymps}info_img` WHERE image_id = '$key' AND infoid = '$id'");
								if($infoimgrow){
									@unlink(MYMPS_ROOT.$infoimgrow['path']);
									//@unlink(MYMPS_ROOT.$infoimgrow['prepath']);
									mymps_delete("info_img","WHERE id = '$infoimgrow[id]'");
								}
								unset($infoimgrow);
							}
						}
					}
					
					write_msg("Operation Successful, and you have successfully edited this post!","?action=edit&id=".$id);
				break;
				default:
					require_once(MYMPS_DATA."/info_lasttime.php");
					require_once(MYMPS_DATA."/info.type.inc.php");

					$post 	= is_member_info($id,'admin');
					
					$catid 	= $post['catid'];
					$areaid = $post['areaid'];
					$cat 	= $db->getRow("SELECT a.if_upimg,a.if_mappoint,a.modid,b.catid FROM `{$db_mymps}category` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.parentid = b.catid WHERE a.catid = '$catid'");
					if($mymps_global['cfg_post_editor'] == 1){
						$acontent 	= get_editor('content','information',$post[content],'100%','400px');
					} else {
						$acontent = "<textarea name=\"content\" style=\"width:100%;height:400px;\">".de_textarea_post_change($post[content])."</textarea><br />
				不得少于10个汉字！描述中请勿出现联系方式以及网址，否则可能被管理员删除(中国元素，建议斟酌)";
					}
					$now = $timestamp;
					$post['upgrade_time'] 	 = ($post['upgrade_time']==0)?0:($post['upgrade_time']-$post['begintime'])/3600/24;
					$post['upgrade_time_list'] 	 = ($post['upgrade_time_list']==0)?0:($post['upgrade_time_list']-$post['begintime'])/3600/24;
					$post['upgrade_time_index']= ($post['upgrade_time_index']==0)?0:($post['upgrade_time_index']-$post['begintime'])/3600/24;
					$post['GetInfoLastTime']	 = GetInfoLastTime($post['activetime']);
					$post['upgrade_type'] 	 	 = GetUpgradeType($post['upgrade_type']);
					$post['upgrade_type_list'] 	 = GetUpgradeTypeList($post['upgrade_type_list']);
					$post['upgrade_type_index']	 = GetUpgradeTypeIndex($post['upgrade_type_index']);
					$post['mymps_extra_value'] 	 = return_category_info_options($cat['modid'],$id);
					$post['upload_img'] 		 = get_upload_image_edit($cat['if_upimg'],$id,'MyMps');
					$post['manage_pwd'] 		 = ($post['ismember']==1)?"":'<tr bgcolor="#f5fbff"><td height="25" width="19%">Post Password</td><td><input type="text" name="manage_pwd" class="text" />  Please leave it blank if you do not want to make any changes.</td></tr>';
					$post['part']="edit";
					$post['submit'] = "Edit";
					$here = "Edit Post Content";
					include(mymps_tpl("information_edit"));
				break;
			}
		} elseif ($action == 'pm'){
			(!is_array($id) || !$do_action) && write_msg("You have not yet selected any sessions!");
			$id = !empty($id) ? join(',', $id) : 0;
			if(empty($id)) write_msg('You have not yet selected any post records!');
			require_once(MYMPS_DATA."/pm_message.inc.php");
			$here = "Affiliated Operation To Post";
			$title = "By operation by an administrator, your post entitled {title} has been put to  {action}";
			$msg = "Possible Reason:  ".$msg;
			$msg .= ($if_money == 1)?"<br />Change In Number Of Coins: <b style=color:red>".$money_num."</b>":'';
			include(mymps_tpl("information_pm"));
		} elseif (strstr($action,'level')) {
			require_once MYMPS_MEMBER."/include/common.func.php";
			$action = FileExt($action);
			$id = explode(',',$id);
			!is_array($id) &&　write_msg("You have not selected any records!");
			
			foreach ($id as $k => $v){
				$get_row = is_member_info($v,'no_level_limit');
				if($get_row['ismember'] == 1){
					$userid = $get_row['userid'];
					if($if_money == 1){
						$db->query("UPDATE `{$db_mymps}member` SET money_own = money_own {$money_num} WHERE userid = '$userid'");
					}
					if($if_pm == 1){
						$title = str_replace('{title}',$get_row[title],$title);
						$title = str_replace('{action}',$information_level[$action],$title);
						$result = sendpm($admin_id,$userid,$title,$msg,1);
					}
				}
				$db->query("UPDATE `{$db_mymps}information` SET info_level = '$action' WHERE id = '$v'");
			}
			
			$id = empty($id)?0:join(',',$id);
			write_msg("The status of post ".$id." has been set to ".$information_level[$action]." successfully!",$url,"REcord");
			
		} 
	break;
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = $idin = $rows_num = $page = $pages_num = $per_page = $per_screen = $startid = NULL;
exit;

function GetUpgradeType($level='',$formname='upgrade_type')
{
	$mymps .= "<select name='$formname' id='$formname'>";
	$info_upgrade_level = array();
	$info_upgrade_level[1] = 'Do Not Top';
	$info_upgrade_level[2] = '<font color=red>Place at the Top of the Broad Headings</font>';
	
	foreach($info_upgrade_level as $k=>$v)
	{
	 	if($k==$level) $mymps .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $mymps .= "<option value='$k'>$v</option>\r\n";
	}
	$mymps .= "</select>\r\n";
	return $mymps;
}

function GetUpgradeTypeList($level='',$formname='upgrade_type_list')
{
	$mymps .= "<select name='$formname' id='$formname'>";
	$info_upgrade_level = array();
	$info_upgrade_level[1] = 'Do Not Top';
	$info_upgrade_level[2] = '<font color=red>Place at the Top of the Broad Headings</font>';
	
	foreach($info_upgrade_level as $k=>$v)
	{
	 	if($k==$level) $mymps .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $mymps .= "<option value='$k'>$v</option>\r\n";
	}
	$mymps .= "</select>\r\n";
	return $mymps;
}

function GetUpgradeTypeIndex($level='',$formname='upgrade_type_index'){
	$mymps .= "<select name='$formname' id='$formname'>";
	$info_upgrade_level = array();
	$info_upgrade_level[1] = 'Do Not Top';
	$info_upgrade_level[2] = '<font color=red>Place at the Top of the Homepage</font>';
	
	foreach($info_upgrade_level as $k=>$v)
	{
	 	if($k==$level) $mymps .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $mymps .= "<option value='$k'>$v</option>\r\n";
	}
	$mymps .= "</select>\r\n";
	return $mymps;
}
?>
