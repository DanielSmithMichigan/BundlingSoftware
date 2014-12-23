function responder() {
	this.catchResponse = function(responses) {
		for(var i = 0; i < responses.length; i++) {
			var response = responses[i];
			var action = response.action;
			if (action === 'replace') {
				this.performReplace(response);
			}
		}
	};
	this.performReplace = function(response) {
		var html = response.html;
		var slot_name = response.slot_name;
		var element_selector = '.' + slot_name;
		$(element_selector).html(html);
	};
}