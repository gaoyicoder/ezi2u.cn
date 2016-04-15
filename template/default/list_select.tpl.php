<div id="select">
	<dl class='fore' id='select-brand'>
	<dt>Category</dt>
	<dd>
	<div class='content'>
		<? foreach($cat_list as $k => $v){?>
		<div><a href="<?=$city[domain]?><?=$v[uri]?>" <? if($v[catid] == $cat[catid]){?>class="curr"<? }?> title="<?=$city[cityname]?><?=$v[catname]?>">Any</a></div>
		<? foreach($v[children] as $t => $w){?>
		<div><a href="<?=$city[domain]?><?=$w[uri]?>" <? if($w[catid] == $cat[catid]){?>class="curr"<? }?> title="<?=$city[cityname]?><?=$w[catname]?>"><?=$w[catname]?></a></div>
		<? }?>
		<? }?>
	</div>
	</dd>
	</dl>
	<? foreach($mymps_extra_model as $k => $v){?>
	<? if($v[type] != 'number'){?>
	<dl>
	<dt><?=$v[title]?></dt>
	<dd>
	<? foreach($v['list'] as $t => $w){?>	
	<div><a href="<?=$city[domain]?><?=$w[uri]?>" <? if ($w[select] == 1){?>class="curr"<? }?>><?=$w[name]?></a></div>
	<? }?>
	</dd>
	</dl>
	<? }?>
	<? }?>
	<? if(is_array($area_list)){?>
	<dl>
	<dt>District</dt>
	<dd>
		<? foreach($area_list as $k =>$v){?>
		<div><a href="<?=$city[domain]?><?=$v[uri]?>" <? if ($v[select] == 1){?>class="curr"<? }?>><?=$v[areaname]?></a></div>
		<? }?>
	</dd>
	</dl>
	<? }?>
	<? if(is_array($street_list)){?>
		<dl>
		<dt></dt>
		<dd>
			<? foreach($street_list as $k =>$v){?>
			<div><a href="<?=$city[domain]?><?=$v[uri]?>" <? if ($v[select] == 1){?>class="curr"<? }?>><?=$v[streetname]?></a></div>
			<? }?>
		</dd>
		</dl>
	<? }?>
	<? if(!$cityid){?>
		<dl>
		<dt>State list</dt>
		<dd>
		<div><a href="#" class="curr">Any</a></div>
			<?php foreach($hotcities as $k => $v){?>
			<div><a href="<?=$v[domain]?><?=$cat[caturi]?>"><?=$v[cityname]?></a></div>
			<? }?>	
		</dd>
		</dl>
	<? }?>
	<dl class="lastdl">
	<form method="get" action="<?=$mymps_global[SiteUrl]?>/search.php?" target="_blank">
		<input name="cityid" value="<?=$city[cityid]?>" type="hidden">
		<input name="mod" value="information" type="hidden">
		<input name="catid" value="<?=$cat.catid?>" type="hidden">
		<input name="areaid" value="<?=$areaid?>" type="hidden">
		<input name="streetid" value="<?=$streetid?>" type="hidden">
		<input name="keywords" type="text" value="" class="searchinput" id="searchbody" onmouseover="hiddennotice('searchbody');"/>
		<input type="submit" value="Search" class="<?=$mymps_global[head_style]?>_searchsubmit" />
	</form>
	</dl>
</div>
