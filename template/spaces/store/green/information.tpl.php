<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>分类信息 - <?=$store[tname]?></title>

<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />

<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>

</head>

<body>

<? include mymps_tpl('header');?>

<div class="content">

	<? include mymps_tpl('sider');?>

	<div class="cright">

		<div class="location">Current Location: <?=$store[location]?></div>

		<div class="clear"></div>

		<div class="information_list"> 

		<table class="mrw_list"> 

		   <tr> 

		   <th width="40%">Post Title</th> 

		   <th width="10%">Time Of Post</th> 

		   <th width="10%" align="center">View</th> 

		   </tr>

		   

		   <? if(is_array($info_list)){foreach($info_list as $k =>$v){?>

		   <tr> 

		   <td><a href="<?=$v[uri]?>" target="_blank"><?=$v[title]?></a></td> 

		   <td align="left"><?=GetTime($v[begintime],'m-d')?></td> 

		   <td align="center"><?=$v[hit]?>Times</td> 

		   </tr> 

		   <? }}else{?>

		   <tr> 

		   <td colspan="3">Currently there are no relevant records!</td> 

		   </tr> 

		   <? }?>

		   </table> 

		</div>	



</div>

</div>

<div class="clear15"></div>

<? include mymps_tpl('footer');?>

</body>

</html>

