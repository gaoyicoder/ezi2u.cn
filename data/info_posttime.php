<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
$info_posttime = array();
/*信息检索的发布时间下拉框选项*/
//注意单位为天，一周则为7，一个月则为30，以此类推
$info_posttime[0] = 'select';
$info_posttime[3] = 'Within 3 days';
$info_posttime[7] = 'Within 1 week';
$info_posttime[30] = 'Within 1 month';
$info_posttime[90] = 'Within 3 months';
?>