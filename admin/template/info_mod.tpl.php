<?php mymps_admin_tpl_global_head();?>

<script type="text/javascript">

function copyoption(s1, s2) {

	var s1 = $(s1);

	var s2 = $(s2);

	var len = s1.options.length;

	for(var i=0; i<len; i++) {

		op = s1.options[i];

		if(op.selected == true && !optionexists(s2, op.value)) {

			o = op.cloneNode(true);

			s2.appendChild(o);

		}

	}

}



function optionexists(s1, value) {

	var len = s1.options.length;

		for(var i=0; i<len; i++) {

			if(s1.options[i].value == value) {

				return true;

			}

		}

	return false;

}



function removeoption(s1) {

	var s1 = $(s1);

	var len = s1.options.length;

	for(var i=s1.options.length - 1; i>-1; i--) {

		op = s1.options[i];

		if(op.selected && op.selected == true) {

			s1.removeChild(op);

		}

	}

	return false;

}



function selectalloption(s1) {

	var s1 = $(s1);

	var len = s1.options.length;

	for(var i=s1.options.length - 1; i>-1; i--) {

		op = s1.options[i];

		op.selected = true;

	}

}

</script>

<form name='form1' method='post' action='?part=mod&action=delall'>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

   

    <tr class="firstr">

      <td width="50"><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/>Delete?</td>

      <td width="50">Number</td>

      <td>Name</td>

      <td>Order of Display</td>

      <td>Edit</td>

    </tr>

<tbody onmouseover="addMouseEvent(this);">

<?php foreach($mod as $k =>$value){?>

    <tr align="center" bgcolor="white">

      <td><input type='checkbox' class="checkbox" name='id[]' value='<?=$value[id]?>' <?php if($value[type]=='1'){echo "disabled";}?>/></td>

      <td><?=$value[id]?></td>

      <td><?=$value[name]?></td>

      <td><?=$value[displayorder]?></td>

      <td><a href="?part=mod&action=edit&id=<?=$value[id]?>">Details</a></td>

    </tr>

<?}?>

	</tbody>

	</table>

	</div>

<center><input type="submit" onClick="if(!confirm('Are you sure you want to delete this model? \n\n This cannot be undone!'))return false;" value="Submit" class="mymps large"/></center>

</form>

<div class="clear" style="height:10px;"></div>

<form action="?part=mod&action=insert" method="post" name="form2">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

    <td colspan="2">Add Model</td>

    </tr>

    <tr bgcolor="#ffffff">

      <td width="15%"><b>Model Name</b></td>

      <td><input name="name" type="text" class="text"></td>

    </tr>

    <tr bgcolor="#ffffff">

      <td><b>Order of Display</b></td>

      <td><input name="displayorder" type="text" class="text" value="0"></td>

    </tr>

    </table>

</div>

<center><input type="submit" value="Submit" class="mymps large"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

