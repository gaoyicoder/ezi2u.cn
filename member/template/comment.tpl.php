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
        <h3 class="ptitle"><span>Comment Management</span></h3>
    </div></div></div>
    <div class="pbody">

        
        <div class="exchange-ranking">
            <table class="ranking-stats">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Last 1 Week</th>
                        <th>Last 1 Month</th>
                        <th>Last 3 Months</th>
                        <th>Earlier than 3 Months Ago</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><img alt="" src="template/images/ping01.gif" /> <span style="color:#c00;">Good</span></th>
                        <td><a href="?m=comment&c=good&t=lastweek&type=corp"><?=$count['good']['lastweek']?></a></td>
                        <td><a href="?m=comment&c=good&t=lastmonth&type=corp"><?=$count['good']['lastmonth']?></a></td>
                        <td><a href="?m=comment&c=good&t=last3month&type=corp"><?=$count['good']['last3month']?></a></td>
                        <td><?php echo $count['good']['wms'] - $count['good']['last3month'] - $count['good']['lastmonth'] - $count['good']['lastweek']; ?></td>
                        <td><?=$count['good']['wms']?></td>
                    </tr>
                    <tr>
                        <th><img alt="" src="template/images/ping02.gif" /> <span style="color:#070;">Plain</span></th>
                        <td><a href="?m=comment&c=middle&t=lastweek&type=corp"><?=$count['middle']['lastweek']?></a></td>
                        <td><a href="?m=comment&c=middle&t=lastmonth&type=corp"><?=$count['middle']['lastmonth']?></a></td>
                        <td><a href="?m=comment&c=middle&t=last3month&type=corp"><?=$count['middle']['last3month']?></a></td>
                        <td><?php echo $count['middle']['wms'] - $count['middle']['last3month'] - $count['middle']['lastmonth'] - $count['middle']['lastweek']; ?></td>
                        <td><?=$count['middle']['wms']?></td>
                    </tr>
                    <tr>
                        <th><img alt="" src="template/images/ping03.gif" /> <span style="color:#000">Poor</span></th>
                        <td><a href="?m=comment&c=bad&t=lastweek&type=corp"><?=$count['bad']['lastweek']?></a></td>
                        <td><a href="?m=comment&c=bad&t=lastmonth&type=corp"><?=$count['bad']['lastmonth']?></a></td>
                        <td><a href="?m=comment&c=bad&t=last3month&type=corp"><?=$count['bad']['last3month']?></a></td>
                        <td><?php echo $count['bad']['wms'] - $count['bad']['last3month'] - $count['bad']['lastmonth'] - $count['bad']['lastweek']; ?></td>
                        <td><?=$count['bad']['wms']?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><a href="?m=comment&t=lastweek&type=corp"><?=$count['good']['lastweek'] + $count['middle']['lastweek'] + $count['bad']['lastweek']?></a></td>
                        <td><a href="?m=comment&t=lastmonth&type=corp"><?=$count['good']['lastmonth'] + $count['middle']['lastmonth'] + $count['bad']['lastmonth']?></a></td>
                        <td><a href="?m=comment&t=last3month&type=corp"><?=$count['good']['last3month'] + $count['middle']['last3month'] + $count['bad']['last3month']?></a></td>
                        <td><?=$count['good']['wms'] + $count['middle']['wms'] + $count['bad']['wms'] - ($count['good']['lastweek'] + $count['middle']['lastweek'] + $count['bad']['lastweek']) - ($count['good']['lastmonth'] + $count['middle']['lastmonth'] + $count['bad']['lastmonth']) - ($count['good']['last3month'] + $count['middle']['last3month'] + $count['bad']['last3month'])?></td>
                        <td><?=$count['good']['wms'] + $count['middle']['wms'] + $count['bad']['wms']?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="cleafix pagetab-wrap">
            <ul class="pagetab">
            <?php foreach(array('all'=>'All Comments','good'=>'Good','middle'=>'Plain','bad'=>'Poor') as $key => $val){?>
                <li><a href="?m=comment&c=<?=$key?>&type=corp" <?php if($c == $key){?>class="current"<?php }?>><span><?=$val?></span></a></li>
            <?php }?>
            </ul>
        </div>
        <div id="msg_success"></div>
<div id="msg_error"></div>
<div id="msg_alert"></div>
		<form method="post" action="?m=<?=$m?>&t=<?=$t?>&c=<?=$c?>&page=<?=$page?>">
        <div class="datatablewrap">
            <table class="datatable">
                <thead>
                    <tr>
                        <td>
                            <input class="checkall" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/>
                        </td>
                        <td>Comment Content</td>
                        <td>Commenter</td>
			            <td>Time of Comment</td>
                        <td>Status</td>
                        <td>Reply</td>
                        <td>Operation</td>
                    </tr>
                </thead>
                <tbody>
                <?php if($rows_num == 0 ){?>
                    <tr>
                        <td colspan="5">
                        <div class="nodata">No Comment Yet</div>
                        </td>
                    </tr>
                <?php } else {
                $i = 1;
                foreach($comment as $comment){
                ?>
                	<tr <?php if($i%2 == 0) echo 'class="row-even"'?>>
                        <td><input class="checkbox" type='checkbox' name='selectedids[]' value='<?=$comment[id]?>' id="<?=$comment[id]?>'"></td>
                        <td><?=$comment['content']?></td>
                        <td><a href="../space.php?user=<?=$comment['fromuser']?>" target="_blank"><?=$comment['fromuser']?></a></td>
                        <td><?=GetTime($comment['pubtime'])?></td>
                        <td>
                        <?php if (empty($comment['commentlevel'])) echo '<font color=red>Under Revision</font>'; else echo '<font color=green>Normal</font>'?>
                        </td>
                        <td>
                        <?php if (empty($comment[reply])) echo '<font color=red>Not Replied</font>'; else echo '<font color=green>Replied</font>'?>
                        </td>
                        <td><a href="?m=comment&id=<?=$comment[id]?>">Reply</a></td>
                    </tr>
                <?php 
                	$i ++;
                	}
                    unset($i);
                }
                ?>
                </tbody>
            </table>
            <div class="clearfix datacontrol">
                <div class="dataaction">
                    <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Delete" class="button" name="comment_submit" onClick="if(!confirm('Do you really wish to delete these comments? This cannot be reverted!'))return false;"/></span></span> 
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
