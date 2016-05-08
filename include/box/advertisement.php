<?php

!defined('IN_MYMPS') && exit('FORBIDDEN');

echo '<style>body:font-size:12px</style><textarea style="width:520px; height:50px;">'.mhtmlspecialchars('<script language="javascript" src="'.$mymps_global["SiteUrl"].'/javascript.php?part=advertisement&id='.$id.'"></script>').'</textarea><br /><br /><font style="font-size:12px">Simply copy the code in the edit box and paste it at the corresponding location in the template.</font>';

exit;

?>