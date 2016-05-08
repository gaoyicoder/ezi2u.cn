$(function(){

    if(window.BLightApp){//�ж�����ǰٶ�app���þɵ�filter

		loadJS("/template/js/filter.js",function(){

			if($(".filter").length){

				var myfilter = new filter(filter_data);

				myfilter.drawList();

			}

		});

	}else{

		window.keyword_other = '';



		//��ѡ��λ�ô���

		//$(".filter_item .selected").each(function(){

		//	$(this).insertBefore($(this).siblings());

		//});	

			

			//��������ɸѡ�� dl

		$(".filter_item").each(function(){

			var len=$(this).find("dd a").length;

			//���a��ǩ�ĳ��ȴ���4���������������cmc����cmcs

			if(len>3 && $(this).attr("type")=="cmc_cmcs"){

				$(this).find("dd").append("<div class='ico_more'></div>");

				$(this).find("dd").css("padding-right","30px");

			}

			//���a��ǩ�ĳ��ȴ���4�����������������Ȧ���

			if(len>4 && $(this).attr("type")=="subarea"){

				$(this).find("dd").append("<div class='ico_more'></div>");

				$(this).find("dd").css("padding-right","30px");

			}

			//���a��ǩ�ĳ��ȴ��ڻ����5�����������������������icoλ�ú�dd�߶�

			if(len>=5 && $(this).attr("type")=="area"){

				$(this).find("dd").append("<div class='ico_more'></div>");

				$(".ico_more").css("top","24px");

				$(this).find("dd").css({"padding-right":"30px","height":"56px"});

			}

			

		});

		

		//��ʾ�����ظ����ɸѡ��

			//isclick ��¼�Ƿ�����a��ǩ�����ͬʱ���������¼���bug

			var isclick = false;

			$(".ico_more,.ico_more2").bind("touchstart",function(){isside=false});

			$(".ico_more,.ico_more2").bind("touchmove",function(){isside=true});

			$(".ico_more,.ico_more2").bind("touchend",function(){

				if(isside){return;}

				$('.filter').css({"height":"auto","-webkit-transition-duration":"0ms"});

				isclick=true;

				if($(this).hasClass("up")){

					if($(this).parent().parent().attr("type")=="area"){

						$(this).parent().css("height","56px");

					}else{

						$(this).parent().css("height","28px");

					}

					$(this).removeClass("up");

				}else{

					$(this).parent().css("height","auto");

					$(this).addClass("up");

				}

				setTimeout(function(){

					isclick=false;

				},500);

			});



			$(".filter_item a").bind("click",function(){

				var _a=$(this);

				var urls = _a.attr("href");

				if(isclick){

					isclick=false;

					_a.attr("href","javascript:;");

					setTimeout(function(){

						_a.attr("href",urls);

					},500);

				}

			});

		//��ʾ�����ظ��ɸѡ��

		$(".filter_more").bind("click",function(){

			var btn_more = $(this);



			$(".filter .filter_item").each(function(){



				if($(this).css('display') == "none" ){

					$(this).css('display','block').addClass('none');

					btn_more.addClass("less").find("span").text("Simplify filtering condition");

				}else if($(this).hasClass("none") && $(this).css('display') != "none"){

					$(this).css('display','none');

					btn_more.removeClass("less").find("span").text("More filtering conditions");

				}

				

				

			});

			

		});	

	}

	

});

