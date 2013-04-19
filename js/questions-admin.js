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

$('.editable').click(function (e) {
	alert('hi');
    $(this).next(".save").show();
    e.stopPropagation();
});