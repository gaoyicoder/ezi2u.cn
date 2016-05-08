<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$page_title?></title>

<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />

<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>

<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>

<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>

<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>

</head>



<body class="<?=$mymps_global[cfg_tpl_dir]?>">

<? include mymps_tpl('inc_head_post');?>

<div class="body1000">

	<div class="clear15"></div>

	<div id="main" class="wrapper">

		<div class="step1">

		<span class="cur"><font class="number">1</font> Select Post Category</span>

		<span><font class="number">2</font> Enter Content Of Post</span>

		<span><font class="number">3</font> Post Successful</span>

		</div>

		<div id="fenlei2">

            <div class="minheight" id="ymenu-side"> 

               <ul class="ym-mainmnu">

                    <? foreach($categories as $k =>$v){?>

                    <li class="ym-tab">

                        <a href="#" class="black"><?=$v[catname]?></a>

                        <ul class="ym-submnu">

                            <? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>

                            <li><a href="?action=input&catid=<?=$w[catid]?>&cityid=<?=$city[cityid]?>"><?=$w[catname]?></a></li>

                            <? }}?>

                        </ul> 

                    </li> 

                    <? }?>

                </ul>

                <? if($catid){?>

                <div class="clear"></div>

                <div class="backall"><a href="?action=input&cityid=<?=$city[cityid]?>">&laquo;Reselect  Broad Headings</a></div>

                <? }?>

            </div>

            <form action="?" method="get">

            <input name="cityid" value="<?=$cityid?>" type="hidden">

        	<div class="psearch">

                <div class="pshead"><em>Search Box</em><input type="text" id="catname" name="catname" placeholder="Please enter keywords to search for category to post in" class="pstxt" value=""><input type="button" value="Recommend Me A Category" onclick="this.form.submit()" class="psbtn" id="btn_cateSearch">

                </div>

       		</div>

            </form>

		</div> 

        

	</div>

	<div class="clear"></div>

	<? include mymps_tpl('inc_foot_about');?>

</div>

<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/post_select.js"></script> 

</body>

</html>

