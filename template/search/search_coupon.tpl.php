<? include mymps_tpl('search_head');?>

	<!-- �������ҳ -->	

	<div class="c"></div>

 	<div class="main2 cc" id="mainbox">

    	<div class="h">

        	<span class="fr">The search for<span class="s1"><?=$search[keywords]?></span>have gained<?=$search[rows_num]?>results

        	</span>

            <span class="mr20"><a href="#"><?=$mymps_global[SiteName]?>Search </a> &raquo; Coupons</span><span class="s6">Hint: Separating each keyword with a space will make the search more accurate!</span>

        </div>



		<div class="content fl">

        	<div class="s_dlA">

            	<? if($search[rows_num] == 0){?>

                <div class="nodata">Sorry, no matched post is found. Please try again with other keywords.</div>

                <? }else{?>

                <div class="searchcoupon mt6">

				<? foreach($search[result] as $k =>$result){?>

				<div class="coupon">

					<div class="preimg"><a href="<?=$result[uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$result[pre_picture]?>"></a></div>

					<div class="middle">

						<div class="title"><a href="<?=$result[uri]?>" target="_blank"><?=$result[title]?></a></div>

						<div class="introduction"><?=cutstr($result[des],150)?></div>

						<div class="enddate">Start From: <?=GetTime($result[begindate],'Y m d')?></div>

						<div class="enddate">Eng By: <?=GetTime($result[enddate],'Y m d')?></div>

					</div>

					<div class="fordetail">

						<div class="detail"><button class="ckxq" value="View Details" onclick="window.open('<?=$result[uri]?>')"></button></div>

						<div class="print"><?=$result[prints]?>Member Prints</div>

					</div>

				</div>

				<? }?>

				</div>

        		<? }?>

                <div class="pagination mt6"><?=$result[pagination]?></div>

            </div>

        </div>



        <div class="sidebar fr">

        	<div class="p15 s_boxA">

            	<h2>Detailed Search For Coupons</h2>

                <ul class="quicksearch">

                    <form action="<?=$mymps_global[SiteUrl]?>/search.php?" method="get" />

                    <input type="hidden" name="mod" value="coupon" />

                    <dl>

                    <dt>Select Category: </dt>

                    <dd>

                    <select name="cate_id">

                    	<option value="" <? if(!$cate_id){?>style="background-color:#6eb00c; color:white!important;"<? }?>>Do Not Limit Category</option>

						<? foreach($catoption as $k =>$options){?>

                        <option value="<?=$options[cate_id]?>" <? if($options[cate_id] == $cate_id){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>>{$options.cate_name}</option>

                        <? }?>

                    </select>

					</dd>

                    <dt>Select District: </dt>

                    <dd>

                    <select name="areaid">

                    <option value="" <? if(!$areaid){?>style="background-color:#6eb00c; color:white!important;"<? }?>>Do Not Limit District</option>

					<? foreach($area_result as $k =>$v){?>

                    <option value="{$area_result.areaid}" <? if($v[areaid] == $areaid){?>selected style="background-color:#6eb00c; color:white!important;"<? }?>><?=$v[areaname]?></option>

                  	<? }?>

                    </select></dd>

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