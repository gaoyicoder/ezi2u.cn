<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>contact us - <?=$store[tname]?></title>
<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>

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
<body>

<? include mymps_tpl('header');?>
<div class="content">
	<? include mymps_tpl('sider');?>
	<div class="cright">
		<div class="location">Current Location: <?=$store[location]?></div>
		<div class="clear"></div>
		<div class="mainbox_body">
			<div class="contactustop">
					Contact: <?=$store[cname]?><br />
					<!--Facebook:<?=$store[qq]?><br />-->
					Landline Number: <?=$store[tel]?><br />
                    Mobile Phone: <?=$store[mobile]?><br />
					Contact Address: <?=$store[address]?><br />
                    Route By Bus: <?=$store[busway]?><br />
					URL: <?=$store[web]?>
				</div>
				
			<div class="hd">Find the route</div>
			  <br />
			<form action="http://maps.google.com/maps" method="get" target="_blank">
				<label for="saddr">From:</label>
				  <input type="text" id="from" name="saddr" required="required" placeholder="My current address" size="60" />
				  <a id="from-link" href="#">Get Current Position</a>
				  <br />
				  <br />
				  <label for="to">GoTo:</label>
				  <input type="text" id="to" name="daddr" required="required" value="<?=$store[address]?>" size="60" />
				  <br />
				  <br />
				  <input type="submit" value="Show Map" />
				  <br />
				  <br />
			</form>	
			
				<iframe margin="0" src="<?=$mymps_global[SiteUrl]?>/map.php?title=<?=$store[tname]?>&isshow=1&p=<?=$store[mappoint]?>&width=731&height=372" width="731" height="382" frameborder="0"></iframe> 
		</div>
	</div>
</div>
<div class="clear15"></div>
<? include mymps_tpl('footer');?>
</body>
</html>
