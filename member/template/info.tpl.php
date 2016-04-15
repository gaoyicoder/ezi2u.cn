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
        <h3 class="ptitle"><span>Categorized Posts Made by Me</span></h3>
        <p class="pextra addwebsite"><a href="../<?php echo $mymps_global['cfg_postfile']; ?>?cityid=<?php echo $cityid; ?>" target="_blank"><span>Make Categorized Post</span></a></p>
    </div></div></div>
    <div class="pbody">

        <div class="cleafix pagetab-wrap">
            <ul class="pagetab">                                                             
                <li><a href="?m=info&l=normal" <?php if($l == 'normal'){?>class="current"<?php }?>><span>Posts Made by Me</span></a></li>
                <li><a href="?m=info&l=inormal" <?php if($l == 'inormal'){?>class="current"<?php }?>><span>Post Under Revision</span></a></li>
				<li><a href="?m=info&l=tuiguang" <?php if($l == 'tuiguang'){?>class="current"<?php }?>><span>Post Being Popularized</span></a></li>
            </ul>
        </div>
        <div id="msg_success"></div>
        <div id="msg_error"></div>
		<div id="msg_alert"></div>
        <form method="post" action="?m=<?=$m?>&l=<?=$l?>&page=<?=$page?>" name="form1">
        <div class="datatablewrap">
			<div class="xinxi-guanli-box">
				<?php 
				if($rows_num > 0){
				$i=1; 
				foreach($list as $art){
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xinfabu prico">
	  <tr class="xintit">
	    <td colspan="3">
			<span class="czfr"><?php if($art['info_level'] > 0){?><a href="<?php echo $mymps_global['cfg_postfile'] ? '../'.$mymps_global['cfg_postfile'] : '../post.php'?>?action=edit&id=<?=$art[id]?>" target="_blank">Edit</a> | <?php }?>
			<a href="?m=info&ac=del&id=<?php echo $art['id']; ?>&l=<?php echo $l;?>&page=<?php echo $page;?>" onClick="if(!confirm('Are you sure you wish to delete this post? This cannot be reverted!'))return false;">Delete</a>
			</span>
 		   	<span class="xthpic"></span>
	    	<span>Time of Post:<?php echo $art['begintime'];?></span>
			<span><?php echo get_info_life_time($art['endtime']); ?></span>
	    	<span>Number:<?php echo $art['id']; ?></span>
	    	<span>View <?php echo $art['hit']?> 次</span>
			</td>
		  </tr>
          <tr>
            <td class="t">
            	<div class="title">
	            	<a href="<?=$art['uri']?>" target="_blank" class="img">
	            		<img src="<?php echo $art['img_path'] ? $art['img_path'] : '../images/nophoto.gif'?>" />
	            	</a>
	            	<a style=" font-weight:bold" title="<?=$art['title']?>" href="<?=$art['uri']?>" target="_blank" style="float:left;"><?=cutstr($art['title'],40)?></a><br><?=cutstr($art['content'],40)?><br> <?php if(mgetcookie('refreshed'.$art['id']) == 1) echo '<span class="refreshed">Post Refreshed</span>'; ?> <?php if($art['ifred'] == 1) echo '<span class="fred">Title Reddened</span>'; ?> <?php if($art['ifbold'] == 1) echo '<span class="fbold">Title Bolded</span>'; ?>
	           	 	<p class="txq"><a target='_blank' href='<?php echo $art[uri_cat]?>' class="a_xq1"><?php echo $art['catname']?></a></p>
           	 	</div>
            </td>
            <td>
			<?php if($art['info_level'] < 1){?>
			<span class="examine"></span><b class="f14 red_f6">Under Revision</b><br />
			<p class="xsitxt">The post will be displayed once it passes the revision. Should you wish to track the progress, please come back later.</p>
			<?}elseif($art['endtime'] < $timestamp && $art['endtime'] && $mymps_global['cfg_info_if_gq'] != 1){?>
			<span class="examine"></span><b class="f14 red_f6">Displayed</b><br />
			<p class="xsitxt" >Contact details in the post are not displayed. They can be displayed through refreshing the post.</p>
			<?php }else{?>
			<span class="xianshi"></span><b class="f14 green">Displayed</b><br />
			
			<?php if($art['upgrade_type_index']){?>
			<span class="examine"></span><b class="f14 red_f6">Place at the Top of the Homepage<?php if($art['upgrade_time_index'] != 0){ echo '至'.date("Y-m-d",$art['upgrade_time_index']);}?></b><br /><?php }?>
			
			<?php if($art['upgrade_type']){?>
			<span class="examine"></span><b class="f14 red_f6">Place at the Top of the Broad Headings<?php if($art['upgrade_time'] != 0){ echo '至'.date("Y-m-d",$art['upgrade_time']);}?></b><br /><?php }?>
			
			<?php if($art['upgrade_type_list']){?>
			<span class="examine"></span><b class="f14 red_f6">Place at the Top of the Sub-headings<?php if($art['upgrade_time_list'] != 0){ echo '至'.date("Y-m-d",$art['upgrade_time_list']);}?></b><br /><?php }?>
			
			<?php }?>
			</td>
   			 <td class="w1">
			 <?php if($art['info_level'] > 0){?>
			 <span class="refresh">
			 <a  <?php if(mgetcookie('refreshed'.$art['id']) != 1){ ?> onClick="<?php if($mymps_global['cfg_member_info_refresh']>0){?>if(!confirm('You currently have <?php echo $money_own; ?> coins. Refreshing the post will cost you <?php echo $mymps_global['cfg_member_info_refresh']; ?> coins.'))return false;<? }?>" <?php }else{?> onClick="alert('This post has already been refreshed and cannot immediately be refreshed again. ');return false;" <?php }?> title='Refreshed post will be displayed among the front few in the list, as if it has just been posted.' href="?m=info&ac=refresh&id=<?=$art[id]?>">Refresh the Post</a>
			 </span>
			 <span class="extension" >
			 <a <?php if($art['ifbold'] == 1){?>onClick="alert('The title of this post has already been bolded.');return false;"<?php }else{?> onClick="if(!confirm('You currently have <?php echo $money_own; ?> coins. Bolding the title will cost you <?php echo $mymps_global['cfg_member_info_bold']; ?> coins.'))return false;" <?php }?>href="?m=info&ac=bold&id=<?=$art[id]?>&page=<?=$page?>">Bold the Title</a>
	</span><br />	
	<span class="sticky" >
		<a href="?m=info&ac=upgrade&id=<?=$art[id]?>">Top the Post</a>
	</span>
	<span class="extension precision" >
		<a class="on" <?php if($art['ifred'] == 1){?>onClick="alert('The title of this post has already been reddened.');return false;"<?php }else{?>onClick="if(!confirm('You currently have <?php echo $money_own; ?> coins. Reddening the title will cost you <?php echo $mymps_global['cfg_member_info_red']; ?> coins.'))return false;"<?php }?> href="?m=info&ac=red&id=<?=$art[id]?>&page=<?=$page?>">Redden Title</a>
	</span>	
		  <?php }?>
		  </td>
          </tr>
          <tr class="infotdno">
          	<td colspan="3">
               
            </td>
          </tr>
	      </table>     
		  		<?php 
				}}
				?>
				 
			</div>				
			<?php if($rows_num > 0){?>
            <div class="clearfix datacontrol">
                <div class="dataaction">
                </div>
                <div class="pagination"><?php echo page2(); ?></div>
            </div>
			<?php }else{?>
			<div class="nodata">No Records yet</div>
			<?php }?>
        </div>
        </form>

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