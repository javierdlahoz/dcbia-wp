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
	};
}
