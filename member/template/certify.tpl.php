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
        <h3 class="ptitle"><span>Credibility Certification</span></h3>
    </div></div></div>
    <div class="pbody">

        <div class="cleafix pagetab-wrap">
            <ul class="pagetab">
                <li><a href="?m=certify&ac=person" <?php if($ac == 'person') echo 'class="current"'; ?>><span>ID Verification</span></a></li>
                <?php if($if_corp == 1){?><li><a href="?m=certify&ac=com" <?php if($ac == 'com') echo 'class="current"'; ?>><span>Business Licence Verification</span></a></li><?php }?>
            </ul>
        </div>
        <div id="msg_success"></div>
        <?php if($certifylang){?><div id="msg_error" class="errormsg"><?php echo $certifylang; ?></div><?php } else {?>
        <div id="msg_error"></div>
        <?php }?>
        <form method="post" name="form1" action="?m=certify&ac=<?=$ac?>" enctype="multipart/form-data" onSubmit="return CertifySubmit();">
        <div class="formgroup section-setting">
        	<div class="formrow">
                <h3 class="label">Verification Status：</h3>
                <div class="form-enter">
                    <?php if($per_certify == 1){?>
                    <img src="../images/person1.gif" alt="ID Verification Passed"/>
                    <?}else{?>
                    <img src="../images/person0.gif" alt="ID Verification Failed"/>
                    <?}?>
                    <?php if($com_certify == 1 && $if_corp == '1'){?>
                    <img src="../images/company1.gif" alt="Business Licence Verification Passed"/>
                    <?}else{?>
                    <img src="../images/company0.gif" alt="Business Licence Verification Failed"/>
                    <?}?>
                </div>
            </div>
            <div class="formrow">
                <h3 class="label">Select File: </h3>
                <div class="form-enter">
                     <input name="certify_image" type="file" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"/><br />
        Supported Formats of Uploaded Image：<?=$mymps_global[cfg_upimg_type]?>
                </div>
            </div>
            
            <div class="formrow">
                <h3 class="label">Preview Here: </h3>
                <div class="form-enter">
                 <img src="images/mpview.gif" width="150" id="picview" name="picview" />
                </div>
            </div>
            
            <div class="formrow">
                <h3 class="label">Note：</h3>
                <div class="form-enter">
                 Please keep the image clear.  The format of the Image should be <?=$mymps_global[cfg_upimg_type]?> , and its size should not be more than <?=$mymps_global[cfg_upimg_size]?>KB 。<br />If the uploading is stuck for too long, please either cancel and try again or downsize the image and retry.
                </div>
            </div>
        
            <div class="formrow formrow-action"><span class="minbtn-wrap"><span class="btn">
              <input type="submit" value="Upload" class="button" name="certify_submit" />
            </span></span></div>
        </div>
        </form>
        <?php if($ac == 'com'){ ?>
        <div class="topup-note">
            <p>
                 Should you have any question, please feel free to contact customer service section of  <?=$mymps_global[SiteName]?>. We will be available from 9:00 to 15:00 on weekdays and from 10:00 to 18:00 on weekends
            </p>
            <p>Contact Telephone Number: <?=$mymps_global[SiteTel]?></p>
            <p>Contact Email Address: <?=$mymps_global[SiteEmail]?></p>
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
</body>
</html>