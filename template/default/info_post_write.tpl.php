<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.common.js" type="text/javascript"></script> 
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/post.js" type="text/javascript"></script> 
<? if($onload || $cat[if_mappoint] == 1){?>
<script language="javascript">var current_domain = '<?=$mymps_global[SiteUrl]?>';</script>
<script language="javascript" src="<?=$mymps_global[SiteUrl]?>/template/global/messagebox.js"></script>
<? }?>
<script type="text/javascript">
	document.domain = '<?=$document_domain?>';
</script>

	
<!--XXXXXX-->
<meta charset="UTF-8" />
    <title>Find a route using Geolocation and Google Maps API</title>
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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


function loadImage(/*demo, */addrsss, mappoint) {
		//console.log( demo );
			console.log( address );
			console.log( mappoint );
		
	var address2;
	
	address2 = document.getElementById(addrsss).value;
	
	console.log( address2 );
	
       var geocoder = new google.maps.Geocoder();

       geocoder.geocode
       (
          {'address': address2 }, 
             
          function (results, status) 
          {
				//console.log( '=========' );
				
				console.log( results );
				console.log( status );
				
                if (status == google.maps.GeocoderStatus.OK) 
                {
                   lat2 = results[0].geometry.location.lat();
                   lon2 = results[0].geometry.location.lng();

					 //  console.log(address2);
					 //  console.log(lat2 + " " + lon2);
               
                 //  var x = document.getElementById(demo);

                 //  x.innerHTML = "lat:" + lat2 + "  lon:" + lon2;

                   console.log("lat:" + lat2 + "  lon:" + lon2);
				   
				   document.getElementById(mappoint).value = lat2 + "," + lon2;
                } 
                else 
                {
					console.log("Not available");
				//	var x = document.getElementById(v);
				//	x.innerHTML = "Not available";
					document.getElementById(mappoint).value = "";
					
					var messageToShow;
					messageToShow = "Please input right format of address in order to get its geocode correctly. Thanks.\n"	
					alert(messageToShow);
                }
           }
        );
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
.thislabel{display:inline-block;width:400px;text-align:relative;padding:0;font-weight:300}
</style> 
		<script>

</script>

<!--xxxxxx-->
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>" onload="<?=$onload?>">
<? include mymps_tpl('inc_head_post');?>

<!--<button onclick="loadImage('demo', 'address', 'mappoint')">Get lat and Lot</button>
<p id="demo" type="text">Lat and Lot</p>-->
	
<div class="body1000">
	<div class="clear15"></div>
	<div class="wrapper" id="main">
		<? if($post[action] == 'edit'){?>
		<div class="step2">
		<span><font class="number">1</font> Enter Post Password</span>
		<span class="cur"><font class="number">2</font> Enter Content Of Post</span>
		<span><font class="number">3</font> Complete Editing Post</span>
		</div>
		<? }else{?>
		<div class="step2">
		<span><font class="number">1</font> Select Post Category <a onClick="if(!confirm('Reselecting category will empty all that you have entered. Are you sure you want to reselect category?'))return false;" href="?action=input&cityid=<?=$city[cityid]?>">(Reselect )</a></span>
		<span class="cur"><font class="number">2</font> Enter Content of Post</span>
		<span><font class="number">3</font> Post Successful</span>
		</div>
		<? }?>
		<div id="fenlei2">
		<div class='publish-detail'>
		<div style="display:none;">
            <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
            <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
            <form method="post" target="iframe_area" id="form_area"></form>
        </div>
        <form name="form1" method="post" enctype="multipart/form-data" onSubmit="return postcheck();" action="<?=$mymps_global[cfg_postfile]?>?action=<?=$post[action]?>">
        <input name="act" value="dopost" type="hidden">
        <input name="ismember" value="<?=$post[ismember]?>" type="hidden">
        <input name="catid" value="<?=$post[catid]?>" type="hidden">
        <input name="id" value="<?=$post[id]?>" type="hidden">
		<input name="mixcode" value="<?=$post[mixcode]?>" type="hidden">	
		
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  From Category: </label>
			<div class="publish-detail-item">
				<?=$cat[parentname]?> > <?=$cat[catname]?> &nbsp;&nbsp;<? if($post[action] != 'edit'){?><a onClick="if(!confirm('Changing category will empty all that you have entered. Are you sure you want to change category?'))return false;" href="?action=input&cityid=<?=$city[cityid]?>">Change Category</a><? }?>
			</div>
		</div>
		<? if($cat_option){?>
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Sub-category: </label>
			<div class="publish-detail-item">
				<select name="catid" class="input" require="true" datatype="limit" msg="Please Select Sub-category" onChange="location.href='?cityid=<?=$cityid?>&catid='+(this.options[this.selectedIndex].value)">
					<option value="">Please Select Category</option>
					<? foreach($cat_option as $k =>$v){?>
					<option value="<?=$v[catid]?>"><?=$v[catname]?></option>
					<? }?>
				</select>
			</div>
		</div>		

		<? }else{?>
		<input name="catid" value="<?=$post[catid]?>" type="hidden">
		<? }?>
		
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Valid For: </label>
			<div class="publish-detail-item">
				<?=$post[GetInfoLastTime]?>
			</div>
		</div>	
		
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Post Title: </label>
			<div class="publish-detail-item">
				<input type="text" maxlength="50" name="title" class="input input-60" value="<?=$post[title]?>" require="true" datatype="limit" msg="Post title cannot be empty!"/>
			</div>
		</div>
		<!--<? if($cat[if_mappoint] == 1){?>
		<div class="p-line">
			<label class="p-label">Location: </label>
			<div class="publish-detail-item">
				<input name="markmap" type="button" value="Click To Mark" class="mappoint" onclick="setbg('Mark On Map',500,250,'map.php?action=markpoint&width=500&height=250&p=<?=$post[mappoint]?>&documentdomain=yes&cityname=<?=$city[citypy]?>')">
				<input id="mappoint" type="text" maxlength="25" name="mappoint" class="input input-small" value="<?=$post[mappoint]?>" /> 
			</div>
		</div>
		<? }?>-->
		<? foreach($post[mymps_extra_value] as $k =>$v){?>
		<div class="p-line">
			<label class="p-label"><? if($v[required] == 1){?><span class="red required">*</span><? }?><?=$v[title]?>:</label>
			<div class="publish-detail-item">
				<?=$v[value]?> <span id="<?=$v[title]?>"></span>
			</div>
		</div>
		<? }?>
		<? if($post[upload_img]){?>
		<div class="p-line">
			<label class="p-label">Upload Photos: </label>
			<div class="publish-detail-item">
				<span class="contentinner">
				<?=$post[upload_img]?>
				</span>
			</div>
		</div>
		<? }?>
		
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Content Details: </label>
			<div class="publish-detail-item">
				<span class="contentinner"><?=$acontent?></span><span id="content"></span>
			</div>
		</div>
		
		<div class="contact">
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Contact: </label>
			<div class="publish-detail-item">
				<input name="contact_who" type="text" class="input input-large" value="<?=$post[contact_who]?>" require="true" datatype="limit" msg="Please enter name of contact"/>
			</div>
		</div>
	
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Address: </label>
			<div class="publish-detail-item">
				<input name="web_address" type="text" id="address" class="input input-large" value="<?=$post[web_address]?>" require="true" datatype="limit" msg="Please enter address"/>
			</div>
			<label class="thislabel">ex: Jalan 6/38A, 51200 (Street, zipcode)</label>
        </div>
		
	<div class="p-line">
                <label class="p-label"><span class="red required">*</span>           </label>
				<div class="publish-detail-item">
				<?=$post[select_where_option]?>
				<span id="District" style="margin-top:-12px;*margin-top:-17px;*margin-left:12px;"></span>
			</div>
		</div>	
		<div class="clearfix"></div>
		
			 <!-- <input id="address" type="textbox" value="Sydney, NSW">-->
			   <input name="markmap" type="button" value="*Get Geocode" class="mappoint" onclick="loadImage('address', 'mappoint')">
	     <input id="mappoint" type="text" maxlength="50" name="mappoint" class="input input-small" value="<?=$post[mappoint]?>" />
	
	    <br />
		<br />
		<br />
      <input id="submit" type="button" value="Check Address">
	  <div id="map" class="relative"></div>
		  <br />
 	  
		<div class="p-line">
  
			<label class="p-label"><span class="red required">*</span>Phone Number:</label>
			<div class="publish-detail-item">
				<input name="tel" type="text" class="input input-large" value="<?=$post[mobile]?>" datatype="limit" require="true" msg="Please enter the correct Phone Number:">
			</div>
		</div>
		
		<!--<div class="p-line">
			<label class="p-label">  Facebook: </label>
			<div class="publish-detail-item">
				<input name="qq" type="text" class="input input-large" value="<?=$post[qq]?>" require="qq" datatype="qq" msg="Please enter Facebook of contact"/>
			</div>
		</div>-->
		
		<div class="p-line">
			<label class="p-label">Email Address: </label>
			<div class="publish-detail-item">
				<input name="email" type="text" class="input input-large" value="<?=$post[email]?>" require="email" datatype="email" msg="Please enter the correct Email Address">
			</div>
		</div>
		</div>
		<? if($post[action] == 'input' && $post[ismember] != 1){?>
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Post Password: </label>
			<div class="publish-detail-item">
				<input name="manage_pwd" type="text" class="input input-small" value="" datatype="limit" require="true" msg="Please enter the Post Password for this post."> 
			</div>
		</div>
		<? }elseif($post[action] == 'edit' && $post[ismember] != 1){?>
		<div class="p-line">
			<label class="p-label">  Post Password: </label>
			<div class="publish-detail-item">
				<input name="manage_pwd" type="text" class="input input-small" value=""> <font style="font-size:12px; line-height:32px;"> If you do not wish to change password, please leave it blank.</font>
			</div>
		</div>
		<? }?>
		
		<? if($post[imgcode]){?>
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Identifying Code: </label>
			<div class="publish-detail-item">
				<input name="checkcode" type="text" class="input input-small" value="" datatype="limit|ajax" require="true" msg="Please enter the Identifying Code" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_authcode" msgid="code">
				<img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>" title="Cannot see clearly? Click to Refresh." width="80" height="25" align="absmiddle" style="cursor:pointer;" onClick="this.src=this.src+'?'" class="authcode"/><span id="code"></span>
			</div>
		</div>
		<? }?>
		
		<? if($checkquestion){?>
		<div class="p-line">
			<label class="p-label"><span class="red required">*</span>  Identifying Question: </label>
			<div class="publish-detail-item">
				<input name="checkquestion[answer]" value="" type="text" msgid="wer" class="input input-small" datatype="limit|ajax" require="true" msg="Please enter answer to the identifying question" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_answer&id=<?=$checkquestion[id]?>"/>
				<div class="qfont"><?=$checkquestion[question]?></div>
				<span id="wer"></span><input name="checkquestion[id]" type="hidden" value="<?=$checkquestion[id]?>"/> 
			</div>
		</div>
		<? }?>
		
		<p class='p-submit'>
		<input type="submit" id="fabu" class="fabu1" value="Post Now" ct="submit" onclick="return AllInputCheck();"/>
		</p>
		<div class="clear"></div>
		<div id='formsubmittips' class='small p-submit'>
		<div id="divTxt" style="display:none"><span style="color:red"><strong>The Uploaded images are: </strong></span><br></div>
		The more detailed the information you enter, the more credible your account can be, and thus the closer your ranking is to the top!<br />Your IP is: <span style="color:red"><?=$post[ip]?></span>. Please do not make posts with tricking or repeated information 
		</div>
		</form>
		</div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
<script language="javascript" type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator3.js"></script> 
</body>
</html>
