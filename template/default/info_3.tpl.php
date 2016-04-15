<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css">
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/information3.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/information_comment.css">
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/slider.js" type="text/javascript"></script>
<script language="javascript">var current_domain="<?=$mymps_global[SiteUrl]?>";</script>
<script src="<?=$mymps_global[SiteUrl]?>/template/global/messagebox.js" type="text/javascript"></script>
<meta name="keywords" content="<? if(is_array($info[extra])){?><? foreach($info[extra] as $k => $v){?><? if($v[value]){?><?=$v[title]?><?=$v[value]?>,<? }?><? }}?><?=$info[title]?>"/>
<meta name="description" content="<?=cutstr(clear_html($info[content]),200)?>"/>
<!--XXXXXX-->
<meta charset="UTF-8" />
    <title>Find a route using Geolocation and Google Maps API</title>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
      function calculateRoute(from, to) {
        // Center initialized to Naples, Italy
        var myOptions = {
          zoom: 10,
          center: new google.maps.LatLng(40.84, 14.25),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: from,
          destination: to,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: mapObject,
                directions: response
              });
            }
            else
              $("#error").append("Unable to retrieve your route<br />");
          }
        );
      }

      $(document).ready(function() {
        // If the browser supports the Geolocation API
        if (typeof navigator.geolocation == "undefined") {
          $("#error").text("Your browser doesn't support the Geolocation API");
          return;
        }

        $("#from-link, #to-link").click(function(event) {
          event.preventDefault();
          var addressId = this.id.substring(0, this.id.indexOf("-"));

          navigator.geolocation.getCurrentPosition(function(position) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK)
                $("#" + addressId).val(results[0].formatted_address);
              else
                $("#error").append("Unable to retrieve your address<br />");
            });
          },
          function(positionError){
            $("#error").append("Error: " + positionError.message + "<br />");
          },
          {
            enableHighAccuracy: true,
            timeout: 10 * 1000 // 10 seconds
          });
        });

        $("#calculate-route").submit(function(event) {
          event.preventDefault();
          calculateRoute($("#from").val(), $("#to").val());
        });
      });
    </script>
    <style type="text/css">
      #map {
        width: 500px;
        height: 400px;
        margin-top: 10px;
      }
	  
    </style>

<!--xxxxxx-->
</head>
<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_info]?>">
<? include mymps_tpl('inc_head');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="location">
		<?=$location?>
	</div>
	<div class="clear"></div>
	<div class="wrapper">
	<div class="information_bd">
		<div class="bd_left">
            <div class="information_hd ">
                <ul>
                    <div class="information_title"><?=$info[title]?></div>
                    <div class="clearfix"></div>
                    <div class="information_time">
                       <span class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间（中国元素，建议斟酌）"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博（中国元素，建议斟酌）"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博（中国元素，建议斟酌）"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网（中国元素，建议斟酌）"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信（中国元素，建议斟酌）"></a></span>
                       <span class="lasttime"><?=GetTime($info[begintime],'Y-m-d')?>发布， <font id="hit"><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=information&id=<?=$info[id]?>"></script></font>次浏览</span>
                       <span class="action">
                        <a rel="nofollow" href="javascript:setbg('Save Post To Favourites',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=shoucang&infoid=<?=$info[id]?>')">Favourite Post</a>
                        <a href="javascript:setbg('Top A Post',538,248,'<?=$mymps_global[SiteUrl]?>/box.php?part=upgrade&id=<?=$info[id]?>');">Top</a>
                        <a rel="nofollow" href="javascript:setbg('Delete Post',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=delinfo&id=<?=$info[id]?>')" title="Be warned: You cannot restore a deleted item!">Delete</a></li>
                        <a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?action=edit&id=<?=$info[id]?>" target="_blank">Edit</a>
                        <a class="report" href="javascript:setbg('Report Post',470,300,'<?=$mymps_global[SiteUrl]?>/box.php?part=report&id=<?=$info[id]?>&infotitle=<?=$info[title]?>');">Report</a>
                       </span>
                    </div>
                </ul>
            </div>
            <div class="clear"></div>
			<div class="extra_contact <? if($info[info_level] == 2){ ?>tuijian<? }?>">
            <? if(is_array($info[image])){?>
            	<div class="extra">
                    <div class="zoombox">
                      <div class="zoompic"><img src="<?=$mymps_global[SiteUrl]?><?=$info[img_path]?>" width="270" height="200" title="<?=$info[title]?>" alt="<?=$info[title]?>" /></div>
                      <div class="sliderbox">
                        <div id="btn-left" class="arrow-btn dasabled"></div>
                        <div class="sliderr" id="thumbnail">
                          <ul>
                          	<? if(is_array($info[image])){$i=1;foreach($info[image] as $k => $v){?>
                            <li <? if($i == 1){?>class="currentt"<? }?>><a href="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$v[prepath]?>" width="43" height="37" alt="<?=$info[title]?>" title="<?=$info[title]?>" /></a></li>
                            <? $i=$i+1; }}?>
                          </ul>
                        </div>
                        <div id="btn-right" class="arrow-btn"></div>
                      </div>
                    </div>
                </div>
                <? }?>
				<div class="contact">
					<ul>
 						<li><span>District: </span><?=$info[areaname]?> <?=$info[streetname]?></li>
						<? if(is_array($info[extra]))
						{foreach($info[extra] as $k => $v)
							{
								if($v[title] != "")
								{
									?><li><span><?=$v[title]?>:</span><?
									
									if(in_array($v[title],array('0 RM','0 RM/Month','0 RM','0 RM/m2')))
									{
										?>Discuss Face To Face<? 
									}
									else
									{
										?><?=$v[value]?><? 
									}
									?></li><?
								}
							}
						}?>
					</ul>
				</div>
			</div>
			<div class="clear15"></div>
			<div class="view_hd">
				<div class="currentl"><a href="#">Post Details</a></div>
                <div class="currentr"></div>
			</div>
            <div class="clearfix"></div>
			<div class="view_bd">
				<div class="maincon cfix">
				<? if($advertisement[type][infoad]){?>
				<div class="infoaddiv">
				<? if(is_array($advertisement[type][infoad])){foreach($advertisement[type][infoad] as $k => $v){?>
				<div class="infoad"><?=$adveritems[$v]?></div>
				<? }}?>
				</div>
				<div class="clear"></div>
				<? }?>
				<p>
				<?=$info[content]?><br>Please remind me that you saw it on<?=$mymps_global[SiteName]?> when contacting me, thank you!
				</p>
				</div>
				<div class="clearfix"></div>
                <? if($info[image]){?>
                <div class="bd">
				<p>
					<? foreach($info[image] as $k => $v){?> <img src="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" class="imginfo" title="<?=$info[title]?>" alt="<?=$info[title]?>"><br>
					<? }?>
				</p>
                </div>
				<div class="clear"></div>
				<? }?>
				<? if($info[mappoint]){?>
				<div class="hd">Geographic Location</div>
				<div class="bd"> 
				   <ul>
					<iframe src="<?=$mymps_global[SiteUrl]?>/map.php?title=<?=$info[title]?>&isshow=1&p=<?=$info[mappoint]?>&width=690&height=405" height="405" width="690" frameborder="0" scrolling="no"></iframe>
				   </ul>
				</div>
				<div class="clear"></div>
				<? }?>
				
			<!---XXXXXXXXXXXXXXXXXXXXXXX-->
						<div class="hd">Find the route</div>
	  <br />
	<form action="http://maps.google.com/maps" method="get" target="_blank">
		<label for="saddr">From:</label>
		  <input type="text" id="from" name="saddr" required="required" placeholder="My current address" size="60" />
		  <a id="from-link" href="#">Get Current Position</a>
		  <br />
		  <br />
		  <label for="to">GoTo:</label>
		  <input type="text" id="to" name="daddr" required="required" value="<?=$info[web_address]?>" size="60" />
		  <br />
		  <br />
		  <input type="submit" value="Show Map" />
		  <br />
		  <br />
	</form>	
		<!---XXXXXXXXXXXXXXXXXXXXXXX-->
		
                <div class="chd">Comments On Posts</div>
				<div class="cbd">
					<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/comment.js"></script>
					<div id="ajaxcomment">
						<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/comment.php?part=information&id=<?=$info[id]?>"></script>
					</div>
				</div>
			</div>
		</div>
		<div class="bd_right">
        	<div class="boxer_hd cfix userhd"><div class="clear5"></div><? if(!$member[prelogo]){?><img src="<?=$mymps_global[SiteUrl]?>/images/noavatar.gif" title="<?=$member[tname]?>" alt="<?=$member[tname]?>" width="120" height="120"><div class="clear"></div><? }else{?><img src="<?=$mymps_global[SiteUrl]?><?=$member[prelogo]?>" title="<?=$member[tname]?>" alt="<?=$member[tname]?>" width="180" height="150"><div class="clear5"></div><? }?></div>
            
            <div class="cfix user">
            	<ul>
				<? if($info[contactview] == 1){?>
                    <? if($info[userid]){?>
                    <li><span>Poster</span><?=$info[userid]?></li>
                    <? }?>
                    <li><span>Contact: </span><?=$info[contact_who]?> </li>
					<li><span>Address: </span><?=$info[web_address]?></li>
					<li><span>Post From IP: </span><? if($info[ip2area] == 'wap'){?><font class="font" color="green">Post Via Mobile Phone</font><? }else{?><font class="font"><?=$info[ip]?></font></li>
                    <li><span>Post From: </span><font class="font" color="green"><?=$info[ip2area]?></font><? }?></li>
                    <? if($info[usecoin] > 0){?>
                        <a href="javascript:void(0);" onclick="setbg('View Contact Details In Post',570,320,'<?=$mymps_global[SiteUrl]?>/box.php?part=seecontact&infoid=<?=$info[id]?>&if_view=<?=$info[contactview]?>')" class="viewcontacts">&nbsp;&nbsp;</a>
                        <div class="clear5"></div>
                    <? }else{?>
                        <li><span>Phone: </span><a target="_blank" href="<?=$info[posthistory]?>" title="Click To View Posting Records"><font class="tel"><?=$info[telephone]?></font></a></li>
                        <? if($info[qq]){?><li><!--<span>Facebook:</span>--><?=$info[qq]?></li><? }?>
                        <? if($info[email]){?><li><span>Email Address: </span><?=$info[email]?></li><? }?>
                    <? }?>
                <? }else{?>
                    <div class="guoqi">This post is expired, so the contact details are automatically hidden.</div>
                <? }?>
                </ul>
            </div>
			<div class="boxer_hd cfix">Your Interested Posts</div>
			<div class="boxer_bd cfix">
				<ul>
					<? foreach($latest_info as $k => $v){?>
					<li><a style="<? if($v[ifred] == 1){?>color:red;<? }?> <? if($v[ifbold] == 1 ){?>font-weight:bold;<? }?>" href="<?=$v[uri]?>" target="_blank" title="<?=$v[title]?>"><? if($v[img_path]){?><font color=green>[Image]</font> <? }?><?=$v[title]?></a></li>
					<? }?>
				</ul>
			</div>
			<div class="boxer_hd cfix">Your Interested Category</div>
			<div class="boxer_bd cfix short">
				<ul>
					<? foreach($relate_cat as $k => $v){?>
					<? foreach($v[children] as $u => $w){?>
					<li><a target="_blank" href="<?=$city[domain]?><?=$w[uri]?>" title="<?=$city[cityname]?> <?=$w[catname]?>"> <?=$w[catname]?></a></li>
					<? }?>
					<? }?>
				</ul>
			</div>
			<div class="boxer_hd cfix">Popular States<?=$info[catname]?>Post</div>
			<div class="boxer_bd cfix noborder short">
				<ul>
					<? if($hotcities){foreach($hotcities as $k => $v){?>
					<li><a href="<?=$v[domain]?><?=$info[caturi]?>" target="_blank" title="<?=$v[cityname]?> <?=$info[catname]?> Post"> <?=$v[cityname]?> <?=$info[catname]?> Post</a></li>
					<? }}else{?>
					<li>Currently there are no posts from popular states!</li>
					<? }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot');?>
</div>
</div>
<script type="text/javascript">window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"Share To: ","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</body>
</html>