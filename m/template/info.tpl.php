<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<?php include mymps_tpl('header');?>
	<title><?=$row['title']?> - <?=$row['catname']?> - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/info.css">
	<link type="text/css" rel="stylesheet" href="template/css/list.css">
	<script src="template/js/list.js"></script>
	<script src="template/js/jq.min.js"></script>
	
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
					getLocation();
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
	  
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
    mapholder = document.getElementById('mapholder')
    mapholder.style.height = '150px';
    mapholder.style.width = '300px';

    var myOptions = {
    center:latlon,zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
    </script>
    <style type="text/css">
      #map {
        width: 500px;
        height: 400px;
        margin-top: 10px;
      }
	  
	div.relative {
    position: relative;
	top: 1px;
    left: 1px;
	right: 5px;
    width: 300px;
    height: 150px;
    border: 3px solid #8AC007;
   } 	  
    </style>
	
	 <style type="text/css"> 
.inputtextFrom { width: 200px; height: 20px; } 
.inputtextTo { width: 250px; height: 20px; } 
.inputtextSubmit { width: 120px; height: 30px; color: white; background-color: rgb(0, 0, 102);} 
.inputtextSearch { width: 60px; height: 30px; color: white; background-color: rgb(0, 0, 102);} 
</style> 

<!--xxxxxx-->
</head>

<body>
<div class="body_div">

	<?php include mymps_tpl('header_search');?>
 
	<div class="dl_nav">
		<span><a href="index.php">Homepage</a><font class="raquo"></font><a href="index.php?mod=category&cityid=<?=$city['cityid']?>">Local Posts</a>
        <? foreach($parentcats as $k=>$v){?>
        <font class="raquo"></font><a href="index.php?mod=category&catid=<?=$v['catid']?>&cityid=<?=$city['cityid']?>"><?=$v['catname']?></a>
        <?php }?>
        </span>
	</div>	
	<div class="detail">	
		<div class="tit_area">
			<h1 class="tit"><?=$row['title']?></h1>
			<div class="status_bar">		    
				<span class="date"><i class="ico"></i><?=GetTime($row['begintime'])?></span>
				<!--<span>Views: <?=$row['id']?></span>-->
				<span class="browse_num"><i class="ico"></i><span id="totalcount" ><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=information&id=<?=$row['id']?>"></script></span></span>
				<a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/box.php?part=wap_shoucang&infoid=<?=$row['id']?>" class="btn_Favorite"><i class="ico"></i>add</a>
			</div>
		</div>

		<?php if(is_array($row['image'])){?>
		<div class="image_area_w">
			<div class="image_area">
				<ul>
					<?php foreach($row['image'] as $k => $v){?>				
					<li><img src="<?=$mymps_global[SiteUrl]?><?=$v[prepath]?>" ref="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" width="220" height="155" /></li>
					<?php }?>
				</ul>
				<div class="panel_num"></div>
			</div>
		</div>
		<?php }?>
		<?php if(is_array($row['extra'])){?>
		<ul class="attr_info" style="margin-top:0;">
			<?php foreach($row['extra'] as $k => $v){?>
			<li>
				<span class="attrName2"  style="<?php if($v[title] == 'Rent'|| $v[title] ==  'Price'|| $v[title] ==  'Real Estate Prices'|| $v[title] ==  'Contact Phone Number') echo 'color:#ff7800;'?>"><?=$v[title]?>：</span>
				<span class="attrVal"  style="<?php if($v[title] == 'Rent'|| $v[title] ==  'Price'|| $v[title] ==  'Real Estate Prices'|| $v[title] ==  'Contact Phone Number') echo 'color:#ff7800;font-weight:bold;font-size:20px;'?>"><?php if($v[value] == '0元/月（中国元素）' || $v[value] == 'Discuss Face to Face 元/月（中国元素）'|| $v[value] == '0万元（中国元素）'|| $v[value] == '0万元/年（中国元素）') {?>Discuss Face to Face<?php }else{ ?><?=$v[value]?><?php }?></span>
			</li>
			<?php }?>
		</ul>
		<?php }?> 
	
		<ul class="attr_info bottom gray">
			<span class="attrVal mfico">
				<?php if(!empty($row['qq'])){?>
				<!--<li>
					<span class="attrName">联系 Q Q（中国元素）：</span>
					<span class="attrVal"> <?=$row[qq]?></span>
				</li>-->
				<?php }?> 
				<li>
					<span class="attrName">Phone: </span>
					<span class="attrVal"><a class="fred" href="tel:<?=$row[tel]?>"><?=$row[tel]?></a>&nbsp;&nbsp;<?=$row[contact_who]?></span>
				</li>
				<li>
					<span class="attrName">Address: </span>
					<span class="attrVal"><?=$row[web_address]?></span>
				</li>
				<li>
					<p class="mt10">
						<a href="tel:<?=$row[tel]?>" class="fangico dianhua"><i></i>Contact Through Phone (Click to Dial)</a>
					</p>
				</li>
				
	<div class="detail-tit">Navigation</div>
	<form action="http://maps.google.com/maps" method="get" target="_blank">
		  <font size="2" color="orange"><label for="saddr">From:</label></font>
		  <input type="text" id="from" name="saddr" required="required" placeholder="My current address" size="40" class="inputtextFrom"/>
		  <font size="2" color="blue" class="inputtextSearch"><a id="from-link" href="#">Search</a></font>
		  <br />
		  <br />
		  <font size="2" color="orange"><label for="to">GoTo:</label></font>
		  <input type="text" id="to" name="daddr" required="required" value="<?=$row[web_address]?>" size="40" class="inputtextTo"/>
		  <br />
		  <br />
		  <input type="submit" value="Start Navigation" class="inputtextSubmit"/>
		 <!-- <br />
		  <br />
		  <div class="relative" id="mapholder"></div>-->
	</form>	
			</span>
		</ul>
	
		<div class="detail-tit">Detailed Description</div>
		<div class="detail_txt_che">
			<?=$row['content']?>
			<br />Please remind me that you saw this post on <?php echo $mymps_global['SiteName']?> when contacting me.
		</div>
	
		<div class="detail-tit">Recommended Posts</div>
		<div class="follow">
			<ul>
				<?php foreach($relevant as $k => $v){ ?>
					<li><a href="index.php?mod=information&id=<?php echo $v['id']; ?>"><?=cutstr($v['title'],26)?></a><span><?=get_format_time($v['begintime'])?></span></li>
				<?php }?>
			</ul>

			<div class="more" style="margin-top:20px;">
				<a style="text-align: center;position: relative" href="index.php?mod=category&catid=<?=$row['catid']?>&cityid=<?=$city['cityid']?>">View More<?=$row['catname']?>&gt;&gt;</a>
			</div>
		</div>
	</div>
	
	<div id="viewBigImagebg"></div>
	<div id="viewBigImage">
		<div class="bigimg_topbar">
			<div class="btn_back"><span>Return</span></div>
			<div class="bigimg_num"><span class="curr_img">1</span>/<span class="total_img">9</span></div>
		</div>
		<div class="bigimg_box"><ul></ul></div>
	</div>

	<script src="template/js/slide.js"></script>
	<div style="display:none"><script src="template/js/history.js"></script></div>
	
<?php include mymps_tpl('footer2'); ?>
</div>
</body>
</html>
