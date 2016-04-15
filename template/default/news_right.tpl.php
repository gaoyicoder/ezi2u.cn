<div class="col2">
	<div class="searchnews">
		<form action="<?=$mymps_global[SiteUrl]?>/search.php" method="get" target="_blank">
		<input name="mod" value="news" type="hidden">
		<input name="keywords" value="" type="text" class="input">
		<input type="submit" class="submit" value="Search">
		</form>
	</div>
	<div class="clear"></div>
	<div class="information">
		<ul>
			<? foreach($latest_info as $k =>$v){?>
			<li><a href="<?=$v[uri]?>" title="<?=$v[title]?>" target="_blank" style="<? if($v[ifred] == 1){?>color:red;<? }?> <? if($v[ifbold] == 1){?>font-weight:bold;<? }?>"><?=$v[title]?></a></li>
			<? }?>
		</ul>
	</div>


	<div class="clear"></div>
	<div class="hotread">
		<div class="hd">Rank Of Most Popular Articles</div>
		<div class="list">
			<ul>
				<? foreach($latest_news as $k =>$v){?>
				<li><a href="<?=$v[uri]?>" title="<?=$v[title]?>" <? if($v[iscommend] == 1){?>style="color:red"<? }?>><?=$v[title]?></a></li>
				<? }?>
			</ul>
		</div>
	</div>
</div>