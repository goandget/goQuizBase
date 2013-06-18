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
			assign($(this).attr('alt'),$('.attempts').html(),$( "#startDate" ).val(),$( "#endDate" ).val(),'user');
		}
		else 
		{
			assign($(this).html(),$('.attempts').html(),$( "#startDate" ).val(),$( "#endDate" ).val(),'class');
		}
	});

		// Set the default Start and End Assigned Dates

		var today = new Date();
		var tomorrow = new Date();
		tomorrow.setDate(today.getDate()+1);
		$( "#startDate" ).val(dateConvert(today,"YYYY-MM-DD"));
		$( "#endDate" ).val(dateConvert(tomorrow,"YYYY-MM-DD"));

		// Set the Date Pickers Up

	    $( "#startDate" ).datepicker({dateFormat: "yy-mm-dd" });
	    $( "#startDate" ).change(function(){
	    	$( "#endDate" ).datepicker( "option", "minDate", $( "#startDate" ).val());
	    });

	    $( "#endDate" ).datepicker({dateFormat: "yy-mm-dd"});
	    $( "#endDate" ).datepicker( "option", "minDate", dateConvert(tomorrow,"YYYY-MM-DD"));

});

function assign(id,attempts,start_date,end_date,type) {

	$.ajax({
		url: base_url + 'index.php/quiz/set_assign',
		type: 'POST',
		dataType: "xml",        
		data: {
			id: id,
			attempts: attempts,
			start: start_date,
			end: end_date,
			type: type,
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

function dateConvert(dateobj,format){

    var year = dateobj.getFullYear();

    var month= ("0" + (dateobj.getMonth()+1)).slice(-2);

    var date = ("0" + dateobj.getDate()).slice(-2);

    var hours = ("0" + dateobj.getHours()).slice(-2);

    var minutes = ("0" + dateobj.getMinutes()).slice(-2);

    var seconds = ("0" + dateobj.getSeconds()).slice(-2);

    var day = dateobj.getDay();

    var months = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];

    var dates = ["SUN","MON","TUE","WED","THU","FRI","SAT"];

    var converted_date = "";

    switch(format){

      case "YYYY-MM-DD":

        converted_date = year + "-" + month + "-" + date;

        break;

      case "YYYY-MMM-DD DDD":

        converted_date = year + "-" + months[parseInt(month)-1] + "-" + date + " " + dates[parseInt(day)];

        break;

    }

    return converted_date;

  }
