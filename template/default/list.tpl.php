<?php
if($cat['modid'] > 1 && $idin) {
	$des = get_info_option_array();
	$extra = $db ->getAll("SELECT a.* FROM `{$db_mymps}information_{$cat[modid]}` AS a WHERE 1 {$idin}"); 
	foreach($extra as $k => $v){
		unset($v['iid']);
		unset($v['content']);
		foreach($v as $u => $w){
			$g = get_info_option_titval($des[$u],$w);
			if($u != 'id' && !is_numeric($u)) $info_list[$v[id]]['extra'][$u] = $g['value'];
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<title><?=$page_title?></title>
<meta name="keywords" content="<?=$cat[keywords]?>" />
<meta name="description" content="<?=$cat[description]?>" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/category.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/hover_bg.js" type="text/javascript"></script>

   <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    

<script>

var lat1, lat2;
var lon1, lon2;
var origDistance = [];
var sortDistance = [];
var origDistanceTemp = [];
var sortDistanceTemp = [];
var origVIndex = [];
var sortVIndex = [];
var origPostTime = [];
var sortPostTime = [];
var origBusinessHour = [];
var sortBusinessHour = [];
var origImageCount = [];
var sortImageCount = [];
var origUrl = [];
var sortUrl = [];
var origImagePath = [];
var sortImagePath = [];
var origMainTitle = [];
var sortMainTitle = [];
var origAreaName = [];
var sortAreaName = [];

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
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
           // user = Lat.toFixed(2) + " " + Lon.toFixed(2);
            setCookie("username", user, 365);
        }
    }
}

function loadImage(v, address2, postTime, imageCount, url, imagePath, mainTitle, areaName, businessHour) {
	
	var user = getCookie("username");

	var pos = user.indexOf(",");
	
	lat1 = user.slice(0,pos);
	lon1 = user.slice(pos + 1, user.length);
	
	console.log(lat1 + " " + lon1);
	
//	lat1 = Number(user.substr(0,5));//2.683518;//
//	lon1 = Number(user.substr(6,6));//112.020385;//
	
       var geocoder = new google.maps.Geocoder();

       geocoder.geocode
       (
          {'address': address2 }, 
             
          function (results, status) 
          {
                if (status == google.maps.GeocoderStatus.OK) 
                {
                   lat2 = results[0].geometry.location.lat();
                   lon2 = results[0].geometry.location.lng();

                 //  console.log(address2);
                 //  console.log(lat2 + " " + lon2);
               
                   var x = document.getElementById(v);

				   var R = 6371; // Radius of the earth in km
				   var dLat = deg2rad(lat2-lat1);  // deg2rad below
				   var dLon = deg2rad(lon2-lon1); 
				   var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) *  Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2); 
				   var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
				   var d = R * c; // Distance in km	

                   x.innerHTML = d.toFixed(2) + " km";

                   console.log(d);
                   
                   origDistance.push(d.toFixed(2));
                   sortDistance.push(d.toFixed(2));
         	       origDistanceTemp.push(d.toFixed(2));
                   sortDistanceTemp.push(d.toFixed(2));
                   origVIndex.push(v);
                   sortVIndex.push(v);
                   origPostTime.push(postTime);
                   sortPostTime.push(postTime);
                   origBusinessHour.push(businessHour);
                   sortBusinessHour.push(businessHour);
                   origImageCount.push(imageCount);
                   sortImageCount.push(imageCount);
                   origUrl.push(url);
                   sortUrl.push(url);
                   origImagePath.push(imagePath);
                   sortImagePath.push(imagePath);
                   origMainTitle.push(mainTitle);
                   sortMainTitle.push(mainTitle);
                   origAreaName.push(areaName);
                   sortAreaName.push(areaName);
      
                } 
                else 
                {
				//	console.log(address2);
					console.log("Not available");
					var x = document.getElementById(v);
					x.innerHTML = "Not available";
					origDistance.push(20000);
					sortDistance.push(20000);
					origDistanceTemp.push(20000);
					sortDistanceTemp.push(20000);
					origVIndex.push(v);
					sortVIndex.push(v);
				    origPostTime.push(postTime);
					sortPostTime.push(postTime);
					origBusinessHour.push(businessHour);
					sortBusinessHour.push(businessHour);
					origImageCount.push(imageCount);
					sortImageCount.push(imageCount);
					origUrl.push(url);
					sortUrl.push(url);
					origImagePath.push(imagePath);
					sortImagePath.push(imagePath);
					origMainTitle.push(mainTitle);
					sortMainTitle.push(mainTitle);	
					origAreaName.push(areaName);
					sortAreaName.push(areaName);	
                                    
                }
           }
        );
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}


function sortLocation() {
   // document.getElementById("demo").innerHTML = "Hello World";
     sortDistance.sort(function(a, b){return a-b});
     sortDistanceTemp.sort(function(a, b){return a-b});
  
	 console.log("orig index " + origVIndex);
	 console.log("orig dis " + origDistance);

   //  document.getElementById("origD").innerHTML = origDistance;
   //  document.getElementById("origVIndex").innerHTML = origVIndex;
   //  document.getElementById("sortD").innerHTML = sortDistance;
 
     //Find sort index by comparing sort distance with orig distance
     var i;
     var j;
     
    for(i = 0; i < sortDistance.length; i++)
    {
      	sortDistanceTemp[i] = sortDistance[i];
      	origDistanceTemp[i] = origDistance[i];
    }
     
     for(i = 0; i < sortDistanceTemp.length; i++)
     {
    	  for(j = 0; j < origDistanceTemp.length; j++)
    	  {
    	      if(sortDistanceTemp[i] == origDistanceTemp[j])
    	      {
    	          sortVIndex[i] = origVIndex[j];
    	          sortPostTime[i] = origPostTime[j];
                  sortBusinessHour[i] = origBusinessHour[j];
                  sortImageCount[i] = origImageCount[j];
                  sortUrl[i]        = origUrl[j];
                  sortImagePath[i]  = origImagePath[j];
                  sortMainTitle[i]  = origMainTitle[j];
                  sortAreaName[i]   = origAreaName[j];
     
    	         // if(sortDistanceTemp[i] == 20000)
    	         // {
    	              delete sortDistanceTemp[i];
    	              delete origDistanceTemp[j];
    	         // }
    	             
    	          break;
    	      }
    	  }
     }
     
     //To remove any duplcate sortVIndex
    /* var m, n;

     for(m = 0; m < sortVIndex.length; m++)
     {
          for(n = m + 1; n < sortVIndex.length; n++)
          {
             if(sortVIndex[m] == sortVIndex[n])
             {
                //delete sortVIndex[n];
                sortVIndex.splice(n-1, 1);
                //delete sortDistance[n];
                sortDistance.splice(n-1, 1);
                break;
             }
          }
     }*/

     var k;

     var htmlS = '';
 
     for(k = 0; k < sortVIndex.length; k++)
     {
          /*  var id;
            
            if(sortVIndex.length >= 11)
            {
                 id = origVIndex[k + sortVIndex.length - 11];

                 if(k >= 11)
                 {
                     id = origVIndex[sortVIndex.length - k - 1];
                 }
            }
            else
                id = origVIndex[k];*/

         var sid = sortVIndex[k];
         var sObj = $( '#ydsrs_' + sid );
         htmlS += '<div class="hover media cfix" id="ydsrs_' + sid + '">' + sObj.html() + '</div>';

            //id = sortVIndex[k];
            
          /*  if(sortDistance[k] == 20000)
            	document.getElementById(id).innerHTML = "Not Available";
            else
				document.getElementById(id).innerHTML = sortDistance[k] + " km";
          	
            document.getElementById(id + "_time").innerHTML = sortPostTime[k];

            document.getElementById(id + "_content").innerHTML = sortBusinessHour[k];

            document.getElementById(id + "_imagecount").innerHTML = sortImageCount[k] + "Image";

            document.getElementById(id + "_uri").href = sortUrl[k];

            document.getElementById(id + "_imagepath").src = sortImagePath[k];

            document.getElementById(id + "_urinext").href = sortUrl[k];

            document.getElementById(id + "_urinext").innerHTML = sortMainTitle[k];

            document.getElementById(id + "_areaname").innerHTML = sortAreaName[k];*/
     }
     

	 console.log("sort index " + sortVIndex);
	  console.log("sort dis " + sortDistance);
   // document.getElementById("sortVIndex").innerHTML = sortVIndex;

    $( '.sep' ).html( htmlS );

  /* var m;

   for(m = 0; m < sortVIndex.length; m++)
   {
     origDistance.slice(m,1);
     sortDistance.slice(m,1);
     origDistanceTemp.slice(m,1);
     sortDistanceTemp.slice(m,1);
     origVIndex.slice(m,1);
     sortVIndex.slice(m,1);
   } */ 

   origDistance.length = 0;
     sortDistance.length = 0;
     origDistance.length = 0;
     sortDistanceTemp.length = 0;
     origVIndex.length = 0;
     sortVIndex.length = 0;     
}

</script>

</head>
<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_cat]?>">
<? include mymps_tpl('inc_head');?>




<p id="origD"></p>
<p id="origVIndex"></p>
<p id="sortD"></p>
<p id="sortVIndex"></p>

<!--<body onload="getLocation()">
<body onload="sleep(2000)">
<p id="demo">try</p>

<button onclick="checkCookie()">Try It</button>-->

<!--<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo">try</p>-->

<!--<img src="images/loading.gif" onload="loadImage()" width="20" height="20">

<p id="demo"></p>-->
<!--<p id="demo"></p>
<script>
document.getElementById("demo").innerHTML = getDistanceFromLatLonInKm(39.865768, -74.962130, 39.861558, -75.001349);
</script>-->

<div class="body1000">
	<div class="clear"></div>
	<div class="location">
		<?=$location?>
	</div>
	<div class="clear"></div>
	<div class="wrapper">
		<? include mymps_tpl('list_select');?>
	</div>
	<div class="clear"></div>
	<div class="<?=$mymps_global[head_style]?>_listhd">
		<div class="listhdleft">
			<div><a href="#" class="currentr"><span></span><?=$cat[catname]?> Posts</a></div>
		</div>
		<div class="listhdcenter">
			Total Number of Posts: <span><?=$rows_num?></span>. Topped posts can be 5 times more likely to bring successful business!
		</div>
		<div class="listhdright">
			<button onclick="sortLocation()">Sort</button>
			<a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?catid=<?=$cat[catid]?>&cityid=<?=$city[cityid]?>" target="_blank">Make Post on <?=$city[cityname]?> <?=$cat[catname]?>>></a>
		</div>
	</div>

	<div class="clear5"></div>
	<div class="body1000">
		<div id="ad_intercatdiv"></div>
		<div class="infolists">
			<div class='section'>
			<ul class='sep'>
				<div id="ad_interlistad_top"></div>
				<? foreach($info_list as $k =>$v){?>
				<div class='hover media cfix <? if ($v[upgrade_type] > 1){?>ding<? }?>' id="ydsrs_<?=$v[id]?>">
				
				<a href='<?=$v[uri]?>' id="<?=$v[id]?>_uri" target='_blank' class='media-cap'><img id="<?=$v[id]?>_imagepath" src='<? if(!$v[img_path]){?><?=$mymps_global[SiteUrl]?>/images/nophoto.gif<? }else{ ?><?=$mymps_global[SiteUrl]?><?=$v[img_path]?><? }?>' title='<?=$v[title]?>'></a>
				<div class='media-body'>
				<div class='media-body-title'>
				<!--<small class='pull-right'><?=$v[begintime]?></small>-->
				
				<small class='pull-right' id="<?=$v[id]?>_time"><?=$v[begintime]?></small>
				
				<a href="<?=$v[uri]?>" id="<?=$v[id]?>_urinext" target="_blank" style="<? if($v[ifred] == 1){?>color:red;<? }?> <? if($v[ifbold] == 1){?>font-weight:bold;<? }?>"><?=$v[title]?></a><? if($v[img_count]){?><span class="img_count" id="<?=$v[id]?>_imagecount"><?=$v[img_count]?>Image</span><? }?><? if($v[info_level] == 2){?><span class="tuijian">Recommended</span><? }?><? if($v[certify] == 1){?><span class="certify">Verified</span><? }?>
				
				<img src="images/dis.gif" onload="loadImage(<?=$v[id]?>, '<?=$v[web_address]?>', '<?=$v[begintime]?>', '<?=$v[img_count]?>', '<?=$v[uri]?>', '<?=$v[img_path]?>', '<?=$v[title]?>', '<?=$v[areaname]?>', '<?=cutstr($v[content],0)?>')" width="20" height="20" type="hidden">
				<small class='pull-right' id=<?=$v[id]?>></small>
				
				</div>
				<div class='typo-small' id="<?=$v[id]?>_content"><?=cutstr($v[content],100)?></div>
				<div class='typo-smalls' id="<?=$v[id]?>_areaname">
				<? 
				if(is_array($v['extra'])){
					foreach($v['extra'] as $t => $w){
						if($w) echo in_array($w,array('0元','0万元','0元/月')) ? ' Discuss Face To Face / ' : $w.' / ';
					}
				}
				?>
				<?=$v[areaname]?></div>
				</div>
				</div>
				<? }?>
			</ul>
			</div>
			<div class="clear"></div>
			<!--<div class="pagination2">
			<?=$pageview?>
			</div>-->
			<div class="clear"></div>
			<div class="totalpost"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?catid=<?=$cat[catid]?>&cityid=<?=$city[cityid]?>" target="_blank">Make A Post On <?=$city[cityname]?> <?=$cat[catname]?> Now&raquo;</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="cateintro relate">
		<div class="introleft"><?=$cat[catname]?> Related States</div>
		<div class="introright">
			<? foreach($hotcities as $k => $v){?><a href='<?=$v[domain]?><?=$cat[caturi]?>' target="_blank"><?=$v[cityname]?> </a><? }?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="cateintro">
		<div class="introleft"><?=$cat[catname]?> Channel</div>
		<div class="introright"><?=$city[cityname]?> <?=$cat[catname]?> The channel provides you with posts about <?=$city[cityname]?> <?=$cat[catname]?>, and we have large numbers of posts concerning <?=$city[cityname]?> <?=$cat[catname]?> for you to choose. You may also view and make posts on <?=$city[cityname]?> <?=$cat[catname]?> for free.
		</div>
	</div>
	<? if(is_array($friendlink)){?>
	<div class="clearfix"></div>
	<div class="cateintro">
		<div class="introleft">Related Links</div>
		<div class="introflink">
			<? foreach($friendlink as $k => $v){ ?>
			<a href='<?=$v[url]?>' target='_blank'><?=$v[name]?></a>
			<? }?>
			<a href="<?=$city[domain]?><?=$about[friendlink_uri]?>" target="_blank">More</a>
		</div>
	</div>
	<? }?>
	<? include mymps_tpl('inc_foot');?>
</div>
</body>
</html>