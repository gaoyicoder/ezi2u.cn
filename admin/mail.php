<?php
define('CURSCRIPT','mail');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_INC.'/email.fun.php';

(!in_array($part,array('setting','template','sendlist')) || !$part) && $part = 'setting';

if(!submit_check(CURSCRIPT.'_submit')){
	
	switch($part){
		
		case 'setting':
			chk_admin_purview("purview_Mail Server");
			$here = 'Mail Server Settings';
			$res = $db->query("SELECT description,value FROM {$db_mymps}config WHERE type='mail'");
			while($row = $db->fetchRow($res)){
				$mail_config[$row['description']] = $row['value'];
			}
		break;
		
		case 'sendlist':
			chk_admin_purview("purview_Sent Record");
			$here = 'Sent Mail Records';
			$list = $db->getAll("SELECT * FROM `{$db_mymps}mail_sendlist` ORDER BY last_send DESC");
		break;
		
		default:
			chk_admin_purview("purview_Mail Template");
			$here = 'Mail Template Management';
			$tpl = mail_template_list();
			$template_id && $edit = $db -> getRow("SELECT * FROM `{$db_mymps}mail_template` WHERE template_id = '$template_id'");
		break;
		
	}
	
	include(mymps_tpl(CURSCRIPT.'_'.$part));
	
} else {
	
	//如果为发送测试邮件
	if(!empty($test_mail)){
		$test_mail = trim($test_mail);
		if(!send_email($test_mail,'The Site'.$mymps_global[SiteName].'has sent you this test mail  If you received it without fail, it means that you have successfully configured the Email server. Time of send: '.GetTime(time()))){
			write_msg('Failed in sending test mail! Please configure mail service settings with caution!','?part=setting');
		} else {
			write_msg('Congratulations, the test mail has successfully been sent!','?part=setting','write_record');
		}
	}
	
	if($part == 'setting'){
		
		$des = array('mail_service','smtp_server','smtp_serverport','smtp_mail','mail_user','mail_pass');
		mymps_delete("config","WHERE type = 'mail'");//清空mail_config表
		foreach($des as $key){
			$db->query("INSERT {$db_mymps}config (description,value,type) VALUES ('$key','".trim(${$key})."','mail')");
		}
		
		clear_cache_files();
		write_msg('Mail server configuration has been successful!','?part='.$part,'WriteRecord');
	
	} elseif($part == 'template') {
		
		$return_url = '?part=template';
		
		//批量删除邮件模板
		if(is_array($delids)){
			foreach ($delids as $kids => $vids){
				mymps_delete("mail_template","WHERE template_id = ".$vids);
			}
		}
		
		/*增加自定义模板*/
		if(is_array($add) && $add[template_subject] && $add[template_code]){
			if($db -> getOne("SELECT template_id FROM `{$db_mymps}mail_template` WHERE template_code = '$add[template_code]'")){
				write_msg('The template ID code you entered is the same as an existing one!');
			} else {
				$db -> query("INSERT `{$db_mymps}mail_template` (template_subject,template_code,is_html,is_sys,last_modify)VALUES('$add[template_subject]','$add[template_code]','$add[is_html]','$add[is_sys]','".time()."')");
			}
			
		}
		
		//修改邮件模板
		if(is_array($edit) && $edit[template_id] && $edit[template_subject] && $edit[template_code] && $edit[template_content]){
			
			$db -> query("UPDATE `{$db_mymps}mail_template` SET template_subject = '$edit[template_subject]', template_code = '$edit[template_code]' , is_html  = '$edit[is_html]' , template_content = '$edit[template_content]' , last_modify = '".time()."'  WHERE template_id = '$edit[template_id]'");
			$return_url = '?part=template&template_id='.$edit[template_id]; 
		}
		
		clear_cache_files();
		write_msg('Mail template has successfully been added or updated!',$return_url,'write_record');
		
	} elseif($part == 'sendlist') {
		$return_url = '?part=sendlist';
		//批量删除邮件发送记录
		if(is_array($delids)){
			foreach ($delids as $kids => $vids){
				mymps_delete("mail_sendlist","WHERE id = ".$vids);
			}
		}
		write_msg('Sent mail record has successfully been deleted!',$return_url,'write_record');
	}
	
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
