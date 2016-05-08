<? include mymps_tpl('search_header'); ?>

<div class="s_logo">

    <div class="logo"><a href="<?=$mymps_global[SiteUrl]?>/search.php"><img src="<?=$mymps_global[SiteLogo]?>" alt="<?=$mymps_global[SiteName]?>"></a></div>

    <div class="s_info">

    <form action="search.php?" method="get" />

        <div class="s_ulA" id="searchType">

            <ul><!--kwg -->

                <li name="s8" id="s8_information" onclick="show_tab('information');" <? if($mod == 'information'){?>class="current"<? }?>><a href="#">Posts</a></li>

				<? if($mymps_global[cfg_if_corp] == 1){?><li name="s8" id="s8_store" onclick="show_tab('store');" <? if($mod == 'store'){?>class="current"<? }?>><a href="#">Sellers</a></li><? }?>

				<? foreach($allowplugin as $k =>$plugin){?>

                <li name="s8" id="s8_<?=$plugin[flag]?>" onclick="show_tab('<?=$plugin[flag]?>');" <? if($mod == $plugin[flag]){?>class="current"<? }?>><a href="#"><?=$plugin[name]?></a></li>

				<? }?>

            </ul>

        </div>

        <div class="s_enter cc">

        	<input type="hidden" id="searchtype" name="mod" value="<?=$mod?>"/>

            <input placeholder="Please enter keywords or category name" value="<?=$keywords?>" class="s_input" type="text" name="keywords" >

            <button class="s_btn" type="submit">Search</button>

        </div>

        </form>

    </div>

</div>

<div class="cc"></div>