<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<meta name="keywords" content="<?=$mymps_global[SiteName]?>,Mobile Version, Switch States"/>
	<meta name="description" content="<?=$mymps_global[SiteName]?>Switching States on Mobile Version"/>
	<title>State list-<?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/changecity.css">
</head>

<body>
<?php include mymps_tpl('header_search');?>

<div class="city_box">
    <h3>State list<span class="local-city"><?php echo $city['cityname']!='State' ? 'Current State:'.$city['cityname'] : 'Please select'?></span></h3>
    <ul class="city_lst hot"><li><a href="index.php">Any</a></li>
	    <?php foreach($hotcities as $k => $v){?>
    <div  align="left"><li><a href="index.php?mod=index&cityid=<?php echo $v['cityid']?>"><?php echo $v['cityname']?></a></li></div>
    <? }?>
    </ul>
<!--
    <h3><?php echo $mymps_global['cfg_cityshowtype'] == 'province' ? 'From Region' : ''; ?>Search Initials</h3>
    <ul class="letters_lst">		
     <?php foreach($cities as $k => $v){?>
    <li><a href="#<?php echo $k; ?>"><?php echo $k?></a></li>
    <?php }?>
    </ul>
    
    <?php foreach($cities as $k =>$v){?>
    <a name="<?=$k?>"></a>
    <h4><p><span><?=$k?></span><?php if($mymps_global['cfg_cityshowtype'] != 'province'){?>(States Names Beginning with <?=$k?>)<?php }?></p></h4>
    <ul class="city_lst">
    <? foreach($v as $u =>$w){?>
   <li> <a href="index.php?mod=index&cityid=<?=$w[cityid]?>" <? if($w[ifhot] == 1){?>style="color:red;text-decoration:underline;"<? }?>><?=$w[cityname]?></a></li>
    <? }?>
    </ul>
    <?php }?>     
-->
<?php include mymps_tpl('footer');?>
</div>

</body>
</html>
