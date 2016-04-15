<?php
$html_type = array();
/*栏目静态目录存放形式*/
$html_type[1] = 'By Column ID';
$html_type[2] = 'By Pinyin';
$html_type[3] = 'By Alphabetical Order (of Column Initial)';
$html_type[4] = 'Customize List Name';


//以下不要修改
function GetHtmlType($dir_type='',$formname='dir_type',$form_type='edit',$mydirval=''){
	global $html_type;
	if($form_type == 'edit'){
		$GetHtmlTypeForm = "<select name='$formname' id='$formname' onchange='if(this.options[this.selectedIndex].value == 4){document.getElementById(\"mydir\").style.display = \"block\"}else{document.getElementById(\"mydir\").style.display = \"none\"}'>";
		foreach($html_type as $k=>$v){
			if($k == $dir_type) {
				$GetHtmlTypeForm .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
			} else {
				$GetHtmlTypeForm .= "<option value='$k'>$v</option>\r\n";
			}
		}
		$GetHtmlTypeForm .= "</select>\r\n";
		$GetHtmlTypeForm .= "<div><br /><input name=\"mydir\" type=\"text\" class=\"text\" id=\"mydir\" ";
		//$GetHtmlTypeForm .= ($dir_type != '4') ? " " : " ";
		$GetHtmlTypeForm .= " value=".$mydirval."></div>";
	} elseif($form_type == 'add') {
		$GetHtmlTypeForm = "<select name='$formname' id='$formname'>";
		foreach($html_type as $k=>$v){
			if($k != '4'){
				if($k == $dir_type) {
					$GetHtmlTypeForm .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
				} else {
					$GetHtmlTypeForm .= "<option value='$k'>$v</option>\r\n";
				}
			}
		}
		$GetHtmlTypeForm .= "</select>\r\n";
	}
	
	return $GetHtmlTypeForm;
}
?>