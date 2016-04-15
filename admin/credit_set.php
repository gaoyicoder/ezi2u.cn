<?php
define('CURSCRIPT','credit_set');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

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

if(!submit_check(CURSCRIPT.'_submit')){
	
	chk_admin_purview("purview_Credit Level");
	$here = 'Credit Level Management.';
	
	if($ac == 'update_credits'){
		$score_change = get_credit_score();
		@set_time_limit(0);
		$query = $db -> query("SELECT id,credit FROM `{$db_mymps}member`");
		while($row = $db -> fetchRow($query)){
			if($score_change){
				foreach($score_change['credit_set']['rank'] AS $level => $credi) {
					if($row['credit'] <= $credi) {
						$credits = $level;
						break;
					}else{
						$credits = 16;
					}
				}
				$credits = $credits - 1;
			}
			$db -> query("UPDATE `{$db_mymps}member` SET credits = '$credits' WHERE id = '$row[id]'");
		}
		write_msg('Member score and credit icons have successfully been updated!','credit_set.php','write_mymps_records');
		$score_change = $row = $credits = NULL;
		exit;
	}
	
	$credit_set = $db->getOne("SELECT value FROM `{$db_mymps}config` WHERE type='credit_sco' AND description = 'credit_set'");
	$credit_set = $credit_set ? ($charset == 'utf-8' ? utf8_unserialize($credit_set) : unserialize($credit_set)) : array(
		'rank' => $defaultrank
	);
	include(mymps_tpl(CURSCRIPT));
	
}else{
	
	if(is_array($credit_setnew['rank'])) {
		foreach($credit_setnew['rank'] AS $rank => $mincredits) {
			$mincredits = intval($mincredits);
			if($rank == 1 && $mincredits <= 0) {
				write_msg('The credit level must be over 0 to enable assessment, so please return and change.');
			} elseif($rank > 1 && $mincredits <= $credit_setnew['rank'][$rank - 1]) {
				write_msg('Credit required to reach level '.$rank.' must be above that required to reach the previous level, so please return and change the corresponding settings.');
			}
			$credit_setnew['rank'][$rank] = $mincredits;
		}
	} else {
		$credit_setnew['rank'] = $defaultrank;
	}
	
	$db->query("DELETE FROM `{$db_mymps}config` WHERE description = 'credit_set' AND type = 'credit_sco'");
	$db->query("INSERT INTO `{$db_mymps}config` (description,value,type) values ('credit_set','".serialize($credit_setnew)."','credit_sco')");
	clear_cache_files('credit_score');
	write_msg('Credit level management has successfully been updated!','credit_set.php','WriteRecord');
	
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
