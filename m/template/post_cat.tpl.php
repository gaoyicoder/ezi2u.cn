<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>Make Post - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/post.css">

	<script src="template/js/jq.min.js"></script>

</head>

<body>

<?php include mymps_tpl('header_search');?>

<?php if(is_array($categories)){?>

	<?php foreach($categories as $k => $v){?>

	<dl class="business">

		<dt class="house" style="background:url(<?=$mymps_global[SiteUrl]?>/<?=$v[icon]?>) 10px 7px no-repeat;"><?=$v[catname]?></dt>

		<dd>

			<?php foreach($v[children] as $x => $c){?>

			<a href="index.php?mod=post&catid=<?=$c['catid']?>&cityid=<?=$cityid?>&areaid=<?=$areaid?>&streetid=<?=$streetid?>"><?=$c[catname]?></a>

			<?php }?>

		</dd>

	</dl>

	<?php }?>

<?php }?>

<script type="text/javascript">

(function () {

	$('.business dt').bind('click', function () {

		var $this = $(this).parent();

		if ($this.hasClass('exp')) {

			$this.removeClass('exp');

		} else {

			var scrollTop = document.body.scrollTop;

			$this.addClass('exp');

			window.scrollTo(0, scrollTop);

		}

	});

}());

</script>

<?php include mymps_tpl('footer');?>

</body>

</html>