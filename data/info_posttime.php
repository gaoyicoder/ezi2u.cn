<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
$info_posttime = array();
/*��Ϣ�����ķ���ʱ��������ѡ��*/
//ע�ⵥλΪ�죬һ����Ϊ7��һ������Ϊ30���Դ�����
$info_posttime[0] = 'select';
$info_posttime[3] = 'Within 3 days';
$info_posttime[7] = 'Within 1 week';
$info_posttime[30] = 'Within 1 month';
$info_posttime[90] = 'Within 3 months';
?>