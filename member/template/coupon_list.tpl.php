<?php include mymps_tpl('inc_header'); ?>

<link rel="stylesheet" type="text/css" href="template/css/new.exchange.css" />

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



<div class="pwrap">

    <div class="phead"><div class="phead-inner"><div class="phead-inner">

        <h3 class="ptitle"><span>Issued Coupon</span></h3>

        <p class="pextra addwebsite"><a href="?m=coupon&ac=detail&type=corp"><span>Issue Coupon</span></a></p>

    </div></div></div>

    <div class="pbody">



        <div class="cleafix pagetab-wrap">

            <ul class="pagetab">

                <li><a href="?m=coupon&status=yes&type=corp" <?php if($status == 'yes') echo 'class="current"'; ?>><span>Valid</span></a></li>

                <li><a href="?m=coupon&status=no&type=corp" <?php if($status == 'no') echo 'class="current"'; ?>><span>Invalid</span></a></li>

            </ul>

        </div>

		<div id="msg_success"></div>

<div id="msg_error"></div>

<div id="msg_alert"></div>

        <form method="post" action="?m=<?=$m?>&ac=<?=$ac?>&page=<?=$page?>">

        <div class="datatablewrap">

            <table class="datatable">

                <thead>

                    <tr>

                        <td>

                            <input class="checkall" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/>

                        </td>

                        <td width="100">Thumbnail</td>

                        <td>Name</td>

                        <td>Times Printed</td>

                        <td>Scan</td>

			            <td>Time of Issue</td>

                        <td>Details</td>

                    </tr>

                </thead>

                <tbody>

                <?php if($rows_num == 0 ){?>

                    <tr>

                        <td colspan="7">

                        <div class="nodata">You have not yet issued any coupons</div>

                        </td>

                    </tr>

                <?php } else {

                $i = 1;

                foreach($coupon as $d){

                ?>

                	<tr <?php if($i%2 == 0) echo 'class="row-even"'?>>

                        <td><input class="checkbox" type='checkbox' name='selectedids[]' value='<?=$d[id]?>' id="<?=$d[id]?>'"></td>

                        <td>

                        <img src="<?php echo $d['pre_picture']; ?>" style="margin:5px 0" width="80">

                        </td>

                        <td width="200">

                        <a href="../coupon.php?id=<?=$d['id']?>" target="_blank" title="<?=$d['title']?>"><?=substring($d['title'],0,30)?></a>

                        </td>

                        <td>

                        <?=$d['prints']?>

                        </td>

                        <td>

                        <?=$d['hit']?>

                        </td>

                        <td>

                        <?=GetTime($d['dateline'])?>

                        </td>

                        <td>

                        <a href="?type=corp&m=coupon&ac=detail&id=<?=$d['id']?>">Edit</a>

                        </td>

                    </tr>

                <?php 

                	$i++;

                    }

                    unset($i);

                }

                ?>

                </tbody>

            </table>

            <div class="clearfix datacontrol">

                <div class="dataaction">

                    <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Delete" class="button" name="coupon_submit" onClick="if(!confirm('Are you sure you wish to delete these coupons? This cannot be reverted!'))return false;"/></span></span> 

                </div>

                <div class="pagination"><?php echo page2(); ?></div>

            </div>

        </div>

		</form>

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