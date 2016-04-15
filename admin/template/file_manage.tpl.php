<?php mymps_admin_tpl_global_head();?>
<?php if($part == 'template'){?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
			<li><a href="template.php">Default Template Settings</a></li>
			<li><a href="file_manage.php" class="current">Online Style Editing</a></li>
			</ul>
		</div>
	</div>
</div>
<?php }?>
<div class="ccc2">
    <ul>
        <img src="../images/warn.gif" align="absmiddle"> Note on Safety: we recommend that the current editing template </span>£º<?=$cfg_if_tpledit?> be enabled unless very necessary. You may disable it by making changes to /data/config.inc.php.
    </ul>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr" align="left">
    <td><?=$mulu?><b style="color:red">¡¾Current Directory: <?=$path?>¡¿</b></td>
  </tr>

  <tr align="center" bgcolor="#ffffff">
    <td>
<?php
$fso=@opendir($path);
while ($file=@readdir($fso)) 
{
	$fullpath	= "$path/$file";
	$is_dir		= @is_dir($fullpath);
	if($is_dir=="1")
    {
        if($file!=".."&&$file!=".")	
        {?>
        <li style="float:left; margin:10px"><a href="?part=<?=$part?>&path=<?=$fullpath?>"><img src="template/images/dir.gif" border="0" align="absmiddle"> <?=$file?></a></li>
      <?} 
        else 
        {
            if($file!=".."&&$path!=$showdir)
            {
            ?>
                <div align="left" style="border-bottom:#e1f2fc 1px solid; padding:0 0 5px 0">
                <a href="?part=<?=$part?>&path=<?=$LastPath?>">
                <img src="template/images/file_topdir.gif" border="0" align="absmiddle">Parent Directory</a>
                </div>
            <?
            }
        }
	}
}
@closedir($fso); 
?>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr"> 
        <td><b>File Name</b></td>
        <td><b>Date of Change</b></td>
        <td><b>File Size</b></td>
        <td><b>Operation</b></td>
      </tr>
<?php
$fso=@opendir($path);
while ($file=@readdir($fso)) {
	$fullpath	= "$path/$file";
	$is_dir		= @is_dir($fullpath);
	if($is_dir=="0"){
	$size=@filesize("$path/$file");
	$size=@getSize($size);
	$lastsave=@date("Y-n-d H:i:s",filemtime("$path/$file"));
    $image_uri = $part == 'template' ? $mymps_global[SiteUrl].'/'.$part.'/default'.str_replace($showdir,'',$fullpath) : $mymps_global[SiteUrl].'/attachment'.str_replace($showdir,'',$fullpath);
    ?>
    <tr bgcolor="white">
    <?php if(is_pic($file)=='yes'){?>
    <td><a href="<?=$image_uri?>" target="_blank" onMouseOut="closediv('<?=$file?>')"><img src="<?=FileImage($fullpath)?>" border="0" align="absmiddle"> <?=$file?></a></td>
    <?}else{?>
    <td bgcolor="white"><img src="<?=FileImage($fullpath)?>" border="0" align="absmiddle"> <?=$file?></td>
    <?}?>
	<td><?=$lastsave?></td>
    <td bgcolor="white"><?=$size?></td>
	<td align="center">
    <a href="?downfile=<?=$fullpath?>">Download</a> / 
    <a href="?editfile=<?=$fullpath?>">Edit</a> / 
    <a href="?part=<?=$part?>&delfile=<?=$fullpath?>&url=<?=urlencode(getUrl())?>" onClick="return confirm('We strongly recommend that nothing here be deleted unless necessary. Are you sure you want to continue?')">Delete</a> </td>
	</tr>
    <?php
	}
}
@closedir($fso); 
?>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>
