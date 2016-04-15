<?php
define('CURSCRIPT','database');
error_reporting(0);
require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

$allowpart = array('backup'=>'Database Backup','restore'=>'Database Restoration','optimize'=>'Database Optimization','check'=>'Database Checking','repair'=>'Database Repairs');
!in_array($part,array_keys($allowpart)) && $part = 'backup';
$here = $allowpart[$part];
$action = isset($action) ? trim($action) : '';
$tabletype = $db->version() > '4.1' ? 'Engine' : 'Type';
$version = MPS_VERSION;

$backupdir = $mymps_global['cfg_backup_dir'];

if($part == 'backup') {

	chk_admin_purview("purview_Backup");

	if($action != 'doaction') {

		$mymps_tables = fetchtablelist($db_mymps);
		$defaultfilename = date('ymd').'_'.random(8);
		include mymps_tpl('db_'.$part);

	} else {
		
		$db->query('SET SQL_QUOTE_SHOW_CREATE=0', 'SILENT');

		if(!$filename || preg_match("/(\.)(exe|jsp|asp|aspx|cgi|fcgi|pl)(\.|$)/i", $filename)) {
			write_msg('Lead-out Files In Wrong Format');
		}

		$time = GetTime($timestamp);
		if($type == 'mymps') {
			$tables = arraykeys2(fetchtablelist($db_mymps), 'Name');
		} elseif($type == 'custom') {
			$tables = array();
			if(empty($setup)) {
				if($tables = $db->fetch_first("SELECT value FROM `{$db_mymps}config` WHERE description='custombackup'")) {
					$tables = $charset == 'utf-8' ? utf8_unserialize($tables['value']) : unserialize($tables['value']);
				}
			} else {
				$customtablesnew = empty($customtables)? '' : addslashes(serialize($customtables));
				$db -> query("DELETE FROM `{$db_mymps}config` WHERE description = 'custombackup' AND type = 'database'");
				$db -> query("INSERT INTO `{$db_mymps}config` (description, value, type) VALUES ('custombackup', '$customtablesnew','database')");
				$tables = & $customtables;
			}
			if( !is_array($tables) || empty($tables)) {
				write_msg('Please select the database tables you wish to backup.');
			}
		}

		$volume = intval($volume) + 1;
		$idstring = '# Identify: '.base64_encode("$timestamp,$version,$type,$method,$volume")."\n";

		$dumpcharset = $sqlcharset ? $sqlcharset : $db_charset;
		$setnames = ($sqlcharset && $db->version() > '4.1' && (!$sqlcompat || $sqlcompat == 'MYSQL41')) ? "SET NAMES '$dumpcharset';\n\n" : '';
		if($db->version() > '4.1') {
			if($sqlcharset) {
				$db->query("SET NAMES '".$sqlcharset."';\n\n");
			}
			if($sqlcompat == 'MYSQL40') {
				$db->query("SET SQL_MODE='MYSQL40'");
			} elseif($sqlcompat == 'MYSQL41') {
				$db->query("SET SQL_MODE=''");
			}
		}

		$backupfilename = MYMPS_ROOT.$backupdir.'/'.str_replace(array('/', '\\', '.'), '', $filename);

		$sqldump = '';
		$tableid = intval($tableid);
		$startfrom = intval($startfrom);

		$complete = TRUE;
		for(; $complete && $tableid < count($tables) && strlen($sqldump) + 500 < $sizelimit * 1000; $tableid++) {
			$sqldump .= sqldumptable($tables[$tableid], $startfrom, strlen($sqldump));
			if($complete) {
				$startfrom = 0;
			}
		}

		$dumpfile = $backupfilename."-%s".'.sql';
		!$complete && $tableid--;
		if(trim($sqldump)) {
			$sqldump = "$idstring".
				"# <?exit();?>\n".
				"# Mymps Multi-Volume Data Dump Vol.$volume\n".
				"# Version: Mymps $version\n".
				"# Time: $time\n".
				"# Type: $type\n".
				"# Table Prefix: $db_mymps\n".
				"#\n".
				"# Mymps Home: http://www.mymps.com.cn\n".
				"# Please visit our website for newest infomation about Mymps\n".
				"# --------------------------------------------------------\n\n\n".
				"$setnames".
				$sqldump;
			$dumpfilename = sprintf($dumpfile, $volume);
			@$fp = fopen($dumpfilename, 'wb');
			@flock($fp, 2);
			if(@!fwrite($fp, $sqldump)) {
				@fclose($fp);
				write_msg('Database backup failed. Please check whether the operator is authorized to read and write files in the backup directory');
			} else {
				fclose($fp);
				unset($sqldump, $content);
				write_msg("Data file #".$volume." has successfully been backed-up, and the program will automatically continue…","?part=backup&type=".rawurlencode($type)."&filename=".rawurlencode($filename)."&method=multivol&sizelimit=".rawurlencode($sizelimit)."&volume=".rawurlencode($volume)."&tableid=".rawurlencode($tableid)."&startfrom=".rawurlencode($startrow)."&extendins=".rawurlencode($extendins)."&sqlcharset=".rawurlencode($sqlcharset)."&sqlcompat=".rawurlencode($sqlcompat)."&action=doaction",'write_record');
			}
		} else {
			$volume--;
			
			for($i = 1; $i <= $volume; $i++) {
				$filename = sprintf($dumpfile, $i);
				$filelist .= $filename.'<br>';
			}
			
			$db -> query("DELETE FROM `{$db_mymps}config` WHERE description = 'latestbackup' AND type = 'database'");
			$db -> query("INSERT INTO `{$db_mymps}config` (description, value, type) VALUES ('latestbackup', '$timestamp','database')");
			
			write_msg('Congratulations, all '.$volume.' backup files has successfully been created and backup proceeding is complete.<br /><br />'.$filelist,'olmsg');
		}

	}

} elseif($part == 'restore') {

	chk_admin_purview("purview_Restore");
	
	if($action == 'dorestore'){
		
		$readerror = 0;
		$datafile = '';
		if($from == 'server') {
			$datafile = $datafile_server;
		}
		if(@$fp = fopen($datafile, 'rb')) {
			$sqldump = fgets($fp, 256);
			$identify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", $sqldump)));
			$dumpinfo = array('method' => $identify[3], 'volume' => intval($identify[4]));
			/*if($dumpinfo['method'] == 'multivol') {
				$sqldump .= fread($fp, filesize($datafile));
			}*/
			$sqldump .= fread($fp, filesize($datafile));
			fclose($fp);
		} else {
			if($autoimport) {
				updatecaches();
				write_msg('Congratulations, data restoration has been successful!','olmsg');
			} else {
				write_msg('Unfortunately, data restoration failed.','olmsg');
			}
		}

	
		$sqlquery = splitsql($sqldump);
		unset($sqldump);

		foreach($sqlquery as $sql) {
			$sql = syntablestruct(trim($sql), $db->version() > '4.1', $dbcharset);

			if($sql != '') {
				$db->query($sql, 'SILENT');
				if(($sqlerror = $db->error()) && $db->errno() != 1062) {
					$db->halt('MySQL Query Error', $sql);
				}
			}
		}

		$datafile_next = preg_replace("/-($dumpinfo[volume])(\..+)$/", "-".($dumpinfo['volume'] + 1)."\\2", $datafile_server);

		if($dumpinfo['volume'] == 1) {
			write_msg('Data in subsection one has successfully been led into the database.<br /><br />Do you want other subsections from this backup be led-in automatically? <br /><br /><center><input class="gray" value="Confirm" type=button onclick="location.href=\'?part=restore&from=server&datafile_server='.$datafile_next.'&autoimport=yes&action=dorestore\'">&nbsp;&nbsp;&nbsp;&nbsp;<input class="gray" type="button" onclick="location.href=\'?part=restore&from=server&datafile_server='.$datafile_next.'&action=dorestore\'" value="Cancel"></center>',"olmsg");
		} elseif($autoimport) {
			write_msg("Data file ".$dumpinfo['volume']."# has successfully been led-in, and the program will automatically continue.","?part=restore&from=server&datafile_server=$datafile_next&autoimport=yes&action=dorestore");
		} else {
			updatecaches();
			write_msg('Congratulations, data has successfully been restored from backup files!','olmsg');
		}
		
	} elseif($action == 'dodelete') {
		
		if(is_array($delete)) {
			foreach($delete as $filename) {
				$file_path = MYMPS_ROOT.$backupdir.'/'.str_replace(array('/', '\\'), '', $filename);
				if(is_file($file_path)) {
					@unlink($file_path);
				} else {
					$i = 1;
					while(1) {
						$file_path = MYMPS_ROOT.$backupdir.'/'.str_replace(array('/', '\\'), '', $filename.'-'.$i.'.sql');
						if(is_file($file_path)) {
							@unlink($file_path);
							$i++;
						} else {
							break;
						}
					}
				}
			}
			write_msg('Congratulations, the designated backup files have successfully been deleted!','database.php?part=restore','write_record');
		} else {
			write_msg('Operation Failed. Please check whether the operator is authorized to read and write files in the backup directory');
		}
		
	} else {
		
		$backuptype = array(
							'mymps'=>'Ezi2u All Data Tables',
							'custom'=>'Customized Backup'
							);
		
		$exportlog = $exportsize = $exportziplog = array();
		if(is_dir(MYMPS_ROOT.$backupdir)) {
			$dir = dir(MYMPS_ROOT.$backupdir);
			while($entry = $dir->read()) {
				$entry = MYMPS_ROOT.$backupdir.'/'.$entry;
				if(is_file($entry)) {
					if(preg_match("/\.sql$/i", $entry)) {
						$filesize = filesize($entry);
						$fp = fopen($entry, 'rb');
						$identify = explode(',', base64_decode(preg_replace("/^# Identify:\s*(\w+).*/s", "\\1", fgets($fp, 256))));
						fclose($fp);
						$key = preg_replace('/^(.+?)(\-\d+)\.sql$/i', '\\1', basename($entry));
						$exportlog[$key][$identify[4]] = array(
							'version' => $identify[1],
							'type' => $identify[2],
							'method' => $identify[3],
							'volume' => $identify[4],
							'filename' => $entry,
							'dateline' => filemtime($entry),
							'size' => $filesize
						);
						$exportsize[$key] += $filesize;
					}
				}
			}
			$dir->close();
		} else {
			write_msg('Cannot recognize the directory that the backup database files are to be stored.');
		}

		include mymps_tpl('db_'.$part);
	}

} elseif($part == 'optimize') {
	chk_admin_purview("purview_Maintenance");
	@set_time_limit(0);
	$optimizetable = '';
	$totalsize = 0;
	$tablearray = array( 0 =>$db_mymps);
	include !submit_check('optimize_submit') ? mymps_tpl('db_'.$part) : mymps_tpl('db_result');

} elseif($part == 'check'){
	chk_admin_purview("purview_Maintenance");
	$optimizetable = '';
	$totalsize = 0;
	$tablearray = array( 0 =>$db_mymps);
	include !submit_check('check_submit') ? mymps_tpl('db_'.$part) : mymps_tpl('db_result');
} elseif($part == 'repair'){
	chk_admin_purview("purview_Maintenance");
	$optimizetable = '';
	$totalsize = 0;
	$tablearray = array( 0 =>$db_mymps);
	include !submit_check('repair_submit') ? mymps_tpl('db_'.$part) : mymps_tpl('db_result');
}

function createtable($sql, $dbcharset) {
	$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
	$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
		(mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=$dbcharset" : " TYPE=$type");
}

function arraykeys2($array, $key2) {
	$return = array();
	foreach($array as $val) {
		$return[] = $val[$key2];
	}
	return $return;
}


function syntablestruct($sql, $version, $dbcharset) {

	if(strpos(trim(substr($sql, 0, 18)), 'CREATE TABLE') === FALSE) {
		return $sql;
	}

	$sqlversion = strpos($sql, 'ENGINE=') === FALSE ? FALSE : TRUE;

	if($sqlversion === $version) {

		return $sqlversion && $dbcharset ? preg_replace(array('/ character set \w+/i', '/ collate \w+/i', "/DEFAULT CHARSET=\w+/is"), array('', '', "DEFAULT CHARSET=$dbcharset"), $sql) : $sql;
	}

	if($version) {
		return preg_replace(array('/TYPE=HEAP/i', '/TYPE=(\w+)/is'), array("ENGINE=MEMORY DEFAULT CHARSET=$dbcharset", "ENGINE=\\1 DEFAULT CHARSET=$dbcharset"), $sql);

	} else {
		return preg_replace(array('/character set \w+/i', '/collate \w+/i', '/ENGINE=MEMORY/i', '/\s*DEFAULT CHARSET=\w+/is', '/\s*COLLATE=\w+/is', '/ENGINE=(\w+)(.*)/is'), array('', '', 'ENGINE=HEAP', '', '', 'TYPE=\\1\\2'), $sql);
	}
}

function sqldumptable($table, $startfrom = 0, $currsize = 0) {
	global $db, $sizelimit, $startrow, $extendins, $sqlcompat, $sqlcharset, $dumpcharset, $usehex, $complete, $excepttables;

	$offset = 300;
	$tabledump = '';
	$tablefields = array();

	$query = $db->query("SHOW FULL COLUMNS FROM $table", 'SILENT');
	if(!$query && $db->errno() == 1146) {
		return;
	} elseif(!$query) {
		$usehex = FALSE;
	} else {
		while($fieldrow = $db->fetch_array($query)) {
			$tablefields[] = $fieldrow;
		}
	}
	if(!$startfrom) {

		$createtable = $db->query("SHOW CREATE TABLE $table", 'SILENT');

		if(!$db->error()) {
			$tabledump = "DROP TABLE IF EXISTS $table;\n";
		} else {
			return '';
		}

		$create = $db->fetch_row($createtable);

		if(strpos($table, '.') !== FALSE) {
			$tablename = substr($table, strpos($table, '.') + 1);
			$create[1] = str_replace("CREATE TABLE $tablename", 'CREATE TABLE '.$table, $create[1]);
		}
		$tabledump .= $create[1];

		if($sqlcompat == 'MYSQL41' && $db->version() < '4.1') {
			$tabledump = preg_replace("/TYPE\=(.+)/", "ENGINE=\\1 DEFAULT CHARSET=".$dumpcharset, $tabledump);
		}
		if($db->version() > '4.1' && $sqlcharset) {
			$tabledump = preg_replace("/(DEFAULT)*\s*CHARSET=.+/", "DEFAULT CHARSET=".$sqlcharset, $tabledump);
		}

		$tablestatus = $db->fetch_first("SHOW TABLE STATUS LIKE '$table'");
		$tabledump .= ($tablestatus['Auto_increment'] ? " AUTO_INCREMENT=$tablestatus[Auto_increment]" : '').";\n\n";
		if($sqlcompat == 'MYSQL40' && $db->version() >= '4.1' && $db->version() < '5.1') {
			if($tablestatus['Auto_increment'] <> '') {
				$temppos = strpos($tabledump, ',');
				$tabledump = substr($tabledump, 0, $temppos).' auto_increment'.substr($tabledump, $temppos);
			}
			if($tablestatus['Engine'] == 'MEMORY') {
				$tabledump = str_replace('TYPE=MEMORY', 'TYPE=HEAP', $tabledump);
			}
		}
	}

	$tabledumped = 0;
	$numrows = $offset;
	$firstfield = $tablefields[0];

	if($extendins == '0') {
		while($currsize + strlen($tabledump) + 500 < $sizelimit * 1000 && $numrows == $offset) {
			if($firstfield['Extra'] == 'auto_increment') {
				$selectsql = "SELECT * FROM $table WHERE $firstfield[Field] > $startfrom LIMIT $offset";
			} else {
				$selectsql = "SELECT * FROM $table LIMIT $startfrom, $offset";
			}
			$tabledumped = 1;
			$rows = $db->query($selectsql);
			$numfields = $db->num_fields($rows);

			$numrows = $db->num_rows($rows);
			while($row = $db->fetch_row($rows)) {
				$comma = $t = '';
				for($i = 0; $i < $numfields; $i++) {
					$t .= $comma.($usehex && !empty($row[$i]) && (strexists($tablefields[$i]['Type'], 'char') || strexists($tablefields[$i]['Type'], 'text')) ? '0x'.bin2hex($row[$i]) : '\''.mysql_escape_string($row[$i]).'\'');
					$comma = ',';
				}
				if(strlen($t) + $currsize + strlen($tabledump) + 500 < $sizelimit * 1000) {
					if($firstfield['Extra'] == 'auto_increment') {
						$startfrom = $row[0];
					} else {
						$startfrom++;
					}
					$tabledump .= "INSERT INTO $table VALUES ($t);\n";
				} else {
					$complete = FALSE;
					break 2;
				}
			}
		}
		

		$startrow = $startfrom;
		$tabledump .= "\n";
	}

	return $tabledump;
}

function splitsql($sql) {
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == "#" ? NULL : $query;
		}
		$num++;
	}
	return($ret);
}

function slowcheck($type1, $type2) {
	$t1 = explode(' ', $type1);$t1 = $t1[0];
	$t2 = explode(' ', $type2);$t2 = $t2[0];
	$arr = array($t1, $t2);
	sort($arr);
	if($arr == array('mediumtext', 'text')) {
		return TRUE;
	} elseif(substr($arr[0], 0, 4) == 'char' && substr($arr[1], 0, 7) == 'varchar') {
		return TRUE;
	}
	return FALSE;
}

function sizecount($filesize) {
	if($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
	} elseif($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
	} else {
		$filesize = $filesize . ' Bytes';
	}
	return $filesize;
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
