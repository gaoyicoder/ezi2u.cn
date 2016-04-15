<?=mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
    <td><strong><?=$nav_path?></strong></td>
  </tr>
  <tr align="center" bgcolor="#ffffff">
    <td align="left" height="100">
    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
    <tr>
    <td colspan='2' ><font color='green'><b>&radic; <?=$message?>£º</b></font></td>
    </tr>
    <tr>
    <td colspan='2' style="height:120px;border-bottom:none;"> 
	Please select your subsequent operation(s): <?=$after_action?>
     </td>
    </tr>
    </table>
	</td>
  </tr>
</table>
</div>
<?=mymps_admin_tpl_global_foot();?>
