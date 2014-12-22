$(document).ready(function() {
	$('.user_selector').click(function() {
		var user_no = $(this).children('.user_no').val();
		var send_data = {};
		send_data.action = 'login';
		send_data.user_no = user_no;
		$.ajax({
			type: 'POST',
			url: 'response.php',
			dataType:'json',
			data: send_data,
			success: function(responses) {
				var responder_obj = new responder();
				responder_obj.catchResponse(responses);
			}
		});
	});
	$('.menu_div .menu_expander').click(function() {
		slideMenuIn();
	});
});

function slideMenuIn(slideAmount) {
	if (typeof slideAmount === 'undefined') slideAmount = '140px';
	var body = $('body');
	var menu_and_items = $('.menu_div, .menu_div .menu_line_item');
	body.animate({paddingLeft: slideAmount},'slow');
	menu_and_items.animate({width: slideAmount},'slow');
	$('.menu_div .expand_menu').hide();
	var menu_expander = $('.menu_div .menu_expander');
	$('.menu_div .menu_expander').off('click');
	$('.menu_div .menu_expander').click(function() {
		slideMenuOut();
	});
}

function slideMenuOut(slideAmount) {
	if (typeof slideAmount === 'undefined') slideAmount = '25px';
	var body = $('body');
	var menu_and_items = $('.menu_div, .menu_div .menu_line_item');
	body.animate({paddingLeft: slideAmount},'slow');
	menu_and_items.animate({width: slideAmount},'slow', function() {
		$('.menu_div .expand_menu').show();
	});
	var menu_expander = $('.menu_div .menu_expander');
	$('.menu_div .menu_expander').off('click');
	$('.menu_div .menu_expander').click(function() {
		slideMenuIn();
	});
	
}