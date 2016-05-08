<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>Delete Post - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/delete.css">

</head>



<body>

<div class="body_div">



	<?php include mymps_tpl('header_search');?>	

	

	<div class="dl_nav">

		<span>

			<a href="index.php">Homepage</a>&gt;<a href="index.php?mod=member">Member Centre</a>&gt;<a href="index.php?mod=delete">Delete Post</a>

		</span>

	</div>

	

    <div class="phone-use">	

        <h1>Please enter your phone number to search for relevant posts.</h1>

        <form action="index.php?" method="get">

            <div class="phone-hao">

			<input name="mod" type="hidden" value="delete"> 

			<input name="keywords" type="text" value="<?php echo $keywords; ?>" x-webkit-speech lang="zh-CN"  class="input-mobile" onKeyUp="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onBlur="this.v();">

			<input type="submit" class="button-mobile" value="Click To Search" >

            </div>

            <span id="pptmobileregmobile_tip" class="red f12" style="display: none;"></span>

        </form>		

		<div class="phone-query">

			<?php if(empty($info_list)) {?>	

				<div class="query-no-info"><i class="regret"></i>Sorry, on phone number <span class="red" id="telephone"><?php echo $keywords; ?></span>  no relevant posts are found.</div>					

			<?php }else{ ?>

				<?php if(empty($keywords)) {?>	

				<?php }else{ ?>				

					<div class='query-tit'>Below are the search results on "<span class='red' id='telephone'><?php echo $keywords; ?></span>". In total, there are <?php echo $rows_num; ?> results.</div>

					<ul>

					<?php foreach($info_list as $k => $v){ ?>

						<li><a href="index.php?mod=information&id=<?php echo $v['id']; ?>"><strong><?php echo HighLight($v['title'],$keywords); ?></strong><br><span><?php echo GetTime($v['begintime']); ?></span></a><a class="del-but" href="tel:<?=$mymps_global[SiteTel]?>" onClick="if(confirm(' You may contact our customer service staff to delete this post; do you wish to phone our staff now?'))return true;return false;" target="_blank">Delete</a></li>

					<?php }?>

					</ul>

					</div>

				<?php }?>

			<?php }?>

		</div>

     </div>

	 

	 

	<?php if(empty($keywords)) {?>	

	<?php }else{ ?>

		<?php if(!empty($info_list)){?>

			<div class="pager">

			<?php pager();?>

			</div>

		<?php }?>

	<?php }?>

	



</div>

<?php include mymps_tpl('footer2');?>

</body>

</html>