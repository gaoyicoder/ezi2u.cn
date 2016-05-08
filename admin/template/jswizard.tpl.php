<?php 

echo mymps_admin_tpl_global_head();

$catoptions = get_categories_tree(0,'category');

?>

<script language="javascript">

function isUndefined(variable) {

	return typeof variable == 'undefined' ? true : false;

}



function insertunit(text) {

	$('jstemplate').focus();

	if(!isUndefined($('jstemplate').selectionStart)) {

		var opn = $('jstemplate').selectionStart + 0;

		$('jstemplate').value = $('jstemplate').value.substr(0, $('jstemplate').selectionStart) + text + $('jstemplate').value.substr($('jstemplate').selectionEnd);

	} else if(document.selection && document.selection.createRange) {

		var sel = document.selection.createRange();

		sel.text = text.replace(/\r?\n/g, '\r\n');

		sel.moveStart('character', -strlen(text));

	} else {

		$('jstemplate').value += text;

	}

}

</script>

<style>

.jswizard{ padding:10px 0; line-height:22px}

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

    <tr class="firstr"><td>Preview</td></tr>

	<tbody style="display: yes; background-color:white">

	<tr><td><textarea rows="3" style="width: 100%; word-break: break-all" onMouseOver="this.focus()" onFocus="this.select()">&lt;script language=&quot;JavaScript&quot; <?php if($parameter['jscharset'] == 1) echo 'charset=&quot;utf-8&quot;';?> src=&quot;<?=$mymps_global[SiteUrl]?>/javascript.php?flag=<?=$flag?>&quot;&gt;&lt;/script&gt;</textarea><div class="jswizard"><script language="javascript" src="../javascript.php?flag=<?=$flag?>" <?php if($parameter['jscharset'] == 1) echo 'charset="utf-8"';?>></script></div>

    </td>

    </tr>

    </tbody>

</table>

</div>

<form action="?" method="post">

<input name="id" value="<?=$id?>" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr"><td>Data-invoking Template</td></tr>

    <tbody id="menu_1dc4da75e7b2017e" style="display: yes; background-color:white">

    <tr>

    <td colspan="2">In Template <a href="###" title="With Link" onclick="insertunit('{title}')">{title}</a>��<a title="Without Link" href="###" onclick="insertunit('{title_nolink}')">{title_nolink}</a> Denote Titles of Posts��<a href="###" onclick="insertunit('{imgpath}')">{imgpath}</a> Denote URL of Images in Post��<a href="###" onclick="insertunit('{introduce}')">{introduce}</a> Denote Categorized Information Briefs��<a href="###" onclick="insertunit('{catname}')">{catname}</a> Denote Column that Stores the Post��<a href="###" onclick="insertunit('{author}')">{author}</a> Denote Poste��<a href="###" onclick="insertunit('{begintime}')">{begintime}</a> Denote Time of Posting of Categorized Post��<a href="###" onclick="insertunit('{hit}')">{hit}</a> Denote Number of Viewers��<a href="###" onclick="insertunit('{link}')">{link}</a> Denote Categorized Information Links<br />

    <textarea cols="100" rows="5" id="jstemplate" name="parameter[jstemplate]" style="width: 95%;"><?php echo $parameter['jstemplate'] ? $parameter['jstemplate'] : '{title}<br />'; ?></textarea>

    </td>

    </tr>

    </tbody>

</table>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr"><td colspan="2">Theme List</td></tr>

<tbody id="menu_4d4985d65fe805ed" style="display: yes; background-color:white">

<tr><td width="45%" class="altbg1" ><b>Unique Sign for Data Invoking:</b><br /><span class="smalltxt">Please enter a sign (preferably English word or number) that can be easily remembered to denote this data-invoking script.</span></td><td class="altbg2"><input type="text" class="text" size="50" name="flag" value="<?php echo $flag; ?>" >

</td></tr>

<tr>

<td width="45%" class="altbg1" ><b>From Columns:</b><br /><span class="smalltxt">Pick sections that are authorized to invoke posting. You may press and hold CTRL to select more than one item. Picking/not picking all means no restrictions are set.<br /> <font color="red">Please select all categories at the lowest level.</font></span>

</td>

<td class="altbg2">

<select name="parameter[catid][]" size="12" multiple="multiple">

<option value="" >&nbsp;> All Enabled Columns</option>

<?php echo cat_list('category',0,$parameter[catid],true); ?>

</select>

</td>

</tr>

<tr>

<td width="45%" class="altbg1" ><b>From Sub-site:</b><br /><span class="smalltxt">Pick districts that are authorized to invoke data. You may press and hold CTRL to select more than one item. Picking/not picking all means no restrictions are set.</span>

</td>

<td class="altbg2">

<select name="parameter[cityid][]" size="5" multiple="multiple">

<option value="">&nbsp;> All Sub-sites</option>

<option value="">&nbsp;</option>

<?php echo get_cityoptions($parameter[cityid])?>

</select>

</td>

</tr>

<tr><td width="45%" class="altbg1" ><b>Number of Data Displayed:</b><br /><span class="smalltxt">Set the number of themes displayed once. Please set the value to be an integer bigger than 0.</span></td><td class="altbg2"><input type="text" class="text" size="50" name="parameter[items]" value="<?php echo $parameter[items]; ?>" >

</td></tr><tr><td width="45%" class="altbg1" ><b>Maximum Byte Amount For Title:</b><br /><span class="smalltxt">This is used to determine whether or not shorten the length of title that exceeds the set value to the set value. The number 0 means no automatic shortening will be applied</span></td><td class="altbg2"><input type="text" class="text" size="50" name="parameter[maxlength]" value="<?php echo $parameter[maxlength]; ?>" >

</td></tr><tr><td width="45%" class="altbg1" ><b>Set Theme to be Displayed:</b><br />

<span class="smalltxt">Set the theme ID(s) to be displayed. For multiple IDs, separate each of them with a comma. Note: Leaving it blank denotes no use of filtering.</span></td><td class="altbg2"><input type="text" class="text" size="50" name="parameter[ids]" value="<?php echo $parameter[ids]; ?>" >

</td></tr><tr><td width="45%" class="altbg1" ><b>Keywords in Titles:</b><br /><span class="smalltxt">Set keywords contained in titles. Note: Leaving it blank denotes no use of filtering.<br />For keywords, the asterisk wildcard * can be applied.<br />When matching multiple keywords in full, you may use space or AND between each keyword. Like: win32 AND unix<br />When matching parts of multiple keywords, you may use | or OR between each item. Like:  win32 OR unix</span></td><td class="altbg2"><input type="text" class="text" size="50" name="parameter[keyword]" value="<?php echo $parameter[keyword]; ?>" >

</td></tr>

<tr><td width="45%" class="altbg1" ><b>Display Only the Following Themes:</b><br /><span class="smalltxt">Set particular theme range. Note: selecting/not selecting all will be regarded as no filtering.</span></td>

<td class="altbg2">

<?php

 echo get_special_subject($parameter['special']);?>

</td>

</tr>

<tr><td width="45%" class="altbg1" ><b>Open Link In:</b><br /><span class="smalltxt">Set Where the Link Will be Opened</span></td><td class="altbg2"><label for="_self"><input class="radio" type="radio" name="parameter[newwindow]" value="0" id="_self" <?php if($parameter[newwindow] == 0) echo 'checked'; ?>> Open in Current Window</label><br /><label for="_target"><input class="radio" type="radio" name="parameter[newwindow]" value="1" id="_target" <?php if($parameter[newwindow] == 1) echo 'checked'; ?>> Open in New Window</label></td></tr><tr><td width="45%" class="altbg1" ><b>Method of Theme Sorting:</b><br /><span class="smalltxt">Set Reference Field for Theme Sorting</span></td><td class="altbg2"><label for="dateline"><input class="radio" type="radio" name="parameter[orderby]" value="dateline" id="dateline" <?php if($parameter[orderby] == 'dateline' || !$parameter) echo 'checked'; ?>> Sort by Time of Posting (From late to early)</label><br /><label for="views"><input class="radio" type="radio" name="parameter[orderby]" value="views" id="views" <?php if($parameter[orderby] == 'views') echo 'checked'; ?>> Sort by Number of Viewers (From more to less)</label></td></tr>

<tr><td width="45%" class="altbg1" ><b>Compulsory Data Converting:</b><br /><span class="smalltxt">Compulsory data converting will output the Invoked text in UTF-8 Code.</span></td><td class="altbg2"><label for="jacharset"><input class="radio" type="radio" name="parameter[jscharset]" value="1" <?php if($parameter[jscharset] == 1) echo 'checked'; ?> id="jscharset"> Yes</label> &nbsp; &nbsp; 

<label for="no_jscharset"><input class="radio" type="radio" name="parameter[jscharset]" value="0" id="no_jscharset" <?php if($parameter[jscharset] == 0) echo 'checked'; ?>> No</label>

</td></tr>

</tbody>

</table>

</div>

<center>

<input class="mymps large" type="submit" name="<?=CURSCRIPT?>_submit" value="Submit"><input name="preview" type="hidden" value="1"></center></form><br /></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

