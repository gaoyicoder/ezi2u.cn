<div class="footsearch <?=$mymps_global[head_style]?>">	<ul>	<form method="get" action="<?=$mymps_global[SiteUrl]?>/search.php?" name="footsearch" target="_blank">		<input name="cityid" value="<?=$city[cityid]?>" type="hidden">		<input name="mod" value="information" type="hidden">		<input name="keywords" type="text" class="footsearch_input" id="searchfooter" onmouseover="hiddennotice('searchfooter');" x-webkit-speech lang="zh-CN">		<input type="submit" value="Search" class="footsearch_submit">		<input type="button" onclick="window.open('<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$city[cityid]?>')" class="footsearch_post" value="Free Post">	</form>	</ul></div><div class="clear"></div><!--广告处理部分开始--><!-- 页尾通栏广告开始--><div id="ad_footerbanner"></div><!-- 页尾通栏广告结束--><!--广告处理部分开始--><? if($advertisement[type][floatad] || $advertisement[type][couplead] ){?><div align="left"  style="clear: both;">    <script src="<?=$mymps_global[SiteUrl]?>/mypub/floatadv.js" type="text/javascript"></script>	    <? if($advertisement[type][couplead]){?>    <script type="text/javascript">		<?=$adveritems[$advertisement[type][couplead][0]]?>theFloaters.play();    </script>    <? }?>    <? if($advertisement[type][floatad]){?>    <script type="text/javascript">        <?=$adveritems[$advertisement[type][floatad][0]]?>theFloaters.play();    </script>    <? }?></div><? }?><div style="display: none" id="ad_none"><!--头部通栏广告--><? if($advertisement[type][headerbanner]){?><div class="header" id="ad_header_none"><? $countheaderbanner = count($advertisement[type][headerbanner]);$i=1;foreach($advertisement[type][headerbanner] as $k => $v){?><div class="headerbanner" <? if($countheaderbanner == $i){?>style="margin-right:0;"<? }?>><?=$adveritems[$v]?></div><? $i=$i+1;}?></div><? }?><!--首页分类间广告--><? if(is_array($advertisement[type][indexcatad])){foreach($advertisement[type][indexcatad] as $k => $v){?><div class="indexcatad" id="ad_indexcatad_<?=$k?>_none"><?=$adveritems[$v[0]]?></div><? }}?><!--栏目信息列表间广告--><? if(is_array($advertisement[type][interlistad][top])){?><div id="ad_interlistad_top_none"><ul class="interlistdiv"><? foreach($advertisement[type][interlistad][top] as $k => $v){?><li class="hover"><?=$adveritems[$v]?></li><? }?></ul></div><? }?><? if(is_array($advertisement[type][interlistad][bottom])){?><div id="ad_interlistad_bottom_none"><ul class="interlistdiv"><? foreach($advertisement[type][interlistad][bottom] as $k => $v){?><li class="hover"><?=$adveritems[$v]?></li><? }?></ul></div><? }?><!--栏目侧边广告--><? if(is_array($advertisement[type][intercatad])){?><div class="intercatdiv" id="ad_intercatdiv_none"><? foreach($advertisement[type][intercatad] as $k => $v){?><div class="intercatad"><?=$adveritems[$v]?></div><? }?></div><? }?><? if(is_array($advertisement[type][topbanner])){?><div class="topbanner" id="ad_topbanner_none"><? foreach($advertisement[type][topbanner] as $k => $v){?><div class="topbannerad"><?=$adveritems[$v]?></div><? }?></div><? }?><? if(is_array($advertisement[type][footerbanner])){?><div class="footerbanner" id="ad_footerbanner_none"><? foreach($advertisement[type][footerbanner] as $k => $v){?><div class="footerbannerad"><?=$adveritems[$v]?></div><? }?></div><? }?></div><!--广告处理部分结束--><div class="footabout">	<? $counturlnav = count($navurl_foot);$i=1;foreach($navurl_foot as $k => $v){?>	<a <? if($counturlnav == $i){?>class="backnone"<? }?> href="<?=$v[url]?>" style="color:<?=$v[color]?>" target="<?=$v[target]?>"><?=$v[title]?><sup class="<?=$v[ico]?>"></sup></a>	<? $i=$i+1;}?></div><div class="debuginfo">copyright&copy;<i><strong><?="EZI2U"?></strong></i> <em><?="version 1.0"?></em></div><br><p id="back-to-top"><a href="#top"><span></span></a></p><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/addiv.js"></script><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/selectoption.js"></script><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/scrolltop.js"></script>