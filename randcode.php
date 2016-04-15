<?php
error_reporting(E_ALL^E_NOTICE);
__FILE__ == '' && die('Fatal error code: 0');

define('IN_MYMPS',true);
define('CURRENTDIR',dirname(__FILE__));
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}

@set_magic_quotes_runtime(0);

if (defined('DEBUG_MODE') == false) define('DEBUG_MODE', 0);

if(PHP_VERSION < '4.1.0') {
	$_GET =	&$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	unset($HTTP_GET_VARS,$HTTP_SERVER_VARS);
}

$part = isset($_GET['part']) ? trim($_GET['part']) : 'authcode';
$wid = isset($_GET['wid']) ? intval($_GET['wid']) : '180';
!in_array($part,array('authcode','contact')) && exit('Access Denied');
if($part == 'authcode') {
	$action = isset($_GET['action']) ? trim($_GET['action']) : 'action';
	if($action == 'preview'){
		authcode();
	} elseif($action == 'action') {
		session_save_path(CURRENTDIR.'/data/sessions');
		session_start();
		$_SESSION['chkcode'] = '';
		$_SESSION['chkcode'] = authcode();
	}
} elseif($part == 'contact') {
	$height = "22";
	$strings = base64_decode(trim($_GET['strings']));
	$image = imagecreatetruecolor($wid,$height);
	$black = imagecolorallocate($image,50,0,50);
	$white = imagecolorallocate($image,255,255,255);
	imagefill($image,0,0,$white);
	imagestring($image,4,0,1,$strings,$black);
	header("Content-type: image/png");
	imagepng($image);
	imagedestroy($image);
	unset($wid,$height,$strings,$image,$black,$white);
}

$part = $action = $timestamp =NULL;

function authcode()
{
	@include CURRENTDIR.'/data/caches/authcodesettings.php';
	if(function_exists("imagecreatetruecolor") && function_exists("imagecolorallocate") && function_exists("imagestring") && function_exists("imagepng") && function_exists("imagesetpixel") && function_exists("imagefilledrectangle") && function_exists("imagerectangle") && function_exists("imageline")){
		$randnum = '';
		$width	 = '80';
		$height  = '25';
		$count	 = '4';
		$pixnoise  = $data['noise'] != '' ? $data['noise'] : 30;
		$linenoise = $data['line'] != '' ? $data['line']  : 3;
		$snownoise = $data['snow'] != '' ? $data['snow'] : 30;
		$authcodetype = !empty($data['type']) ? $data['type'] : 'engber';
		$authcodetype = $authcodetype == 'rand' ? array_rand(array('english'=>1,'number'=>2,'chinese'=>3,'plus'=>4,'minus'=>5,'engber'=>6),1) : $authcodetype;

		$widthx = floor($width / 4);
		$data = NULL;
		
		//$image  = imagecreatetruecolor($width,$height);
		$background = array('background1.jpg','background2.jpg','background3.jpg','background4.jpg','background5.jpg');
		$image	= imagecreatefromjpeg(CURRENTDIR.'/images/authcode/'.$background[array_rand($background,1)]);
		//imagefilledrectangle($image,0,0,$width,$height,imagecolorallocate($image,255,255,255));
		//imagerectangle($image,0,0,$width-1,$height-1,imagecolorallocate($image,180,180,180));
		$sjamcolor = imagecolorallocate($image,rand(0,100),rand(0,100),rand(50,250));//�����ص���ɫ
		$fontcolor = imagecolorallocate($image,rand(10,30),rand(90,120),rand(240,250));//��֤�����ɫ
		for ($i = 0; $i < $pixnoise; $i++) {
			imagesetpixel($image,rand(0,$width),rand(0,$height),$sjamcolor);
		}
		for($i = 0; $i < $linenoise; $i++){
			imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$sjamcolor);
		}
		for ($i=1; $i < $snownoise; $i++) {
			imagestring($image,5,rand(0,$width),rand(0,$height),'*',imagecolorallocate($image,rand(200,255),rand(200,255),rand(200,255)));
		}
		
		unset($snownoise);
		$fontfile = array('english.ttf','FetteSteinschrift.ttf','PilsenPlakat.ttf');
		//$fontfile = array('FetteSteinschrift.ttf');
		$fontfile = CURRENTDIR.'/data/ttf/'.$fontfile[array_rand($fontfile,1)];
		if(in_array($authcodetype,array('english','number','engber'))) {
			$randnum = randstr($authcodetype);
			imagettftext($image, 12, 2, $width*0.1, $height*1, $fontcolor, $fontfile, $randnum);
		}elseif($authcodetype == 'plus') {
			$plus1 = rand(10,20);
			$plus2 = rand(10,20);
			$randnum = $plus1+$plus2;
			$output  = $plus1.'+'.$plus2.'=?';
			imagettftext($image, 12, 2, $width*0.1, $height*1, $fontcolor, $fontfile, $output);
		}elseif($authcodetype == 'minus') {
			$plus1 = rand(20,30);
			$plus2 = rand(10,20);
			$randnum = $plus1-$plus2;
			$output  = $plus1.'-'.$plus2.'=?';
			imagettftext($image, 12, 2, $width*0.1, $height*1, $fontcolor, $fontfile, $output);
		}elseif($authcodetype == 'chinese') {
			unset($widthx);
			$fontfile = CURRENTDIR."/data/ttf/heiti.ttf";
			$str = "抗苏显苦英快称坏移约巴材省黑武培着河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫送获兴独官混纪依未突架七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批如应形想制心样干都向变关点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页";
			$str = iconv("UTF-8","GB2312",$str);
			$rand=rand(0,strlen($str)-4);
			if($rand%2)$rand+=1;
			$randnum = substr($str,$rand,8);
			$output = iconv("GB2312","UTF-8",$randnum);
			imagettftext($image, 12, 2, $width*0.1, $height*1, $fontcolor, $fontfile, $output);
		}
		header('Pragma:no-cache');
		header('Cache-control:no-cache');
		header('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
	}
	$pixnoise = $width = $height = $count = $authcodetype = $output = $image = NULL;
	return $randnum;
}
function randstr($type='engber')
{
	$hash = '';
	if($type == 'number') {
		$chars = '0123456789';
	} elseif($type == 'english') {
		$chars = 'abcdefghijklmnopqrstuvwxyz';
	} elseif($type == 'engber'){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
	}
	$max = strlen($chars) - 1;
	mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < 4; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	$max = $chars = $type = NULL;
	$hash = strtoupper($hash);
	return $hash;
}
?>
