<?php
define('CURSCRIPT','file_manage');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_DATA."/config.inc.php";
require_once MYMPS_INC."/db.class.php";

$part = $part ? $part : 'template' ;

if($downfile) {
	!is_file($downfile) && write_msg("The file you wish to download does not exist!");
	FileExt($downfile) == 'php' && write_msg("This file is not allowed to download!");
	$filename = basename($downfile);
	$filename_info = explode('.', $filename);
	$fileext = $filename_info[count($filename_info)-1];
	header('Content-type: application/x-'.$fileext);
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Description: PHP3 Generated Data');
	readfile($downfile);
	exit;
}

if($delfile!=""){
	$part == 'template' && write_msg("Template files cannot be deleted on this condition, please delete it manually via FTP!");
	(FileExt($delfile) == 'php' || FileExt($delfile) == 'css' || FileExt($delfile) == 'js' || FileExt($delfile) == 'html') && write_msg("This file is not allowed to be deleted within system, please delete it manually via FTP!");
	if(file_exists($delfile)) {
		@unlink($delfile);
		$msgs[]="Successfully Deleted File<br /><br />".$delfile;
		$msgs[]="<a href=\"".$url."\">Click to return &raquo;</a>";
		show_msg($msgs);
	} else {
		write_msg("This file no longer exists!");
	}
	exit;
}

$cfg_if_tpledit = ($mymps_mymps['cfg_if_tpledit'] == 0) ? "<font color=green>已关闭</font>" : "<font color=red>已开启</font>";

switch ($part){
	case 'template':
		chk_admin_purview("purview_Template");
		$here = "模板在线管理";
		$mulu = "Mymps模板目录";
		$showdir= MYMPS_TPL.'/default';
		
		if ($editfile && $do=='update'){
			
			if($mymps_mymps['cfg_if_tpledit']=='0'){
				write_msg("Operation failed, for the administrator has disabled Online Editing Of Style!<br /><br />You may edit the file /dat/config.inc.php to enable it.");
			}
			
			$content=str_replace('&amp;','&',trim($content));
			$content=str_replace('&quot;','"',trim($content));
			$nowfile = trim($editfile);
			
			if(!is_file($nowfile)){
				write_msg("Sorry, this file does not exist!");
			}
			
			$norootfile = str_replace(MYMPS_ROOT."/template",'',$nowfile);
			
			if($db->getOne("SELECT content FROM `{$db_mymps}template` WHERE filepath LIKE '$norootfile'")){
				$update_sql=$db->query("UPDATE `{$db_mymps}template` SET content = '$content' WHERE filepath = '$norootfile'");
			}else{
				$db->query("INSERT INTO `{$db_mymps}template` (filepath,content) VALUES ('$norootfile','$content')");
			}

			$row=$db->getRow("SELECT filepath,content FROM `{$db_mymps}template` WHERE filepath = '$norootfile'");
			if(!$row){write_msg("Operation Failed!");exit();}
			$create_c = createfile($nowfile,$row[content]);
			if($create_c){
				write_msg("Template file".$nowfile."<br /><br />has successfully been edited",$url,"MyMps");
			}else{
				write_msg("The template file".$nowfile."cannot be edited.<br /><br />Please check whether the operator has the authority to operate files in Template directory");
			}
			
		} elseif ($editfile&&empty($do)){
		
			$ext = FileExt($editfile);
			
			if($ext!="html" && $ext!="css" && $ext!="htm" && $ext!="js"){
				write_msg("This file cannot be edited online!");
			}
			
			if(!$edit = file_get_contents($editfile)){
				write_msg("This file is not readable, please check whether the operator is authorized to operate on this file.");
			}
			
			$path = str_replace("/".end(explode("/",$editfile)),"",$editfile);
			$edit = htmlspecialchars($edit);
			$acontent = "<textarea name=\"content\" cols=\"110\" rows=\"25\">".$edit."</textarea>";
			include(mymps_tpl("template_edit"));
			exit();
			
		}
	break;
	case 'upload':
	
		chk_admin_purview("purview_Accessory");
		$here = "系统上传附件管理";
		$mulu = "系统附件目录";
		$showdir= MYMPS_UPLOAD;
		
	break;
}

$path	   = trim($path) ? trim($path) : $showdir;
$LastPath  = str_replace("/".end(explode("/",$path)),"",$path);
$con 	   = explode($showdir,$CurrentPath);

include mymps_tpl(CURSCRIPT);
is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
