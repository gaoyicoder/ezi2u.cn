<?php

if($action == 'do_mymps'){



	if(!$optimize || !is_array($optimize)) {

		write_msg('No maintenance task selected, please return and select at least one item.');

		exit;

	}

	

	$optimize_arr = array('check' => 'Check','repair' => 'Repair','analyze' => 'Analyse','optimize' => 'Optimize');

	

	$goodresults = $tables = array();

	

	$query = $db->query("SHOW TABLE STATUS");

	

	while($myval = $db->fetch_array($query)) {

		if(substr($myval['Name'], 0, strlen($dbpre)) == $dbpre) {

			$tables[] = $myval['Name'];

		}

	}

	

	foreach($optimize as $val) {

		if(array_key_exists($val, $optimize_arr)) {

			$newtable =& $tables;

			foreach ($newtable as $table) {

				$result = $db->query($val.' TABLE '.$table) ? '<font color="#339900">Success</font>' : '<font color="#FF0000">Failure</font>';

				$goodresults[] = array('do'=>$optimize_arr[$val],'table'=>$table,'result'=>$result);

			}

		}

	}

	

	if($goodresults && is_array($goodresults) && count($goodresults) > 0) {

	

		$here = 'Mymps Database Maintenance';

		$mymps .= mymps_admin_tpl_global_head();

		$mymps .= '<div id='.MPS_SOFTNAME.'><table class="vbm" border="0" cellspacing="0" cellpadding="0"><tr class="firstr"><td>Operation</td><td>Operated Data Table</td><td>Result</td></tr>';

		foreach($goodresults as $result) {

			$mymps .= '<tr><td width="10%" bgcolor="white">'.$result['do'].'</td><td width="80%"  bgcolor="white">'.$result['table'].'</td><td width="10%"  bgcolor="white">'.$result['result'].'</td></tr>';

		}

		$mymps .= '</table></div>';

		$mymps .= mymps_admin_tpl_global_foot();

		

		echo $mymps;

	} else {

		write_msg('Operation Failed��');

		exit;

	}

	

} else {



	$query = $db->query("SHOW TABLE STATUS");

	

	$mymps_rows_total = $plugin_rows_total = $other_rows_total = $mymps_Index_length = $other_Index_length = $mymps_Data_free = $other_Data_free = $mymps_Data_length = $other_Data_length = 0;

	

	while($info = $db->fetch_array($query)) {

	

		$info['Index_length_unit'] += sizeunit(@intval($info['Index_length']));

		$info['Data_free_unit'] += sizeunit(@intval($info['Data_free']));

		$info['Data_length_unit'] += sizeunit(@intval($info['Data_length']));

		

		if(substr($info['Name'],0,strlen($db_mymps)) == $db_mymps) {

			$mymps_table_info[] = $info;

			$mymps_rows_total += $info['Rows'];

			$mymps_Index_length += $info['Index_length'];

			$mymps_Data_free += $info['Data_free'];

			$mymps_Data_length += $info['Data_length'];

		} else {

			$other_table_info[] = $info;

			$other_rows_total += $info['Rows'];

			$other_Index_length += $info['Index_length'];

			$other_Data_free += $info['Data_free'];

			$other_Data_length += $info['Data_length'];

		}

		

	}

	

	$here = 'Database Maintenance';

	include(mymps_tpl("mymps_optimize"));

}

?>