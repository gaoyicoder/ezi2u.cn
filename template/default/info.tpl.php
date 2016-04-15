<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css">
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/information.css">
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/information_comment.css">
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
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
	<div class="information_hd ">
		<ul>
			<div class="information_title"><?=$info[title]?></div>
			<div class="information_time">
				<span class="viewhits">Views: <font id="hit" color="red"><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=information&id=<?=$info[id]?>"></script></font></span>
				<span class="lasttime">This Post<?=$info[endtime]?></span>
				<span class="begintime">Time Of Post: <?=GetTime($info[begintime])?></span>
			</div>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="information_bd">
		<div class="bd_left">
			<div class="extra_contact <? if($info[info_level] == 2){ ?>tuijian<? }?>">
				<div class="extra">
					<ul>
						<li><span>District: </span><?=$info[areaname]?> <?=$info[streetname]?></li>
						<? if(is_array($info[extra]))
						{foreach($info[extra] as $k => $v)
							{
								if($v[value] != "")
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
				<div class="contact">
					<ul>
						<? if($info[contactview] == 1){?>
							<? if($info[userid]){?>
							<li><span>From User: </span><?=$info[userid]?> <? if($member[if_corp] == 1){?><img src="<?=$mymps_global[SiteUrl]?>/template/default/images/user2.gif" align="absmiddle" title="Seller"/><? }?></li>
							<? }?>
							<li><span>Contact: </span><?=$info[contact_who]?> <? if($info[ip2area] == 'wap'){?><font class="font" color="green">Post Via Mobile Phone</font><? }else{?><font class="font"><?=$info[ip]?></font> <? }?></li>
							<li><span>Address: </span><?=$info[web_address]?></li>
							<? if($info[usecoin] > 0){?>
								<a href="javascript:void(0);" onclick="setbg('View Contact Details In Post',570,320,'<?=$mymps_global[SiteUrl]?>/box.php?part=seecontact&infoid=<?=$info[id]?>&if_view=<?=$info[contactview]?>')" class="viewcontacts">&nbsp;&nbsp;</a>
								<div class="clear5"></div>
							<? }else{?>
								<li><span>Phone: </span><font class="tel"><?=$info[telephone]?></font> <font class="font"><a rel="nofollow" href="<?=$info[posthistory]?>" target="_blank">View Posting Records</a></font></li>
								<? if($info[qq]){?><li><!--<span>Facebook:</span>--><?=$info[qq]?></li><? }?>
								<? if($info[email]){?><li><span>Email: </span><?=$info[email]?></li><? }?>
							<? }?>
							<li><div class="tips">Please remind me that you saw it on <?=$mymps_global[SiteName]?>  when contacting me, thank you!</div></li>
						
						<? }else{?>
							<div class="guoqi">This post is expired, so the contact details are automatically hidden.</div>
						<? }?>
					</ul>
				</div>
			</div>
			<div class="clear15"></div>
			<div class="view_hd">
				<div><a href="" class="currentr"><span></span>Post Details</a></div>
			</div>
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
				<?=$info[content]?>
				</p>
				</div>
				<div class="clearfix"></div>
				<?if($info[image]){?>
				<p>
					<? foreach($info[image] as $k => $v){?> <img src="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" class="imginfo" title="<?=$info[title]?>" alt="<?=$info[title]?>"><br>
					<? }?>
				</p>
				<div class="clear">
				</div>
				
 <!--<h1>Calculate your route</h1>
    <br />
    <form id="calculate-route" name="calculate-route" action="#" method="get">
      <label for="from">From:</label>
      <input type="text" id="from" name="from" required="required" placeholder="My current address" size="60" />
      <a id="from-link" href="#">Get Current position</a>
      <br />
      <br />
      <label for="to">GoTo:</label>
      <input type="text" id="to" name="to" required="required" value="<?=$info[web_address]?>" size="60" />
     <a id="to-link" href="#">Get Current position</a>
      <br />
	  <br />
      <input type="submit" />
      <input type="reset" />
    </form>
    <div id="map"></div>
    <p id="error"></p>	-->


				
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
				
	<div class="hd">Find the route</div>
	  <br />
	  
	    
		 
	<form action="http://maps.google.com/maps" method="get" target="_blank">
		<label for="saddr">From:</label>
		  <input type="text" id="from" name="saddr" required="required" placeholder="My current address" size="60" />
		  <a id="from-link" href="#">Get Current position</a>
		  <br />
		  <br />

		  <label for="to">GoTo:</label>
		  <input type="text" id="to" name="daddr" required="required" value="<?=$info[web_address]?>" size="60" />
		  <input type="submit" value="Show Map" />
		  <br />
		  <br />
	     <!-- <div class="relative" id="mapholder"></div>-->
		
		  <br />
		  <br />
	</form>	
	
	

	
	
	
	
		<!--<p id="demo">Current position map</p>

  <button onclick="getLocation()">Current Map</button>  style='float:right'-->


   
   
				<div class="hd">Comments On Posts</div>
				<div class="bd">
					<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/comment.js"></script>
					<div id="ajaxcomment">
						<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/comment.php?part=information&id=<?=$info[id]?>"></script>

					</div>
					
				</div>
			</div>
		</div>
		<div class="bd_right">
			<div class="boxer_hd cfix">Manage Posts<font color="#999999">（Number: <?=$info[id]?>）</font></div>
			<div class="boxer_bd cfix action">
				<ul>
					<li><a href="javascript:setbg('Top A Post',538,248,'<?=$mymps_global[SiteUrl]?>/box.php?part=upgrade&id=<?=$info[id]?>');" style="color:red">Top</a></li>
					<li><a rel="nofollow" href="javascript:setbg('Top A Post',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=shoucang&infoid=<?=$info[id]?>')">Favourite</a></li>
					<li><a rel="nofollow" href="javascript:setbg('Delete Post',538,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=delinfo&id=<?=$info[id]?>')" title="Be warned: You cannot restore a deleted item!">Delete</a></li>
					<li><a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?action=edit&id=<?=$info[id]?>" target="_blank">Edit</a></li>
					<li><a class="report" href="javascript:setbg('Report Post',470,270,'<?=$mymps_global[SiteUrl]?>/box.php?part=report&id=<?=$info[id]?>&infotitle=<?=$info[title]?>');">Report</a></li>
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
			<div class="boxer_bd cfix noborder short">
				<ul>
					<? foreach($relate_cat as $k => $v){?>
					<? foreach($v[children] as $u => $w){?>
					<li><a target="_blank" href="<?=$city[domain]?><?=$w[uri]?>" title="<?=$city[cityname]?> <?=$w[catname]?>"> <?=$w[catname]?></a></li>
					<? }?>
					<? }?>
				</ul>
			</div>
			<div class="boxer_hd cfix">Popular State <?=$info[catname]?> Information</div>
			<div class="boxer_bd cfix noborder">
				<ul>
					<? if($hotcities){foreach($hotcities as $k => $v){?>
					<li><a href="<?=$v[domain]?><?=$info[caturi]?>" target="_blank" title="<?=$v[cityname]?> <?=$info[catname]?>Post"> <?=$v[cityname]?> <?=$info[catname]?> Post</a></li>
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
</body>
</html>