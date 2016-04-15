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
            <span class="mr20"><a href="#"><?=$mymps_global[SiteName]?>Search </a> &raquo; Seller</span><span class="s6">Hint: Separating each keyword with a space will make the search more accurate!</span>
        </div>

		<div class="content fl">
        	<div class="s_dlA">
            	<? if($search[rows_num] == 0){?>
                <div class="nodata">Sorry, no matched post is found. Please try again with other keywords.</div>
                <? }else{?>
                <div class="searchuser mt6">
        <? foreach($search[result] as $k =>$result){?>
            <dl>
                <dt>
                  <a  href="<?=$result[uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$result[prelogo]?>"></a>
                    <div style="width:400px; float:left;">
                    <h3><a  href="<?=$result[uri]?>" target="_blank"><?=$result[tname]?></a></h3>
                    Contact Phone: <?=$result[tel]?> <br />Contact Address: <?=$result[address]?><br>
                    </div>
                </dt>
                <dd>
                    <a href="<?=$result[uri_aboutus]?>" target="_blank">Seller Introduction </a>
                    <a href="<?=$result[uri_comment]?>" target="_blank">Add Comment</a>
                    <a href="<?=$result[uri_album]?>" target="_blank">Seller Album</a>
                </dd>
            </dl>
       <? }?>
    	</div>
        		<? }?>
                <div class="pagination mt6"><?=$search[pagination]?></div>
            </div>
        </div>

        <div class="sidebar fr">
        	<div class="p15 s_boxA">
            	<h2>Detailed Search For Seller</h2>
                <ul class="quicksearch">
					<div style="display:none;">
                        <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
                        <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
                        <form method="post" target="iframe_area" id="form_area"></form>
                    </div>
                    <form action="<?=$mymps_global[SiteUrl]?>/search.php?" method="get" />
                    <input type="hidden" name="mod" value="store" />
                    <dl>
                    <dt>Select Category: </dt>
                    <dd>
                    <select name="catid">
                    	<option value="" <? if(!$catid){?>style="background-color:#6eb00c; color:white!important;"<? }?>>Do Not Limit Category</option>
						<? foreach($catoption as $k =>$options){?>
                        <option value="<?=$options[corpid]?>" <? if($options[corpid] == $catid){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>><?=$options[corpname]?></option>
                        <? }?>
                    </select>
					</dd>
                    <dt>Select District: </dt>
                    <dd>
                    <?=$select_where_option?></dd>
                    <dt>Keywords: </dt>
                    <dd><input type="text" name="keywords"  class="searchinput inputbox" value="<?=$search[keywords]?>" /></dd> 
                    <dt>&nbsp;</dt>
                    <dd><input type="submit" value="I Want To Search" class="submit"/></dd>
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