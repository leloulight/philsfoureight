var Bills = function() {

	this.__construct = function() {
		// console.log('City');
		event = new Event();
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

var Event = function() {
	 this.__construct = function() {
	 	// console.log('City Event');
	 	bills_main_click();
	 };

	var bills_main_click = function() {
		$(".content").on('change', '#bills_main', function() {
			var dd = this;
			// alert(dd.value);
			loader.init();
			get_sub(dd.value);
			loader.destroy();
		});
	};

	var get_sub = function(bills_main) {
		$("#bills_sub").empty();
	    $.get('/api/bills_sub/' + bills_main, function(o) {
	        var output = '';
	        for (var i = 0; i < o.length; i++) {
    			output += '<option value=' + o[i].id + '>' + o[i].name + '</td>';
	        }
	        $("#bills_sub").html(output);
		}, 'json');
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

