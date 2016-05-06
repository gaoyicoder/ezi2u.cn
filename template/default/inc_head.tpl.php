<?

	if($s_uid==null)
		$data11='<ul><a href="'.$mymps_global['SiteUrl'].'/'.$mymps_global['cfg_member_logfile'].'?cityid='.$cityid.'" >Login</a></ul><ul class="line"><u></u></ul><ul><a href="'.$mymps_global[SiteUrl].'/'.$mymps_global['cfg_member_logfile'].'?mod=register&cityid='.$cityid.'" >Register</a></ul>';
	else
		$data11='Welcom,'.$s_uid.' &nbsp;<a href="'.$mymps_global['SiteUrl'].'/member/index.php">MemberCenter</a> <a href="'.$mymps_global[SiteUrl].'/'.$mymps_global['cfg_member_logfile'].'?mod=out&url='.$url.'" >Logout</a> ';
?>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script>
var Lat, Lon;
var PreLat, preLon;
var previousState;
var currentSubDomain;
var currentDomain;

var eachState = ["johor", "kedah", "kelantan", "lumpur", "melaka", "semblan", "pahang", "penang", "perak", "perlis", "selangor", "sabah", "sarawak", "terengganu"];
var eachChineseState = ["Èá·ð", "¼ª´ò", "¼ªÀ¼µ¤", "¼ªÂ¡ÆÂ", "ÂíÁù¼×", "É­ÃÀÀ¼", "Åíºà", "éÄ³Ç", "Åùö¨", "²£Á§ÊÐ", "Ñ©À¼Ý­", "É³°Í", "É°À­Ô½", "µÇ¼ÎÂ¥"];
var domainState = ["johor", "kedah", "kelantan", "kl", "mm", "ns", "pahan", "penan", "perak", "perli", "selan", "sabah", "saraw", "teren"];
var preDomain = "/city/";

//var x = document.getElementById("demo");

function getLocation(state) {

    console.log("state is " + state);
        
	var user = getCookie("username");
	
	console.log("user is" + user);
	
	if ((user != "") && (user != null))
	{
		//alert("user is not empty");
	}
	else
	{
	      // alert("user is empty();
	       
		previousState = state;
		
		previousState = previousState.toLowerCase();
		
		console.log(previousState);
		
	   	 if (navigator.geolocation) {
	      	  	navigator.geolocation.getCurrentPosition(showPosition, showError);
	   	 } else { 
	       // x.innerHTML = "Geolocation is not supported by this browser.";
	    	}
	}
	

}

function getLocationAlways(state) {
       
	var curSite = window.location.href;

   // alert(curSite);
	
	previousState = state;
	
	previousState = previousState.toLowerCase();
	
	console.log(previousState);
	
	 if (navigator.geolocation) {
	  	navigator.geolocation.getCurrentPosition(showPosition, showError);
	 } else { 
	// x.innerHTML = "Geolocation is not supported by this browser.";
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
    var latlng = new google.maps.LatLng(lat, lng);

    var geocoder;

    geocoder = new google.maps.Geocoder();

    geocoder.geocode({'latLng': latlng}, function(results, status) 
    {
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
		  
		  curState = region.long_name;//"JOHOR";//"Federal Territory Kuala Lumpur";
		  
		  currentDomain = "";
		  
		  for(i = 0; i < eachState.length; i++)
		  { 
			  curState = curState.toLowerCase();
			  
			  console.log(curState);
			  
			  pos = curState.search(eachState[i]);

                          if(pos < 0)
			       pos = curState.search(eachChineseState [i]);

			//  console.log(pos);
			  
			  if( pos >= 0)
		          {
				  currentSubDomain = domainState[i];
				  
				  currentDomain = preDomain + currentSubDomain;
				  
			//	  console.log(currentDomain);
				  
				  break;
			  }
		  }

			//city data

		
			//console.log(previousState);
			//console.log(curState);
			
			//pos = curState.search(previousState);
			
			//console.log(pos);
			
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
			
			//if(((pos < 0) || (previousState == "")) /*&& (currentDomain != "")*/)
			//{
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
			//}
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
    if ((user != "") && (user != "undefined")) {
     //   alert("Your current location is " + user);
    } else {
       // user = prompt("Please enter your name:", "");
       // if (user != "" && user != null) {
            user = Lat + "," + Lon;
            setCookie("username", user, 365);
      //  }
    }
}


function checkLoginBeforeClose() {
// window.open("http://www.ezi2u.com.my/member/index.php");

   //var curSite = window.location.href;
   //alert("clientX =" + window.event.clientX + "clientY =" + window.event.clientX);
   //alert(curSite);

   var curClientX = window.event.clientX;
   var curClientY = window.event.clientY;



    if((curSite == "http://www.ezi2u.com.my/") || (curSite == "http://ezi2u.com.my/"))
  // if(window.event.clientX < 0 && window.event.clientY <0)
 //if(window.event.clientX <= 0 || window.event.clientY <= 0)
 if((curClientX >= 0) && (curClientX >= 0))
 {
		window.open("http://www.ezi2u.com.my/member.php?mod=out&amp;url=");
 }
	
//	return "logout"
}


function CheckBrowser()
{
	alert("beofore to be closed");
	
     // Check Browser Close [X] , Alt+F4 , File -> Close  
     if(event.clientX <= 0 || event.clientY <= 0)
    {
		alert("to be closed")
      /*    window.open("Operation.aspx", 
                "Operation",'left=12000,top=1200,width=10,height=1');*/
    }
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
  
        //$member_log->out('noredirect');

        window.open("http://www.ezi2u.com.my/member.php?mod=out&amp;url=");
 
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

<!--<body onload="CheckBrowser('<?=$city[cityname]?>')">-->

<!--<body onbeforeunload="checkLoginBeforeClose()">-->

<!--<body onunload="checkLoginBeforeClose()">-->

<!--<body onbeforeunload="handleBrowserCloseButton(event)">-->

<div class="bartop floater">
	<div class="barcenter">
		<div class="barleft">
			<ul class="barcity"><span><? if($city[cityname]){ ?><?=$city[cityname]?><? }else{ ?>State<? } ?></span> [<a href="<?=$mymps_global[SiteUrl]?>/changecity.php">select</a>]</ul> 
			<ul class="line"><u></u></ul>
			<ul class="barcang"><a href="<?=$mymps_global[SiteUrl]?>/desktop.php" target="_blank" title="Right click and select Save Target As to save a shortcut of the link on desktop.">Save On Desktop</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="barpost"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$cityid?>" rel="nofollow">Fast</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="bardel"><a href="<?=$mymps_global[SiteUrl]?>/delinfo.php" rel="nofollow">Edit Post</a></ul>
			<ul class="line"><u></u></ul>
			<ul class="barwap"><a href="<?=$mymps_global[SiteUrl]?>/mobile.php" target="_blank">View On Mobile</a></ul>
			<ul class="line"><u></u></ul>
			<ul><button onclick="javascript:getLocationAlways('<?=$city[cityname]?>')">Auto Detect</button></ul>
			</div>
		<div class="barright"><?=$data11?></div>
	</div>
</div>
<div class="clear"></div>
<div class="logosearchtel">
	<!--ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½æ¿ªÊ¼-->
	<div id="ad_topbanner"></div>
	<!--ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½-->
			

    <!--<div class="weblogo"><a href="<?=$city[domain]?>" onclick="javascript:getLocation('<?=$city[cityname]?>')"><img src="<?=$mymps_global[SiteUrl]?><?=$mymps_global[SiteLogo]?>" title="<?=$mymps_global[SiteName]?>" border="0"/></a></div>-->
	
    <div class="weblogo"><a href="<?=$city[domain]?>"><img src="<?=$mymps_global[SiteUrl]?><?=$mymps_global[SiteLogo]?>" title="<?=$mymps_global[SiteName]?>" border="0"/></a></div>
        
	<div class="postedit">
	    &nbsp;
	    <!-- <a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?cityid=<?=$cityid?>" class="post" rel="nofollow">Free Post</a> -->
	</div>
	<div class="websearch">
		<div class="sch_t_frm">
			<form method="get" action="<?=$mymps_global[SiteUrl]?>/search.php?" id="searchForm" target="_blank">
			<input name="cityid" value="<?=$city[cityid]?>" type="hidden">
			<div class="sch_ct">
				<input type="text" class="topsearchinput" name="keywords" id="searchheader" onmouseover="hiddennotice('searchheader');" x-webkit-speech lang="zh-CN"/>
			</div>
			<div>
				<input type="submit" value="Search" class="btn-normal"/>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="daohang">
	<ul>
		<li><a href="<?=$city[domain]?>" id="index">Home</a></li>
		<? foreach($navigation as $k => $v){?>
		<li><a <? if ($v[flag] == $cat[catid] || $v[flag] == $cat[parentid]){?>class="current"<? }?> target="<?=$v[target]?>" id="<?=$v[flag]?>" href="<?=$v[url]?>"><font color="<?=$v[color]?>"><?=$v[title]?></font><sup class="<?=$v[ico]?>"></sup></a></li>
		<? }?>
	</ul>
</div>
<? if(is_array($navurl_head)){?>
<div class="subsearch">
<ul>
	<? $i = 1;foreach($navurl_head as $k => $v){?>
    <li class="n<?=$i?>"><a href="<?=$v[url]?>" style="color:<?=$v[color]?>" target="<?=$v[target]?>" title="<?=$v[title]?>"><?=$v[title]?><sup class="<?=$v[ico]?>"></sup></a></li>
    <? $i = $i + 1;}?>
</ul>
</div>
<? }?>
<div class="clearfix"></div>
<!--Í·ï¿½ï¿½Í¨ï¿½ï¿½ï¿½ï¿½æ¿ªÊ¼-->
<div id="ad_header"></div>
<!--Í·ï¿½ï¿½Í¨ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½-->
<div class="clearfix"></div>
