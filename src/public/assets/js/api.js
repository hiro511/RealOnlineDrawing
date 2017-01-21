function api(path, method, dataType, data, is_async, done, fail){
	baseURL = "./api/";
	$.ajax({
		url: baseURL+path ,
		dataType: dataType,
		method: method,
		data: data,
		async: is_async,
	})
	.done(function(data){
		done(data);
	})
	.fail(function(){
		fail();
	})
}

function apiJson(path, method, data, is_async, done, fail){
	api(path, method, 'json', data, is_async, done, fail);
}