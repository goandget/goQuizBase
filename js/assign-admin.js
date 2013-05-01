$(document).ready(function() {
	// Initialise Plugin
	var options = {
		additionalFilterTriggers: [$('#quickfind')],
		clearFiltersControls: [$('#cleanfilters')],         
	};
	$('#users').tableFilter(options);
	$('.filters').toggle();

	$('.assign').click(function(){
		
		if ($(this).attr('alt') != undefined)
		{
			assign($(this).attr('alt'),$('.attempts').html(),$( "#startDate" ).val(),$( "#endDate" ).val());
		}
		else 
		{
			assign($(this).html(),$('.attempts').html(),$( "#startDate" ).val(),$( "#endDate" ).val());
		}
	});

		// Set Assign Date Restrictions.

	    $( "#startDate" ).datepicker({dateFormat: "yy-mm-dd" });
	    $( "#startDate" ).change(function(){
	    	$( "#endDate" ).datepicker( "option", "minDate", $( "#startDate" ).val());
	    });

	    $( "#endDate" ).datepicker({dateFormat: "yy-mm-dd"});

});

function assign(id,attempts,start_date,end_date) {

	$.ajax({
		url: base_url + 'index.php/quiz/set_assign',
		type: 'POST',
		dataType: "xml",        
		data: {
			id: id,
			attempts: attempts,
			start: start_date,
			end: end_date,
			ajax: 1
		},
		success:function (data) {
				
                $('#alert').remove();

                var $message = $(data).find('message');

                var html = '<div id="alert" class="' + $message.find('type').text() + '">';                    

                html += '<h3>' + $message.find('title').text() + '</h3>';

                html += '<div class="message">' + $message.find('content').text()  + '</div>';                   

                html += '</div>';

                $('#container').prepend(html);
                $('#alert').toggle();
                $('#alert').slideDown('slow').delay(3000).slideUp('slow');
		}
	});
}