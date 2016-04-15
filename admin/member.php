<?php 
define('CURSCRIPT','member');

require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");
require_once(MYMPS_MEMBER."/include/mymps.menu.inc.php");

$do = $do ? mhtmlspecialchars($do) : 'member';
$tuijian = $tuijian ? mhtmlspecialchars($tuijian) : 'all';
$if_corp = !$if_corp ? 0 : 1; 

if(in_array(PASSPORT_TYPE,array('ucenter','phpwind'))){
	require (PASSPORT_TYPE == 'ucenter' ? MYMPS_ROOT.'/uc_client/client.php' : MYMPS_ROOT.'/pw_client/uc_client.php');
}

switch ($do){

	case 'member':
	
		$part = $part ? $part : 'default';
		
		if($part == 'default'){
			
			$do_action = isset($do_action) ? trim($do_action) : '';
			$url = $url ? $url : 'member.php';
			
			if($do_action == 'delall') {

				foreach ($_POST['id'] as $k => $v){
					$row = $db->getRow("SELECT id,userid,prelogo,logo FROM `{$db_mymps}member` WHERE id ='$v'");
					$deluserarr[] = $row['userid'];
					if($row['logo'] != '/images/nophoto.jpg') @unlink(MYMPS_ROOT.$row['logo']);
					if($row['prelogo'] != '/images/nophoto.jpg') @unlink(MYMPS_ROOT.$row['prelogo']);
					mymps_delete("member_category","WHERE userid = '$row[userid]'");
					mymps_delete("member_pm","WHERE fromuser = '$row[userid]' OR fromuser = '$row[userid]'");
					
					/*删除附表信息*/
					$query = $db -> query("SELECT a.id,b.modid FROM `{$db_mymps}information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid = b.catid WHERE a.userid = '$row[userid]'");
					while($r = $db -> fetchRow($query)){
						mymps_delete("information_".$r[modid],"WHERE id = '$r[id]'");
					}
					
					
					$row['userid'] && mymps_delete("information","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("member_docu","WHERE userid = '$row[userid]'");
					
					/*删除相册*/
					$query = $db -> query("SELECT path,prepath FROM `{$db_mymps}member_album` WHERE userid = '$row[userid]'");
					if($query){
						while($r = $db -> fetchRow($query)){
							@unlink(MYMPS_ROOT.$r['path']);
							@unlink(MYMPS_ROOT.$r['prepath']);
						}
					}
					
					$row['userid'] && mymps_delete("member_album","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("member_record_login","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("member_record_use","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("member_comment","WHERE userid = '$row[userid]'");
					
					/*删除插件里的信息*/
					$row['userid'] && mymps_delete("goods","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("coupon","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("group","WHERE userid = '$row[userid]'");
					
					/*删除操作记录*/
					$row['userid'] && mymps_delete("member_record_login","WHERE userid = '$row[userid]'");
					$row['userid'] && mymps_delete("member_record_use","WHERE userid = '$row[userid]'");
					
				}
				
				write_msg('Member'.mymps_del_all("member",$_POST[id]).'has successfully been deleted!',$url,"mymps");
				
			} elseif($do_action == 'delinfo'){
				
				foreach ($_POST['id'] as $k => $v){
					$row = $db->getRow("SELECT userid FROM `{$db_mymps}member` WHERE id ='$v'");
					$query = $db -> query("SELECT img_path,html_path FROM `{$db_mymps}information` WHERE userid = '$row[userid]'");
					if($query){
						while($r = $db -> fetchRow($query)){
							@unlink(MYMPS_ROOT.$r['img_path']);
							@unlink(MYMPS_ROOT.$r['html_path']);
						}
					}
					$row['userid'] && mymps_delete("information","WHERE userid = '$row[userid]'");
				}
				write_msg('Categorized posts by member has successfully been deleted!',$url,"mymps");
				
			} elseif($do_action == 'deldoc'){
				foreach ($_POST['id'] as $k => $v){
					$row = $db->getRow("SELECT id,userid FROM `{$db_mymps}member` WHERE id ='$v'");
					$row['userid'] && mymps_delete("member_docu","WHERE userid = '$row[userid]'");
				}
				write_msg('Articles by member has successfully been deleted!',$url,"mymps");
			} elseif($do_action == 'delcomment') {
				foreach ($_POST['id'] as $k => $v){
					$row = $db->getRow("SELECT id,userid FROM `{$db_mymps}member` WHERE id ='$v'");
					$row['userid'] && mymps_delete("member_comment","WHERE userid = '$row[userid]'");
				}
				write_msg('Comments on member has successfully been deleted!',$url,"mymps");
			} elseif($do_action == 'delpm') {
				foreach ($_POST['id'] as $k => $v){
					$row = $db->getRow("SELECT userid FROM `{$db_mymps}member` WHERE id ='$v'");
					$row['userid'] && mymps_delete("member_pm","WHERE fromuser = '$row[userid]' OR fromuser = '$row[userid]'");
				}
				
				write_msg('Message records of member has successfully been deleted!',$url,"mymps");
			} elseif($do_action == 'delalbum') {
				foreach ($_POST['id'] as $k => $v){
					$row = $db->getRow("SELECT userid FROM `{$db_mymps}member` WHERE id ='$v'");
					$query = $db -> query("SELECT path,prepath FROM `{$db_mymps}member_album` WHERE userid = '$row[userid]'");
					if($query){
						while($r = $db -> fetchRow($query)){
							@unlink(MYMPS_ROOT.$r['path']);
							@unlink(MYMPS_ROOT.$r['prepath']);
						}
					}
					$row['userid'] && mymps_delete("member_album","WHERE userid = '$row[userid]'");
				}
				
				write_msg('Space album of member has successfully been deleted!',$url,"mymps");
			} elseif($do_action == 'person') {
				
				foreach ($_POST['id'] as $k => $v){
					$db -> query("UPDATE `{$db_mymps}member` SET if_corp = '0',tname='' WHERE id = '$v'");	
				}
				write_msg("Type of member has successfully been set to Individual!",$url,'write_record');
				
			} elseif($do_action == 'per_certify') {
				
				foreach ($_POST['id'] as $k => $v){
					$db -> query("UPDATE `{$db_mymps}member` SET per_certify = '1' WHERE id = '$v'");	
				}
				write_msg("The designated member has successfully been set to pass the ID verification!",$url,'write_record');
				
			} elseif($do_action == 'com_certify') {
				
				foreach ($_POST['id'] as $k => $v){
					$db -> query("UPDATE `{$db_mymps}member` SET com_certify = '1' WHERE id = '$v'");	
				}
				write_msg("The designated member has successfully been set to pass the business licence verification!",$url,'write_record');
				
			} elseif($do_action == 'corp') {
				
				foreach ($_POST['id'] as $k => $v){
					$db -> query("UPDATE `{$db_mymps}member` SET if_corp = '1' WHERE id = '$v'");	
				}
				write_msg("Type of member has successfully been set to Seller!",$url,'write_record');
				
			} elseif($do_action == 'ifindex2'){
			
				is_array($id) && $db -> query("UPDATE `{$db_mymps}member` SET ifindex = '2' WHERE ".create_in($id,'id'));
				write_msg("Your request has successfully been submitted!",$url);
			
			} elseif($do_action == 'ifindex1'){
				
				is_array($id) && $db -> query("UPDATE `{$db_mymps}member` SET ifindex = '1' WHERE ".create_in($id,'id'));
				write_msg("Your request has successfully been submitted!",$url);
			
			} elseif($do_action == 'iflist2'){
			
				is_array($id) && $db -> query("UPDATE `{$db_mymps}member` SET iflist = '2' WHERE ".create_in($id,'id'));
				write_msg("Your request has successfully been submitted!",$url);
			
			} elseif($do_action == 'iflist1'){
			
				is_array($id) && $db -> query("UPDATE `{$db_mymps}member` SET iflist = '1' WHERE ".create_in($id,'id'));
				write_msg("Your request has successfully been submitted!",$url);
			
			} elseif(is_numeric($do_action)) {
				
				$nowval = $db -> getOne("SELECT levelname FROM `{$db_mymps}member_level` WHERE id = '$do_action'");
				
				if(!$nowval){
					write_msg('The member group you wish to edit does not exist!');
				}
				
				if(is_array($_POST['id'])){
					foreach ($_POST['id'] as $k => $v){
						$db -> query("UPDATE `{$db_mymps}member` SET levelid = '$do_action' WHERE id = '$v'");	
					}
					write_msg("Status of member has successfully been set to ".$nowval."!",$url,'write_record');
				} else {
					write_msg('You have not selected members to be operated!');
				}
				
			} elseif(empty($do_action)){
			
				chk_admin_purview($if_corp == '0' ? 'purview_Individual' : 'purview_Seller');
				
				$where = "WHERE 1 ";
				$where .= $admin_cityid && $if_corp == 1 ? " AND a.cityid = '$admin_cityid'" : ( $cityid ? " AND a.cityid = '$cityid'" : "" );
				$where .= $userid != ''  ? " AND a.userid = '$userid'" : "";
				$where .= $ifindex != ''  ? " AND a.ifindex = '$ifindex'" : "";
				$where .= $iflist != ''  ? " AND a.iflist = '$iflist'" : "";
				$where .= $levelid != '' ? " AND a.levelid = '$levelid'" : "";
				$where .= $tname != ''? " AND a.tname LIKE '%".$tname."%'" : "";
				$where .= isset($if_corp) ? " AND a.if_corp = '$if_corp'" : "";
				
				if($tuijian == 'index'){
					$where .= " AND a.ifindex = '2'";
				} elseif($tuijian == 'list'){
					$where .= " AND a.iflist = '2'";
				}
				
				$where .= ($catid != '' && $if_corp == 1) ? "  AND f.catid IN (".get_corp_children($catid).")" : "";
				$where .= !empty($areaid) ? "  AND a.areaid IN (".get_area_children($areaid).")" : "";
				
				$regdatebefore = $regdatebefore ? strtotime($regdatebefore) : 0;
				$where .= $regdatebefore ? " AND a.jointime <= '$regdatebefore'" : "";
				
				$regdateafter = $regdateafter ? strtotime($regdateafter) : 0;
				$where .= $regdateafter ? " AND a.jointime >= '$regdateafter'" : "";
				
				$lastvisitbefore = $lastvisitbefore ? strtotime($lastvisitbefore) : 0;
				$where .= $lastvisitbefore ? " AND a.logintime <= '$lastvisitbefore'" : "";
				
				$lastvisitafter = $lastvisitafter ? strtotime($lastvisitafter) : 0;
				$where .= $lastvisitafter ? " AND a.jointime >= '$lastvisitafter'" : "";
				
				$where .= $regip != '' ? " AND a.joinip LIKE '".str_replace('*', '%', $regip)."'" : "";
				$where .= $lastip != '' ? " AND a.loginip LIKE '".str_replace('*', '%', $lastip)."'" : "";
				
				$moneylower = $moneylower ? intval($moneylower) : 0;
				$where .= $moneylower != '' ? " AND a.money_own <= '$moneylower'" : ""; 
				
				$moneyhigher = $moneyhigher ? intval($moneyhigher) : 0;
				$where .= $moneyhigher != '' ? " AND a.money_own >= '$moneyhigher'" : "";
				
				$sql = ($catid != '' && $if_corp == 1) ? "SELECT a.id,a.if_corp,a.money_own,a.userid,a.userpwd,a.joinip,a.logintime,a.credit,a.credits,a.jointime,a.levelid,b.levelname,a.tname,a.levelup_time,a.ifindex,a.iflist FROM `{$db_mymps}member` AS a LEFT JOIN `{$db_mymps}member_category` AS f ON a.userid = f.userid LEFT JOIN `{$db_mymps}member_level` AS b ON a.levelid = b.id $where ORDER BY a.id DESC" : "SELECT a.id,a.if_corp,a.money_own,a.userid,a.userpwd,a.joinip,a.logintime,a.credit,a.credits,a.jointime,a.levelid,b.levelname,a.tname,a.levelup_time,a.ifindex,a.iflist FROM {$db_mymps}member AS a LEFT JOIN `{$db_mymps}member_level` AS b ON a.levelid = b.id  $where ORDER BY a.id DESC";
				$param = setParam(array('userid','catid','lastip','regip','tname','levelid','cityid','areaid','if_corp','more_options','moneylower','moneyhigher','regdatebefore','regdateafter','lastvisitbefore','lastvisitafter','ifindex','iflist','tuijian'));
				
				$rows_num = $db->getOne(($catid != '' && $if_corp == 1) ?  "SELECT COUNT(*) FROM `{$db_mymps}member` AS a LEFT JOIN `{$db_mymps}member_category` AS f ON a.userid = f.userid $where" : "SELECT COUNT(*) FROM `{$db_mymps}member` AS a $where");
				$member = page1($sql);
				
				$regdatebefore   =  $regdatebefore ? date('Y-m-d',$regdatebefore) : '';
				$regdateafter   =  $regdateafter ? date('Y-m-d',$regdateafter) : '';
				$lastvisitbefore =  $lastvisitbefore   ? date('Y-m-d',$lastvisitbefore)	 : '';
				$lastvisitafter  =  $lastvisitafter   ? date('Y-m-d',$lastvisitafter)	 : '';
				$moneylower		 = $moneylower == 0   ? '' : $moneylower;
				$moneyhigher	 = $moneyhigher == 0   ? '' : $moneyhigher;
				
				$here = $if_corp == '0' ? 'Individual Member' : 'Seller Member';
				include(mymps_tpl("member_default"));
				
			}
			
		}elseif($part == 'add'){
		
			chk_admin_purview("purview_Add a Member");
			$action = 'insert';
			$acontent	= get_editor('content','','','100%','300px');
			$here = "Added Members";
			include(mymps_tpl($if_corp == 1 ? 'member_shop' : 'member'));
			
		}elseif($part == 'insert'){
		
			require_once MYMPS_MEMBER.'/include/common.func.php';
			
			if(PASSPORT_TYPE == 'phpwind'){
				//整合pw
				$checkuser = uc_check_username($userid);
				if($checkuser == -2){
				write_msg('This user ID already exists. Please try again with another user ID.');
				} elseif($checkuser == -1){
				write_msg('This user ID does not conform to the format. Please try again with another user ID.');
				} elseif($checkuser == 1){
				
				} else {
				write_msg('Unknown error. Please try again with another user ID.');
				}
				
				if($email){
					$checkemail = uc_check_email($email);
					$checkemail == -3 && write_msg('Email  This Email address is in wrong format, please try again with another Email address.');
					$checkemail == -4 && write_msg('This Email address already exists, please try again with another Email address.');
				}
				
				uc_user_register($userid,md5($userpwd),$email);
			
			}elseif(PASSPORT_TYPE == 'ucenter'){
				//整合uc
				
				if(!empty($activation) && ($activeuser = uc_get_user($activation))) {
					list($uid, $userid) = $activeuser;
				} else {
				
					if(uc_get_user($userid) && !$db->getOne("SELECT userid FROM {$db_mymps}member WHERE userid='$userid'")) {
						write_msg('This user ID already exists in Ucenter. You may log into User Management Centre from foreground to activate this user ID.');
					}
			
					$uid = uc_user_register($userid,$userpwd,$email);
					
					if($uid <= 0) {
					
						if($uid == -1) {
							write_msg('Invalid User ID');
						} elseif($uid == -2) {
							write_msg( 'Contain Forbidden Content');
						} elseif($uid == -3) {
							write_msg( 'User ID Already Exists');
						} elseif($uid == -4) {
							write_msg( 'Email Address In Wrong Format');
						} elseif($uid == -5) {
							write_msg( 'Email Address Not Allowed To Register');
						} elseif($uid == -6) {
							write_msg( 'Email Address Registered');
						} else {
							write_msg( 'Undefined');
						}
						
					} else {
					
						$userid  = trim($userid);
						$userpwd = $userpwd ? trim(md5($userpwd)) : md5(random());
						$email 	 = trim($email);
						
					}
					
				}
				
			} else {
				
				$rs	= CheckUserID($userid,'User ID');
				
				$rs != 'ok' && write_msg($rs);
				
				strlen($userid) > 20 && write_msg("Your user ID or password is too long and cannot be used to register!");
				
				(strlen($userid) < 3 || strlen($userpwd) < 5) && write_msg("Your user ID or password is too short (shorter than 3 characters) and cannot be used to register!");
				
				!is_email($email) && write_msg("Email address is in wrong format!");

				if($db->getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$userid' ")){
					write_msg("The user ID {$userid} that you have designated already exists, so please try again with another user ID!");
				}
			}
			
			if($userid) {
			
				member_reg($userid,md5($userpwd),$email);
				$reg_corp = intval($reg_corp);
				
				switch ($reg_corp){
					case '0':
						$db->query("UPDATE `{$db_mymps}member` SET cname = '$cname',levelid = '$levelid',money_own='$money_own',if_corp = '0' WHERE userid = '$userid'");
					break;
					
					case '1':
						if(is_array($catid)){
							$catids  = implode(',',$catid);
						} else {
							write_msg('Please select seller type');
						}
						
						/*信用等级*/
						$score_change = get_credit_score();
						if($score_change){
							foreach($score_change['credit_set']['rank'] AS $level => $credi) {
								if($credit <= $credi) {
									$credits = $level;
									break;
								}else{
									$credits = 16;
								}
							}
							$credits = $credits - 1;
						}

						
						$db->query("UPDATE `{$db_mymps}member` SET levelid='$levelid',tname = '$tname',cname = '$cname',catid = '$catids', cityid = '$cityid',areaid='$areaid',streetid='$streetid',qq='$qq',msn='$msn',email='$email',address='$address',busway='$busway',money_own='$money_own',score='$score',credit='$credit',credits='$credits',tel='$tel',mobile='$mobile',mappoint='$mappoint',introduce='$content',web='$web',if_corp='1',template='$template' WHERE userid = '$userid'");
						if(is_array($catid)){
							foreach($catid as $kids => $vids){
								$db->query("INSERT `{$db_mymps}member_category` (userid,catid)VALUES('$userid','$vids')");
							}
						}
					break;
				}
				
				write_msg("Member <b>".$userid."</b> has successfully been added!","member.php","mymps");
			
			}

			
		}elseif($part == 'edit'){
		
			$sql = "SELECT a.*,b.id as levelid,b.levelname FROM `{$db_mymps}member` AS a LEFT JOIN `{$db_mymps}member_level` AS b ON a.levelid = b.id WHERE a.id = '$id'";
			$edit = $db->getRow($sql);
			$if_corp = $edit['if_corp'];
			$if_corp == 1 && $acontent	= get_editor('content','',$edit['introduce'],'100%','300px');
			$here = "Edit Member Information";
			$action = 'update';
			include(mymps_tpl($if_corp == 1 ? "member_shop" : "member"));
			
		}elseif($part == 'update'){
			
			if(PASSPORT_TYPE == 'phpwind'){
				//整合pw
				$pw_user = uc_user_get($userid);
				if(!empty($userpwd)){
					$result = uc_user_edit($pw_user['uid'], $pw_user['username'], '', md5($userpwd), $email);
					
					if ($result == -3) {
						write_msg('Undefined error: Email address in wrong format!');
					} elseif ($result == -4) {
						write_msg('Undefined error: Email address registered!');
					} elseif ($result == -2) {
						write_msg('Undefined error: You cannot edit corresponding information of a protected user!');
					} elseif ($result == -1) {
						write_msg('Undefined error: You cannot edit corresponding information of a protected user!');
					}
				}
			}elseif(PASSPORT_TYPE == 'ucenter'){
				//整合uc
				
				$result =  uc_user_edit($userid, $userpwd, $userpwd, $email, 1);
								
				if ($result == -4) {
					write_msg('Undefined error: Email address in wrong format!');
				} elseif ($result == -5) {
					write_msg('Undefined error: This Email address is not allowed to register!');
				} elseif ($result == -6) {
					write_msg('Undefined error: Email address registered!');
				} elseif ($result == -8) {
					write_msg('Undefined error: You cannot edit corresponding information of a protected user!');
				} elseif ($result == -1) {
					write_msg('Undefined error: Original Password is incorrect!');
				} elseif ($result == -7) {
					write_msg('Undefined error: Email address cannot be empty!');
				}
				
			}  else {
			
				$rs = CheckUserID($userid,'User ID');
				if( $rs != 'ok'){
					write_msg($rs);
				}
				
				!is_email($email) && write_msg("Email address is in wrong format!");
				
				$old=$db->getRow("SELECT id,userid FROM `{$db_mymps}member` WHERE id = '$id'");
				if($db->getOne("SELECT id FROM `{$db_mymps}member` WHERE userid LIKE '$userid' AND userid != '$old[userid]'")){
					write_msg("The user ID {".$userid."} that you have designated had been used by another user!");
				}
				
			}
			
			if($reg_corp == '1'){
				if(is_array($catid)){
					mymps_delete("member_category","WHERE userid = '$userid'");
					foreach($catid as $kids => $vids){
						$db->query("INSERT `{$db_mymps}member_category` (userid,catid)VALUES('$userid','$vids')");
					}
					$catid  = implode(',',$catid);
				} else {
					write_msg('Please select the category it is from');
				}
			}
			
			$userpwd = !empty($userpwd) ? "userpwd='".md5($userpwd)."'," :"";
			/*信用等级*/
			$score_change = get_credit_score();
			if($score_change){
				foreach($score_change['credit_set']['rank'] AS $level => $credi) {
					if($credit <= $credi) {
						$credits = $level;
						break;
					}else{
						$credits = 16;
					}
				}
				$credits = $credits - 1;
			}
						
			$sql = ($if_corp == '1' && $reg_corp == '1') ? "UPDATE `{$db_mymps}member` SET {$userpwd} userid = '$userid', levelid='$levelid',tname = '$tname',cname = '$cname',catid = '$catid', cityid = '$cityid',areaid = '$areaid',streetid = '$streetid',qq='$qq',msn='$msn',email='$email',address='$address',busway='$busway',money_own='$money_own',tel='$tel',mobile='$mobile',mappoint='$mappoint',introduce='$content',web='$web',per_certify='$per_certify',com_certify='$com_certify',score='$score',credit='$credit',credits='$credits',template='$template' WHERE id = '$id'" : "UPDATE `{$db_mymps}member` SET {$userpwd} userid = '$userid', levelid='$levelid',cname = '$cname',email='$email',money_own='$money_own',per_certify='$per_certify',com_certify='$com_certify',score='$score',credit='$credit',credits='$credits' WHERE id = '$id'";
		
			$res = $db->query($sql);
			$score_change = $credits = $credit = NULL;
			
			if($per_certify == 1 || $com_certify == 1) {
				$db -> query("UPDATE `{$db_mymps}information` SET certify = '1' WHERE userid = '$userid'");
			}
			
			write_msg(($if_corp == '1' ? $tname : $userid)."has been edited on user information","member.php?do=member&part=edit&id=".$id,'record');
			
		} elseif($part == 'levelup') {
			$levelup_notice = textarea_post_change($levelup_notice);
			mymps_delete("config","WHERE description = 'levelup_notice'");
			$db -> query("INSERT INTO `{$db_mymps}config` SET value = '$levelup_notice', type = 'levelup', description = 'levelup_notice'");
			write_msg('Notice has successfully been submitted!','member.php?do=group');
		}
	break;
	
	case 'group':
		$part = $part ? $part : 'list' ;
		if ($part == 'list'){
		
			//chk_admin_purview("purview_Group Category");
			$sql = "SELECT * FROM {$db_mymps}member_level ORDER BY id desc";
			$group = $db->getAll($sql);
			$here = "Registered User Group Management";
			$levelup_notice = $db -> getOne("SELECT value FROM `{$db_mymps}config` WHERE description = 'levelup_notice'");
			$levelup_notice = de_textarea_post_change($levelup_notice);
			include(mymps_tpl("member_group"));	
			
		}elseif($part == 'add'){
		
			//chk_admin_purview("purview_Group Category");
			$here = "Added User Group";
			include(mymps_tpl("member_group_add"));
			
		}elseif($part == 'insert'){
			$purview  = is_array($purview) ? implode(",", $purview) : '';
			$purview  = $purview ? trim($purview) : '';
			$perday_maxpost = trim($perday_maxpost);
			if(!$settings['ifopen']) write_msg('You must select one deadline to upgrade');
			if(!empty($levelname)){
				if($db->getOne("select count(*) from {$db_mymps}member_level where levelname = '$levelname'")){
					write_msg("User group with this name already exists, please try again with another name!");
				}
				$settings = serialize($settings);
				$db->query("INSERT INTO `{$db_mymps}member_level` (id,levelname,ifsystem,purviews,money_own,perday_maxpost,signin_notice,signin_del,signin_view,moneysettings) VALUES ('','$levelname','0','$purview','$money_own','$perday_maxpost','$signin_notice','$signin_del','$signin_view','$settings')");
				clear_cache_files('member_'.$db->insert_id());
				write_msg("User group ".$levelname." has successfully been added!","member.php?do=group","MyMPS");
			}else{
				write_msg("Member group name cannot be empty!");
			}
			
		}elseif($part == 'edit'){
		
			$group = $db->getRow("SELECT * FROM `{$db_mymps}member_level` WHERE id = '$id'");
			$purviews = explode(',',$group['purviews']);
			$group['allow_tpl'] = explode(',',$group['allow_tpl']);
			$settings = $charset == 'utf-8' ? utf8_unserialize($group['moneysettings']) : unserialize($group['moneysettings']);
			$here = "Set Authority For Member Group";
			include(mymps_tpl("member_group_edit"));

		}elseif($part == 'update'){

			$purview = is_array($purview) ? implode(",", $purview) : '';
			$purview = $purview ? trim($purview) : '';
			$allow_tpl = is_array($allow_tpl) ? implode(",", $allow_tpl) : '';
			if(!$settings['ifopen']) write_msg('You must select one deadline to upgrade.');
			$settings = serialize($settings);
			$db->query("UPDATE `{$db_mymps}member_level` SET levelname='$levelname',purviews='$purview',money_own='$money_own',perday_maxpost='$perday_maxpost',signin_view='$signin_view',signin_del='$signin_del',signin_notice='$signin_notice',member_contact='$member_contact',allow_tpl='$allow_tpl',moneysettings = '$settings' WHERE id = '$id'");
			clear_cache_files('member_'.$id);
			write_msg("Authority setting on member group ".$levelname." has been successful!","member.php?do=group&part=edit&id=".$id,"mymps");
			
		}elseif($part == 'delete'){
		
			if(empty($id)){
				write_msg("No Records Selected");
			}elseif (mymps_count("member","WHERE levelid = '$id'")>0){
				write_msg("There are still members with in this group, so it cannot be deleted!");
			}else{
				mymps_delete("member_level","WHERE id = '$id'");
				clear_cache_files('member_'.$id);
				write_msg("User group $id has successfully been deleted!","?do=group","record");
			}
			
		}
	break;
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();

function get_member_level($id=''){
	global $db,$db_mymps;
	$member_level = $db -> getAll("SELECT id,levelname FROM `{$db_mymps}member_level`");
	$mymps .= "<select name=\"levelid\">";
	$mymps .= "<option value=''>>Do Not Limit Group</option>";
	foreach($member_level as $k=>$value){
		$mymps .= "<option value=".$value[id]."";
		$mymps .= ($id==$value[id])?" selected style=\"background-color:#6EB00C;color:white\"":"";
		$mymps .= ">".$value[levelname]."</option>";
	}
	$mymps .= "</select>";
	return $mymps;
}

function get_member_level_label(){
	global $db,$db_mymps;
	$member_level = $db -> getAll("SELECT id,levelname FROM `{$db_mymps}member_level`");
	foreach($member_level as $k=>$value){
		$mymps .= "<label for=".$value[id]."><input name=do_action value=".$value[id]." type=radio class=radio id=".$value[id]."";
		$mymps .= ($id==$value[id])?" checked":"";
		$mymps .= ">".$value[levelname]."</label>";
	}
	return $mymps;
}
?>
