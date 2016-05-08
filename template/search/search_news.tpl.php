<? include mymps_tpl('search_head');?>



	<!-- �������ҳ -->	

	<div class="c"></div>

 	<div class="main2 cc" id="mainbox">

    	<div class="h">

        	<span class="fr">The search for <span class="s1"><?=$search[keywords]?></span> have gained <?=$search[rows_num]?>results

        	</span>

            <span class="mr20"><a href="#"><?=$mymps_global[SiteName]?>Search </a> &raquo; Information</span><span class="s6">Hint: Separating each keyword with a space will make the search more accurate!</span>

        </div>



		<div class="content fl">

        	<div class="s_dlA">

               <div class="searchpagelist">

                    <ul>

               	<? if($search[rows_num] == 0){?>

                <div class="nodata">Sorry, no matched post is found. Please try again with other keywords.</div>

                <? }else{?>

                    <? foreach($search[result] as $k =>$result){?>

                        <li>

                            <h3><a href="<?=$result[uri]?>" target="_blank"><?=$result[title]?></a></h3>

                            <p><?=cutstr($result[content],200)?></p>

                            <div>

                            <span class="fgreen"><?=$result[uri]?></span> &nbsp;&nbsp;Category: <span class="fgreen"><a href="<?=$result[caturi]?>" target="_blank"><?=$result[catname]?></a></span> Views: <span class="fgreen"><?=$result[hit]?></span> Date: <span class="fgreen"><?=GetTime($result[begintime],'Y m d')?></span> 

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

            	<h2>Detailed Search For Information</h2>

                <ul class="quicksearch">

                    <form action="search.php?" method="get" />

                    <input type="hidden" name="mod" value="<?=$mod?>" />

                    <dl>

                    <dt>Select Category: </dt>

                    <dd>

                    <select name="catid">

                    	<option value="" <? if(!$catid){?>style="background-color:#6eb00c; color:white!important;"<? }?>>Do Not Limit Category</option>

						<? foreach($catoption as $k =>$options){?>

                        <option value="<?=$options[catid]?>" <? if($options[catid] == $catid){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>><?=$options[catname]?></option>

                        <? }?>

                    </select>

					</dd>

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