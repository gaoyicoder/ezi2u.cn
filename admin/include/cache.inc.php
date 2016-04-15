<?php
$admin_cache_array = array(
	"index"=>"Homepage",
	"info" => "Info",
	"about" => "Site Management"
);

$admin_cache = array(
	
	"index"=>array(
			"site"=>array("name"=>'Homepage',"open"=>'Open/close',"des"=>'Homepage, can be longer')
			),
	
	"info"=>array(
			"info" => array("name"=>'Information',"open"=>'Open/close',"des"=>'Page->Information, can be shorter'),
			"list" => array("name"=>'Info Table',"open"=>'Open/close',"des"=>'Page->Info Table, can be longer')
			),
	
	"about"=>array(
			"aboutus" => array("name"=>'Site Management-About Us',"open"=>'Open/close',"des"=>'Page->Site Management->About Us, seldom changes, can be longer'),
			"announce" => array("name"=>'Site Management-Announcements',"open"=>'Open/close',"des"=>'Page->Site Management->Announcements, seldom changes, can be longer'),
			"faq" => array("name"=>'Site Management-Help',"open"=>'Open/close',"des"=>'Page->Site Management->Help, seldom changes, can be longer'),
			"friendlink" => array("name"=>'Site Management-Related Sites',"open"=>'Open/close',"des"=>'Page->Site Management->Related Sites, seldom changes, can be longer'),
			"guestbook" => array("name"=>'Site Management-Messages',"open"=>'Open/close',"des"=>'Page->Site Management->Messages, seldom changes, can be longer'),
			)
);
?>