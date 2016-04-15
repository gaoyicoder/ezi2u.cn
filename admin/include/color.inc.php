<?php
$color = array(
	"#ff0000"=>'Red',
	"#006ffd"=>'Deep Blue',
	"#444444"=>'Light Blue',
	"#000000"=>'Black',
	"#46a200"=>'Green',
	"#ff9900"=>'Yellow',
	"#ffffff"=>'White'
);

function get_color_options($tcolor=''){
	global $color;
	foreach ($color as $k  => $v){
		$mymps .= '<option value='.$k.' style=background-color:'.$k;
		if($k == $tcolor) $mymps .= ' selected';
		$mymps .= '>'.$v.'</option>';
	}
	return $mymps;
}
?>