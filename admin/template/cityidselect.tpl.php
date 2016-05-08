<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.autocomplete.min.js"></script> 

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/jquery.autocomplete.css" />

<script type="text/javascript"> 

var cities = [

<? $i=1;if(is_array($allcities = get_allcities()))foreach($allcities as $k =>$v){?>

<? if($i > 1) echo ',';?>{ name1: "<?=$v[cityid]?>",name: "<?=$v[directory]?>", to: "<?=$v[cityname]?>" }

<? $i=$i+1;}?>

];

$(function() {

$('#cityid').autocomplete(cities, {

max: 400, //�б������Ŀ�� 

minChars: 0, //�Զ���ɼ���֮ǰ�������С�ַ� 

width: 166, //��ʾ�Ŀ�ȣ�������� 

scrollHeight: 300, //��ʾ�ĸ߶ȣ������ʾ������ 

matchContains: true, //��ƥ�䣬����data���������ݣ��Ƿ�ֻҪ���ı��������ݾ���ʾ 

autoFill: false, //�Զ���� 

formatItem: function(row, i, max) { 

return row.to; 

}, 

formatMatch: function(row, i, max) { 

return row.name1 + row.name + row.to; 

}, 

formatResult: function(row) { 

return row.name1; 

} 

});

});

</script>