<?php
$adv_target = array(
	'All'=> 'all',
	'Index'=>'index'
);

$vbm_adv_type = array();
$vbm_adv_type[normalad][name] 	= '[Customized] Ordinary Advertisement
';
$vbm_adv_type[normalad][notice] = '<li><strong>Method of Application</strong>Apply the JS Application, copy & print the JS code obtained from the addition of the ad to the corresponding space on the template. 
</li>';

$vbm_adv_type[topbanner][name] 	= '[System] Top-banner Advertisement';
$vbm_adv_type[topbanner][notice] = '<li><strong>Display:</strong> A top-banner advertisement appears like a banner on the top of a web page, contents usually being 1000(1200 for wide screen)*60 pictures or flash movies.
</li><li><strong>Potential: </strong> This is the best choice of ad for commercial and brand promotion because it displays the content on the most eye-catching space at the opening of a page. Therefore placing an ad of this kind is one of the most expensive.
</li>';

$vbm_adv_type[headerbanner][name] 	= '[System] Under-navigation Advertisement';
$vbm_adv_type[headerbanner][notice] = '<li><strong>Display: </strong> Under-navigation Advertisement displays the content under the navigation section. It is usually comprised of 7 134*72 pictures or one 1000(1200 for wide screen)*60 picture or a flash movie.
</li><li><strong>Potential: </strong> This is the best choice of ad for commercial and brand promotion because it displays the content on the most eye-catching space at the opening of a page. Therefore placing an ad of this kind is one of the most expensive.</li>';

$vbm_adv_type[footerbanner][name] 	= '[System] Bottom-banner Advertisement';
$vbm_adv_type[footerbanner][notice] = '<li><strong>Display: </strong>  Bottom-banner Advertisement displays the content somewhere between the middle and the bottom of the page. It is usually comprised of a 1000(1200 for wide screen)*60 picture (or pictures of other size) or a flash movie.
</li><li><strong>Potential: </strong> Compared to ads placed at the top or middle of a page, Bottom-banner Advertisements are less probably to be seen. Thus such ads can usually avoid being desliked by the viewers and be spotted by most viewers interested in the content. Therefore this type is suitable for unaggressive promotion of contents acceptable to the majority.</li>';

$vbm_adv_type[floatad][name] 	= '[System] Floating Advertisement';
$vbm_adv_type[floatad][notice] 	= '<li>
<strong>Display: </strong>  Floating Advertisement are usually fixed at the bottom-right of the display (and does not subject to the movement of the page), with contents normally small pictures or small-sized flash movies. When multiple floating advertisements are assigned to one single page, the system will randomly pick one of them for display. </li><li><strong>Potential: </strong> Placing a floating advertisement is a powerful way of commercial promotion due to the fact that "floating" contents are more likely to draw the viewer attention. However, such a forceful promotion may also trigger dislike among uninterested viewers, so try not to block any main content of the page with oversized floating advertisement.
</li>';

$vbm_adv_type[couplead][name] 	= '[System] Side-pair Advertisement';
$vbm_adv_type[couplead][notice] = '<li><strong>Display: </strong> Side-pair advertisements display the content with paired vertical banners on both sides of the top of the page, usually using pictures or flash movies. This type of ad is only seen in pages with limited main table width (in pixels), for if the main table width covers more than 90% of that of the page, the main content on the page may be partly covered. Therefore, side-pair advertisements will not be shown on browser pages narrower than 800 pixels, and when multiple side-pair advertisements are assigned to one single page, the system will randomly pick one of them for display. </li><li><strong>Potential: </strong>Since side-pair advertisements take up only blank spaces on the sides of the page, they can hardly trigger any dislike among viewers. Nevertheless, due to the particular requirement on resolution (usually bigger than 1024*768) and main table width (not more than 90% as wide as the whole page), not 100% of the viewers can see them.</li>';

$vbm_adv_type[intercatad][name] 	= '[System] Column-side Advertisement';
$vbm_adv_type[intercatad][notice] = '<li><strong>Display: </strong> Column-side Advertisement appears beside every column list, usually using pictures or flash movies with width of 165 pixels.
</li><li><strong>Potential: </strong>Applying corresponding column-side advertisements to different columns makes the promotion more directed and thus more acceptable. </li>';

$vbm_adv_type[interlistad][name] 	= '[System] Between-columns Advertisement';
$vbm_adv_type[interlistad][notice] = '<li><strong>Display: </strong> Between-columns Advertisements appear either right above/below a column or between columns (in case of multiple columns), usually comprised of texts, codes, pictures or flash movies.
</li><li><strong>Potential: </strong>Being so close to the column list makes between-columns advertisements more likely to be clicked.</li>';

$vbm_adv_type[indexcatad][name] 	= '[System] Homepage Between-categories Advertisement';
$vbm_adv_type[indexcatad][notice] = '<li><strong>Display: </strong> Homepage between-categories advertisement appear between two root category lists on the homepage in forms of a flash movie or a picture sized 629*88 (or other sizes).
</li><li><strong>Potential: </strong>Its eye-catching position on the homepage makes homepage between-categories advertisement a good choice for display. However, placing too many or too large of such ads may trigger dislike among viewers.</li>';

$vbm_adv_type[infoad][name] 	= '[System] Below-info Advertisement';
$vbm_adv_type[infoad][notice] = '<li><strong>Display: </strong> Below-info advertisement displays its content right below the information (usually the main content) on the page.
</li><li><strong>Potential: </strong> Because it comes right after the information needed by the viewer, below-info advertisement is sequentially viewed by all who opens the page. This makes it a perfect choice for effective promotion and site announcement.</li>';

/**/
$vbm_adv_style = array();
$vbm_adv_style['code']	= 'Code';
$vbm_adv_style['text']	= 'Text';
$vbm_adv_style['image']	= 'Image';
$vbm_adv_style['flash']	= 'Flash';
?>