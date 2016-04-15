<?php
!defined('IN_MYMPS') && exit('FORBIDDEN');
echo "<div style=\"font-size:12px; font-weight:100; margin:10px;\">You have not yet logged in as a member. However, we do not require that you have to log in to make posts.<br /><br />But, if you register to be a member, it will be easier for you to manage your posts. Try<a href=\"".$mymps_global['SiteUrl']."/".$mymps_global['cfg_member_logfile']."?url=".$url."\" target=_top>register now. &raquo;</a></div>";
?>