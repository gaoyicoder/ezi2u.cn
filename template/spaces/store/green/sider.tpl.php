<div class="cleft">
	<div class="storelogo"><img src="<?=$mymps_global[SiteUrl]?><? if($store[logo]){?><?=$store[logo]?><? }else{?>/template/default/images/category/nophoto.gif<? }?>" border="0" /></div>
	<div class="clear"></div>
	<div class="square leftnews">
		<div class="hd"><span>News On Institution</span></div>
		<div class="bd">
			<ul>
				<? if(is_array($docu_list)){foreach($docu_list as $k =>$v){?>
				<li><a href="<?=$v[uri]?>"><?=$v[title]?></a></li>
				<? }}else{?>
				<li>No news on the institution for now!</li>
				<? }?>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<div class="square leftcontact">
		<div class="hd"><span>Contact Us</span></div>
		<div class="bd">
			<ul>
				<li><span>Contact: </span><?=$store[cname]?></li>
				<li>Contact Phone: <font color="#5A8EC8"><?=$store[tel]?></font></li>
				<!--<li>Facebook:<?=$store[qq]?></li>-->
				<li>Contact Address: <?=$store[address]?> <a href="<?=$uri[contactus]?>" target="_blank">[View On The Map]</a></li>
			</ul>
		</div>
	</div>
</div>