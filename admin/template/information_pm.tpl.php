<?php mymps_admin_tpl_global_head();?>



<form action="?" name="form1" method="post">

<input name="url" value="<?=$url?>" type="hidden">

<input name="action" value="<?=$do_action?>" type="hidden">

<input name="id" value="<?=$id?>" type="hidden">

<input name="typeid" value="<?=$typeid?>" type="hidden">

<input name="userid" value="<?=$userid?>" type="hidden">

<input name="part" value="sendpm" type="hidden" />

<?php if(in_array($do_action,array('upgrade_index','upgrade','upgrade_list'))){?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

	<td class="h" style="text-align:right">Topping Period</td><td class="h">&nbsp;</td>

</tr>

<tr bgcolor="#f5fbff">

    <td width="20%" style="text-align:right;">Your Selection of Topping Type: </td>

    <td bgcolor="white">

    <font color="red"><?php echo $do_action == 'upgrade_index' ? 'Place at the Top of the Homepage' :( $do_action == 'upgrade_list' ? 'Place at the Top of the Sub-headings' : 'Place at the Top of the Broad Headings'); ?></font>

    </td>

</tr>

<tr bgcolor="#f5fbff">

    <td width="20%" style="text-align:right;">Please select topping period: </td>

    <td bgcolor="white">

    <?=GetUpgradeTime()?>

    </td>

</tr>

</table>

</div>

<?php }?>

<?php if(in_array($do_action,array('ifred'))){?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr bgcolor="#f5fbff">

    <td width="20%" style="text-align:right;">Redden Post Title or Not: </td>

    <td bgcolor="white">

        <select name="ifred">

            <option value="1">Redden</option>

            <option value="0">Cancel Reddening</option>

        </select>

    </td>

</tr>

</table>

</div>

<?php }?>

<?php if(in_array($do_action,array('ifbold'))){?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr bgcolor="#f5fbff">

    <td width="20%" style="text-align:right;">Overstrike Post Title or Not: </td>

    <td bgcolor="white">

        <select name="ifbold">

            <option value="1">Overstrike</option>

            <option value="0">Cancel Overstriking</option>

        </select>

    </td>

</tr>

</table>

</div>

<?php }?>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr"><td class="h" style="text-align:right">Management Settings</td><td class="h">&nbsp;</td></tr>

	<tr bgcolor="#f5fbff">

		<td width="20%" style="text-align:right;">Coin Management: </td>

        <td bgcolor="white">

			<input type="radio" class="radio" name="if_money" value="1" onClick="this.form.money_num.disabled=false"/>On

			<input type="radio" class="radio" name="if_money" value="0" checked onClick="this.form.money_num.disabled=true"/>Off

		</td>

	</tr>

    

	<tr bgcolor="#f5fbff">

		<td width="20%" style="text-align:right;">Coin Number Change: </td>

        <td bgcolor="white">

            <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle">

            <input name="money_num" disabled="disabled" value="<?php echo $nummoney ? $nummoney : '+2';?>" style="width:40px; margin-top:5px">(Use + for coin adding; - for coin deducting)

		</td>

	</tr>



	<tr bgcolor="#f5fbff">

		<td width="20%" style="text-align:right;">Notice through Message: </td>

		<td bgcolor="white">

			<input type="radio" class="radio" name="if_pm" value="1" onClick="this.form.because.disabled=false;this.form.msg.disabled=false;this.form.title.disabled=false"/>Yes

			<input type="radio" class="radio" name="if_pm" value="0" checked onClick="this.form.because.disabled=true;this.form.msg.disabled=true;this.form.title.disabled=true"/>No

		</td>

	</tr>

    

	<tr bgcolor="#f5fbff">

		<td width="20%" style="text-align:right;">Notice Title: </td>

		<td>

			<input name="title" value="<?=$title?>" id="title" class="text" style="width:300px"/>

		</td>

	</tr>

    

	<tr bgcolor="#f5fbff">

		<td style="text-align:right;">Notice Content: </td>

		<td bgcolor="white">

        <select name="because" disabled="disabled" size="10" multiple onchange="this.form.msg.value=this.value">

            <option value="">Customize</option>

            <?php foreach($info_do_type as $k=>$v){?>

            	<optgroup label="<?=$k?>"><?=$k?></optgroup>

                <?php foreach ($v as $w=>$m){?>

                	<option value="<?=$m?>"><?=$m?></option>

                <?}?>

            <?}?>

        </select>&nbsp;&nbsp;

        <textarea name="msg" disabled="disabled" rows="10" cols="80"></textarea>

		</td>

	</tr>

    

	<tr bgcolor="#f5fbff">

    <td>&nbsp;</td>

    <td bgcolor="white">

    <input type="submit" value="Submit" style="margin-left:5px;" class="mymps mini" name="<?=CURSCRIPT?>_submit"/>&nbsp;&nbsp;

    <input type="button" onclick="javascript:history.go(-1)" class="mymps mini" value="Return"/>

	</td>

    </tr>

</table>

</div>

</form>

<?php mymps_admin_tpl_global_foot();?>

