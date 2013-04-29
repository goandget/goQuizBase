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
			assign($(this).attr('alt'),$('.attempts').html());
		}
		else 
		{
			assign($(this).html(),$('.attempts').html());
		}
	});

});

function assign(id,attempts) {

	$.ajax({
		url: base_url + 'index.php/quiz/set_assign',
		type: 'POST',
		dataType: "xml",        
		data: {
			id: id,
			attempts: attempts,
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