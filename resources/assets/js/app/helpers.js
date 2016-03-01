// Helpers

;var Helpers = {
	API: function(path) {
		return API_URL + "/" + path;
	},

	inArray: function(value, array) {
		return array.indexOf(value) > -1;
	},
	
	dataURItoBlob: function(dataURI) {
		'use strict'
		var byteString, 
		mimestring 
		
		if(dataURI.split(',')[0].indexOf('base64') !== -1 ) {
			byteString = atob(dataURI.split(',')[1])
		} else {
			byteString = decodeURI(dataURI.split(',')[1])
		}
		
		mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0]
		
		var content = new Array();
		for (var i = 0; i < byteString.length; i++) {
			content[i] = byteString.charCodeAt(i)
		}
		
		return new Blob([new Uint8Array(content)], {type: mimestring});
	},

	loopObject: function(_callback, obj) {
		for (var key in obj) {
			if (!obj.hasOwnProperty(key)) {
				continue;
			}

			_callback(key, obj);
		}
	},

	getMonth: function(index) {
		return TRANSLATIONS.months[index];
	},
};