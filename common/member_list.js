 var Template = function() {

	this.__construct = function() {
		// console.log('Member Created');
		event = new Event();
		view_member();
	};

	var view_member = function() {
		loader.init();
		get_member();
		loader.destroy();
	};

	var get_member = function() {
	    $.get('member/get_list', function(o) {
	        var output = '';
	        output += '<tr>';
	        output += '<th>Id</th>';
	        output += '<th>Name</th>';
	        output += '<th>Username</th>';
	        output += '<th>Date Added</th>';
	        output += '<th>Status</th>';
	        output += '</tr>';
	        for (var i = 0; i < o.length; i++) {
	            output += '<tr>';
	            output += '<td>' + o[i].id + '</td>';
	            output += '<td>' + o[i].name + '</td>';
	            output += '<td>' + o[i].username + '</td>';
	            output += '<td>' + o[i].dateAdded + '</td>';
	            output += '<td><span class="badge ' + o[i].badgeStatus + '">' + o[i].badgeStatusLabel + '</span></td>';
	            output += '</tr>';
		    }
		    $("#member_list").html(output);
		}, 'json');
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

var Event = function() {
	 this.__construct = function() {
	 	badge_click();
	 };

	var badge_click = function() {
		$(".table").on('click', '.badge', function() {
	 	// $('.badge').on('click', function() {
		var span = this;
		$(span).removeClass('bg-green');
		$(span).html('Loading...');
		loader.init();
		/*
		Replace this with an ajax call
		*/
		setTimeout(function(){
			 $(span).addClass('bg-yellow');
			 $(span).html('Inactive');
			 loader.destroy();
			}, 2500);
 		});
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

