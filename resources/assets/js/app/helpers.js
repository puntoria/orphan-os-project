// Helpers

;var Helpers = {
	API: function(path) {
		return API_URL + "/" + path;
	},

	inArray: function(value, array) {
		return array.indexOf(value) > -1;
	}
};