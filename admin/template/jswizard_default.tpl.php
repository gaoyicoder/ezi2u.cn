<?php mymps_admin_tpl_global_head();?>

<style>
.smalltxt{ font-size:12px!important; color:#999!important; font-weight:100!important}
.altbg1{ background-color:#f1f5f8}
</style>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?part=settings">Basic Settings</a></li>
                <li><a href="?" class="current">Management of Items to be invoked</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <form method="get" action="?">
    <input name="part" value="add" type="hidden">
    <tr class="firstr"><td>Add Data Invoking Script</td></tr>
    <tr bgcolor="#ffffff">
    <td>
    <span style="display:block; float:left; margin-top:6px; font-size:12px">Unique Sign: </span><input type="text" name="flag" value="<?=$randam?>" class="text" style="line-height:18px"/>
    <input type="submit" value="Add Item to be Invoked" class="gray mini"/>
    </td>
    </tr>
    </form>
</table>
</div>
<form name='form1' method='post' action='?'>
<input name="forward_url" value="<?=GetUrl()?>" type="hidden">
<input name="part" value="<?=$part?>" type="hidden"/>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td width="5%"><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/>Delete?</td>
<td width="15%">Unique Sign</td>
<td width="15%">Add Time</td>
<td>Invoke Code</td>
</tr>

<?php 
if(is_array($jswizard)){
	foreach($jswizard as $key => $val){?>
<tr bgcolor="white">
  <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$val[id]?>' id="<?=$val[id]?>"></td>
  <td><a href="?part=detail&id=<?=$val['id']?>"><?=$val['flag']?></a></td>
  <td><?=GetTime($val['edittime'])?></td>
  <td><a href="javascript:void(0);" onclick="setbg('Invoke Post Data',550,110,'../box.php?part=jswizard&flag=<?=$val[flag]?><?php if($val['jscharset'] == 1) echo '&jscharset=1'; ?>')">Invoke</a></td>
</tr>
<?php 
	}
}
?>

</table>
</div>
<center>
<input type="submit" value="Submit" class="mymps large" name="<?=CURSCRIPT?>_submit"/>  
</center>
</form>
<div class="pagination"><?php echo page2();?></div>
<?php mymps_admin_tpl_global_foot();?>
