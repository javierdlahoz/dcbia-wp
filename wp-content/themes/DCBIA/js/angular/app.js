angular.module('angular-wp', ['google.places']);

function getUrls() {
	return {

		//for resources
		searchResources: "/api/resources/search",
		getAreasOfFocus: "/api/resources/areasoffocus",
		getResourceTypes: "/api/resources/types",
		getResourceFormats: "/api/resources/formats",
		getResourceStakeholders: "/api/resources/stakeholders",
		deleteResourceFile: "/api/resources/delete_file",

		//for regular posts
		searchPost: "/api/post/search",

		//for email
		sendContactEmail: "/api/email/send",
		shareThis: "/api/email/share"
	};
}

function getContentTypes() {
	return {
		form: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		xml: {
			'Content-Type': 'application/xml'
		},
	};
}


var zohoEnv = {
	url: "https://crm.zoho.com/crm/private/xml/",
	authtoken: "22ddae076da1ccb0bcc5b3e9d81ac2fa",
	version: 2,
	scope: "crmapi",
};