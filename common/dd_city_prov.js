 var City_Province = function() {

	this.__construct = function() {
		// console.log('City');
		event = new Event();
		loader.init();
		load_city();
		load_province();
		loader.destroy();
	};

	var load_city = function() {
	    $.get('api/city', function(o) {
	        var output = '';
	        for (var i = 0; i < o.length; i++) {
    			output += '<option value=' + o[i].id + '>' + o[i].name + '</td>';
	        }
	        $("#city").html(output);
		}, 'json');
	};

	var load_province = function() {
	    $.get('api/province', function(o) {
	        var output = '';
	        for (var i = 0; i < o.length; i++) {
    			output += '<option value=' + o[i].id + '>' + o[i].name + '</td>';
	        }
	        $("#province").html(output);
		}, 'json');
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

var Event = function() {
	 this.__construct = function() {
	 	// console.log('City Event');
	 	dd_province_click();
	 };

	var dd_province_click = function() {
		$(".content").on('change', '#province', function() {
			var dd = this;
			// alert(dd.value);
			loader.init();
			get_city(dd.value);
			loader.destroy();
		});
	};

	var get_city = function(prov_id) {
		$("#city").empty();
	    $.get('api/city/' + prov_id, function(o) {
	        var output = '';
	        for (var i = 0; i < o.length; i++) {
    			output += '<option value=' + o[i].id + '>' + o[i].name + '</td>';
	        }
	        $("#city").html(output);
		}, 'json');
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

