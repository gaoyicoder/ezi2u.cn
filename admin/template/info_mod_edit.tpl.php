<?php include mymps_tpl('inc_head');?>
<script type="text/javascript">
function copyoption(s1, s2) {
	//alert('99999999:'+s1);
	var ss1 = document.form1.coptselect;
	var ss2 = document.form1.moptselect;
	var len = ss1.options.length;
	for(var i=0; i<len; i++) {
		op = ss1.options[i];
		if(op.selected == true && !optionexists(ss2, op.value)) {
			o = op.cloneNode(true);
			ss2.appendChild(o);
			//alert('99999999:'+op.value);
		}
	}
	ss2.focus();
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
	var ss1 = document.form1.moptselect;
	var len = ss1.options.length;
	for(var i=ss1.options.length - 1; i>-1; i--) {
		op = ss1.options[i];
		if(op.selected && op.selected == true) {
			ss1.removeChild(op);
		}
	}
	return false;
}

function selectalloption(s1) {
	var ss1 = document.form1.moptselect;
	var len = ss1.options.length;
	for(var i=ss1.options.length - 1; i>-1; i--) {
		op = ss1.options[i];
		op.selected = true;
	}
}

function move(index,to) {
	var list = document.form1.moptselect;
	var total = list.options.length-1;
	if (index == -1) return false;
	if (to == +1 && index == total) return false;
	if (to == -1 && index == 0) return false;
	var items = new Array;
	var values = new Array;
	for (i = total; i >= 0; i--) {
		items[i] = list.options[i].text;
		values[i] = list.options[i].value;
	}
	for (i = total; i >= 0; i--) {
	if (index == i) {
		list.options[i + to] = new Option(items[i],values[i + to], 0, 1);
		list.options[i] = new Option(items[i + to], values[i]);
		i--;
	} else {
		list.options[i] = new Option(items[i], values[i]);
	   }
	}
	list.focus();
}
</script>
<form method="post" name="form1" action="?part=mod&action=update" onsubmit="selectalloption('moptselect');">
<input name="id" value="<?=$edit['id']?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td colspan="2">Basic Settings  on Categorized Options</td>
    </tr>
    <tr bgcolor="#f5fbff">
      <td width="15%">Model Name</td>
      <td bgcolor="#f5fbff"><input name="name" value="<?=$edit['name']?>" type="text" class="text"></td>
    </tr>
    <tr bgcolor="#f5fbff">
      <td width="15%">Order of Display</td>
      <td bgcolor="#f5fbff"><input name="displayorder" value="<?=$edit['displayorder']?>" type="text" class="text"></td>
    </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellpadding="0" cellspacing="0" class="vbm">
    <tr class="firstr">
    <td colspan="3">Model Option Settings</td>
    </tr>
    <tr>
    <td width="15%" bgcolor="#f5fbff"><b>Model Field</b></td>
    <td bgcolor="#f5fbff" width="300">
    <select name="options[]" size="10" multiple="multiple" style="width: 300px" id="moptselect">
    <?php if(is_array($options)){foreach ($options as $k=>$value){
        $get=$db->getRow("SELECT optionid,title,type,identifier FROM `{$db_mymps}info_typeoptions` WHERE optionid = '$value'");
    	?>
        <option value="<?=$value?>"><?=$get[title]?> / <?=$get[identifier]?> / <?=$get[type]?></option>
	<?}}?>
    </select><br /><a href="###" onclick="removeoption('moptselect')">[Delete]</a>    </td>
    <td bgcolor="#f5fbff" title="left">
	<input type="button" value="U  p" 
onClick="move(this.form.moptselect.selectedIndex,-1)"><br><br>
<input type="button" value="Down"
onClick="move(this.form.moptselect.selectedIndex,+1)">
	</td>
    </tr>
    <tr>
    <td width="15%" bgcolor="#f5fbff"><b>Available System Field</b></td>
    <td colspan="2" bgcolor="#f5fbff">
    <select name="" size="20" multiple="multiple" style="width: 300px" id="coptselect">
    <?php echo $opt;?>
    </select>
    <br /><a href="###" onclick="copyoption('coptselect', 'moptselect')">[Add to Model Options]</a>    </td></tr>
    </table>
</div>
<center>
<input type="submit" value="Submit" class="mymps large" <?php if($edit['id'] == 1) echo 'disabled'; ?>/>
<input type="button" onclick="location.href='?part=mod&action=list';" value="Return" class="gray large">
</center>
<?php mymps_admin_tpl_global_foot();?>