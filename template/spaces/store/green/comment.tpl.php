<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>留言点评 - <?=$store[tname]?></title>

<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />

<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>

</head>

<body>



<? include mymps_tpl('header');?>

<div class="content">

	<? include mymps_tpl('sider'); ?>

	<div class="cright">

		<div class="location">Current Location: <?=$store[location]?></div>

		<div class="clear"></div>

			

	<div class="dpRight">

	

			<div class="commentpage">

				<div class="pageSelect">

				<ul class="cfix">

					<li id="cur1" <? if(!$type){?>class="selected"<? }?>><em><a href="<?=$uri[comment]?>">All Reviews(<?=$store[all_comment]?>)</a></em></li>

					<li id="cur2" <? if($type == 'good'){?>class="selected"<? }?>><em><a href="<?=$uri[good_comment]?>">Good(<?=$store[good_comment]?>)</a></em></li>

					<li id="cur3" <? if($type == 'soso'){?>class="selected"<? }?>><em><a href="<?=$uri[soso_comment]?>">Plain(<?=$store[soso_comment]?>)</a></em></li>

					<li id="cur4" <? if($type == 'bad'){?>class="selected"<? }?>><em><a href="<?=$uri[bad_comment]?>">Bad(<?=$store[bad_comment]?>)</a></em></li>

				</ul>

			</div>

	

				<div class="selectBd cfix">

	

					<div class="left">

	

						<div class="tongji commentTj">

	

						<ul class="dpScore"> 

					<li><span class="tits">Good <small>(<?=$store[good_comment_per]?>%)</small></span><div class="kBg"><div class="hBg" style="width:<?=$store[good_comment_per]?>px;"></div></div></li> 

					<li><span class="tits">Plain <small>(<?=$store[soso_comment_per]?>%)</small></span><div class="kBg"><div class="hBg" style="width:<?=$store[soso_comment_per]?>px;"></div></div></li> 

					<li><span class="tits">Bad <small>(<?=$store[bad_comment_per]?>%)</small></span><div class="kBg"><div class="hBg" style="width:<?=$store[bad_comment_per]?>px;"></div></div></li> 

					</ul> 

	

						</div>

	

					</div>

	

					<div class="middle">Times Reviewed: <em><?=$store[all_comment]?></em>Times</div>

	

					<div class="right"><a href="#comment" class="pjMenu">Leave My Review</a></div>

	

				</div>

	

				<? foreach($comment as $k =>$v){?>

				<div class="comment cfix mt10">

				<div class="bd">

					<div class="dpContent cfix">

						<div class="pic"><a href="<?=$v[useruri]?>" target="_blank"><img src="<?=$v[face]?>" width="50" height="50"/></a></div>

						<div class="textt">

							<div class="starB">

							  <ul class="clearfix">

								<li><span class="zi">Quality</span><span class="startimg start<?=$v[service]?>"></span></li>

								<li><span class="zi">Service</span><span class="startimg start<?=$v[quality]?>"></span></li>

								<li><span class="zi">Environment</span><span class="startimg start<?=$v[environment]?>"></span></li>

								<li><span class="zi">Cost Performance</span><span class="startimg start<?=$v[price]?>"></span></li>

								<li><img src="<?=$mymps_global[SiteUrl]?>/images/<?=$v[enjoy]?>.gif"></li>

							  </ul>

							</div>

							<div class="ut"><?=$v[content]?> <span class="time">[Time Of Comment <?=$v[pubtime]?>]</span></div>

							<? if($v[reply]){?><div class="huip"><em>Response From Seller: </em><?=$v[reply]?><span class="time">[Time Of Respond <?=$v[retime]?>]</span></div><? }?>

						</div>

					</div>

				</div>

				</div>

				<? }?>

	

				<div class="pagination" style="margin-left:0!important;"><?=$pageview?></div>

	

				<? if($store[commentsettings]){?>

				<div class="box mt10" >

	

					<div class="tit">Leave My Review</div>

	

					<div class="mbk-send cfix" style="border-top:0;">

	

					<form method="post" action="<?=$mymps_global[SiteUrl]?>/store.php?" name="StoreCommentForm" onsubmit="return StoreCommentFormCheck();">

					<input type="hidden" name="part" value="comment" />

					<input type="hidden" name="user" value="{$store.userid}" />

					<input type="hidden" name="action" value="dopost" />

	

					<div class="selectstar">							

	

					<select name="quality">

	

						<option value="">-Quality-</option>

	

						<option value="0">Bad(0)</option>

	

						<option value="1">Plain(1)</option>

	

						<option value="2">Not Bad(2)</option>

	

						<option value="3">Good(3)</option>

	

						<option value="4">Very Good(4)</option>

	

						<option value="5">Excellent(5)</option>

	

					</select>

	

					

	

					<select name="service">

	

						<option value="">-Service-</option>

	

						<option value="0">Bad(0)</option>

	

						<option value="1">Plain(1)</option>

	

						<option value="2">Not Bad(2)</option>

	

						<option value="3">Good(3)</option>

	

						<option value="4">Very Good(4)</option>

	

						<option value="5">Excellent(5)</option>

	

					</select>

	

					

	

					<select name="environment">

	

						<option value="">-Environment-</option>

	

						<option value="0">Bad(0)</option>

	

						<option value="1">Plain(1)</option>

	

						<option value="2">Not Bad(2)</option>

	

						<option value="3">Good(3)</option>

	

						<option value="4">Very Good(4)</option>

	

						<option value="5">Excellent(5)</option>

	

					</select>

	

					

	

					<select name="price">

	

						<option value="">-Cost Performance-</option>

	

						<option value="0">Bad(0)</option>

	

						<option value="1">Plain(1)</option>

	

						<option value="2">Not Bad(2)</option>

	

						<option value="3">Good(3)</option>

	

						<option value="4">Very Good(4)</option>

	

						<option value="5">Excellent(5)</option>

	

					</select>

	

					</div>

					

					<div class="like">

	

					<input type="radio" name="enjoy" value="0" class="radio">Dislike <input type="radio" name="enjoy" value="1" class="radio">Plain <input type="radio" name="enjoy" checked="checked" value="2" class="radio">Like <input type="radio" name="enjoy" value="3" class="radio">Fancy

	

					</div>

	

			

	

					<input type="hidden" name="total_score" value="1" />

	

					<textarea id="txt" name="content"></textarea>

	

					<div class="cfix comment_login">

					<span class="left">

					<span class="left"><?=$store[loginlimit]?></span>

					</span>

					<span class="left"><input name="comment_submit" class="send" value="&nbsp;&nbsp;" type="submit" /> 

					You may type in another <span id="word">200</span> characters</span>

					</div>

	

					</form>

	

					</div>

	

					</div>

					<? }?>

			</div>

	

	</div>



</div>

</div>

<div class="clear15"></div>

<? include mymps_tpl('footer');?>

</body>

</html>

