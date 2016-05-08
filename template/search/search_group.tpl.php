<? include mymps_tpl('search_head');?>

	<!-- �������ҳ -->	

	<div class="c"></div>

 	<div class="main2 cc" id="mainbox">

    	<div class="h">

        	<span class="fr">The search for<span class="s1"><?=$search[keywords]?></span>have gained<?=$search[rows_num]?>results

        	</span>

            <span class="mr20"><a href="#"><?=$mymps_global[SiteName]?>Search </a> &raquo; Group Purchase</span><span class="s6">Hint: Separating each keyword with a space will make the search more accurate!</span>

        </div>



		<div class="content fl">

        	<div class="s_dlA">

            	<? if($search[rows_num] == 0){?>

                <div class="nodata">Sorry, no matched post is found. Please try again with other keywords.</div>

                <? }else{?>

                <div class="searchgroup mt6">

				<? foreach($search[result] as $k =>$result){?>

				<div class="listgroup">

					<div class="preimg"><img src="<?=$mymps_global[SiteUrl]?><?=$result[pre_picture]?>"></div>

					<div class="middle">

						<div class="title"><span class="ttitle"><a href="<?=$result[uri]?>" target="_blank" ><?=$result[gname]?></a></span><span class="number">Activity Number: <?=$result[groupid]?></span></div>

						<div class="introduction"><?=cutstr($result[des],160)?></div>

						<div class="subintro"><div class="floatleft">

						<button class="hdxq" value="Activity Details" onclick="window.open('<?=$result[uri]?>')"></button> 

						<? if($result[commenturl]){?><button value="Join Discussion" class="cytl" onclick="window.open('<?=$result[commenturl]?>')"></button><? }?>

						</div> <div class="floatright"><span class="zz">Organized by the Site</span> <span class="zt">Status: <?=$glevel[$result[glevel]]?></span> <span class="enddate">Valid To: <?=GetTime($result[enddate],'Y m d')?></span></div></div>

					</div>

					<div class="signin">

						<div class="ybm"><?=$result[signintotal]?></div>

						<div class="wybm"></div>

						<div class="bmjr"><button class="bmjr" value="Sign-up" onclick="window.open('<?=$result[uri]?>#signin')"></button></div>

					</div>

				</div>

				<? }?>

    	</div>

        		<? }?>

                <div class="pagination mt6"><?=$search[pagination]?></div>

            </div>

        </div>



        <div class="sidebar fr">

        	<div class="p15 s_boxA">

            	<h2>Detailed Search For Group Purchase Activities</h2>

                <ul class="quicksearch">

                    <form action="search.php?" method="get" />

                    <input type="hidden" name="mod" value="group" />

                    <dl>

                    <dt>Select Category: </dt>

                    <dd>

                    <select name="cate_id">

                    	<option value="" <? if(!$cate_id){?>style="background-color:#6eb00c; color:white!important;"<? }?>>Do Not Limit Category</option>

						<? foreach($catoptions as $k =>$options){?>

                        <option value="<?=$options[cate_id]?>" <? if($options[cate_id] == $cate_id){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>><?=$options[cate_name]?></option>

                        <? }?>

                    </select>

					</dd>

                    <dt>Select District: </dt>

                    <dd>

                    <select name="areaid">

                    <option value="" <? if(!$areaid){?>style="background-color:#6eb00c; color:white!important;"<? }?>>Do Not Limit District</option>

					<? foreach($area_result as $k =>$v){?>

                    <option value="<?=$v[areaid]?>" <? if($v['areaid'] == $areaid){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>><?=$v[areaname]?></option>

                  	<? }?>

                    </select></dd>

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

<?=$mymps_global[SiteStat]?></body>

</html>