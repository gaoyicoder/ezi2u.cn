<?php

!defined('IN_MYMPS') && exit('FORBIDDEN');

require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

$ip 		 = GetIP();

$infoid		 = isset($_POST['infoid']) 	  ? intval($_POST['infoid'])  : '';

$infotitle	 = isset($_POST['infotitle']) ? trim($_POST['infotitle']) : '';

$content	 = isset($_POST['content']) ? trim($_POST['content']) : '';

$report_type = isset($_POST['report_type']) ? trim($_POST['report_type']) : '';



if(mymps_count("info_report","WHERE infoid = '$infoid' AND ip = '$ip' AND pubtime > '".mktime(0,0,0)."'") > 0){

	echo "<center style=\"color:red; font-weight:bold\">Operation Failed, for you have reported this post already!</font>";

	exit;

}

$db->query("INSERT INTO `{$db_mymps}info_report` (report_type,content,infoid,infotitle,ip,pubtime)VALUES('$report_type','$content','$infoid','$infotitle','$ip','".$timestamp."')");

echo "<div style=\"margin:10px 15px\"><font style=\"color:red; font-size:12px\"><h1>We appreciate your report :)</h1><br />".$mymps_global[SiteName].". Thousands of improper posts are deleted every day thanks to the users' reports.<br /><br />If you did not intend to click report just now, please have no worries. A post can be deleted only when it receives a certain amount of reports.</font></div>";

?>

