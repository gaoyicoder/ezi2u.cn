<?php
//您可以根据自己的需要修改以下设置
$mymps_mymps = array();

$mymps_mymps['cfg_if_tpledit'] = "1";
//是否开启模板风格在线编辑功能，0为关闭，1为开启，如非十分必要，建议关闭该功能

$mymps_mymps['cfg_record_save'] = "500";
/*
设置后台管理员操作记录至少保存多少条最新记录
默认500条，当少于500条的时候不允许删除记录
便于您查看后台操作记录
*/

$mymps_mymps['cfg_iflogin_port'] = "1";
/*是否开启会员登录记录端口的功能，0为关闭，1为开启*/

$mymps_mymps['cfg_if_rewritepy'] = "0";
/*当架设好分站二级域名后可开启后台拼音伪静态的选项，0为关闭，1为开启*/

//以下设置请保持默认，一般情况下请不要修改
$mymps_mymps['cfg_focus_limit']['portal']['index']['width']='550';
$mymps_mymps['cfg_focus_limit']['portal']['index']['height']='195';

$mymps_mymps['cfg_focus_limit']['classic']['index']['width']='332';
$mymps_mymps['cfg_focus_limit']['classic']['index']['height']='195';

$mymps_mymps['cfg_focus_limit']['simple']['index']['width']='550';
$mymps_mymps['cfg_focus_limit']['simple']['index']['height']='195';


$mymps_mymps['cfg_focus_limit']['news']['width']='333';
$mymps_mymps['cfg_focus_limit']['news']['height']='226';
//首页焦点图尺寸

$mymps_mymps['cfg_memberlogo_limit']['width']='180';
$mymps_mymps['cfg_memberlogo_limit']['height']='150';
//会员头像尺寸

$mymps_mymps['cfg_memberalbum_limit']['width']='120';
$mymps_mymps['cfg_memberalbum_limit']['height']='150';
//会员相册尺寸

$mymps_mymps['cfg_information_limit']['width']='240';
$mymps_mymps['cfg_information_limit']['height']='180';
//信息图片尺寸

$mymps_mymps['cfg_normal_limit']['width']='400';
$mymps_mymps['cfg_normal_limit']['height']='300';
//通用缩略图尺寸

$mymps_mymps['cfg_coupon_limit']['width'] = '180';
$mymps_mymps['cfg_coupon_limit']['height'] = '180';
//优惠券缩略图尺寸

$mymps_mymps['cfg_group_limit']['width'] = '80';
$mymps_mymps['cfg_group_limit']['height'] = '80';
//团购缩略图尺寸

$mymps_mymps['cfg_goods_limit']['width'] = '120';
$mymps_mymps['cfg_goods_limit']['height'] = '100';
//商品缩略图尺寸

$mymps_mymps['cfg_banner_limit']['width'] = '950';
$mymps_mymps['cfg_banner_limit']['height'] = '150';
//商家banner缩略图尺寸
?>