<?php

!defined('IN_MYMPS') && exit('FORBIDDEN');

require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

require_once MYMPS_INC."/cache.fun.php";

require_once MYMPS_INC."/member.class.php";



if(!$member_log->chk_in()) write_msg("Sorry, you must log in to proceed.");



/*��ֱ仯��������*/

$score_change = get_credit_score();

$coin_credit = $score_change['credit']['rank']['coin_credit'];



$row = $db -> getRow("SELECT credit,credits,money_own FROM `{$db_mymps}member` WHERE userid = '$s_uid'");



if($action == 'post'){

	require_once MYMPS_ROOT."/member/include/common.func.php";

	

	$coin = isset($_POST['coin']) ? intval($_POST['coin']) : '';

	if(!$coin) write_msg('Please enter the amount of coins you wish to exchange.');

	if($coin > $row['money_own']) write_msg('You do not have enough coins, please recharge first.');

	$credit = $coin*$coin_credit;

	$nowcredit = $row['credit'] + $credit;

	

	/*���õȼ��仯*/

	if($score_change){

		foreach($score_change['credit_set']['rank'] AS $level => $credi) {

			if($nowcredit <= $credi) {

				$credits = $level;

				break;

			}else{

				$credits = 16;

			}

		}

		$credits = $credits - 1;

	}

	

	$db -> query("UPDATE `{$db_mymps}member` SET money_own = money_own - ".$coin." , credit = credit + ".$credit.",credits = '$credits' WHERE userid = '$s_uid'");

	

	/*��д��Ѽ�¼*/

	write_money_use("���� ".$credit." Credit","<font color=red>Deduct Coin ".$coin." </font>");

	

	write_msg('Credit successfully exchanged! Now you have<font color=red>'.$nowcredit.'</font>credits. The system has deducted<font color=red>'.$coin.'</font>coin from your account.<br /><br /><input value="Close Window" type="button" onclick=\'parent.window.location.reload();parent.closeopendiv();\' style="margin-left:auto;margin-right:auto;" class="blue">','olmsg');

} else {



	$defaultrank = array(

		1 => 10,

		2 => 20,

		3 => 40,

		4 => 70,

		5 => 120,

		6 => 200,

		7 => 400,

		8 => 700,

		9 => 1200,

		10 => 1800,

		11 => 2600,

		12 => 4000,

		13 => 10000,

		14 => 30000,

		15 => 60000

	);

	$credit_set = $db->getOne("SELECT value FROM `{$db_mymps}config` WHERE type='credit_sco' AND description = 'credit_set'");

	$credit_set = $credit_set ? ($charset == 'utf-8' ? utf8_unserialize($credit_set) : unserialize($credit_set)) : array(

		'rank' => $defaultrank

	);

	

	include MYMPS_ROOT.'/template/box/credits_up.html';

	

}

$row = $credit_set = $defaultrank = $nowcredit = $credit = $credits = $credit_set = NULL;

?>

