<?php
if (!defined('IN_MYMPS'))
{
    die('FORBIDDEN');
}
//user for option_edit
$mymps_admin_info_type=array(
	"number"=>'
		<tr>
		<td bgcolor="#f5fbff" width="45%" ><b>Maximal Value (Selectable):</b></td>
		<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[number][maxnum]" value="'.$rules.'" >
		</td>
		</tr>
		<tr>
		<td bgcolor="#f5fbff" width="45%" ><b>Minimal Value (Selectable):</b></td>
		<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[number][minnum]" value="'.$rules.'" >
		</td>
		</tr>
		',
	"text"=>'
		<tr>
		<td bgcolor="#f5fbff" width="45%" >
		<b>Maximum Length of Content(Selectable):</b>
		</td>
		<td bgcolor="#f5fbff">
		<input type="text" size="50" name="rules[text][maxlength]" value="'.$rules.'" >
		</td>
		</tr>
		',
	"textarea"=>'
		<tr>
		<td bgcolor="#f5fbff" width="45%" >
		<b>Minimum Length of Content(Selectable):</b>
		</td>
		<td bgcolor="#f5fbff">
		<input type="text" size="50" name="rules[textarea][maxlength]" value="'.$rules.'" >
		</td>
		</tr>
		',
	"select"=>'
		<tr>
		<td bgcolor="#f5fbff" width="25%">
		<b>Option contents:</b><br />Valid only when the column can be selected. Options are placed one line at a time, with option indexes (application of number recommended) and option contents placed respectively in front of and behind the "=". Example: <br /><i>1 = Optical Mouse<br />2 = Mechanical Mouse<br />3 = No Mouse</i><br /><br />Note: Once an option is set, so is the relation between its index and content, so please do not make further changes to it. However, adding options is still possible. Should you wish to change the order of display of an option, move its line up or down.</td>
		<td bgcolor="#f5fbff">
	<textarea rows="8" name="rules[select][choices]" id="rules[select][choices]" cols="50">'.$rules.'</textarea>
		</td>
		</tr>
		',
	"radio"=>'
		<tr>
		<td bgcolor="#f5fbff" width="45%">
		<b>Option contents:</b><br />Valid only when the column can be selected. Options are placed one line at a time, with option indexes (application of number recommended) and option contents placed respectively in front of and behind the "=". Example: <br /><i>1 = Optical Mouse<br />2 = Mechanical Mouse<br />3 = No Mouse</i><br />Note: Once an option is set, so is the relation between its index and content, so please do not make further changes to it. However, adding options is still possible. Should you wish to change the order of display of an option, move its line up or down.
		</td>
		<td bgcolor="#f5fbff">
		<textarea  rows="8" name="rules[radio][choices]" id="rules[radio][choices]" cols="50">'.$rules.'</textarea>
		</td>
		</tr>
		',
	"checkbox"=>'
		<tr>
		<td bgcolor="#f5fbff" width="45%">
		<b>Option contents:</b><br />Valid only when the column can be selected. Options are placed one line at a time, with option indexes (application of number recommended) and option contents placed respectively in front of and behind the "=". Example: <br /><i>1 = Optical Mouse<br />2 = Mechanical Mouse<br />3 = No Mouse</i><br />Note: Once an option is set, so is the relation between its index and content, so please do not make further changes to it. However, adding options is still possible. Should you wish to change the order of display of an option, move its line up or down.</td>
		<td bgcolor="#f5fbff">
		<textarea  rows="8" name="rules[checkbox][choices]" id="rules[checkbox][choices]" cols="50">'.$rules.'</textarea>
		</td>
		</tr>
		',
	"image"=>'
		<tr>
		<td bgcolor="#f5fbff" width="45%" ><b>Maximum Width of Picture (Selectable):</b></td>
		<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[image][maxwidth]" value="'.$rules.'" >
		</td>
		</tr>
		<tr>
		<td bgcolor="#f5fbff" width="45%" ><b>Maximum Height of Picture (Selectable):</b></td>
		<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[image][maxheight]" value="'.$rules.'" >
		</td>
		</tr>
		'
);

$var_type= array(
	'text'=>'String',
	'number'=>'Number',
	'textarea'=>'Text',
	'radio'=>'Multiple Choice with Single Pick',
	'checkbox'=>'Multiple Choice with Multiple Pick',
	'select'=>'Select',
	'age'=>'Age',
	'email'=>'Email Address',
	'image'=>'Picture',
	'url'=>'Hyperlink',
	'calendar'=>'Calendar'
);


function get_info_var_type($type,$name,$value){
	switch($type){
		case 'text':
			str.="<input name=\"".$name."\" value=\"".$value."\">";
		break; 
		case 'textarea':
			str.="<textarea name=\"".$name."\">".$value."</textarea>";
		break;
		case 'radio':
			$str.="<input name=\"".$name."\" type=\"radio\">";
		break;
		case 'checkbox':
			$str.="<input name=\"".$name."\" type=\"checkbox\">";
		break;
		case 'select':
			$str.="<select name=\"".$name."\">";
			$str.="<option value=\"".$value."\"></option>";
			$str.="</select>";
		break;
	}
	return $str;
}
?>
