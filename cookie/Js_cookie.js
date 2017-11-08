// 直接在李兰器的console输入行打开，执行
var Cookie = {
	set : function( key, val, expiresDays ){
		//判断是否设置expires
		if ( expiresDays ){
			var day = new Date();
			day.setTime( day.getTime() + expiresDays * 24 * 3600 * 1000 );
			var expireStr = 'expires=' + day.toGMTString() + ';' ;
		} else {
			var expireStr = '';
		}
		document.cookie = key + '=' + escape(val) + ';' + expireStr;
		//escape()对字符串进行编码，使得计算机可以读取字符串而不会产生乱码
	},
	get : function(key){
		var getCookie = document.cookie.replace(/[ ]/g,'');
		var resArr = getCookie.split(';');
		var res;
		for(var i = 0, len = resArr.length; i < len; i ++ ){
			var arr = resArr[i].split('=');
			if(arr[0] == key){
				res = arr[1];
				break;
			}
		}
		return unescape(res);
	}
}