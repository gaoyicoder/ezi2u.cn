<? include mymps_tpl('search_head');?>
<script language="javascript">
document.domain = '{$document_domain}';
</script>
	<!-- ËÑË÷½á¹ûÒ³ -->
	<div class="c"></div>
 	<div class="main2 cc" id="mainbox">
    	<div class="h">
        	<span class="fr">The search for<span class="s1"><?=$search[keywords]?></span>have gained<?=$search[rows_num]?>results
        	</span>
            <span class="mr20"><a href="<?=$mymps_global[SiteUrl]?>/search.php"><?=$mymps_global[SiteName]?>Search </a> &raquo; Post</span><span class="s6">Hint: Separating each keyword with a space will make the search more accurate!</span>
        </div>

		<div class="content fl">
        	<div class="s_dlA">
                <div class="searchpagelist">
                <ul>
                <? if($search[rows_num] == 0){?>
                <div class="nodata">Sorry, no matched post is found. Please try again with other keywords.</div>
                <? }else{?>
                <? 
				foreach($search[result] as $k =>$result){?>
                <li style="height:85px">
                <h3><a href="<?=$result[uri]?>" target="_blank"><?=$result[title]?></a><span class="fgreen" style="margin-left:20px; font-size:12px"><a href="<?=$result[caturi]?>" target="_blank"><?=$result[catname]?></a></span><span class="dateline">[<?=get_format_time($result[begintime])?>]</span></h3>
                <div class="intro">
                    <div class="p"><?=$result[content]?></div>
                    <div class="p-b"><?  if(is_array($result[extra])){foreach($result[extra] as $k =>$extra){?><font color="#666666"><?=$extra?></font>&nbsp;&nbsp;<? }}?></div>

                </div>
                </li>
                <? }?>
                <? }?>
                </ul>
                </div>
                <div class="pagination mt6"><?=$search[pagination]?></div>
            </div>
        </div>
        <div class="sidebar fr">
        	<div class="p15 s_boxA">
            	<h2>Detailed Search</h2>
                <ul class="quicksearch">
					<div style="display:none;">
                        <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
                        <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
                        <form method="post" target="iframe_area" id="form_area"></form>
                    </div>
                    <form action="search.php?" method="get" />
                    <dl>
                    <dt>Category: </dt>
                    <dd>
                    <select name="catid">
                        <option value="" <? if(!$catid){?>style="background-color:#6eb00c; color:white!important;"<? }?>>select</option>
                        <? foreach($catoption as $k =>$options){?>
                        <option value="<?=$options[catid]?>" <? if($options[catid] == $catid){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>><?=$options[catname]?></option>
                        <? }?>
                    </select>
					</dd>
                    <dt>State: </dt>
                    <dd><?=$select_where_option?></dd>
                    <dt>Time: </dt>
                    <dd><?=$posttime_select?></dd>
					<? if($extra_model){?>
						<? foreach($extra_model as $k => $model){?>
                        <dt><?=$model[title]?>£º</dt><dd>
                        <?=$model[publish]?>
                        </dd>
                        <? }?>
                    <? }?>
                    <dt>Phone: </dt>
                    <dd><input type="text" name="tel"  class="searchinput inputbox" value="<?=$tel?>" /></dd>
					<dt>Keywords: </dt>
                    <dd><input type="text" name="keywords"  class="searchinput inputbox" value="<?=$search[keywords]?>" /></dd>
                    <dt>&nbsp;</dt>
                    <dd><input type="submit" class="submit" value="I Want To Search"/></dd>
                    </dl>
                    </form>
                </ul>
            </div>
        </div>

        <div class="c">&nbsp;</div>
  
    </div>  

</div></div>

<div class="footer-wrap">
<div class="c mt10"></div>
<? include mymps_tpl('search_foot'); ?>
</div>
</div>
</body>
</html>