/**
 * 
 */
var ZohoConverter = {
	jsonToXML: function(jsonObject, row){
		var xml = '<row no="' + row + '">';
		for(var index in jsonObject){
			var value = jsonObject[index];
			if(typeof jsonObject[index] === "string"){
				value = jsonObject[index].replace("&", "and");
				value = value.replace(/#/g, " ");
			}
			
			xml += '<FL val="' + index + '"><![CDATA[' + value + ']]></FL>';
		}
		xml += '</row>';
		return xml;
	}
}
 