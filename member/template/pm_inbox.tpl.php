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
        <h3 class="ptitle"><span>Message Management</span></h3>
    </div></div></div>
    <div class="pbody">

        <div class="cleafix pagetab-wrap">
            <ul class="pagetab">                                                             
                <li><a href="?m=pm&ac=inbox" class="current"><span>Inbox</span></a></li>
                <li><a href="?m=pm&ac=outbox"><span>Outbox</span></a></li>
                <li><a href="?m=pm&ac=sendnew"><span>Send Message</span></a></li>
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
                            <td>&nbsp;<input class="checkall" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/></td>
                            <td>Title</td>
                            <td>From</td>
                            <td>Time</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if($rows_num > 0){
                    $i=1; 
                    foreach($pm as $art){
                    ?>
                    <tr <?php if($i%2 == 0) echo 'class="row-even"'?>>
                    	<td>&nbsp;<input class="checkbox" type='checkbox' name='deleteids[]' value='<?=$art[id]?>' id="<?=$art[id]?>'"></td>
                            <td><a href="?m=pm&ac=inbox&id=<?=$art['id']?>" onClick="this.style.fontWeight = 'normal'" 
            <?php if($art['if_read'] == '0'){?>style="font-weight:bold"<? }?>><?=$art['title']?></a></td>
                            <td><?if($art['if_sys'] == '1'){?>[System Administrator]<?}else{?>
                <a href="../space.php?user=<?=$art['fromuser']?>" target="_blank"><?=$art['fromuser']?></a>
                <?}?></td>
                            <td><?=GetTime($art['pubtime'])?></td>
                    </tr>
                    <?php 
                    	$i=$i+1;
                   	 }
                    } else {
                    ?>
                   <tr>
                        <td height="15" colspan="10">
                            <div class="nodata">No Records</div>
                        </td>
                    </tr>
                    <?}?>
                    </tbody>
                </table>
            <div class="clearfix datacontrol">
                <div class="dataaction">
                    <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Delete" class="button" name="pm_submit" onClick="if(!confirm('Are you sure you want to delete these messages? This cannot be reverted!'))return false;"/></span></span> 
                    
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