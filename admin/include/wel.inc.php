<?php
(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$gd_info 		  = @gd_info();
$gd_version 	  = is_array($gd_info) ? $gd_info['GD Version'] : '<font color=red>Do not support GD database</font>';
$cfg_if_tpledit   = ($mymps_mymps[cfg_if_tpledit]==0)?"<font color=green>Disabled</font>":"<font color=red>Enabled</font>";
$if_del_install   = !is_file(MYMPS_ROOT."/install/index.php") ? "<font color=green>Deleted</font>":"<font color=red>Not Deleted</font>";
$Register_Globals = ini_get('Register_Globals')?'on':'off';
$Magic_Quotes_Gpc = MAGIC_QUOTES_GPC ? 'on' : 'off';
$expose_php		  = ini_get('expose_php') ? 'on' : 'off';
$cur_dir		  = getcwdOL();
$cur_dir		  = $cur_dir == '/admin' ? '<font color=red title=We do not recommended to use admin as table name>/admin</font>' : '<font color=green>'.$cur_dir.'</font>';
$latestbackup	  = $db -> getOne("SELECT value FROM `{$db_mymps}config` WHERE description = 'latestbackup' AND type = 'database'");
$parttime = round(($latestbackup > 0 ? ($timestamp - $latestbackup) : 0)/(3600*24));
if(!$latestbackup){
	$message = '<font color=red>You have not backed up all Mymps system data.</font>';
} else {
	if($parttime > 13){
		$message = '<font color=red>It has been 2 weeks since your last backup of all Mymps system data. </font>';
	} elseif($parttime == 0) {
		$message = '<font color=green>You have backed up all Mymps system data today.</font>';
	} else{
		$message = 'In <font color=green>'.$parttime.'</font> days ago you had backed up all Mymps system data. Last backup: <font color=green>'.GetTime($latestbackup).'</font>';
	}
}

$message .= ',<a href="database.php?part=backup" style="text-decoration:underline">Click to back-up system data.</a>';

$welcome['Usual Operations'] = '<div><!--<span><input value="Post Information" onclick="window.open(\'../'.$mymps_global[cfg_postfile].'\'); target=\'_blank\'" type="button" class="gray large"></span>--><span><input value="Clear Cache" onclick="location.href=\'config.php?part=cache_sys&return_url='.urlencode("index.php?do=manage&part=right").'\'" type="button" class="gray large"></span><span><input value="Optimize System" onclick="location.href=\'optimise.php\'" type="button" class="gray large"></span></div>';

$welcome['Statistics'] = $mymps_count_str;

$welcome['Shortcut']='<div class="mainnav">
		<ul>
		<li><a href="'.$mymps_global[SiteUrl].'" target="_blank"><img border="0" src="template/images/default/home.gif" />Shortcut</a></li>
		<li><a href="#" onclick="parent.framRight.location=\'member.php\'"><img border="0" src="template/images/default/user.png" alt="Verification and Registration" />Verification and Registration</a></li>
		<li><a href="#" onclick="parent.framRight.location=\'announce.php?part=add\'"><img border="0" src="template/images/default/tpc.png" alt="Theme Verification" />Post an Announcement</a></li>
		<li><a href="#" onclick="parent.framRight.location=\'information.php\'"><img border="0" src="template/images/default/post.png"/>Categorized Information</a></li>
		<li><a href="#" onclick="parent.framRight.location=\'friendlink.php\'"><img border="0" src="template/images/default/share.png" />Link Verification</a></li>
		</ul>
		</div>';

if(!$admin_cityid)
{/*
	$welcome['Advices on Safety'] = '<span>Online Module Editing</span> Current: '.$cfg_if_tpledit.'it is recommend that you enable it only when necessary. Please make changes in /data/config.inc.php to disable it.<br />
<span>System Install Directory</span> Current: '.$if_del_install.'To prevent the contents from being used by outside parties, it is recommend that you delete this folder upon completion of installation.<br />
<span>System Management Folder</span> Current: '.$cur_dir.'It is recommended that you change the folder name (direct change is possible) upon completion of the installation.<br />
<span>Data Safety</span>'.$message;

	$welcome['Note Before Purchase'] = '<span>Authorization for Commercial Users</span>
If you have not purchased an authorization for commercial users, please contact us for professional tech-support!<br />';

	$welcome['On Server']='<div><span>Server Runtime Environment:</span>'.$_SERVER['SERVER_SOFTWARE'].'</div>
		<div><span>Server System:</span>'.PHP_OS.'</div>
		<div><span>Current time:</span>'.GetTime($timestamp)." ".date("DayN",$timestamp).'</div>
		<div><span>PHP Program Version:</span>'.PHP_VERSION.'</div>
		<div><span>Register_Globals:</span>'.$Register_Globals.' &nbsp;&nbsp;<font color=red>[Recommended to turn off]</font></div>
		<div><span>Magic_Quotes_Gpc:</span>'.$Magic_Quotes_Gpc.' &nbsp;&nbsp;<font color=red>[Recommended to turn on]</font></div>
		<div><span>expose_php:</span>'.$expose_php.' &nbsp;&nbsp;<font color=red>[Recommended to turn off]</font></div>
		<div><span>MYSQL Version:</span>'.$db->version().'</div>
		<div><span>mymps Directory: </span>'.MYMPS_ROOT.'</div>
		<div><span>Domain Name Used: </span>'.$_SERVER["SERVER_NAME"].'</div>
		<div><span>Script Overtime</span>'.ini_get('max_execution_time').'</div>
		<div><span>Maximum size of uploaded attachementnt</span>'.ini_get('upload_max_filesize').'</div>
		<div><span>GD Database Version</span>'.$gd_version.'</div>
		<div><span>Check for authority to read and write.</span><a href=\'javascript:setbg("Check for authority to read and write.",305,380,"../box.php?part=sp_testdirs")\' class="icon_open" id="spanmymsg" >Click to Check</a>';
		
	$welcome['Development Team']='
		<div><span>All Right Reserved: </span> EZI2U <br />
		<div><span>Version: </span> '.MPS_VERSION.' <br />
		<div><span>Latest Update: </span> '.MPS_RELEASE.' <br />';
*/
}

?>