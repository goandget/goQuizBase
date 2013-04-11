$(document).ready(function() {
	$('.answer').toggle();
	$('.timeout').toggle();
	setTimeout(answerReveal, 1000);
	setTimeout(quizCount, 1000);
});

var answerReveal = function(){

	// Countdown Script
	var countID = 'answerreveal'; 	// the name of the ID that contains the countdown script.
	// Hide the Count Down Number
	$('.'+countID).hide();

    if($('.'+countID).html() == 0){
        // Reveal Answers
        $('.answer').slideDown('slow');
    }
    else {
    	$('.'+countID).html($('.'+countID).html() - 1);
        setTimeout(answerReveal, 1000); // check again in a second
    }

}

var quizCount = function(){

	// Countdown Script
	var countID = 'timeout'; 	// the name of the ID that contains the countdown script.
	var formID = 'questionForm';
	// Hide the Count Down Number
	$('.'+countID).hide();

    if($('#'+countID).html() == 0){
        // Submit Question after time out.
        $('#'+formID).append("<input type='hidden' name='finish' value='1' />");
        $('#'+formID).submit();
    }
    else {
    	$('#'+countID).html($('#'+countID).html() - 1);
        setTimeout(quizCount, 1000); // check again in a second
    }
}
