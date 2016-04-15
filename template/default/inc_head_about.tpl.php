<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<div class="header">
	<div class="inner">
		<div class="logo"><a href="<?=$mymps_global[SiteUrl]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$mymps_global[SiteLogo]?>" title="<?=$mymps_global[SiteName]?>"></a></div>
		<div class="nav">
			<a href="<?=$about[aboutus_uri]?>" <? if ($part == 'aboutus'){?>class="current"<? }?>>About Us</a>
			<a href="<?=$about[announce_uri]?>" <? if ($part == 'announce'){?>class="current"<? }?>>Site Announcements</a>
			<a href="<?=$about[faq_uri]?>" <? if ($part == 'faq'){?>class="current"<? }?>>Help Centre</a>
			<a href="<?=$about[friendlink_uri]?>" <? if ($part == 'friendlink'){?>class="current"<? }?>>Related Sites</a>
			<a href="<?=$about[sitemap_uri]?>" <? if ($part == 'sitemap'){?>class="current"<? }?>>Site Map</a>
		</div>
	</div>
</div>