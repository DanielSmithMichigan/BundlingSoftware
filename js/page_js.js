var memory = new memory();
var fnTimer = new functionTimer();
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
		var owner = clicked_elem.closest('.alter_title');
		var title = owner.data('title');
		var new_html = title;
		if (!clicked_elem.hasClass('clr')) {
			new_html += ': ' + clicked_elem.html();
		} 
		owner.find('.change_me').html(new_html);
	});
	$(document).on('click', '.filter_selector', function() {
		var send_data = {};
		var filters = [];
		var selected_class = 'selected';
		var clr_class = 'clr';
		var individual_filter_selector_element = ' a.filter_selector ';
		var individual_filter_selector = ' ul.filter_menu li ' + individual_filter_selector_element;
		
		// remove selected from all selectors in this group
		var filter_group = $(this).closest('.filter_group');
		var all_filters_curr_group = filter_group.find(individual_filter_selector);
		all_filters_curr_group.removeClass(selected_class);
		
		// add selected to the selected element in filter
		var curr_filter = $(this).closest(individual_filter_selector_element)
		curr_filter.addClass(selected_class);
		
		
		// get filter data from all filter
		var selected_filter_selector = ' a.filter_selector.selected ';
		var individual_selected_filter = ' ul.filter_menu li ' + selected_filter_selector;
		var all_selected_filters = $('.part_filters').find(individual_selected_filter);
		all_selected_filters.each(function() {
			if (!jQuery(this).hasClass(clr_class)) {
				filters.push(getParams(this));
			}
		});
		
		var bundle_no = $('div.part_filters').children('input.bundle_no').val();
		
		send_data.action = 'add_filter';
		send_data.filters = filters;
		send_data.bundle_no = bundle_no;
		sendAjax(send_data, responder_obj);
		
	});
	$(document).on('click', '.hide_footer', function() {
		hideFooter();
	});
	$(document).on('click', '.delete_bundle', function() {
		bootbox.confirm("Are you sure you want to delete this bundle?", function(result) {
			if (result) {
				var send_data = {};
				send_data.action = 'delete_bundle';
				send_data.params = getParams(this);
				sendAjax(send_data, responder_obj);
			}
		}.bind(this));
	});
	$(document).on('click', '.create_bundle', function() {
		var send_data = {};
		send_data.action = 'create_bundle';
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.delete_all_bundles', function() {
		bootbox.confirm("Are you sure you want to delete ALL bundles?", function(result) {
			if (result) {
				var send_data = {};
				send_data.action = 'delete_all_bundles';
				sendAjax(send_data, responder_obj);
			}
		}.bind(this));
	});
	$(document).on('click', '.customer_view', function() {
		hide_menu();
		var send_data = {};
		send_data.action = 'customer_view';
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.duplicate_bundle', function() {
		var send_data = {};
		send_data.action = 'duplicate_bundle';
		send_data.params = getParams(this);
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.update_warranty', function() {
		var send_data = {};
		send_data.action = 'update_warranty';
		send_data.params = getParams(this);
		sendAjax(send_data, responder_obj);
	});
	$(document).on('click', '.hide_menu', function() {
		hide_menu();
	});
	$(document).on('click', '.show_menu', function() {
		$('.top_menu_shown').show();
		$('.top_menu_hidden').hide();
	});
	$(document).on('keyup', '.update_bundle_name_modifier', function () {
		var function_name = 'updateBundleName';
		var function_time = 1500;
		var fade_time = 250;
		fnTimer.reseat(function_name, setTimeout(function() {
			$(this).parent().children('.params').children('.bundle_title').val($(this).val());
			var send_data = {};
			send_data.action = 'update_bundle_title';
			send_data.params = getParams($(this).parent());
			sendAjax(send_data, responder_obj);
			fnTimer.remove(function_name);
		}.bind(this), function_time)); 
	});
});

function hide_menu() {
	$('.top_menu_shown').hide();
	$('.top_menu_hidden').show();
}

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