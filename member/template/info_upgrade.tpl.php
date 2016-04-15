<?php include mymps_tpl('inc_header');?>
<style>.refreshed{ margin-left:5px;}</style>
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
        <h3 class="ptitle"><span>Introduction to Topping Services</span></h3>
        <p class="pextra"><a href="?m=info"><span>&laquo; Return to Categorized Post List</span></a></p>
    </div></div></div>
    <div class="pbody">
        <div id="msg_success"></div>
        <div id="msg_error"></div>
        <table>
		<tr>
			<td>
			<div class="upgradetd">
                <div class="introTitle"><span style="color:#F30;" class="t1">Place at the Top of the Homepage</span><br>
<span class="t2">Needs only <?=$mymps_global[cfg_member_upgrade_index_top]?> coins a day!</span></div>
                <div class="t3">Place your post in <font color="#FF3300">the most favourable position on the Homepage</font> on a regular basis and let all viewers see it!</div>
            </div>
            </td>
			<td>
            <div class="upgradetd" style="margin-left:5px">
                <div class="introTitle"><span style="color:#369;" class="t1">Place at the Top of the Broad Headings</span><br>
<span class="t2">Needs only <?=$mymps_global[cfg_member_upgrade_top]?> coins a day!</span></div>
                <div class="t3">Place your post at the top of the <font color="#FF3300">broad headings list</font>  to attract more attention!</div>
            </div>
            </td>
			<td>
			<div class="upgradetd" style="margin-left:5px">
                <div class="introTitle"><span style="color:green;" class="t1">Place at the Top of the Sub-headings</span><br>
<span class="t2">Needs only <?=$mymps_global[cfg_member_upgrade_list_top]?> coins a day!</span></div>
                <div class="t3">Place your post at the top of the  <font color="#FF3300">sub-headings list</font> to attract more attention!</div>
            </div>
            </td>
		</tr>
	</table>
        <form method="post" action="?m=<?=$m?>&l=<?=$l?>&page=<?=$page?>">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="catid" value="<?=$row['catid']?>">
        <input type="hidden" name="money_own" value="<?=$money_own?>">
        <input type="hidden" name="iftop" value="<?=$row['upgrade_type']?>">
		<input type="hidden" name="iflisttop" value="<?=$row['upgrade_type_list']?>">
        <input type="hidden" name="ifindextop" value="<?=$row['upgrade_type_index']?>">
        <input type="hidden" name="ac" value="actionupgrade">
        <div class="datatablewrap">
            <table class="datatable">
                    <thead>
                        <tr>
                            <td>Popularize My Posts</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                            <td>
                            <a href="../information.php?id=<?=$id?>" target="_blank" style="float:left; font-weight:bold; line-height:22px"><?=$row['title']?></a> <?php if($row['upgrade_type'] == 2) echo '<span class="refreshed">Placed at the Top of the Broad Headings</span>'; ?>  <?php if($row['upgrade_type_list'] == 2) echo '<span class="refreshed">Placed at the Top of the Broad Headings</span>'; ?> <?php if($row['upgrade_type_index'] == 2) echo '<span class="refreshed">Placed at the Top of the Homepage</span>'; ?>
							
							</td>
                    </tr>
                    <tr>
                      <td>
							<select name="upgrade_type" id="upgrade_type">
                                <option value="cfg_member_upgrade_top">Place at the Top of the Broad Headings</option>
								<option value="cfg_member_upgrade_list_top">Place at the Top of the Sub-headings</option>
                                <option value="cfg_member_upgrade_index_top">Display on Homepage</option>
                            </select></td>
                    </tr>
                    <tr>
                      <td><?=GetUpgradeTime()?></td>
                    </tr>
                    </tbody>
                </table>
        </div>
        <div class="clearfix current_action_money">You currently have <font color="red"><?=$money_own?></font>coins. Coins that will be deducted: <span style="color:red"><font id="total">0</font></span></div>
        <div class="clearfix datacontrol">
                <div class="dataaction">
                    <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Confirm Submission of Topping Selection(?)" class="button" name="actionupgrade" <?php if($row['upgrade_type'] == 2 && $row['upgrade_type_list'] == 2 && $row['upgrade_type_index'] == 2) echo 'disabled';?>></span></span> 
                </div>
            </div>
        </form>
		<script language="javascript">
            function calculate() 
            {
                var ID0=document.getElementById("upgrade_type").value; 
                var ID1=document.getElementById("upgrade_time").value; 
                var ID2=document.getElementById("total").value;
                if(ID0 == "cfg_member_upgrade_top"){
                    document.getElementById("total").innerHTML=(<?php echo $mymps_global[cfg_member_upgrade_top]?>*ID1);
                }else if(ID0 == "cfg_member_upgrade_list_top"){
                    document.getElementById("total").innerHTML=(<?php echo $mymps_global[cfg_member_upgrade_list_top]?>*ID1);
                }else{
                    document.getElementById("total").innerHTML=(<?php echo $mymps_global[cfg_member_upgrade_index_top]?>*ID1);
                }
                
                if(ID0==""||ID1=="") 
                ID2="";
                setTimeout("calculate()",30);
            } 
            calculate();
        </script>
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