<?php include mymps_tpl('inc_header');?>

<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />

<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />

<script language="javascript" src="template/javascript.js"></script>

</head>

<body class="<?php echo $mymps_global['cfg_tpl_dir']; ?>" <?php if($box == 1){?>style="background:none"<?}?>>

<div class="container">

    

    <?php include mymps_tpl('inc_head');?>

    

    <div id="main" class="main section-setting">

            <div class="clearfix main-inner" >

                <div class="content">

                    <div class="clearfix content-inner" <?php if($box == 1) echo 'style="margin:13px!important;"';?>>

                        <div class="content-main">

                            <div class="content-main-inner">

                                

                                <div class="pwrap">

                                    <div class="phead"><div class="phead-inner"><div class="phead-inner">

                                        <h3 class="ptitle"><span>Recharge Coin</span></h3>

                                    </div></div></div>

                                    <div class="pbody">

    

                                        <div class="clearfix pagetab-wrap">

                                            <ul class="pagetab">

                                                <li><a href="?m=pay&ac=pay" <?php if($ac == 'pay') echo 'class="current"'; ?>><span>Recharge Coin</span></a></li>

												<?php if($box != 1){?>

                                                <li><a href="?m=pay&ac=record" <?php if($ac == 'record') echo 'class="current"'; ?>><span>Recharging Details</span></a></li>

                                                <li><a href="?m=pay&ac=use" <?php if($ac == 'user') echo 'class="current"'; ?>><span>Purchase Records</span></a></li>

												<?php }?>

                                            </ul>

                                        </div>

										<div id="msg_success"></div>

										<div id="msg_error"></div>

										<div id="msg_alert"></div>

                                        <form action="?m=pay&ac=pay" target="_blank" method="post">

                                        <div class="formgroup topupform">

                                            

                                            <div class="errormsg" id="error" style="display:none"></div>

                                          

                                            <div class="formrow">

                                                <h3 class="label"><label for="value">Please enter your designated <span id="pointname">coin amount</span>to be charged <span class="note">(At least<span id="minvalue">0<?=$moneytype?></span>)</span></label></h3>

                                                <div class="formrow-enter">

                                                    <input type="hidden" name="currentPointType" id="currentPointType" value="Point8" />

                                                    <input type="text" class="text number" name="money" id="payvalue" value="" onKeyUp="value=value.replace(/[^\d]/g,'');if(value>2147483647)value=2147483647;setMustPay()" />

                                                    <span id="pointunit"></span>

                                                    <span class="surplus">(Coins You Now Have: <img src="template/images/coins.gif" align="absmiddle"><?=$money_own?>)</span>

                                                </div>

                                            </div>

                                            <div class="formrow">

                                                <h3 class="label">Amount to be Paid</h3>

                                                <div class="formrow-enter">

                                                    <span class="pay" id="mustpay">0</span> <?php echo $moneytype; ?>

                                                    <span class="note" id="paytype"></span>

                                                </div>

                                            </div>

                                            <div class="formrow">

                                                <h3 class="label"> Please select payment type</h3>

                                                <div class="formrow-enter">

                                                    <ul class="clearfix paymentlist">

                                                     <?php 

                                                     if(is_array($opened_pay_api)){

                                                     foreach($opened_pay_api as $k => $v){?>

                                                        <li id="li<?=$v['paytype']?>" <?php if($v['payid'] == 1){?>class="selected"<?php }?>>

                                                            <label for="payment_<?=$v['paytype']?>" class="image">

                                                                <img src="template/images/<?=$v['paytype']?>.png" alt="<?=$v['payname']?>" width="160" height="40" onClick="$('payment_<?=$v['paytype']?>').checked = true;selPayment();" />

                                                            </label>

                                                            <input id="payment_<?=$v['paytype']?>" class="radio" type="radio" name="payid" onClick="selPayment()" value="<?=$v['payid']?>"  <?php if($v['payid'] == 1) echo 'checked="checked"'; ?> />

                                                            <label for="payment_<?=$v['paytype']?>" class="title"><?=$v['payname']?></label>

                                                        </li>

                                                     <?php

                                                     	}}else{

                                                        ?>

                                                        <font color="red">Please contact our customer service staff to recharge.</font>

                                                     <?

                                                     }

                                                     ?>

                                                     

                                                    </ul>

                                                </div>

                                            </div>

                                            <script type="text/javascript">

                                                function selPayment() {

                                                    var varPayment = document.getElementsByName("payid");

                                                    for (i = 0; i < varPayment.length; i++) {

                                                        if (varPayment[i].checked) {

                                                            switch (varPayment[i].value) {

                                                                case "3":

                                                                    setCssClass("lialipay", "selected");

                                                                    setCssClass("litenpay", "");

                                                                    setCssClass("lichinabank", "");

                                                                    $('paytype').innerHTML = '(��ѡ����֧����֧�����й�Ԫ�أ�)';

                                                                    break;

                                                                case "1":

                                                                    setCssClass("lialipay", "");

                                                                    setCssClass("litenpay", "selected");

                                                                    setCssClass("lichinabank", "");

                                                                    $('paytype').innerHTML = '(��ѡ���˲Ƹ�֧ͨ�����й�Ԫ�أ�)';

                                                                    break;

                                                                case "2":

                                                                    setCssClass("lialipay", "");

                                                                    setCssClass("litenpay", "");

                                                                    setCssClass("lichinabank", "selected");

                                                                    $('paytype').innerHTML = '(��ѡ������������֧�����й�Ԫ�أ�)';

                                                                    break;

                                                                default:

                                                                    break;

                                                            }

                                                        }

                                                    }

                                                }

    

                                                function setCssClass(id, className) {

                                                    var element = document.getElementById(id);

                                                    if (element != null)

                                                        element.className = className;

                                                }

                                             

                                            </script>

                                            <div class="formrow formrow-action"> 

                                                <span class="minbtn-wrap"><span class="btn">

                                                <input class="button" type="submit" name="pay_submit" id="confirmResult" onClick="return checkInput();" value="Confirm Recharging" <?php if(!is_array($opened_pay_api)){?>disabled<?}?>/>

                                                </span>

                                                </span>

                                            </div>

                                        </div>

                                        </form>

                                		<?php if($box != 1){?>

                                        <div class="topup-note">

                                            <p>1. Coin recharging goes with the ratio of 1: <?php echo $mymps_global['cfg_coin_fee']; ?>. This means that 1<?php echo $moneytype; ?> can buy <?php echo $mymps_global['cfg_coin_fee']; ?> coin(s).</p>

											<p>2. If the notice of successful recharging appeared but no coins are charged into your account, there could be a problem on network or the system. Have no worries, and we will charge for you within 2 working days after confirmation; </p>

                                            <p>3. Please check carefully your requested amount to be recharged as well as your account when recharging to avoid errors and mistakes;</p>

                                            <p>4. If the correspondent web pages cannot be opened or are too slowly opened, please check your bank record first to see whether the payment is made, then check your account to see if your coins are recharged. Should either of the above is negative, please do not refresh the pages too frequently to prevent repeated purchases; </p>

                                            <p>5. Should you have any questions, you may also directly contact our  customer service staff: <strong><?=$mymps_global['SiteTel']?></strong></p>

                                        </div>

										<?php }?>

                                    

                                    </div>

                                    <div class="pfoot"><p><b>-</b></p></div>

                                </div>

                                    

                            </div>

                        </div>

                    </div>

                </div>

                <?php include mymps_tpl('inc_sidebar');?>

            </div>

        </div>

        

    <?php include mymps_tpl('inc_foot');?>

    

</div>

<script type="text/javascript">

    function checkInput() {

        var messages = {

            //

            'Point1': ['At least o experience(?) point should be recharged at a time'],

            //

            'Point2': ['At least 0 charm(?) should be recharged at a time'],

            //

            'Point4': ['At least 0 coin should be recharged at a time'],

            //

            'Point8': ['At least 1 coin should be recharged at a time'],

            //

            '-1': ['', '']

        };

        var pointType = $('currentPointType').value;

        var pavValue = $('payvalue').value;

        if (pavValue == '' || minvalues[pointType] > pavValue) {

            $('error').style.display = '';

            $('error').innerHTML = messages[pointType][0];

            location.href = '#error';

            setButtonDisable('confirmResult', false);

            return false;

        }

        else {

            $('error').style.display = 'none';

            return true;

        }

    }



    var moneys = {};

    var points = {};

    var minvalues = {};

    //

    moneys['Point8'] = 1;

    points['Point8'] = 10;

    minvalues['Point8'] = <?php echo $mymps_global['cfg_coin_fee'] ? $mymps_global['cfg_coin_fee'] : 1 ;?>;

    //

    //

    function setMustPay() {

        var type = $('currentPointType').value;

        var payvalue = $('payvalue').value;

        $('minvalue').innerHTML = minvalues[type];

        if (payvalue == '') {

            $('mustpay').value = '0';

            return;

        }

        var pay = moneys[type] * payvalue;

        var payStr = pay + '';

        var dotIndex = payStr.indexOf('.');

        if (dotIndex > 0) {

            var temp = payStr.substring(dotIndex + 1);

            if (temp.length > 2) {

                var t = parseInt(temp.substring(0, 2)) + 1;

                pay = parseInt(payStr.substring(0, dotIndex)) + t / 100;

            }

        }

        $('mustpay').innerHTML = Math.ceil(pay/<?php echo $mymps_global["cfg_coin_fee"];?>);

    }

    setMustPay();

    //

</script>

</body>

</html>