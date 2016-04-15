<!DOCTYPE html>
<html lang="en" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Make Post - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/post.css">
	
<!--XXXXXX-->
<meta charset="UTF-8" />
    <title>Find a route using Geolocation and Google Maps API</title>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: {lat: 3.140, lng: 101.689}
  });
  var geocoder = new google.maps.Geocoder();

  document.getElementById('submit').addEventListener('click', function() {
    geocodeAddress(geocoder, map);
  });
}

function geocodeAddress(geocoder, resultsMap) {
  var address = document.getElementById('address').value;
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
    } else {
      alert('Please enter valid addrss for its checking. Thanks.');
    }
  });
}

    </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaMnzM70m2N3hZ_lG6rJ_8oMhFy99lRR8&signed_in=true&callback=initMap"
        async defer>
	</script>
    <style type="text/css">
      #map {
        width: 290px;
        height: 150px;
        margin-top: 10px;
      }
	  
	div.relative {
    position: relative;
	top: 1px;
    left: 1px;
    width: 290px;
    height: 150px;
    border: 3px solid #8AC007;
   } 
#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}   
    </style>
	 <style type="text/css"> 
.inputtextFrom { width: 200px; height: 20px; } 
.inputtextTo { width: 250px; height: 20px; } 
.inputtextSubmit { left: 20px; width: 100px; height: 35px; color: white; background-color: rgb(0, 0, 102);} 
.thislabel{display:inline-block;width:300px;padding:0;font-weight:100; color: green; font-size:small; text-align: right;}
    </style> 

<!--xxxxxx-->
</head>
<body>

	<?php include mymps_tpl('header_search');?>
    <form id="form1" method="post" enctype="multipart/form-data" action="index.php?mod=post">
    <?php if(empty($child)){?><input name="catid" type="hidden" value="<?=$catid?>"><? }?>
    <input name="areaid" type="hidden" value="<?=$areaid?>">
    <input name="cityid" type="hidden" value="<?=$cityid?>">
    <input name="streetid" type="hidden" value="<?=$streetid?>">
    <input name="action" type="hidden" value="post">
    <input type="hidden" value="<?=$mixcode?>" name="mixcode"/>
        <ul class="list">		
        	
            <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Category: </span></div>
                <div class="inputs"><?=$catname?> &nbsp;&nbsp;&nbsp;<a href="index.php?mod=post&areaid=<?=$catid?>&streetid=<?=$streetid?>&cityid=<?=$cityid?>">(Reselect)</a></div>
            </li>
            
            <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Title: </span></div>
                <div class="input"><input name="title" type="text" size="26" value="" /></div>
            </li>
            
            <?php 
            if(is_array($show_mod_option)){
            foreach($show_mod_option as $k => $v){?>
            <li class="item">
                <div class="title"><span><?php if($v['required'] == 1){?><font style="color:#FF0000;">* </font><?php }?><?php echo $v['title']; ?></strong></span></div>
                <div class="inputs"><?php echo $v['value']; ?></div>
            </li>
            <?php }
            }?>
            
            <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Content: </span></div>
                <div class="input"><textarea name="content" style="width:100%; height:70px;"></textarea></div>
            </li>
            
            <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Contact: </span></div>
                <div class="input"><input name="contact_who" type="text" size="26" value="<?=$contact_who?>" /></div>
            </li>
            
		    <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Address: </span></div>
                <div class="input"><input id="address" name="web_address" type="text" size="26" value="<?=$web_address?>" /></div>
				<label class="thislabel">ex: Jalan 6/38A, 51200(street, postalcode)</label>
            </li>
	
	        <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>District: </span></div>
                <div class="input"><?php echo $areaname; ?> &nbsp;&nbsp;&nbsp;<a href="index.php?mod=post&catid=<?=$catid?>&cityid=<?=$cityid?>&areaid=0&streetid=0">(Reselect)</a></div>
            </li>
			
		 <!-- <input id="address" type="textbox" value="Sydney, NSW">-->
		  <br />
      <input id="submit" type="button" value="Check Address">
	  <div id="map" class="relative"></div>
		  <br />
		  
	
	
			
	       <!--XXXXXXXXXX     
	<form action="http://maps.google.com/maps" method="get" target="_blank">
	
		  <div class="post"><input type="submit" name="button" id="to-link" href="#" value="Check" /></div>
		  <div class="relative" id="mapholder"></div>
		  <br />
	</form>	
	XXXXXXXXXX-->   
            <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Phone: </span></div>
                <div class="input"><input name="tel" type="text" size="26" value="<?=$tel?>" /></div>
            </li>
            
 <!--           <li class="item">
                <div class="title"><span>QQ</span></div>
                <div class="input"><input name="qq" type="text" size="26" value="<?=$qq?>" /></div>
            </li>-->

            <?php if($upload_img){?>	
            <li class="item">
                <div class="title"><span>Image: </span></div>
                <div class=""><?=$upload_img?></div>
            </li>
            <?php }?>

            <?php if($mobile_settings['authcode'] == 1){?>
            <li class="item">
                <div class="title"><span><font style="color:#FF0000;">* </font>Add Photo: </span></div>
                <div class="input"><input name="checkcode" type="text" size="26" /><img src="<?php echo $mymps_global['SiteUrl']?>/<?php echo $mymps_global['cfg_authcodefile']?>?mod=m" alt="Cannot see clearly? Please click on Refresh." width="70" height="25" align="absmiddle" style="cursor:pointer;" onClick="this.src=this.src+'?'"/></div>
            </li>
            <?php }?>
        </ul>
        <div class="post"><input type="submit" name="button" id="button" value="Click To Post" /></div>
      </form>
	<?php include mymps_tpl('footer');?>
</body>
</html>
