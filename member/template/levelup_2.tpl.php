<?php include mymps_tpl('inc_header'); ?>

<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />

<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />

<script language="javascript" src="template/javascript.js"></script>

</head>

<body class="<?php echo $mymps_global['cfg_tpl_dir']; ?>">

<div class="container">

<?php include mymps_tpl('inc_head'); ?>

<div id="main" class="main section-setting">

        <div class="clearfix main-inner">

            <div class="content">

                <div class="clearfix content-inner">

                    <div class="content-main">

                        <div class="content-main-inner">

                            <div class="pwrap setting-userinfo">

                                <div class="phead"><div class="phead-inner"><div class="phead-inner">

                                    <h3 class="ptitle"><span>Member Level Upgrade Self-service</span></h3>

                                </div></div></div>

                                <div class="pbody">

                                

                                    <div class="formcaption-note">

                                       Your current member level is <b style="color:#FF3300"><?=$levelname?></b>. The number of coins you own is <img src="template/images/coins.gif" align="absmiddle"> <b style="color:#FF3300"><?=$money_own?></b>

                                    </div>

                                    

                                    <div id="msg_success"></div>

<div id="msg_error"></div>

<div id="msg_alert"></div>

                                    

                                    <form method="post" name="form1" action="?m=levelup&ac=step3" enctype="multipart/form-data" onSubmit="return AvatarSubmit();">

                                    <input name="forwardlevel" value="<?php echo $forwardlevel; ?>" type="hidden">

                                    <div class="formgroup section-setting">

                                <div class="formrow">

                                            <h3 class="label">Selected Level to be Upgraded: </h3>

                                            <div class="form-enter">

                                              <strong style="color:#ff3300"><?php echo $forwardlevelname; ?></strong> <a href="?m=levelup">Return and Reselect</a>

                                      		</div>

                                        </div>

                                        

                                        <div class="formrow">

                                            <h3 class="label">Time Take to Upgrade: </h3>

                                            <div class="form-enter">

                                             	<?php echo GetUplevelTime('leveluptime',$forwardlevel); ?>

                                            </div>

                                        </div>

                                        

                                        <div class="formrow">

                                            <h3 class="label">Coins to be Deducted: </h3>

                                            <div class="form-enter" style="color:#ff3300">

                                             	<img src="template/images/coins.gif" align="absmiddle"> <font id="total">0</font>

                                            </div>

                                        </div>



                                        <div class="formrow formrow-action"><span class="minbtn-wrap"><span class="btn">

                                          <input type="submit" value="Confirm Upgrade" class="button" name="levelup_submit" />

                                        </span></span></div>

                                    </div>

                                    </form>

									<script language="javascript">                                    

									function calculate() 

                                    {

										var ID1 = $('leveluptime').value;

										if(ID1 == 'halfyear'){

											$('total').innerHTML = '<?=$forwardlevelmoney[halfyear]?>';

										} else if(ID1 == 'year') {

											$('total').innerHTML = '<?=$forwardlevelmoney[year]?>';

										} else if(ID1 == 'forever') {

											$('total').innerHTML = '<?=$forwardlevelmoney[forever]?>';

										} else if(ID1 == 'month') {

											$('total').innerHTML = '<?=$forwardlevelmoney[month]?>';

										}

										setTimeout("calculate()",30);

                                    }

									calculate();

                                    </script>

                                    

                                </div>

                                <div class="pfoot"><p><b>-</b></p></div>

                            </div>

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

