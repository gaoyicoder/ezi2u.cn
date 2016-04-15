<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?=$action?>Post - <?=$post[title]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.common.js" type="text/javascript"></script> 
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.js" type="text/javascript"></script>
</head>
<body class="<?=$mymps_global[cfg_tpl_dir]?>" onload="<?=$onload?>">
<? include mymps_tpl('inc_head_post');?>
<div class="body1000">
	<div class="clear15"></div>
	<div class="clear15"></div>
	<div class="wrapper" id="main">
		<div class="step1">
			<? if($action == 'Edit'){?>
            <span class="cur"><font class="number">1</font>Enter Post Password</span>
            <span><font class="number">2</font>Enter Content Of Post</span>
            <span><font class="number">3</font>Complete Post Editing</span>
            <? }elseif($action == 'Delete'){?>
            <span class="cur"><font class="number">1</font>Enter Post Password</span>
            <span><font class="number">2</font>Delete Made Post</span>
			<span><font class="number">3</font>Post Successfully Deleted</span>
            <? }?>
		</div>
	</div>
    <div class="clearfix"></div>
	<div id="fenlei2">
	<div class="publish-detail">
    <form  name="form1" method="post" onSubmit="return postcheck();" 
    <? if($action == 'Edit'){?>action="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?action=edit&id=<?=$post[id]?>"
    <? }elseif($action == 'Delete'){?>
    action="<?=$mymps_global[SiteUrl]?>/member/info.php?part=del&id=<?=$post[id]?>"
    <? }?>
    >
        <table cellpadding="0" cellspacing="0" class="write_pwd">
        <tr>
            <td class="tdright" style="height:30px!important;">Post Title: </td>
            <td style="font-size:14px; color:red; font-weight:bold;"><?=$post[title]?></td>
        </tr>
        <tr>
            <td class="tdright" style="height:30px!important;">Post Password: </td>
            <td><input type="password" class="input" style="width:300px" name="manage_pwd" require="true" datatype="limit" msg="Please enter the Post Password for this post."/></td>
        </tr>
        <tr>
            <td valign="bottom" align="right">&nbsp;</td>
            <td height="30" valign="bottom"><input type="submit" name="mymps" value="Next step" class="fabu1"></td>
        </tr>
        </table>
        </form>
	 </div>
     </div>
    <div class="clear"></div>
    <? include mymps_tpl('inc_foot_about');?>
</div>
<script language="javascript" type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator3.js"></script> 
</body>
</html>
