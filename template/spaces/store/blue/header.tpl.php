<div class="head1">
	<ul>
		<div class="head1_left">
			<span class="storename"><?=$store[tname]?></span>
			<div class="clear"></div>
			<span class="storecertify"><img src="<?=$mymps_global[SiteUrl]?>/images/credit/<?=$store[credits]?>.gif" title="Credit: <?=$store[credit]?>"> <? if($store[per_certify] == 1){?><img src="<?=$mymps_global[SiteUrl]?>/images/person1.gif" title="ID Verification Passed"/><? }?> <? if($store[com_certify] == 1){?><img src="<?=$mymps_global[SiteUrl]?>/images/company1.gif" title="Business Licence Verification Passed"/><? }?></span>
		</div>
		<div class="head1_right">
			 <a href="javascript:AddFavorite(window.location,document.title)">Favourites</a> | <a href="<?=$mymps_global[SiteUrl]?>">Return to <?=$mymps_global[SiteName]?> Home</a>
		</div>
	</ul>
</div>
<div class="clear15"></div>
<div class="navigation">
	<ul>
		<li><a href="<?=$uri[index]?>" <? if($part == 'index'){?>class="current"<? }?>>Homepage</a></li>
		<li><a href="<?=$uri[about]?>" <? if($part == 'about'){?>class="current"<? }?>>Introduction</a></li>
		<li><a href="<?=$uri[information]?>" <? if($part == 'information'){?>class="current"<? }?>>Posts</a></li>
		<? foreach($docunav as $k =>$v){?><li><a <? if($v[typeid] == $typeid || $v[typeid] == $docu[typeid]){?>class="current"<? }?> href="<?=$v[uri]?>" ><?=$v[typename]?></a></li> <? }?>
		<li><a href="<?=$uri[goods]?>"<? if($part == 'goods'){?>class="current"<? }?>>Vouchers</a></li>
		<!--<li><a href="<?=$uri[comment]?>"<? if($part == 'comment'){?>class="current"<? }?>>Comments</a></li>-->
		<li><a href="<?=$uri[album]?>"<? if($part == 'album'){?>class="current"<? }?>>Album</a></li>
		<li><a href="<?=$uri[contactus]?>"<? if($part == 'contactus'){?>class="current"<? }?>>Contact Us</a></li>
	</ul>
</div>
<div class="clear"></div>
<div class="banner"><img src="<? if(!$store[banner]){?><?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/images/banner.gif<? }else{?><?=$mymps_global[SiteUrl]?><?=$store[banner]?><? }?>"></div>
<div class="clear"></div>