 var Register_Template = function() {

	this.__construct = function() {
		console.log('Register Created');
		event = new Event();
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

var Event = function() {
	 this.__construct = function() {
	 	// console.log('City Event');
	 	register_click();
	 };

	var register_click = function() {

		$("#frm_register").submit(function(){          
		    // evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            
            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('Todo created successfuly.');
                    $("#todo_create_content").val('');
                    var output = template.todo(o.data);
                    $("#list_todo tbody").append(output);
                } else {
                    alert('error!');
                }
            }, 'json');     
		}); 
	};

	this.__construct();
};

//------------------------------------------------------------------------------------------------

