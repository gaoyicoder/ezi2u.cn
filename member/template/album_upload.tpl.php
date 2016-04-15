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
        <h3 class="ptitle"><span>Branch Album</span></h3>
    </div></div></div>
    <div class="pbody">

        <div class="cleafix pagetab-wrap">
            <ul class="pagetab">
                <li><a href="?m=album&ac=list&type=corp"><span>Branch Album</span></a></li>
                <li><a href="?m=album&ac=upload&type=corp" <?php if($ac == 'upload') echo 'class="current"'; ?>><span>Upload a New Photo</span></a></li>
                <?php if($ac == 'edit'){?>
                <li><a href="?m=album&ac=edit&id=<?=$id?>&type=corp" class="current"><span>Edit Photo</span></a></li>
                <? }?>
            </ul>
        </div>
		<div id="msg_success"></div>
		<div id="msg_error"></div>
		<div id="msg_alert"></div>        
        <form method="post" name="form1" action="?m=album&ac=<?=$ac?>&type=corp" enctype="multipart/form-data" <?php if($ac == 'upload'){?>onSubmit="return AlbumSubmit();"<?php }?>>
        <?php if($ac == 'edit'){?>
        <input name="id" value="<?=$edit['id']?>" type="hidden">
        <input name="path" value="<?=$edit['path']?>" type="hidden">
        <input name="prepath" value="<?=$edit['prepath']?>" type="hidden">
        <?php }?>
        <div class="formgroup section-setting">
            <div class="formrow">
                <h3 class="label">Title of Photo£∫</h3>
                <div class="form-enter">
                      <input name="title" type="text" class="text" value="<?=$edit['title']?>"/>
                </div>
            </div>
            <?php if($ac == 'edit' && $edit['prepath'] != ''){?>
            <div class="formrow">
                <h3 class="label">Original Photo£∫</h3>
                <div class="form-enter">
                      <img src="<?=$edit['prepath']?>"/>
                </div>
            </div>
            <?php }?>
            <div class="formrow">
                <h3 class="label">Upload New Image: </h3>
                <div class="form-enter">
                     <input name="album_up" type="file" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"/> <?php echo $ac == 'edit' ? 'If you do not wish to upload any new images, please do not select it.' : ''; ?><br />
        Supported format: <?=$mymps_global[cfg_upimg_type]?>
		</div>
            </div>
            
            <div class="formrow">
                <h3 class="label">Notice: </h3>
                <div class="form-enter">
		<img src="images/mpview.gif" width="150" id="picview" name="picview" />
                </div>
            </div>
            
            <div class="formrow">
                <h3 class="label">Ê≥®ÊÑè‰∫ãÈ°πÔºö</h3>
                <div class="form-enter">
                Please keep the image clear.  The format of the Image should be <?=$mymps_global['cfg_upimg_type']?>, and its size should not be more than <?=$mymps_global[cfg_upimg_size]?>  KB.<br />
If a prolonged pause occurred during the uploading, it is recommended that you stop the proceeding and restart it or cut the size of the picture and restart uploading.

                </div>
            </div>
        
            <div class="formrow formrow-action"><span class="minbtn-wrap"><span class="btn">
              <input type="submit" value="<?php echo $ac == 'edit' ? 'Submit Changes' : 'Upload'; ?>" class="button" name="album_submit" />
            </span></span></div>
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
