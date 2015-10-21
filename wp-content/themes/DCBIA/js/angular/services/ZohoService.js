angular.module('angular-wp')
	.factory('ZohoService', function($http) {

		return{
			insertAccount: function(account, callback){
				var xmlData = "<Accounts>";
				xmlData += ZohoConverter.jsonToXML(account, 1);
				xmlData += "</Accounts>";
				
				var url = zohoEnv.url + "Accounts/insertRecords?authtoken=" + zohoEnv.authtoken 
					+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
					+ "&newFormat=1" 
					+ "&xmlData=" + xmlData;
				
				$http({
					url: url,
					method: "GET"
				}).success(function (data){
					return callback(data);
				});
			},
			
			insertContacts: function(members, callback){				
				var url = zohoEnv.url + "Contacts/insertRecords?authtoken=" + zohoEnv.authtoken 
				+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
				+ "&newFormat=1"; 

				var xmlData = "<Contacts>";
				var row = 1;
				for(index in members){
					xmlData += ZohoConverter.jsonToXML(members[index], row);
					row++;
				}
				xmlData += "</Contacts>";
				url += "&xmlData=" + xmlData;
				
				$http({
					url: url,
					method: "GET"
				}).success(function (data){
					return callback(data);
				});
				
			},
			
			insertPayment: function(payment, callback){				
				var url = zohoEnv.url + "Potentials/insertRecords?authtoken=" + zohoEnv.authtoken 
				+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
				+ "&newFormat=1"; 

				var xmlData = "<Potentials>";
				xmlData += ZohoConverter.jsonToXML(payment, 1);
				xmlData += "</Potentials>";
				
				url += "&xmlData=" + xmlData;
				
				console.log(url);
				$http({
					url: url,
					method: "GET"
				}).success(function (data){
					return callback(data);
				});
				
			},
			
		};
	});