var loader = {
	init: function(){
		var loader = "<div id=\"loader-bg\" style=\"z-index:9999;background:#000;opacity:0.5;position:fixed;height:100%;width:100%;top:0;left:0;\"><div style=\"margin:20% auto;color:#fff;font-size:18px;width:133px;\"><i class=\"fa fa-refresh fa-spin\"></i>&nbsp;&nbsp;Please wait...</div></div> ";
		$('body').append(loader);
	},
	destroy: function(){
		$('#loader-bg').remove();
	}
}