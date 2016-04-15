<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<link rel="stylesheet" type="text/css" href="template/css/contribute.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.exchange.css" />
<script language="javascript">
var current_domain = '<?php echo $mymps_global[SiteUrl]?>';
</script>
<script language="javascript" src="../template/global/messagebox.js"></script>
<script language="javascript" src="template/javascript.js"></script>
</head>
<body class="<?php echo $mymps_global['cfg_tpl_dir']; ?>">
<div class="container">

<?php include mymps_tpl('inc_head'); ?>

    <div id="main" class="main section-default">
        <div class="clearfix main-inner">
            <div class="content">
                <div class="clearfix content-inner">
                    <div class="content-main">
                        <div class="content-main-inner">
                            <div class="pwrap accountinfo">
                                <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                    <h3 class="ptitle"><span>Account Information</span></h3>
                                    
                                </div></div></div>
                                <div class="pbody">
                                    <div class="clearfix accountinfo-dock">
                                        <div class="account-avatar">
                                            <a href="index.php?t=index&m=avatar" title="Change Avatar">
                                                <img src="<?php echo $mymps_global['SiteUrl'].($face != '' ? $face : '/images/noavatar_small.gif')?>" alt="Change Avatar" width="48" height="48" />
                                                <span class="avatar-change">Change Avatar</span>
                                            </a>
                                        </div>
                                        <div class="account-quicktools">
                                            <span class="account-sum" title="Coin Balance: <?php echo $row['money_own']?>"><strong><?php echo $row['money_own']?></strong></span>
                                            <a class="account-topup" href="index.php?m=pay">Recharge Coins</a>
                                        </div>
                                        <div class="account-uesrinfo">
                                            <span class="account-name"><?php echo $row['tname'].$s_uid; ?> <a target="_blank" style="font-size:12px; font-weight:100;" href="<?php echo Rewrite('space',array('user'=>$row['userid']))?>">View Personal Homepage</a></span>
                                            <span class="account-id">UID: <?php echo $uid; ?></span>
                                        </div>
                                        <div class="account-baseinfo">
                                            <span>Email Address: <?php echo $row['email']; ?></span>
                                            <span>Time of Register: <?php echo GetTime($row['jointime']); ?></span>
                                        </div>
                                        <div class="account-track">
                                            <span>Time of Last Visit: <?php echo GetTime($row['logintime'])?></span>
                                            <span>IP Used for Last Visit: <?php echo $row['loginip']?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pfoot"><p><b>-</b></p></div>
                            </div>
							
							<div id="msg_success"></div>
							<div id="msg_error"></div>
							<div id="msg_alert"></div>
							
                            <div class="pwrap pwrap-simple">
                            <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                <h3 class="ptitle"><span>Summary</span></h3>
                            </div></div></div>
                            <div class="pbody">
                            <ul class="clearfix statistics-list">
								<div class="clearfix counttable">
									<div class="cli"><span class="label">Posts</span> <span class="value"><a href="index.php?m=info"><?=$info_total?>Posts</a></span> <input name="postinfo" value="Make Post&raquo;" type="button" class="postinfo" onClick="window.open('<?php echo (!$row['tel'] && !$row['qq']) ? '?m=base&error=41' : '../'.$mymps_global['cfg_postfile'].'?cityid='.$cityid; ?>')"></div>
									<div class="cli"><span class="label">Messages</span> <span class="value"><a href="index.php?m=pm"><?=$pm_total?>Messages</a></span></div>
									<?php if($if_corp == 1){?>
									<div class="cli"><span class="label">Shop Photos</span> <span class="value"><a href="index.php?m=album&type=corp"><?=$album_total?>Photos</a></span><input name="postinfo" value="Upload Photo&raquo;" type="button" class="postinfo" style="color:#12459c" onClick="location.href='index.php?m=album&ac=upload&type=corp'"></div>
									<div class="cli"><span class="label">My Comments</span> <span class="value"><a href="index.php?m=comment&type=corp"><?=$comment_total?>Times</a></span></div>
									<div class="cli"><span class="label">Articles by Seller</span> <span class="value"><a href="index.php?m=document&type=corp"><?=$document_total?>Articles</a></span><input name="postinfo" value="Post Article&raquo;" type="button" class="postinfo" style="color:#12459c" onClick="location.href='index.php?m=document&ac=detail&type=corp'"></div>
									<?php if($coupon_total){?><div class="cli"><span class="label">Coupons</span> <span class="value"><a href="index.php?m=coupon&type=corp"><?=$coupon_total?>Coupons</a></span> <input name="postinfo" value="Issue Coupon&raquo;" type="button" class="postinfo" style="color:#12459c" onClick="location.href='index.php?m=coupon&ac=detail&type=corp'"></div><?php }?>
									<?php if($group_total){?><div class="cli"><span class="label">Group000 Purchases</span> <span class="value"><a href="index.php?m=group&type=corp"><?=$group_total?>Times </a></span> <input name="postinfo" value="Start Group Purchase&raquo;" type="button" class="postinfo" style="color:#12459c" onClick="location.href='index.php?m=group&ac=detail&type=corp'"></div><?php }?>
									<?php if($group_signin_total){?><div class="cli"><span class="label">Sign-ups for Group Purchase</span> <span class="value"><a href="index.php?m=group&ac=signin&type=corp"><?=$group_signin_total?>Times </a></span></div><?php }?>
									<?php if($goods_total){?><div class="cli"><span class="label">Products</span> <span class="value"><a href="index.php?m=goods&type=corp"><?=$goods_total?>Products</a></span><input name="postinfo" value="Product Orders&raquo;" type="button" class="postinfo" style="color:#12459c" onClick="location.href='index.php?m=goods&ac=detail&type=corp'"></div><?php }?>
									<?php if($goods_order_total){?><div class="cli"><span class="label">Product Orders</span> <span class="value"><a href="index.php?m=goods&ac=order&type=corp"><?=$goods_order_total?>Orders</a></span></div><?php }?>
									<?php }?>
                                </div>
                            </ul>
                            
                            </div>
                            <div class="pfoot"><p><b>-</b></p></div>
                            </div>
                            
                            <div class="pwrap pwrap-simple exchange-finance">
                            <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                <h3 class="ptitle"><span>Financial Information</span></h3>
                            </div></div></div>
                            <div class="pbody">
                                <ul class="financelist">
                                    <li>
                                        <span class="label">Account:</span>
                                        <span class="value"><strong><?php echo $money_own; ?></strong> Coin</span>
                                        <a class="topup" href="index.php?m=pay">Recharge</a>
                                        <a class="withdraw" href="index.php?m=pay&ac=use">Purchase Details</a>
                                    </li>
									<li>
                                        <span class="label">Your Scores: </span>
                                        <span class="value"><strong><?php echo $row['score']; ?></strong> points</span>
										<a class="detail" href="javascript:setbg('Exchange Coins',450,270,'../box.php?part=score_coin&userid=<?=$s_uid?>');">Exchange Coins</a>
										<a style="color:#ff3300;" href="javascript:setbg('How to get scores',350,270,'../box.php?part=howtogetscore');">How to get scores?</a>
                                        
                                    </li>
									<li class="noborder">
                                        <span class="label">Credit Level: </span>
                                        <span class="value"><strong><img src="../images/credit/<?php echo $row['credits']; ?>.gif" alt="Credit: <?php echo $row['credit']?>"></strong></span>
                                        <a class="detail" href="javascript:setbg('Elevate Credit Level',650,270,'../box.php?part=credits_up&userid=<?=$s_uid?>');">Elevate Credit Level</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pfoot"><p><b>-</b></p></div>
                            </div>
							<div class="pwrap pwrap-simple exchange-security">
                            <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                <h3 class="ptitle"><span>Verification Status<font style="font-weight:100; color:#585858; font-size:12px">(Pass the verifications to get a reward of scores!)</font></span></h3>
                            </div></div></div>
                            <div class="pbody">
                                <ul class="securitylist">
									<?php if($if_corp == 1){?>
                                    <li>
                                        <span class="label">Business Licence Verification: </span>
                                        <span class="value">
											<?php if($row['com_certify'] == 1){?>
											<img align="absmiddle" src="../images/company1.gif" alt="Business Licence Verification Passed"/>
											<?}else{?>
											<img align="absmiddle" src="../images/company0.gif" alt="Business Licence Verification Failed"/>
											<?}?>
										</span>
                                        <a href="?m=certify&ac=com">Submit Business Licence for Verification</a>
                                    </li>
									<?php }?>
                                    <li class="noborder">
                                        <span class="label">ID Verification Status: </span>
                                        <span class="value">
											<?php if($row['per_certify'] == 1){?>
											<img align="absmiddle" src="../images/person1.gif" alt="ID Verification Passed"/>
											<?}else{?>
											<img align="absmiddle" src="../images/person0.gif" alt="ID Verification Failed"/>
											<?}?></span>
                                        <a href="?m=certify&ac=per">Submit ID for Verification</a>
                                    </li>
                                    </ul>
                            </div>
                            <div class="pfoot"><p><b>-</b></p></div>
                            </div>
							
							<?php if($mymps_global['cfg_if_affiliate'] == 1){?>
							<div class="pwrap pwrap-simple exchange-security">
                            <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                <h3 class="ptitle"><span>Popularize the Site and Encourage Registration</span></h3>
                            </div></div></div>
                            <div class="pbody">
                                <ul class="statistics-list clearfix">
                                    <li class="myurl">
                                        To attract more visitors and increase the number of members, our site now starts the activity of Getting Reward for Attracting Potential Members. The proceeding is as follows:<br>

										1. Copy the invitation code provided by our site and spread it via BBS or Blog ;<br>2. A visitor clicks on the code and visits our site;<br>
										3. Within 24 hours after the link is clicked, if the visitor registered, you will get <font color="#ff3300;"><?php echo $mymps_global['cfg_affiliate_score']?></font> scores as a reward.<br>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" style="margin-top:5px">
<tr>
<td width="20%" height="50" bgcolor="#ffffff">&nbsp;&nbsp;Page Signature Code</td>
<td bgcolor="#ffffff">&nbsp;&nbsp;<input size="115" onClick="this.select();" type="text" value="&lt;a href=&quot;<?php echo $mymps_global['SiteUrl']?>/index.php?fromuid=<?=$row[id]?>&quot; target=&quot;_blank&quot;&gt;<?php echo $mymps_global['SiteName']?>&lt;/a&gt;" style="border:1px solid #ccc;padding:3px 5px" /></td>
</tr>
<tr>
<td bgcolor="#ffffff" height="50">&nbsp;&nbsp;BBS Signature Code</td>
<td bgcolor="#ffffff">&nbsp;&nbsp;<input size="115" onClick="this.select();" type="text" value="[url=<?php echo $mymps_global['SiteUrl']?>/index.php?fromuid=<?=$row[id]?>]<?php echo $mymps_global['SiteName']?>[/url]" style="border:1px solid #ccc;padding:3px 5px" /></td>
</tr>

</table>
										
                                    </li>
                                   
                                 </ul>
                            </div>
                            <div class="pfoot"><p><b>-</b></p></div>
                            </div>
							<?php }?>
							
                            <!--<div class="pwrap pwrap-simple exchange-security">
                            <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                <h3 class="ptitle"><span>Safety Information</span></h3>
                            </div></div></div>
                            <div class="pbody">
                                <ul class="securitylist">
                                    <li class="noborder">
                                        <span class="label">Log-in Password:</span>
                                        <span class="value">******</span>
                                        <a href="index.php?m=password">Change Log-in Password</a>
                                    </li>
                                    </ul>
                            </div>
                            <div class="pfoot"><p><b>-</b></p></div>
                            </div>-->
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php include mymps_tpl('inc_sidebar'); ?>
        </div>
    </div>
	<?php include mymps_tpl('inc_foot'); ?>
</div>
</body>
</html>