<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<?php include mymps_tpl('header');?>
	<title><?=$cat['catname']?> - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/list.css">
	<script src="template/js/jq.min.js"></script>
	<script src="template/js/list.js"></script>
	
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

	<script>
var origDistance = [];
var sortDistance = [];
var origDistanceTemp = [];
var sortDistanceTemp = [];
var origVIndex = [];
var sortVIndex = [];
var origPostTime = [];
var sortPostTime = [];
var origPostContents = [];
var sortPostContents = [];
var origImageCount = [];
var sortImageCount = [];
var origUrl = [];
var sortUrl = [];
var origImagePath = [];
var sortImagePath = [];
var origMainTitle = [];
var sortMainTitle = [];
var origViewHits = [];
var sortViewHits = [];

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

function loadImage(v, address2, postTime, postContents, imageCount, url, imagePath, mainTitle, viewHits) {
	
	var user = getCookie("username");

	var pos = user.indexOf(",");
	
	lat1 = user.slice(0,pos);
	lon1 = user.slice(pos + 1, user.length);
	
//	console.log(lat1 + " " + lon1);
	
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
               
                   var x = document.getElementById(v);

				   var R = 6371; // Radius of the earth in km
				   var dLat = deg2rad(lat2-lat1);  // deg2rad below
				   var dLon = deg2rad(lon2-lon1); 
				   var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) *  Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2); 
				   var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
				   var d = R * c; // Distance in km	

                   x.innerHTML = d.toFixed(2) + " km";

                   //console.log(d);
                   
                   origDistance.push(d.toFixed(2));
                   sortDistance.push(d.toFixed(2));
         	       origDistanceTemp.push(d.toFixed(2));
                   sortDistanceTemp.push(d.toFixed(2));
                   origVIndex.push(v);
                   sortVIndex.push(v);
                   origPostTime.push(postTime);
                   sortPostTime.push(postTime);
                   origPostContents.push(postContents);
                   sortPostContents.push(postContents);
                   origImageCount.push(imageCount);
                   sortImageCount.push(imageCount);
                   origUrl.push(url);
                   sortUrl.push(url);
                   origImagePath.push(imagePath);
                   sortImagePath.push(imagePath);
                   origMainTitle.push(mainTitle);
                   sortMainTitle.push(mainTitle);
                   origViewHits.push(viewHits);
                   sortViewHits.push(viewHits);				   
                } 
                else 
                {
					//console.log("Not available");
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
					origPostContents.push(postContents);
					sortPostContents.push(postContents);
					origImageCount.push(imageCount);
					sortImageCount.push(imageCount);
					origUrl.push(url);
					sortUrl.push(url);
					origImagePath.push(imagePath);
					sortImagePath.push(imagePath);
					origMainTitle.push(mainTitle);
					sortMainTitle.push(mainTitle);	
					origViewHits.push(viewHits);
					sortViewHits.push(viewHits);					
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
	 
//	console.log("orig index " + origVIndex);
//	console.log("orig dis " + origDistance);

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
                  sortPostContents[i] = origPostContents[j];
                  sortImageCount[i] = origImageCount[j];
                  sortUrl[i]        = origUrl[j];
                  sortImagePath[i]  = origImagePath[j];
                  sortMainTitle[i]  = origMainTitle[j];
                  sortViewHits[i]   = origViewHits[j];
     
    	         // if(sortDistanceTemp[i] == 20000)
    	         // {
    	              delete sortDistanceTemp[i];
    	              delete origDistanceTemp[j];
    	         // }
    	             
    	          break;
    	      }
    	  }
     }
     
     var k;
  
     var htmlS = '';
     
     for(k = 0; k < sortVIndex.length; k++)
     {
       /*     var id;
                
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
         
         //htmlS += '<div class="hover media cfix" id="ydsrs_' + sid + '">' + sObj.html() + '</div>';

          htmlS += '<li id="ydsrs_' + sid + '">' + sObj.html() + '</li>';
            
           /* if(sortDistance[k] == 20000)
            	document.getElementById(id).innerHTML = "Not Available";
            else
				document.getElementById(id).innerHTML = sortDistance[k] + " km";
          	
            document.getElementById(id + 1000).innerHTML = sortPostTime[k];

            document.getElementById(id + 2000).innerHTML = sortPostContents[k];

            document.getElementById(id + 3000).innerHTML = sortImageCount[k] + "Image";

            document.getElementById(id + 4000).href = sortUrl[k];

            document.getElementById(id + 5000).src = sortImagePath[k];

            document.getElementById(id + 6000).href = sortUrl[k];

            document.getElementById(id + 6000).innerHTML = sortMainTitle[k];

            document.getElementById(id + 7000).innerHTML = "Views: " + sortViewHits[k];*/
     }
     
//	 console.log("sort index " + sortVIndex);
//	 console.log("sort dis " + sortDistance);
//   document.getElementById("sortVIndex").innerHTML = sortVIndex;
    $( '.list-info' ).html( htmlS );

     origDistance.length = 0;
     sortDistance.length = 0;
     origDistance.length = 0;
     sortDistanceTemp.length = 0;
     origVIndex.length = 0;
     sortVIndex.length = 0;     
}

</script>

</head>

<body>

<p id="origD"></p>
<p id="origVIndex"></p>
<p id="sortD"></p>
<p id="sortVIndex"></p>

<div class="body_div">

    <?php include mymps_tpl('header_search');?>
	

	<div class="dl_nav">
		<span><a href="index.php?cityid=<?=$cityid?>">Homepage</a><font class="raquo"></font><a href="index.php?mod=category&cityid=<?=$cityid?>">Local Posts</a>
        <? foreach($parentcats as $k =>$v){?>
        <font class="raquo"></font><a href="index.php?mod=category&cityid=<?=$cityid?>&catid=<?=$v['catid']?>"><?=$v['catname']?></a>
        <? }?>
        </span>
	</div>
	
	<div class="filter">
		
		<? foreach($cat_list as $k => $v){?>
		<dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt>Category</dt>
			<dd style="padding-right: 30px;">
            <a href="index.php?mod=category&catid=<?=$v['catid']?>&cityid=<?=$cityid?>"<?php if($catid == $v['catid']){?>class="selected"<?php }?>>Any</a>
			<?php foreach($v['children'] as $u => $w){?>
				<a href="index.php?mod=category&catid=<?=$w['catid']?>&cityid=<?=$cityid?>" <?php echo $w['catid'] == $catid ? 'class="selected"' : ''; ?>><?=$w['catname']?></a>
			<?php }?>
			</dd>
		</dl>
		<?php }?>
		
        <?php if(is_array($area_list)){?>
		<dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt>District</dt>
			<dd style="padding-right: 30px;">
			<?php foreach($area_list as $k => $v){?>
				<a href="<?=$v['uri']?>" <?php echo $v['select'] == 1 ? 'class="selected"' : ''; ?>><?=$v['areaname']?></a>
			<?php }?>
			</dd>
		</dl>
        <?php }elseif($hotcities){?>
        <dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt>State</dt>
			<dd style="padding-right: 30px;">
			<?php foreach($hotcities as $k => $v){?>
				<a href="index.php?mod=category&&catid=<?=$catid?>&cityid=<?=$v['cityid']?>"><?=$v['cityname']?></a>
			<?php }?>
			</dd>
		</dl>
        <?php }?>
        <?php if(is_array($street_list)){?>
		<dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt></dt>
			<dd style="padding-right: 30px;">
			<?php foreach($street_list as $k => $v){?>
				<a href="<?=$v['uri']?>" <?php echo $v['select'] == 1 ? 'class="selected"' : ''; ?>><?=$v['streetname']?></a>
			<?php }?>
			</dd>
		</dl>
		<?php }?>
		<?php if($mymps_extra_model){?>
			<?php foreach($mymps_extra_model as $k => $v){?>
			<dl class="filter_item cmcdata" type="cmc_cmcs" style="display:none;">
				<dt><?=cutstr($v['title'],8,'')?></dt>
				<dd style="padding-right:30px;">
				<?php foreach($v['list'] as $x => $c){?>
					<a href="<?=$c['uri']?>" <?php echo $c['select'] == 1 ? 'class="selected"' : ''?>><?=$c['name']?></a>
				<?php }?>
				</dd>
			</dl>
			<?php }?>
			
			<div class="filter_more">
				<a href="javascript:;"><span>More Filtering Conditions</span><b class="arrow"></b></a>
			</div>
			
			<div>
		    <button class='pull-right' onclick="sortLocation()">Sort</button>
			</div>
			
		<?}?>
	</div>

	<div class="infolst_w">
		<ul class="list-info">
		<?php 
			if(empty($info_list)) echo '<div style="margin:30px 0; text-align:center;color:#999"">Sorry, on '.$cat[catname].' we currently do not have any posts found! <a href="index.php?mod=category&catid='.$parent['catid'].'">Return</a></div>';
			foreach((array)$info_list as $k => $v){ 
			$v['upgrade_type']	= !$cat['parentid'] ? ($v['upgrade_time'] >= $timestamp ? $v['upgrade_type'] : 1):($v['upgrade_time_list'] >= $timestamp ? $v['upgrade_type_list'] : 1);
		?>
    		<li id="ydsrs_<?php echo $v['id']; ?>">
                <a href="index.php?mod=information&id=<?php echo $v['id']; ?>" id=<?php echo $v['id'] + 4000; ?>>
				<?php if(!empty($v['img_path'])){?>
					<img class="thumbnail" id=<?php echo $v['id'] + 5000; ?> src="<?=$mymps_global['SiteUrl']?><?php echo $v['img_path']; ?>" alt="<?php echo $v['title']; ?></strong>">
				<? } else {?>
					<img class="thumbnail" src="template/images/noimg.gif" alt="nopic">
				<?}?>
				<dl>
					<dt class="tit" id=<?php echo $v['id'] + 6000; ?>><font color="#5E5F61" size="2"><?php echo $v['title']; ?></font>&nbsp;<?php if(!empty($v['img_path'])){?><sapn  style="background:#339966; color:#FFFFFF; font-size:14px; padding:0 2px;text-align:center;" id=<?php echo $v['id'] + 3000; ?>><?=$v['img_count']?>Image</sapn><? } else {?><?}?><?php echo $v['upgrade_type'] > 1 ? '<span class="ico ding"></span>' : ''?> </dt>
					<dd class="attr" id=<?php echo $v['id'] + 2000; ?>><span><font color="#5E5F61" size="1"><?=cutstr(clear_html($v['content']),50)?></font></span></dd>
					<dd class="attr pr5">
						<font color="#5E5F61" size="2"><? 
                        if(is_array($v['extra'])){
                            foreach($v['extra'] as $u => $w){
								echo '<span>';
                                if($w) echo in_array($w,array('0元（中国元素）','0万元（中国元素）','0元/月（中国元素）')) ? ' Discuss Face to Face ' : $w;
								echo '</span>';
                            }
                        }
                        ?></font>
						<span class="lvzi" id=<?php echo $v['id'] + 1000; ?>><font color="#5E5F61" size="1"><?php echo get_format_time($v['begintime']); ?></font></span>
						<span id=<?php echo $v['id'] + 7000; ?>><font color = "#5E5F61" size="1">Views: <?php echo $v['hit']; ?></font></span>
						
						<img src="template/images/noimg.gif" onload="loadImage(<?php echo $v['id']; ?>, '<?php echo $v['web_address']; ?>', '<?php echo get_format_time($v['begintime']); ?>', '<?=cutstr(clear_html($v['content']),0)?>', '<?=$v['img_count']?>', 'index.php?mod=information&id=<?php echo $v['id']; ?>', '<?php echo $v['img_path']; ?>', '<?php echo $v['title']; ?>', '<?php echo $v['hit']; ?>')" width="1" height="1" type="hidden">
						<small class='pull-right' id=<?php echo $v['id']; ?>></small>
					</dd>
				</dl>
				
                </a>
    		</li>
		<?php }?>
		</ul>  
	</div>

	<?php if(!empty($info_list)){?>
	<div class="pager">
	<?php pager();?>
	</div>
	<?php }?>
	<?php include mymps_tpl('footer');?>
</div>
</body>
</html>
