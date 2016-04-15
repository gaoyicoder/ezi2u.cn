<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/group.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/plugin/group/template/style.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/plugin/group/template/view.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/plugin/group/template/check_signin.js"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head');?>
	<div class="body1000">
		<div class="clear"></div>
		<div class="location"><?=$location?></div>
		<div class="clear"></div>
		<div class="indexcontent">
			<div class="cleft">

				<div class="grid_c1">
					<div class="pic"><img src="<?=$group[pre_picture]?>" alt="" width=80 height=80/></div>
					<div class="info">
						<h3>
							<span class="left"><span class="title"><?=$group[gname]?></span> [<span class="zt"><?=$glevel[$group[glevel]]?></span>]</span>
							<span class="right"><span class="red_skin">Organized by the Site.</span> Leader: <span class="red_skin"><?=$group[mastername]?></span> </span>
						</h3>
						<div class="hack"></div>
						<p>
							<span style="float:left; margin-right:12px">
							<? if($group[glevel] == 1 || $group[glevel] == 2){?>
							<input type="button" value="Sign-up Now" class="baoming" onclick="location.href='#signin'"><? }?>
							<? if($group[commenturl]){?>
							<input type="button" value="Join Discussion" class="taolun" onclick="window.open('<?=$group[commenturl]?>')"><? }?>
							</span>
							<span style="float:left; overflow:hidden;"><img src="<?=$mymps_global[SiteUrl]?>/plugin/group/template/images/time_06.gif" /> 
							<? if($group[remaindate] >= 0){?>There are only <b><?=$group[remaindate]?></b>days left for signing-up<?}else{?>
							Signing-up has been closed.
							<? }?>
							</span>
						</p>
					</div>
					<div class="num">
						<p><b>Signed-up</b><?=$group[signintotal]?></p>
					</div>
					<div class="hack"></div>
					<div class="qita_xinxi">
						<ul>
							<li><span>Activity ID: </span><?=$group[groupid]?></li>
							<li><span>District: </span><?=$group[areaname]?></li>
							<li><span>Site: </span><?=$group[gaddress]?></li>
							<li><span>Starting Time: </span><?=GetTime($group[meetdate], 'Y-m-d')?></li>
							<li><span>Ending Time: </span><?=GetTime($group[enddate], 'Y-m-d')?></li>
							<li class="jianjie"><span>Brief: </span><?=$group[des]?></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="grid_c2">
					<div class="bd">
						<h3>Activity Details</h3>
						<div class="cont">
							<?=$group[content]?>
						</div>
						<? if($group[glevel] == 1 || $group[glevel] == 2){?>
						<h3 style="border-top:1px #c0d9e5 solid; ">I Want To Sign-up<a name="signin"></a></h3>
						<div class="signincont">
							<form name="form1" method="post" action="<?=$mymps_global[SiteUrl]?>/group.php?" onsubmit="return checkbaoming();">
							<input name="id" value="<?=$group[groupid]?>" type="hidden">
							<div class="hdbc">Real Name: 
							  <input name="sname" type="text" class="input0" value=""/>
							 &nbsp; &nbsp; <em>*</em> <span>Please enter your real name</span> </div>
							<div class="hdbc">Gender: 
							<label for="man"><input name="sex" type="radio" value="Male" id="man" checked="checked"/>Male</label> 
							<label for="woman"><input type="radio" name="sex" value="Female" id="woman"/>Female</label>
							 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <em>*</em> <span> Select Your Gender</span> </div>
							<div class="hdbc">Contact Phone: 
							  <input name="tel" type="text" class="input0" value=""/>&nbsp; <em> &nbsp; * </em><span>We strongly recommend that you input your mobile phone number for more convenient communication. </span> </div>
							<div class="hdbc">Facebook&nbsp;&nbsp;
							<input name="qqmsn" type="text" class="input0" value=""/>
							&nbsp; <span>  Select  your usual internet contact details </span></div>
							<div class="hdbc">Age: 
							  <select name="age" size="1">
								<option value="">Select</option>
								<option value="Under 18">Under 18</option>
								<option value="18-25">18-25</option>
								<option value="26-35">26-35</option>
								<option value="36-50">36-50</option>
								<option value="Above 51">Above 51</option>
							  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <em>* </em><span>Please select the age group that fits you</span></div>
							<div class="hdbc">Number of Participants:  
							 <input name="totalnumber" type="text" size="7"  value="" class="input0"> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="chkbaonum"><em>*</em><span> Please enter the number of participants of this activity</span></span></div>
							
							<div class="hdbc"><div class="abc">Affiliated<br />
							<span>(50 words)</span></div>
							  <textarea name="message" class="text"></textarea><span id="chkbaochrmark"></span>
							</div>
							
							<div class="hdbc"><div class="abc">Identifying</div>
							  <input type="text" name="checkcode" style="width:70px" class="input0"> <img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>" width="70" height="25" align="absmiddle" style="cursor:pointer;" onClick="this.src=this.src+'?'"/><span id="chkbaochrmark"></span>
							</div>
							
							<div class="hdbc"><div class="abc">&nbsp;</div>
							  <input name="group_submit" value="Submit" class="group_submit" type="submit">
							</div>
							
							</form>
						</div>
						<? }?>
					</div>
				</div>
			</div>

		<div class="clear"></div>
		<? include mymps_tpl('inc_foot');?>
	</div>
</div>
</body>
</html>
