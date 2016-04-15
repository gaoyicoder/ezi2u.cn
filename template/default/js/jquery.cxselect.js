/*!
 * jQuery cxSelect
 * @name jquery.cxselect.js
 * @version 1.3.3
 * #date 2013-10-20
 * @author ciaoca
 * @email ciaoca@gmail.com
 * @site https://github.com/ciaoca/cxSelect
 * @license Released under the MIT license
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){a.cxSelect=function(b){var c,h,i,d={dom:{},api:{}},e=function(a){return a&&("function"==typeof HTMLElement||"object"==typeof HTMLElement)&&a instanceof HTMLElement?!0:a&&a.nodeType&&1===a.nodeType?!0:!1},f=function(a){return a&&a.length&&("function"==typeof jQuery||"object"==typeof jQuery)&&a instanceof jQuery?!0:!1};for(h=0,i=arguments.length;i>h;h++)f(arguments[h])?c=arguments[h]:e(arguments[h])?c=a(arguments[h]):"object"==typeof arguments[h]&&(b=arguments[h]);if(!(c.length<1))return d.init=function(){var e,d=this;if(d.dom.box=c,d.settings=a.extend({},a.cxSelect.defaults,b,{url:d.dom.box.data("url"),nodata:d.dom.box.data("nodata"),required:d.dom.box.data("required"),firstTitle:d.dom.box.data("firstTitle"),firstValue:d.dom.box.data("firstValue")}),d.settings.selects.length){for(d.selectArray=[],d.selectSum=d.settings.selects.length,e=0;e<d.selectSum&&d.dom.box.find("select."+d.settings.selects[e]);e++)d.selectArray.push(d.dom.box.find("select."+d.settings.selects[e]));d.selectSum=d.selectArray.length,d.selectSum&&("string"==typeof d.settings.url?a.getJSON(d.settings.url,function(a){d.dataJson=a,d.buildContent()}):"object"==typeof d.settings.url&&(d.dataJson=d.settings.url,d.buildContent()))}},d.getIndex=function(a){return this.settings.required?a:a-1},d.getNewOptions=function(b,c){var d,e,f,g,h;if(b)return d=this.settings.firstTitle,e=this.settings.firstValue,f=b.data("firstTitle"),g=b.data("firstValue"),h="",("string"==typeof f||"number"==typeof f||"boolean"==typeof f)&&(d=f.toString()),("string"==typeof g||"number"==typeof g||"boolean"==typeof g)&&(e=g.toString()),this.settings.required||(h='<option value="'+e+'">'+d+"</option>"),a.each(c,function(a,b){h+="string"==typeof b.v||"number"==typeof b.v||"boolean"==typeof b.v?'<option value="'+b.v+'">'+b.n+"</option>":'<option value="'+b.n+'">'+b.n+"</option>"}),h},d.buildContent=function(){var b,a=this;a.dom.box.on("change","select",function(){a.selectChange(this.className)}),b=a.getNewOptions(a.selectArray[0],a.dataJson),a.selectArray[0].html(b).prop("disabled",!1).trigger("change"),a.setDefaultValue()},d.setDefaultValue=function(a){var b,c;a=a||0,b=this,a>=b.selectSum||!b.selectArray[a]||(c=b.selectArray[a].data("value"),("string"==typeof c||"number"==typeof c||"boolean"==typeof c)&&(c=c.toString(),setTimeout(function(){b.selectArray[a].val(c).trigger("change"),a++,b.setDefaultValue(a)},1)))},d.selectChange=function(a){var b,c,d,e,f,g;for(a=a.replace(/ /g,","),a=","+a+",",b=[],g=0;g<this.selectSum;g++)b.push(this.getIndex(this.selectArray[g].get(0).selectedIndex)),"number"==typeof c&&g>c&&(this.selectArray[g].empty().prop("disabled",!0),"none"===this.settings.nodata?this.selectArray[g].css("display","none"):"hidden"===this.settings.nodata&&this.selectArray[g].css("visibility","hidden")),a.indexOf(","+this.settings.selects[g]+",")>-1&&(c=g);for(d=c+1,e=this.dataJson,g=0;d>g;g++){if("undefined"==typeof e[b[g]]||Array.isArray(e[b[g]].s)===!1||!e[b[g]].s.length)return;e=e[b[g]].s}this.selectArray[d]&&(f=this.getNewOptions(this.selectArray[d],e),this.selectArray[d].html(f).prop("disabled",!1).css({display:"",visibility:""}).trigger("change"))},d.init(),this},a.cxSelect.defaults={selects:[],url:null,nodata:null,required:!1,firstTitle:"请选择",firstValue:"0"},a.fn.cxSelect=function(b,c){return this.each(function(){a.cxSelect(this,b,c)}),this}});