<?php include mymps_tpl('inc_header'); ?>
<link rel="stylesheet" type="text/css" href="template/css/new.exchange.css" />
<script language="javascript" src="template/javascript.js"></script>
<script language="javascript">
function toother(){
	$('action').innerHTML = 'Reply to This Message';
	$('title').value = '<?=$pm[title]?>';
	$('touser').value = '';
	$('content').value = CleanHtml($('toothercontent').innerHTML);
}
function reply(){
	$('action').innerHTML = 'Forward This Message';
	$('title').value = 'Re:<?=$pm[title]?>';
	$('touser').value = '<?=$pm[fromuser]?>';
	$('content').value = '';
}
</script>
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
                <li><a href="?m=pm&ac=inbox" <?php if($ac == 'inbox'){echo 'class="current"';}?>><span>Inbox</span></a></li>
                <li><a href="?m=pm&ac=outbox" <?php if($ac == 'outbox'){echo 'class="current"';}?>><span>Outbox</span></a></li>
                <li><a href="?m=pm&ac=sendnew"><span>Send Message</span></a></li>
            </ul>
        </div>
        <div id="msg_success"></div>
<div id="msg_error"></div>
<div id="msg_alert"></div>
        <div class="datatablewrap">
            <table class="datatable">
                   <tbody>
                   <tr>
                        <td height="15" colspan="10">
                            <div class="dataline"><span class="l">Title: </span><span class="r"><?=$pm['title']?></span></div>
                            <div class="dataline"><span class="l">From: </span><span class="r"><?=$pm['fromuser']?></span></div>
                            <div class="dataline"><span class="l">Time: </span><span class="r"><?=GetTime($pm['pubtime'])?></span></div>
                            <div class="dataline"><span class="l">Content: </span><span class="r" id="toothercontent"><?=$pm['content']?></span></div>
                            <div class="endline"><a href="javascript:history.back();">Return</a> 
                            <?php if($ac == 'inbox'){?>- <a href="javascript:reply();">Reply</a><?php }?> 
                            - <a href="javascript:toother();">Forward</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tbody id="reply">
                        <tr>
                        <td colspan="3">
                            <form method="post" id="postform" action="?m=pm&ac=<?=$ac?>&id=<?=$id?>">
                            <div class="highlightborder">
                                <table summary="Send Message" cellspacing="0" cellpadding="0" class="highlightbox">
                                <tr>
                                	<td colspan="2" style="font-weight:bold" ><font id="action"><?php echo $ac == 'inbox' ? 'Reply to This Message' : 'Forward This Message'; ?></font></td>
                                </tr>
                                
                                <tr>
                                <td><label for="msgto">Send To</label></td>
                                <td><input type="text" id="touser" name="touser" style="width:300px" class="text" value="<?php echo $ac == 'inbox' ? $pm['fromuser'] : ''; ?>"/></td>
                                </tr>
                                
                                <tr>
                                <td><label for="subject">Title</label></td>
                                <td><input type="text" id="title" name="title" style="width:300px" class="text" value="<?php echo ($ac=='inbox'?'Re:':'').$pm['title']?>" /></td>
                                </tr>
                                
                                <tr>
                                <td valign="top"><label for="content">Content</label></td>
                                <td><textarea id="content" name="content" style="width: 400px; height:120px"><?php echo $ac == 'inbox' ? '' : de_textarea_post_change($pm['content']);?></textarea>
                                </td>
                                </tr>
                                
                                <tr class="btns">
                                <td>&nbsp;</td>
                                <td>
                                <div class="clearfix datacontrol">
                                <div class="dataaction">
                                    <span class="minbtn-wrap"><span class="btn">
                                	<input name="pm_submit" type="submit" class="button" value="Submit">
                                	</span>
                                </div>
                                </div>
                                </td>
                                </tr>
                                </table>
                            </div>
                            </form>
                        </td>
                        </tr>
                    </tbody>
                </table>
        </div>

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