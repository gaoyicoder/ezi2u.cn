<!DOCTYPE html PUBliC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$search[page_title]?></title>

<meta name="keywords" content="<?=$search[keywords]?>" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/search/css/search.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/search/css/search_style.css" />

<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/global/page.css" />

<script language="JavaScript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js"></script>

<script language="JavaScript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/search.js"></script>

</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">

<div class="main_current">

<div class="s_home cc">

<div class="new_topbar_wrap">

  <div class="new_topbar">

    <div class="cc">

      <ul class="new_topbar_right" style=" float:left;">

        <li class="noborder"><a href="<?=$mymps_global[SiteUrl]?>">Homepage</a></li>

        <li><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$city[cityid]?>" rel="nofollow">Fast Posting</a></li>

        <li><a href="<?=$mymps_global[SiteUrl]?>/delinfo.php" rel="nofollow">Edit/Delete Post</a></li>

      </ul>

      <span class="fr" style="padding-top:7px;"> </span> <span class="new_topbar_left fr"><a href="<?=$mymps_global[SiteUrl]?>/member/index.php">Member Centre</a></span> </div>

  </div>

</div>

<div class="cc"></div>

