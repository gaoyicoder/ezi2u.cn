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

<dl class="business exp">

    <dt class="house" style="background:url(<?=$mymps_global[SiteUrl]?>/template/default/images/login/arrow.gif) 10px 10px no-repeat;background-size: 28px 27px;">Select District</dt>

    <dd>

    <?php foreach($street_list as $k => $v){?>

      <a href="index.php?mod=post&catid=<?=$catid?>&cityid=<?=$cityid?>&areaid=<?=$areaid?>&streetid=<?=$v['streetid']?>"><?=$v[streetname]?></a>

    <?php }?>

    </dd>

</dl>

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