function add_fields()
{
	if($('.type').val() == '0')
	{
		$('.qtype').slideUp('fast');
		return;
	}
	
	$('#type-' + type).slideUp('fast');

	type = $('.type').val();

	$('#type-' + type).slideDown('slow');
}

function add_answers()
{
	$('.multianswers').html('<table>');
	$('.multianswers table').append('<tr><th></th><th>Answer</th><th>Answer Image</th><th>Correct?</th></tr>');
	for (var i=0;i<$('.no_answers').val();i++)
	{
		$('.multianswers table').append('<tr><td>' + String.fromCharCode(97 + i) + ':</td><td><input type="text" name="answer'+i+'" value="" onchange="add_answers()" class="no_answers" /></td><td><input type="file" name="aimage-'+i+'" value=""  /></td><td>Yes <input type="radio" name="correct-'+i+'" value="yes"  /> No <input type="radio" name="correct-'+i+'" value="no"  /></td></tr>');
	}
}
 
$(document).click(function() {
    $(".save").hide();
});

$(document).ready(function() {
	/*
	 *	Set up the page 
	 */
	 $('.answers').toggle(); // Hide Answers.


	$('.editable').click(function (e) {
    	$(".save").hide();
	    $(this).children(".save").show();
	    e.stopPropagation();
	});

	$('.save').click(function(e)
	{

		var result = $(this).parent('.editable').html().replace(/<button .*<\/button>/,'');
		result += '#'+$(this).closest('.grid12').children('.id').html();
		
		var type = $(this).attr('class').replace('save ','');
		
		$.ajax({
			url: base_url + 'index.php/questions/update',
			type: 'POST',
			dataType: "xml",        
			data: {
				type: type,
				data: result,
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
                    $(".save").hide();
                    $('#alert').slideDown('slow').delay(3000).slideUp('slow');
			}
		});
	});

	$('a.setting').click(function(e)
	{
		if ($(this).html() == 'Delete')
		{
			delete_question($(this).closest('.grid12').children('.id').html());
			$(this).closest('.grid12').slideUp('slow');
		}
		else if ($(this).html() == 'View' || $(this).html() == 'Hide' )
		{
			$(this).closest('.grid12').children('.answers').slideToggle('slow');
			if ($(this).html() == 'View')
			{
				$(this).html('Hide');
			}
			else 
			{
				$(this).html('View');
			}
		}
		e.preventDefault();

	});

	$(".save").hide();
});

function delete_question(id)
{
	alert(id);
	$.ajax({
		url: base_url + 'index.php/questions/delete',
		type: 'POST',
		dataType: "text",        
		data: {
			id: id,
			type: 'question',
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
