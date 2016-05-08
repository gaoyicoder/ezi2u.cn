<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script>
var Lat, Lon;
var PreLat, preLon;
var previousState;
var currentSubDomain;
var currentDomain;

var eachState = ["johor", "kedah", "kelantan", "lumpur", "melaka", "semblan", "pahang", "penang", "perak", "perlis", "selangor", "terengganu", "sabah", "sarawak"];
var eachChineseState = ["柔佛", "吉打", "吉兰丹", "吉隆坡", "马六甲", "森美兰", "彭亨", "槟城", "霹雳", "玻璃市", "雪兰莪", "登嘉楼", "沙巴", "砂拉越"];
//var domainState = ["johor", "kedah", "kelantan", "kl", "mm", "ns", "pahan", "penan", "perak", "perli", "selan", "sabah", "saraw", "teren"];
var preDomain = "?mod=index&cityid=";

//var x = document.getElementById("demo");

function getLocation(state) {
 
   //     console.log("state is " + state);
        
	var user = getCookie("username");
	
//	console.log("user is" + user);
	
	if ((user != "") && (user != null))
	{
		//alert("user is not empty");
	}
	else
	{
  		previousState = state;
		
		previousState = previousState.toLowerCase();
		
	//	console.log(previousState);

        //        alert(previousState);
		
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition, showError);
	    } else { 
	 //       x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}

}

function getLocationAlways(state) {
 
 
	previousState = state;
	
	previousState = previousState.toLowerCase();
	
//	console.log(previousState);
	
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
 //       x.innerHTML = "Geolocation is not supported by this browser.";
          alert('2');
    }

}



function showPosition(position) {

	var x = document.getElementById("demo");

    Lat = position.coords.latitude;
    Lon = position.coords.longitude;
 
//	checkCookie()
	
	codeLatLng(Lat, Lon)
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

function codeLatLng(lat, lng) 
{
  //  alert(lat + " " + lng);
    var latlng = new google.maps.LatLng(lat, lng);

    var geocoder;

    geocoder = new google.maps.Geocoder();

    geocoder.geocode({'latLng': latlng}, function(results, status) 
    {
    //  alert("OK");

      if (status == google.maps.GeocoderStatus.OK) 
      {
        //console.log(results);
        if (results[1]) {
        var indice=0;
        for (var j=0; j<results.length; j++)
        {
            if (results[j].types[0]=='locality')
            {
                    indice=j;
                    break;
            }
        }

        console.log(results[j]);
        for (var i=0; i<results[j].address_components.length; i++)
        {
                if (results[j].address_components[i].types[0] == "locality") 
                {
                        //this is the object you are looking for
                        city = results[j].address_components[i];
                }

                if (results[j].address_components[i].types[0] == "administrative_area_level_1") 
                {
                        //this is the object you are looking for
                        region = results[j].address_components[i];
                }

                if (results[j].address_components[i].types[0] == "country") 
                {
                        //this is the object you are looking for
                        country = results[j].address_components[i];
                }
         }
		 
		 //To find which region it belongs to
		  var curState;
		  
		  var i, pos;
		  
		  curState = region.long_name;//"JOHOR";//"Federal Territory Kuala Lumpur";//
		  
		  currentDomain = "";
		  for(i = 0; i < eachState.length; i++)
		  { 
			  curState = curState.toLowerCase();
			  
			 // console.log(curState);
			 
			// alert(curState);
			  
			  pos = curState.search(eachState[i]);

                          if(pos < 0)
			        pos = curState.search(eachChineseState[i]);

			//  console.log(pos);
			  
			  if( pos >= 0)
		      {
				  
				 // currentSubDomain = domainState[i];
				  var nId = i + 1;
				  
				  currentDomain = preDomain + nId;//currentSubDomain;
				  
			//	  alert(currentDomain);
				  
			//	  console.log(currentDomain);
				  
				  break;
			  }
		  }

			//pos = curState.search(previousState);
			
			//console.log(pos);
			
		       //city data
			var messageToShow;
			
			previousState = previousState.toUpperCase();
			
			if(currentDomain == "")
			{
				messageToShow = "The system finds that you are located at " + city.long_name + " in state " + region.long_name +
			   ", but we can not automatically take you to the domain since it is out of our scope.\n"				
			}
			else if(previousState == "")
			{
				messageToShow = "The system finds that you are located at " + city.long_name + " in state " + region.long_name + 
			 "\n\nWould you like to switch to " + region.long_name + "?\n"
			}
			else
			{
				messageToShow = "The system finds that you are now located at " + city.long_name + " in state " + region.long_name + 
					 "\n\nWould you like to switch from " + previousState + " to " + region.long_name + "?\n"		
			}
					
			//console.log(previousState);
			//console.log(curState);
			
			
		//	if(((pos < 0) || (previousState == ""))/*&& (currentDomain != "")*/)
		//	{
				if(currentDomain == "")
				{
				   alert(messageToShow);
				}
				else if (confirm(messageToShow) == true) 
				{ 
					if(currentDomain != "")
					       window.location.href = currentDomain;
				
				} 
				
				checkCookie();
		//	}
       } 
       else 
       {
           alert("No results found");
       }
      }
      else 
      {
        alert("Geocoder failed due to: " + status);
      }
    }); 
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
   // if ((user != "") && (user != "undefined")) {
    //    alert("Your current location is " + user);
   // } else {
       // user = prompt("Please enter your name:", "");
       // if (user != "" && user != null) {
            //user = Lat.toFixed(2) + " " + Lon.toFixed(2);
			user = Lat + "," + Lon;

        //    alert("Your current Lat and Lon is " + user);

            setCookie("username", user, 365);
      //  }
 //   }
}

</script>

<script>

/**
 * This javascript file checks for the brower/browser tab action.
 * It is based on the file menstioned by Daniel Melo.
 * Reference: http://stackoverflow.com/questions/1921941/close-kill-the-session-when-the-browser-or-tab-is-closed
 */
var validNavigation = false;
 
function wireUpEvents() {
  /**
   * For a list of events that triggers onbeforeunload on IE
   * check http://msdn.microsoft.com/en-us/library/ms536907(VS.85).aspx
   *
   * onbeforeunload for IE and chrome
   * check http://stackoverflow.com/questions/1802930/setting-onbeforeunload-on-body-element-in-chrome-and-ie-using-jquery
   */


  var dont_confirm_leave = 0; //set dont_confirm_leave to 1 when you want the user to be able to leave without confirmation
  var leave_message = 'For your security, please logout before leaving this page. Thanks.'
  function goodbye(e) {
    if (!validNavigation) {
      if (dont_confirm_leave!==1) {
        if(!e) e = window.event;
        //e.cancelBubble is supported by IE - this will kill the bubbling process.
        e.cancelBubble = true;
        e.returnValue = leave_message;
        //e.stopPropagation works in Firefox.
        if (e.stopPropagation) {
          e.stopPropagation();
          e.preventDefault();
        }
        //return works for Chrome and Safari
  
        window.open("https://www.ezi2u.com.my/m/index.php?mod=login&action=logout&returnurl=");

        return leave_message;
      }
    }
  }

  window.onbeforeunload=goodbye;
 
  // Attach the event keypress to exclude the F5 refresh
  $(document).bind('keypress', function(e) {
    if (e.keyCode == 116){
      validNavigation = true;
    }
  });
 
  // Attach the event click for all links in the page
  $("a").bind("click", function() {
    validNavigation = true;
  });
 
  // Attach the event submit for all forms in the page
  $("form").bind("submit", function() {
    validNavigation = true;
  });
 
  // Attach the event click for all inputs in the page
  $("input[type=submit]").bind("click", function() {
    validNavigation = true;
  });
 
}
 
// Wire up the events as soon as the DOM tree is ready
$(document).ready(function() {
  wireUpEvents();
});

</script>

<body onload="getLocation('<?=$city[cityname]?>')">

<button onclick="getLocationAlways('<?=$city[cityname]?>')">Auto Detect</button>

<div class="header">
	<!--<a class="logo_a" href="index.php?cityid=<?=$city['cityid']?>" onclick="javascript:getLocation('<?=$city[cityname]?>')"><img src="template/images/waplogo02.jpg" alt="<?=$mymps_global[SiteName]?>" width="100%"></a>-->

        <a class="logo_a" href="index.php?cityid=<?=$city['cityid']?>"><img src="template/images/waplogo02.jpg" alt="<?=$mymps_global[SiteName]?>" width="100%"></a>

	<a class="city_a"><?=$city[cityname]?></a>		
	<a class="city_a" href="index.php?mod=changecity&cityid=<?=$city['cityid']?>">[select]</a>
	<a class="publish" href="index.php?mod=post&cityid=<?=$city['cityid']?>&areaid=<?=$areaid?>&streetid=<?=$streetid?>" rel="nofollow"><i class="ico"></i>Post</a>
<?
if($member_log->chk_in()){
?>
<span class="login_txt"><a href="index.php?mod=member&userid='.$s_uid.'" class="u_name fl"><?=$s_uid?></a></span>
<?
}else {
?>
	<span class="login_txt"><a href="index.php?mod=member&cityid=<?=$city['cityid']?>" rel="nofollow">Login</a></span>
<?
}
?>
</div>

<div class="search">
	<form action="index.php?" method="get">
		<div class="search_input">
        <input name="cityid" type="hidden" value="<?=$city[cityid]?>">
		<input name="mod" type="hidden" value="search">
		<input class="input_keys" name="keywords" type="text" value="<?php echo $keywords; ?>" x-webkit-speech lang="zh-CN" placeholder="Enter Keywords Here">
		</div>
		<input class="search_but body_bg" id="qixc" type="submit" value="Search for Posts">
	</form>
	
</div>