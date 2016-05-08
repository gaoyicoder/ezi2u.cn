<?php include mymps_tpl('inc_header');?>

<link rel="stylesheet" type="text/css" href="template/css/new.exchange.css" />

<script language="javascript" src="template/javascript.js"></script>



</head>

<body class="<?php echo $mymps_global['cfg_tpl_dir']; ?>">

<div class="container">



	<?php include mymps_tpl('inc_head');?>

    <div id="main" class="main section-setting">

        <div class="clearfix main-inner">

            <div class="content">

                <div class="clearfix content-inner">

                    <div class="content-main">

                        <div class="content-main-inner">

                            

                            <div class="pwrap">

    <div class="phead"><div class="phead-inner"><div class="phead-inner">

        <h3 class="ptitle"><span>Branch Album</span></h3>

    </div></div></div>

    <div class="pbody">



        <div class="cleafix pagetab-wrap">

            <ul class="pagetab">

                <li><a href="?m=album&ac=list&type=corp" class="current"><span>Branch Album</span></a></li>

                <li><a href="?m=album&ac=upload&type=corp"><span>Upload a New Photo</span></a></li>

            </ul>

        </div>

        <div id="msg_success"></div>

		<div id="msg_error"></div>

		<div id="msg_alert"></div>

        <div class="datatablewrap">

        <?php if($rows_num == 0){?>

        <div class="nodata">You have not yet uploaded any photos, <a href="?m=album&ac=upload">please click here to upload &raquo;</a><br><br><br></div>

        <?php } else {?>

        <div class="albumlist">

            <ul>

                <?php foreach($album AS $album){?>

                <li class="li">

                <a href="<?php echo $mymps_global[SiteUrl].$album['path'];?>" target="_blank" class="box" title="Click to View the Actual Image"><img src="<?php echo $mymps_global[SiteUrl].$album['prepath']?>" border="0"></a>

                <h4 align="center"><font title="<?=$album['title']?>"><?=substring($album['title'],0,15)?></font><br /><a href="?m=album&ac=edit&id=<?=$album['id']?>&type=corp">Change</a> <a href="?m=album&ac=delete&id=<?=$album['id']?>" onClick="if(!confirm('Do you really wish to delete this image? This cannot be undone!'))return false;">Delete</a></h4>

                </li>

                <?}?>

            </ul>

        </div>

        <div class="clearfix datacontrol">

            <div class="pagination"><?php echo page2(); ?></div>

        </div>

        <?php }?>

        </div>

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

</body>

</html>