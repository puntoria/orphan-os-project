// Helpers

;var Helpers = {
	API: function(path) {
		return API_URL + "/" + path;
	},

	inArray: function(value, array) {
		return array.indexOf(value) > -1;
	},

	replaceObject: function(a, b) {
		var prop;

		for ( prop in a ) delete a[prop];
		for ( prop in b ) a[prop] = b[prop]; 
	}
};