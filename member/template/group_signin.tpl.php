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

        <h3 class="ptitle"><span>Group Purchase Sign-up Management</span></h3>

        <p class="pextra addwebsite"><a href="?m=group&ac=detail&type=corp"><span>Start Group Purchase</span></a></p>

    </div></div></div>

    <div class="pbody">



        <div class="cleafix pagetab-wrap">

            <ul class="pagetab">

                <li><a href="?m=group&ac=list&type=corp" <?php if($ac == 'list') echo 'class="current"'; ?>><span>Started Group Purchase</span></a></li>

                <li><a href="?m=group&ac=signin&type=corp" <?php if($ac == 'signin') echo 'class="current"'; ?>><span>Sign-up Management</span></a></li>

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

                        <td width="100">Real Name</td>

                        <td>Activity Name</td>

                        <td>Number of Participants</td>

                        <td>Time of Sign-up</td>

			            <td>IP</td>

                        <td>Status</td>

                        <td>Operation</td>

                    </tr>

                </thead>

                <tbody>

                <?php if($rows_num == 0 ){?>

                    <tr>

                        <td height="17" colspan="8">

                        <div class="nodata">You have not yet started any group purchase activities</div>

                        </td>

                    </tr>

                <?php } else {

                $i = 1;

                foreach($signin as $d){

                ?>

                	<tr <?php if($i%2 == 0) echo 'class="row-even"'?>>

                        <td><input class="checkbox" type='checkbox' name='selectedids[]' value='<?=$d[groupid]?>' id="<?=$d[signid]?>'"></td>

                        <td>

                        <?php echo $d['sname']; ?>

                        </td>

                        <td width="200">

                        <a href="../group.php?id=<?=$d[groupid]?>" target="_blank"><?=$d['gname']?></a>

                        </td>

                        <td>

                        <?=$d['totalnumber']?>

                        </td>

                        <td>

                        <?=GetTime($d['dateline'])?>

                        </td>

                        <td>

                        <?=$d['signinip']?>

                        </td>

                        <td>

                        <?=$status[$d['status']]?>

                        </td>

                        <td>

                        <a href="?type=corp&m=group&ac=signin&id=<?=$d['signid']?>">Details</a>

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

                    <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Delete" class="button" name="group_signin_submit" onClick="if(!confirm('Are you sure you wish to delete these sign-up records? This cannot be reverted!'))return false;"/></span></span> 

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