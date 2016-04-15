<!doctype html>
<html>

	<head>
		<meta charset="gb2312" />
		<title>System Background</title>
		<meta name="robots" content="noindex,nofollow">
		<link href="template/css/login.css" rel="stylesheet" />
		<script type="text/javascript" src="js/login.js"></script>
	</head>

<body>
	<div class="topbg">
		<span class="left"><a href="<?php echo $mymps_global[SiteUrl]?>" target="_blank">Visit Site Homepage</a></span>
		<span class="right"><a href="#" onClick="var strHref=window.location.href;this.style.behavior='url(#default#homepage)';this.setHomePage('<?php echo GetUrl();?>');" style="cursor: hand">Set as Home Page</a> <a href="#" onClick="collect();">Add to Favourites</a></span>
	</div>
	<div class="wrap">
		<h1>Mymps Background Management Centre</h1>
		<form name="Login" action="index.php?part=chk&url=<?=$url?>&go=<?=$go?>" method="post" onSubmit="return CheckForm();">
            <input name="do" value="login" type="hidden">
			<div class="login">
				<ul>
					<li>
						<input class="input" required name="username" type="text" placeholder="Account" title="Administrator Account" />
					</li>

					<li>
						<input class="input" type="password" required name="password" placeholder="Password" title="Administrator Password" />
					</li>
					<?php if ($authcodesettings['adminlogin'] == 1){?>
					<li>
						<img style="float:right;" src="../<?php echo $mymps_global[cfg_authcodefile]; ?>" alt="Cannot see clearly? Click on Refresh." class="authcode" onClick="this.src=this.src+'?'" align="absmiddle"/> <input style="float:left; width:100px; height:28px;" class="input" type="text" required name="checkcode" placeholder="Identifying Code" title="Identifying Code" />
					</li>
					 
					<?php }?>
				</ul>
				<button type="submit" name="submit" class="btn">Log-in Management</button>
			</div>
		</form>
	</div>
	<div class="foot">
		Copyright@ <a href="http://www.ezi2u.com.my" target="_blank">ezi2u</a> <?php echo MPS_VERSION; ?>
	</div>
</body>
</html>