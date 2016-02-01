// start global js here

/*var tribe_ev = {};
var tribe_js_config = {};
var tribe_debug = false;*/
var offset = 220;
var duration = 500;

var mainLinks = [ "home", "about", "resources", "toolkits", "festivals",
		"calendar", "blog" ];

function updateQueryStringParameter(key, value) {
	var parameters = window.location.search.split("&");
	var uri = "";
	var isInParams = false;
	for (var i = 0; i < parameters.length; i++) {
		if (parameters[i].indexOf(key + "=") > -1) {
			// if(!key == "type" && !value == "*"){
			parameters[i] = key + "=" + value;
			isInParams = true;
			// }
		}
		uri = uri + parameters[i] + "&";
	}
	if (isInParams === false) {
		uri = uri + key + "=" + value + "&";
	}
	var subSearch = uri.substring(0, uri.length - 1);
	subSearch = changeResourcePageByOne(subSearch);
	return "?" + subSearch;
}

function changeResourcePageByOne(searchString) {
	if (searchString.indexOf("resources_page=") >= 0) {
		var splitedSearch = searchString.split("resources_page=");
		splitedSearch[0] += "resources_page=";
		var restOf = splitedSearch[1].split("&");
		var urlTmp = splitedSearch[0] + "1";
		for (var i = 1; i < restOf.length; i++) {
			urlTmp += "&" + restOf[i];
		}

		return urlTmp;
	}
	return searchString;
}

function isFestivalRelated() {
	window.localStorage.setItem('isRelated', true);
}

function strippingHashTags(module) {
	var index = module.indexOf("#");
	if (index >= 0) {
		return module.substring(index, module.lenght - 1);
	}
	return module;
}

function assingClassHelper(module, isMain) {

	if (module != undefined) {
		if (module == "event") {
			module = "calendar";
		}

		module = strippingHashTags(module);

		jQuery("#main-nav li#home").removeClass("active");

		if (module.substr(module.length - 1, 1) != "s" && module != "blog"
				&& module != "calendar" && module != "home"
				&& module != "about" && isMain == true) {
			module = module + "s";
		}

		if (module != "#" && module != "" && module.indexOf("?") < 0) {
			jQuery("#menuFrontPage li").parent().find("li.active").removeClass(
					"active");
			var isSuccess = jQuery("#menuFrontPage li#" + module).addClass(
					"active");

			if (isInLinks(module)) {
				jQuery("#main-nav").find("li a.active").removeClass("active");
				jQuery("#main-nav li#" + module).addClass("active");
			}

			if (isSuccess.length > 0) {
				jQuery("#main-nav").find("li a.active").removeClass("active");
				jQuery("#main-nav li#resources").addClass("active");
			}

			jQuery('.back-to-top').click(function(event) {
				event.preventDefault();
				jQuery('html, body').animate({
					scrollTop : 0
				}, duration);
				return false;
			});

		} else {
			jQuery("#main-nav").find("li a.active").removeClass("active");
			jQuery("#main-nav li#home").addClass("active");
		}
	}
}

function asingClassMenu() {
	var page = document.URL.split("/");

	assingClassHelper(page[3], true);
	assingClassHelper(page[4], false);

	if (page.length <= 4) {
		jQuery("#home").addClass("active");
	} else {
		jQuery("#home").removeClass("active");
	}
}

jQuery(document).ready(function() {

	jQuery("#wpadminbar").hide();
	asingClassMenu();
	// setBlockColors();

	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > offset) {
			jQuery('.back-to-top').fadeIn(duration);
		} else {
			jQuery('.back-to-top').fadeOut(duration);
		}
	});
	jQuery('.back-to-top').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({
			scrollTop : 0
		}, duration);
		return false;
	})
});

function isInLinks(url) {
	for (var i = 0; i < mainLinks.length; i++) {
		if (url == mainLinks[i]) {
			return true;
		}
	}
	return false;
}

function isHome(url) {
	console.log(url);
	if (url == "") {
		return true;
	}
	return false;
}

function goToAllResourcesIfNoType() {
	var urlLocation = window.location.pathname;
	if (urlLocation != "/resources/") {
		var parameters = window.location.search.split("&");
		for (var i = 0; i < parameters.length; i++) {
			if (parameters[i].indexOf("type=") > -1) {
				var typeValue = parameters[i].split("type=");
				if (typeValue[1] == "*") {
					window.location.pathname = "/resources/";
					return false;
				}
			}
			urlLocation = urlLocation + parameters[i] + "&";
		}
	}
}

function formatAsForm(jsonArray) {
	var result = {};
	for (var i = 0; i < jsonArray.length; i++) {
		var indexName = jsonArray[i].name;
		result[indexName] = jsonArray[i].value;
	}
	return result;
}

function setActiveStateOnMenu(){
	var url = window.location.pathname;
	if(url.indexOf("/about/") > -1){
		jQuery("#about").addClass("active");
		jQuery("#m-about").addClass("active");
	}
	else if(url.indexOf("/join/") > -1){
		jQuery("#join").addClass("active");
		jQuery("#m-join").addClass("active");
	}
	else if(url.indexOf("/advocacy/") > -1){
		jQuery("#advocacy").addClass("active");
		jQuery("#m-advocacy").addClass("active");
	}
	else if(url.indexOf("/sponsors/") > -1){
		jQuery("#sponsors").addClass("active");
		jQuery("#m-sponsors").addClass("active");
	}
	else if(url.indexOf("/events/") > -1 || url.indexOf("/event/") > -1){
		jQuery("#events").addClass("active");
		jQuery("#m-events").addClass("active");
	}
	else if(url.indexOf("/news/") > -1 || url.indexOf("/blog/") > -1){
		jQuery("#news").addClass("active");
		jQuery("#m-news").addClass("active");
	}
}

jQuery("#main-nav #resources").hover(function() {
	jQuery(".dropdown-menu-left").slideDown();
}, function() {
	jQuery(".dropdown-menu-left").slideUp();
});

jQuery(document).ready(function() {
	if (jQuery("#your-selections-results").children().length == 0) {
		jQuery("#your-selections-panel").hide();
	}
});

if (window.location.search == "?type=*") {
	window.location.search = "";
}

jQuery(".tt-hint").css("width", "100% !important");
jQuery(".tt-hint").css("height", "100%");

jQuery(".dropit-submenu").children()
		.hover(
				function(e) {
					if (jQuery(e.target).parent().parent().parent().hasClass(
							"active") == true) {
						window.isActive = true;
					} else {
						window.isActive = false;
						jQuery(e.target).parent().parent().parent().addClass(
								"active");
					}
				},
				function(e) {
					if (window.isActive === false) {
						jQuery(e.target).parent().parent().parent()
								.removeClass("active");
					}
				});

jQuery(document).ready(function() {
	jQuery("#angular-app").show();
	jQuery("#wpadminbar").hide();
	setActiveStateOnMenu();
});

function gotoResources(areaOfFocus) {
	jQuery("#areas-of-focus").val(areaOfFocus);
	jQuery("#areas-form").submit();
}

var icySlide = {"slider_speed":"5000","slider_auto":"false"};
/*
 * function goToTag(tagId){ $('html, body').animate({ scrollTop:
 * $("#"+tagId).offset().top }, 1000); }
 */