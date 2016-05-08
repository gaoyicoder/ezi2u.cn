<?php

!defined('IN_MYMPS') && exit('FORBIDDEN');

require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

require_once MYMPS_INC."/member.class.php";

if(!$member_log->chk_in()) write_msg("Sorry, you have not yet logged in.");



$row = $db -> getRow("SELECT score FROM `{$db_mymps}member` WHERE userid = '$s_uid'");



if($action == 'post'){

	$score = isset($_POST['score']) ? intval($_POST['score']) : '';

	if(!$score) write_msg('Please enter the amount of credits you wish to exchange.');

	

	if($score > $row['score']) write_msg('The amount you entered have exceeded the amount you have.');

	$coin = floor($score/$mymps_global['cfg_score_fee']);

	if(empty($coin)) write_msg('Exchange failed, please reenter an amount of credit and make sure it is valid.');

	$db -> query("UPDATE `{$db_mymps}member` SET score = score - ".$score.",money_own=money_own + ".$coin." WHERE userid = '$s_uid'");

	

	write_msg('Credit successfully exchanged! <font color=red>'.$coin.'</font>Coins have been added to your account.<br /><br /><input value="Close Window" type="button" onclick=\'parent.window.location.reload();parent.closeopendiv();\' style="margin-left:auto;margin-right:auto;" class="blue">','olmsg');

} else {

	include MYMPS_ROOT.'/template/box/score_coin.html';

}

$row = $coin = $score = NULL;

?>

