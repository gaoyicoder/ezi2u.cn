<?php mymps_admin_tpl_global_head();?>

<script language="javascript" src="js/vbm.js"></script>

<script language="javascript">

function do_copy(){

  ff = document.form1;

  ff.keywords.value=document.getElementById("title").value;

}

function NewsAdd(){

	if(document.form1.title.value==""){

		alert('Please enter the title of news!');

		document.form1.title.focus();

		return false;

	}

	if(document.form1.catid.value==""){

		alert('Please select the column to be categorized in!');

		document.form1.catid.focus();

		return false;

	}

	if(document.form.catname.value.length<2){

		alert('Please keep the column title more than 2 characters!');

		document.form1.catname.focus();

		return false;

	}

}

</script>

<title><?php echo $part == 'edit' ? 'Edit Article' : 'Add Article'?></title>

</head>

<body <?php if($row[isjump] == 1){?>onload='HidUrlTr()'<?php }?>>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

				<li><a href="news.php" <?php if($part == 'list'){?>class="current"<?php }?>>News List</a></li>

				<li><a href="news.php?part=add" <?php if($part == 'add'){?>class="current"<?php }?>>Add News</a></li>

				

				<?php if($part == 'edit' && $row[id]){?><li><a href="news.php?part=edit&id=<?=$row[id]?>" class="current">Edit News</a></li><?php }?>

			</ul>

		</div>

	</div>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Hint</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

  <li>If Display Focus Images in Turns is enabled, Do please remember to upload or identify thumbnail directory, otherwise the news will not be successfully published!</li>

  <li>Caution: DO NOT copy and paste content directly from .doc/.docx files (unless necessary)!!!</li>

  <li> For paragraphing, place two spaces before each paragraph. Because putting paragraphs too close may not benefit readers, please remember to leave a line of space between each paragraph.</li>

    </td>

  </tr>

</table>

</div>

<form name="form1" action="?part=<?php echo $part; ?>" method="post" onSubmit="return NewsAdd();">

<input type="hidden" name="id" value="<?=$row[id]?>">

<input type="hidden" name="html_path" value="<?php echo $row[html_path] == '/html/news'? '' : $row['html_path']?>">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

	<td colspan="2">Regular Content</td>

</tr>

<tr style=" background-color:#FFF">

  <td width="135">&nbsp;Title of Article: </td>

  <td><input name="title" type="text" class="text" id="title" style="width:300px" value="<?=$row[title]?>"/>    </td>

  </tr>

<tr style=" background-color:#FFF">

  <td width="135" height="20">&nbsp;Main Column of Article: </td>

  <td>

  <select name='catid' style='width:300px'>

  <option value=''>Please Select Main Category...</option>

  <?php echo cat_list('channel',0,$row[catid]);?>

</select></td>

  </tr>

<tr style="background-color:#FFF;" >

  <td width="135">&nbsp;Author: </td>

  <td colspan="2"><input name="author" type="text" class="text" value="<?=$row[author]?$row[author]:$admin_uname?>" style="width:300px"/>

  </td>

</tr>

<tr style="background-color:#FFF;" >

  <td width="135">&nbsp;Source: </td>

  <td colspan="2"><input name="from" type="text" class="text" value="<?=$row[source]?$row[source]:$mymps_global[SiteName]?>" style="width:300px"/>

  </td>

</tr>

<tr style=" background-color:#FFF"> 

<td width="135">&nbsp;Keyword: </td>

<td>

  <input name="keywords" type="text" class="text" id="keywords" style="width:300px" value="<?=$row[keywords]?>">      If it is the same as the title, please <a href="javascript:do_copy();">click on here to copy</a> (for multiple Items, use a comma between each item).</td>

</tr>

<tr class="firstr">

	<td colspan="2">Affiliated Settings</td>

</tr>

<tr style="background-color:#FFF;">

  <td width="135">&nbsp;Affiliated Parameters: </td>

  <td colspan="2">

    <label for="iscommend"><input name="iscommend" type="checkbox" class="checkbox" id="iscommend" value="1"  <?php if($row[iscommend] == 1) echo 'checked';?>/>Recommended</label>

    <label for="isbold"><input name="isbold" type="checkbox" class="checkbox" id="isbold" value="1" <?php if($row[isbold] == 1) echo 'checked';?>/>Overstrike</label>

    <label for="isactive"><input name="isactive" type="checkbox" class="checkbox" id="isactive" value="1" checked/>For Dynamic View Only</label>

    <label for="isjump"><input name="isjump" type="checkbox" class="checkbox" id="isjump" value="1" onClick="ShowUrlTr()" <?php if($row[isjump] == 1) echo 'checked';?>/>Jump To</label>

  </td>

</tr>

<tr style="background-color:#FFF;">

  <td width="135">&nbsp;Display Focus Image in Turns: </td>

  <td colspan="2">

    <label for="indexfocus"><input name="isfocus[]" type="checkbox" class="checkbox" id="indexfocus" value="index"  <?php if($row[isfocus] == 'index') echo 'checked';?>/>Homepage</label>

    <label for="newsfocus"><input name="isfocus[]" type="checkbox" class="checkbox" id="newsfocus" value="news"  <?php if($row[isfocus] == 'news') echo 'checked';?>/>News Page</label>

  </td>

</tr>

<?php if($part == 'add'){?>

<tr id="pictable" style=" background-color:#FFF">

    <td width="135" height="81">&nbsp;Thumbnail Directory: </td>

    <td>

        <label><input type="radio" onclick='

        document.getElementById("iframe").style.display = "none";

        document.getElementById("imgsrc").style.display = "none";

        ' name="ifout" value="bodyimg" class="radio" checked="checked" />Automatic Acquisition [the First Image Appeared in the Article]</label>

        <label><input type="radio" onclick='

        document.getElementById("iframe").style.display = "none";

        document.getElementById("imgsrc").style.display = "block";' name="ifout" value="no" class="radio"/>Image From Exterior Source</label>

        <label><input type="radio" onclick='

        document.getElementById("iframe").style.display = "block";

        document.getElementById("imgsrc").style.display = "block";' name="ifout" value="yes" class="radio"/>Upload From Local Source</label>

        <input name=imgpath id="imgsrc" type="text" class="text" value="<?=$row[imgpath]?>" style=" margin:10px 0; display:none; width:300px"/>

         

        <iframe src="include/upfile.php?destination=news&watermark=0" width="450" frameborder="0" scrolling="no" onload="this.height=iFrame1.document.body.scrollHeight" id="iframe" style="display:none; margin-top:10px"></iframe>

    </td>

</tr>

<?php } else {?>

<tr id="pictable" style=" background-color:#FFF">

    <td width="135" height="81">&nbsp;Thumbnail Directory: </td>

    <td>

        <label><input type="radio" onclick='

        document.getElementById("iframe").style.display = "none";

        document.getElementById("imgsrc").style.display = "none";

        ' name="ifout" value="bodyimg" class="radio"/>Automatic Acquisition [the First Image Appeared in the Article]</label>

        <label><input type="radio" onclick='

        document.getElementById("iframe").style.display = "none";

        document.getElementById("imgsrc").style.display = "block";' name="ifout" value="no" class="radio"  checked="checked"/>Image From Exterior Source</label>

        <label><input type="radio" onclick='

        document.getElementById("iframe").style.display = "block";

        document.getElementById("imgsrc").style.display = "block";' name="ifout" value="yes" class="radio"/>Upload From Local Source</label><br>

        <input name=imgpath id=imgsrc type="text" class="text" value="<?=$row[imgpath]?>" style=" margin:10px 0; width:300px"/>

         

        <iframe src="include/upfile.php?destination=news&watermark=0" width="450" frameborder="0" scrolling="no" onload="this.height=iFrame1.document.body.scrollHeight" id="iframe" style="display:none; margin-top:10px"></iframe>

    </td>

</tr>

<?php }?>

<tr style="background-color:#FFF; display:none" id="redirecturltr">

  <td width="135">&nbsp;Jump To: </td>

  <td colspan="2"><input name="redirect_url" type="text" class="text" id="redirecturl" style="width:300px" value="<?=$row[redirect_url]?>" />

  </td>

</tr>



<tbody id="detail">

<tr style="background-color:#FFF;" >

  <td width="135">&nbsp;Initial Number of Views: </td>

  <td colspan="2"><input name="hit" type="text" class="txt" value="<?=$row[hit]?$row[hit]:0?>" />

  </td>

</tr>

<tr style="background-color:#FFF;" >

  <td width="135">&nbsp;Add Number of Views with Each Visit: </td>

  <td colspan="2"><input name="perhit" type="text" class="txt" value="<?=$row[perhit]?$row[perhit]:1?>" />

  </td>

</tr>

<tr style="background-color:#FFF;">

	<td width="135">Article Brief (Not Compulsory): </td>

	<td colspan="2"><textarea name="introduction" style="width:500px; height:100px"><?php echo $row['introduction']; ?></textarea></td>

</tr>

</tbody>

</table>

<div style="margin-top:3px">

<?=$acontent?>

</div>

</div>

<center style='margin-bottom:10px'><input name="news_submit" value="<?php echo $part == 'edit'? 'Save Changes' : 'Submit'?>" type="submit" class="mymps"/>&nbsp;&nbsp;<input name="news_submit" value="Return" type="button" onClick="location.href='?part=list'" class="mymps"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

