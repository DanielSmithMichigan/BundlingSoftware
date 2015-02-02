function responder() {
	this.modal_count = 0;
	this.catchResponse = function(responses) {
		for(var i = 0; i < responses.length; i++) {
			var response = responses[i];
			var action = response.action;
			if (action === 'replace_html') {
				this.performHTMLReplace(response);
			} else if (action === 'replace_data') {
				this.performDataReplace(response);
			} else if (action === 'show_footer') {
				this.performShowFooter(response);
			} else if (action === 'congratulate') {
				this.performCongratulation(response);
			}
		}
	};
	this.performShowFooter = function(response) {
		var amount = response.properties.amount;
		expandFooter(amount);
	}
	this.performHTMLReplace = function(response) {
		var html = response.html;
		var slot_name = response.slot_name;
		var element_selector = '.' + slot_name;
		$(element_selector).html(html);
	};
	this.performDataReplace = function(response) {
		var var_data = response.var_data;
		var var_name = response.var_name;
		var controller_id = response.controller_id;
		var angularElement = $('#' + controller_id).get(0);
		var $scope = angular.element(angularElement).scope();
		$scope.$apply(function() {
			$scope[var_name] = var_data;
		});
	};
	this.performAngularHTMLReplace = function(response) {
		var html = response.html;
		var slot_name = response.slot_name;
		var element_selector = '.' + slot_name;
		var controller_id = response.controller_id;
		$(element_selector).html(html);
	}
	this.performCongratulation = function(response) {
		$.bootstrapGrowl(response.properties.message, {
			align: 'center'
		});
	}
}