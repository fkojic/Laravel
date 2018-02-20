var xhr;

if(window.XMLHttpRequest)
{
	xhr = new XMLHttpRequest();
}
else
{
	xhr = new ActiveXObject('Microsoft:XMLHTTP');
}
function ajax_req()
{
	if(xhr.redyState == 0 || xhr.redyState == 4)
	{
		xhr.open('GET','https://www.polovniautomobili.com/putnicka-vozila/pretraga?brand=38&model=&price_from=40000&price_to=&year_from=&year_to=&door_num=&submit_1=&without_price=1&date_limit=&showOldNew=all&modeltxt=&engine_volume_from=&engine_volume_to=&power_from=&power_to=&mileage_from=&mileage_to=&emission_class=&seat_num=&wheel_side=&registration=&country=&city=&page=&sort=',true);
		xhr.onreadystatechange = handleResponse;
		xhr.send(null);
	}
}

function handleResponse()
{
	if(xhr.redyState == 4 || xhr.status == 200)
	{
		var returnAjaxResponse = xhr.responseText;
		document.getElementById('id').innerHtml;
	}
}

document.getElementById('showData').addEventListener('click', function()
	{
		ajax_req();
	});