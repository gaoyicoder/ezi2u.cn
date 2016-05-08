<?php

$admin_global_class=array(

	"Site Foreground Configuration",

	"Core Parameter Configuration",

	"Member Settings",

	"Picture Uploading Settings",

	"Map Port Settings",

	"Categorized Information Settings"

);



$admin_global = array(



	"SiteName"=>array("des"=>'Site Name',"type"=>'Hollerith',"class"=>'Site Foreground Configuration'),

	

	"SiteUrl"=>array("des"=>'Use Domain Name, example: http://www.yourdomain.com<br /><i style=color:#666666>If installed in secondary directory, this directory should be filled in. Example: http://www.yourdamain.com/upload</i>',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),

	

	"SiteQQ"=>array("des"=>'Customer Service QQ account, please fill in only one. ',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),

	

	"SiteEmail"=>array("des"=>'Customer Service Email',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),

	

	"SiteTel"=>array("des"=>'Customer Service Hotline',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),

	

	"SiteBeian"=>array("des"=>'Site Record Number',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),

	

	"SiteLogo"=>array("des"=>'Site Logo Directory',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),

	

	"SiteStat"=>array("des"=>'Third-party Site Statistics code',"type"=>'Hollerith ',"class"=>'Site Foreground Configuration'),



	"cfg_if_site_open"=>array("des"=>'Start-up/shut-down Site��<i style=color:#666666>Attention: do not shut-down the site unless necessary, or its ranking on search engines will be considerably lowered!</i>',"type"=>'Boolean',"class"=>'Core Parameter Configuration'),

	

	"cfg_authcodefile"=>array("des"=>'Identifying code display file name, in default settings: randcode.php<br /><i style=color:#666666>It must end with ".php". If changed, please make corresponding changes to files in the root directory in  FTP.</i>',"type"=>'Hollerith',"class"=>'Core Parameter Configuration'),

	

	"cfg_site_open_reason"=>array("des"=>'If the site is shutting down, an announcement will appear on the foreground page (stating the reason).',"type"=>'Hollerith ',"class"=>'Core Parameter Configuration'),

	

	"cfg_list_page_line"=>array("des"=>'Record of times of display of every page in foreground paging ',"type"=>'Hollerith ',"class"=>'Core Parameter Configuration'),

	

	"cfg_page_line"=>array("des"=>'Record of times of display of every page in background paging',"type"=>'Hollerith ',"class"=>'Core Parameter Configuration'),

	

	"cfg_raquo"=>array("des"=>'Delimiter in current position',"type"=>'Hollerith ',"class"=>'Core Parameter Configuration'),

	

	"cfg_backup_dir"=>array("des"=>'Database Backup Folder,<font color=red>Attention, this is in contrast to the root directory of the site</font><br /><br />If the system cannot create this directory automatically after successful saving, please create it manually.',"type"=>'Hollerith ',"class"=>'Core Parameter Configuration'),

	

	"cfg_member_logfile"=>array("des"=>'Member login and register file name, default: login.php<br /><i style=color:#666666>It must end with ".php". If changed, please make corresponding changes to files in the root directory in  FTP.</i>',"type"=>'Hollerith ',"class"=>'Member Settings'),

	

	"cfg_if_member_register"=>array("des"=>'Enable/disable new member registration',"type"=>'Boolean',"class"=>'Member Settings'),

	

	"cfg_if_member_log_in"=>array("des"=>'Enable/disable member login',"type"=>'Boolean',"class"=>'Member Settings'),

	

	"cfg_if_corp"=>array("des"=>'Enable/disable seller member',"type"=>'Boolean',"class"=>'Member Settings'),

	

	"cfg_member_regplace"=>array("des"=>'Restrict District of Registration<font color=red>That means people from restricted provinces or cities<font color=red></font>cannot register to be members.</font><br /><font color=red>Pattern: </font>District Name<br /><font color=red>Example:</font><font color=green>Beijing</font>This means anyone browsing from<font color=red>outside</font>Beijing can not register as a member.<br /><i style=color:#666666>Note: to input different districts, use "," in between, like<font color=green>Bejing,Shanghai</font></i>',"type"=>'Hollerith',"class"=>'Member Settings'),

	

	"cfg_forbidden_reg_ip"=>array("des"=>'List of Restricted IP for Registration.  Anyone browsing from IP in the list can not register to be a member.<br /> You can input IP in full or type only the front like <font color=red>192.168.</font><br />to input multiple IPs, use "," in between 

like <font color=red>192.168.,203.171.</font> <br />denotes application to all Ip addresses among <font color=green>192.168.0.0��192.168.255.255</font> and<font color=green>203.171.0.0��203.171.255.255</font> If left blank, it means that no IP is restricted.<br />',"type"=>'Hollerith',"class"=>'Member Settings'),

	

	"cfg_member_reg_title"=>array("des"=>'Edit Welcome Message Title<br />

<i style=color:#666666>Note: if you do not want to send a welcome message, please leave it blank.</i>',"type"=>'Hollerith',"class"=>'Member Settings'),



	"cfg_member_reg_content"=>array("des"=>'Edit Welcome Message<br />

<i style=color:#666666>Note: if you do not want to send a welcome message, please leave it blank.</i>',"type"=>'Hollerith',"class"=>'Member Settings'),



	"cfg_if_affiliate"=>array("des"=>'Enable/disable member self registration promotion<br /><i style=color:#666666>hen someone registers within 24 hours through a link published by a certain member,<br />this member will be rewarded with credits.</i>',"type"=>'Boolean',"class"=>'Member Settings'),

	

	"cfg_affiliate_score"=>array("des"=>'Any member who promotes self-registration will be rewarded with credits<br /><i style=color:#666666>only when member self-registration promotion is enabled</i>',"type"=>'Hollerith',"class"=>'Member Settings'),

	

	"cfg_member_perpost_consume"=>array("des"=>'A post of categorized information will cost certain amount of gold coin.<br /><i style=color:#666666>Note: this only works for the members<br />So if you do not want coins to be deducted, please leave it blank.</i>',"type"=>'Hollerith',"class"=>'Member Settings'),

	

	"cfg_coin_fee"=>array("des"=>' How many coins can 1 RM buy. The default value is 1',"type"=>'Hollerith',"class"=>'Member Settings'),

	

	"cfg_score_fee"=>array("des"=>'How many credits does 1 coin cost',"type"=>'Hollerith',"class"=>'Member Settings'),

	

	"cfg_member_upgrade_top"=>array("des"=>'Categorized Info<font style=color:#ff3300>Place Broad Headings at the Top</font>Deduct Coin',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_member_upgrade_list_top"=>array("des"=>'Categorized Info<font style=color:#ff9900>Place Sub-headings at the Top</font>Deduct Coin',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_member_upgrade_index_top"=>array("des"=>'Categorized Info<font style=color:#ff9900>Place at the top of the homepage </font>Deduct Coin',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_member_info_red"=>array("des"=>'Categorized Info-redden the title cost coins',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_member_info_bold"=>array("des"=>'Categorized Info-overstriking the title cost coins',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_member_info_refresh"=>array("des"=>'Categorized Info-refresh the title cost coins<br /><i style=color:#666>No coin will be deducted when the value is 0</i>',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_upimg_type"=>array("des"=>'Allowed Picture Format',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_size"=>array("des"=>'Size Limit of Uploaded Picture (in KB)',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark"=>array("des"=>'Enable/Disable Watermark on Uploaded Picture, <i style=color:#666666>Note: this requires that the server supports GD database</i>',"type"=>'Boolean',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_width"=>array("des"=>'Watermark Width',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_height"=>array("des"=>'Watermark Height',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_img"=>array("des"=>'Watermark File Name',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_text"=>array("des"=>'Watermark Text<br /><i style=color:#666666>Note: Watermark text only supports English and does not support Chinese. It is usually the domain name of the site</i>',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_color"=>array("des"=>'Watermark Text Colour<br /><i style=color:#666666>White as #FFFFFF Red as #FF0000 Black as #000000 Blue as #0000FF</i>',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_size"=>array("des"=>'Watermark Text Font Size',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),



	"cfg_upimg_watermark_diaphaneity"=>array("des"=>'Watermark Transparency (0-100, the more the value is, the less the mark is transparent)',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_upimg_watermark_position"=>array("des"=>'Watermark Position on Uploaded Pictures.',"type"=>'Hollerith',"class"=>'Picture Uploading Settings'),

	

	"cfg_postfile"=>array("des"=>'Information posting program file, set to default as post.php<br /><i style=color:#666666>The name must end with ".php". If changed, please make changes to the corresponding files in FTP.</i>',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_post_editor"=>array("des"=>'Use/do not use KindEditor as the text editing tool for posts.',"type"=>'Boolean',"class"=>'Categorized Information Settings'),

	

	"cfg_info_if_img"=>array("des"=>'Do/do not use pictures to display contact<br /><i style=color:#666666> (in default, yes)</i>',"type"=>'Boolean',"class"=>'Categorized Information Settings'),

	

	"cfg_info_if_gq"=>array("des"=>'Do/Do not show contact after the information has expired <br /><i style=color:#666666>(in default, no)</i>',"type"=>'Boolean',"class"=>'Categorized Information Settings'),

	

	"cfg_allow_post_area"=>array("des"=>'Specify Posting District<br /><font color=red>Specify Posting District <font color=red>(IPs in provinces and cities not specified</font>may either not be allowed or require authentication to post)</font><br /><font color=red>Pattern: </font>District Name=0 or 1<br /><font color=red>Example:</font><br /><font color=green>Beijing=-1</font>This means anyone browsing from <font color=red>outside Beijing</font>may not be allowed to post.<br /><font color=green>Beijing=0</font>This means anyone browsing from<font color=red>outside Beijing</font>may require authentication to post.<br /><i style=color:#666666>ote: To specify multiple districts, use "," in between like<font color=green>Beijing,Shanghai=-1</font></i>',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_disallow_post_tel"=>array("des"=>'Restrict Posting by Phone Number<br /><font color=red>(Accounts with restricted phone numbers may either not be allowed or require authentication to post)</font><br /><font color=red>Pattern��</font>13788888888=0 or -1<br /><font color=red>Example��</font><br /><font color=green>13788888888=-1</font>means account with the number 13788888888 is not allowed to post.<br /><font color=green>13888888888=0</font>means account with the number 13788888888 requires authentication to post.<br /><i style=color:#666666>Note: to input multiple phone numbers, please put "," in between like<font color=green>13788888888,13888888888=-1</font></i>',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_forbidden_post_ip"=>array("des"=>'List of Restricted IP for posting.  Anyone browsing from IP in the list can not make posts.<br /> You can input IP in full or type only the front like <font color=red>192.168.</font><br />To input multiple IPs, use "," in between, like <font color=red>192.168.,203.171.</font> <br />means application to all IP addresses among  <font color=green>192.168.0.0�192.168.255.255</font> and <font color=green>203.171.0.0�203.171.255.255</font> If left blank, it means that no IP is restricted.<br />',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),



	"cfg_if_post_othercity"=>array("des"=>'Do/do not allow users to post on other sub-sites.',"type"=>'Boolean',"class"=>'Categorized Information Settings'),



	"cfg_upimg_number"=>array("des"=>'Maximum amount of pictures in a post (default value is 4).',"type"=>'Number',"class"=>'Categorized Information Settings'),

	

	"cfg_if_nonmember_info"=>array("des"=>'Tourists can/cannot post categorized Information.

',"type"=>'Boolean',"class"=>'Categorized Information Settings'),

	

	"cfg_if_nonmember_info_box"=>array("des"=>'Enable/Disable notification of register when a tourist is trying to post.<br /><i style=color:#666666>Note: if you forbid tourists to post, then this section is closed.</i>',"type"=>'Boolean',"class"=>'Categorized Information Settings'),

	

	"cfg_nonmember_perday_post"=>array("des"=>'The Maximum number of posts a tourist can post per day<br /><i style=color:#666666>Note: this setting works only when non-members can post.<br />If no limit to such maximum number is applied, please leave this section blank.</i>',"type"=>'Hollerith',"class"=>'Categorized Information Settings'),

	

	"cfg_if_info_verify"=>array("des"=>'Audit all posted categorized Information?

<br /><font color=red>��All newly-posted categorized Information must go though auditing.��</font>',"type"=>'Boolean',"class"=>'Categorized Information Settings'),

	

	"mapapi"=>array("des"=>'Map API Address<br /><i style=color:#666>Fill JS addresses with APIs provided by different map sellers.</i><br />

<a href="http://code.google.com/intl/zh-CN/apis/maps/signup.html" target="_blank">For foreign users, please click here to apply to use Google map API &raquo;</a>',"type"=>'Hollerith',"class"=>'Map Port Settings'),

	

	"mapflag"=>array("des"=>'Map Mark<br /><i style=color:#666> According to different map marks, the system will load dofferent map JS, you may only fill <br /><font color=red>baidu/google/51ditu.</font></i>',"type"=>'Hollerith',"class"=>'Map Port Settings'),

	

	"mapapi_charset"=>array("des"=>'Map API Code<br /><i style=color:#666>No code setting is needed for default map. As for Google map, the code should be set to UTF-8</i>',"type"=>'Hollerith',"class"=>'Map Port Settings'),

	

	"mapview_level"=>array("des"=>'Setting default zoom level for the map through map port

<br /><i style=color:#666>Different maps have respective zoom levels, usually between 1-15.  To test, try inputting a number (and only a number) for foreground test to find the most satisfying value.</i>',"type"=>'Hollerith',"class"=>'Map Port Settings')



);

?>