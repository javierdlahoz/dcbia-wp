angular.module('angular-wp')
	.factory('ZohoService', function($http) {

		return{
			insertAccount: function(account, callback){
				if(account["ACCOUNTID"] !== undefined && account["ACCOUNTID"] != "" && account["ACCOUNTID"] !== null){
					this.updateAccount(account["ACCOUNTID"], 
							account, 
							function(data){
								return callback(data);
							}
					);
					return callback(false);
				}
				
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
					if(members[index]["CONTACTID"] !== undefined && members[index]["CONTACTID"] != "" && members[index]["CONTACTID"] !== null){
						this.updateContact(members[index]["CONTACTID"], 
								members[index], 
								function(data){
							
								}
						);
					}
					else{
						xmlData += ZohoConverter.jsonToXML(members[index], row);
						row++;
					}
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
				$http({
					url: url,
					method: "GET"
				}).success(function (data){
					return callback(data);
				});
				
			},
			
			getAccount: function(accountName, callback){				
				var url = "https://crm.zoho.com/crm/private/json/" + "Accounts/searchRecords?authtoken=" + zohoEnv.authtoken 
				+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
				+ "&newFormat=1&criteria=(Account Name:"+accountName+")"; 
				
				$http.jsonp(url).success(function (data){
					return callback(data);
				});
			},
			
			getContact: function(email, callback){				
				var url = "https://crm.zoho.com/crm/private/json/" + "Contacts/searchRecords?authtoken=" + zohoEnv.authtoken 
				+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
				+ "&newFormat=1&criteria=(Email:"+email+")"; 
				$http({
					url: url,
					method: "POST",
					dataType:'jsonp'
				}).success(function (data){
					return callback(data);
				});
			},
			
			updateAccount: function(accountId, account, callback){
				var xmlData = "<Accounts>";
				xmlData += ZohoConverter.jsonToXML(account, 1);
				xmlData += "</Accounts>";
				
				var url = zohoEnv.url + "Accounts/updateRecords?authtoken=" + zohoEnv.authtoken 
				+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
				+ "&newFormat=1" + "&id=" + accountId
				+ "&xmlData=" + xmlData;
				
				$http({
					url: url,
					method: "GET"
				}).success(function (data){
					return callback(data);
				});
			},
			
			updateContact: function(contactId, contact, callback){
				var xmlData = "<Contacts>";
				xmlData += ZohoConverter.jsonToXML(contact, 1);
				xmlData += "</Contacts>";
				
				var url = zohoEnv.url + "Contacts/updateRecords?authtoken=" + zohoEnv.authtoken 
				+ "&scope=" + zohoEnv.scope + "&wfTrigger=true&version=" + zohoEnv.version
				+ "&newFormat=1" + "&id=" + contactId
				+ "&xmlData=" + xmlData; 
				
				$http({
					url: url,
					method: "GET"
				}).success(function (data){
					return callback(data);
				});	
			},
			
		};
	});