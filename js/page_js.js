var memory = new memory();
$(document).ready(function() {
	var responder_obj = new responder();
	$('.user_selector').click(function() {
		var user_no = $(this).children('.user_no').val();
		var send_data = {};
		send_data.action = 'login';
		send_data.user_no = user_no;
		sendAjax(send_data, responder_obj);
	});
	$(document).on("click", '.create_bundles', function() {
		var send_data = {};
		send_data.action = 'create_bundles';
		sendAjax(send_data, responder_obj);
	});
	$(document).on("click", '.add_parts', function() {
		var send_data = {};
		send_data.action = 'add_parts';
		send_data.params = getParams(this);
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.load_menu', function() {
		var send_data = {};
		send_data.action = 'load_menu';
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.add_part', function() {
		var send_data = {};
		send_data.action = 'add_part';
		send_data.params = getParams(this);
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.remove_part', function() {
		var send_data = {};
		send_data.action = 'remove_part';
		send_data.params = getParams(this);
		sendAjax(send_data, responder_obj);
	});
	
	$(document).on('click', '.alter_title li a', function() {
		var clicked_elem = jQuery(this);
		var owner = clicked_elem.parents('.alter_title');
		var title = owner.data('title');
		var new_html = title;
		if (!clicked_elem.hasClass('clr')) {
			new_html += ': ' + clicked_elem.html();
		} 
		owner.find('.change_me').html(new_html);
	});
	$(document).on('click', '.filter_selector', function() {
		var send_data = {};
		send_data.action = 'add_filter';
		send_data.params = getParams(this);
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.hide_footer', function() {
		hideFooter();
	});
});

function expandFooter(amount) {
	if (typeof amount === 'undefined') amount = '50';
	amount = amount + 'px';
	var footer = $('#static_footer');
	footer.show();
	footer.css('height', amount);
	var wrapper = $('#static_wrapper');
	wrapper.css('padding-bottom', amount);
	memory.footer_showing = true;
}
function hideFooter() {
	if (memory.footer_showing === true) {
		expandFooter(0);
		var footer = $('#static_footer');
		footer.hide();
		memory.footer_showing = false;
	}
}
function sendAjax(send_data, responder_obj) {
	$.ajax({
		type: 'POST',
		url: 'response.php',
		dataType:'json',
		data: send_data,
		success: function(responses) {
			responder_obj.catchResponse(responses);
		}
	});
}

function getParams(elem) {
	elem = $(elem);
	var params = {};
	elem.find('.params').children('input').each(function(){
		var input = $(this);
		var param_name = input.attr('name');
		var param_value = input.val()
		params[param_name] = param_value;
	});
	return params;
}