function unlinkFile(fileId){
	jQuery("#resource_url").val("unlinked");
	jQuery("#file_id").val(fileId);
}

jQuery("#resource-draggable").on("dragover", function(event) {
    event.preventDefault();
    event.stopPropagation();
});

jQuery("#resource-draggable").on("dragleave", function(event) {
    event.preventDefault();
    event.stopPropagation();
});

jQuery("#resource-draggable").on("drop", function(event) {
    event.preventDefault();
    event.stopPropagation();
    alert("Dropped!");
});

var array_autocompletes = [];

jQuery(function () {
    jQuery('.sortable').sortable();

    for (var i = 1; i <= jQuery('.datepicker').length / 2; i++) {
        initialize_datepickers(i);
    };

    for (var i = 1; i <= jQuery('.autocomplete').length; i++) {
        initialize_autocomplete_and_listener(i);
    };
});

function initialize_autocomplete_and_listener(num_autocomplete){
    array_autocompletes[num_autocomplete - 1] = new google.maps.places.Autocomplete(
        (document.getElementById('autocomplete' + num_autocomplete )),
        { types: ['geocode'] }
    );

    google.maps.event.addListener(array_autocompletes[num_autocomplete - 1], 'place_changed', function() {
        var place = array_autocompletes[num_autocomplete - 1].getPlace();
        jQuery('#lat-autocomplete'+num_autocomplete).val(place.geometry.location.lat());
        jQuery('#lng-autocomplete'+num_autocomplete).val(place.geometry.location.lng());
    });
}

function add_new_date_and_location() {
    var calc_num_autocomplete = array_autocompletes.length + 1;
    var date_and_location_html;

    date_and_location_html =  ' <div class="panel panel-default">';
    date_and_location_html += '     <div class="div-date-location panel-heading clearfix">';
    date_and_location_html += '         <div class="btn btn-danger btn-xs pull-left" onclick="jQuery(this).parent().parent().remove();">';
    date_and_location_html += '             <i class="glyphicon glyphicon-remove"></i> Remove';
    date_and_location_html += '         </div>';
    date_and_location_html += '     </div>';

    date_and_location_html += '     <div class="panel-body">';

    date_and_location_html += '         <div class="form-group">';
    date_and_location_html += '             <label class="control-label col-lg-2 col-sm-2" for="date">Start Date</label>';
    date_and_location_html += '             <div class="col-lg-10 col-sm-10" data-date-format="mm-dd-yyyy">';
    date_and_location_html += '                 <input type="text" name="dates[]" id="date' + calc_num_autocomplete + '" placeholder="mm-dd-yyyy" class="form-control datepicker" required="true"/>';
    date_and_location_html += '             </div>';
    date_and_location_html += '         </div>';

    date_and_location_html += '         <div class="form-group">';
    date_and_location_html += '             <label class="control-label col-lg-2 col-sm-2" for="end_dates">End Date</label>';
    date_and_location_html += '             <div class="col-lg-10 col-sm-10" data-date-format="mm-dd-yyyy">';
    date_and_location_html += '                 <input type="text" name="end_dates[]" id="end_date' + calc_num_autocomplete + '" placeholder="mm-dd-yyyy" class="form-control datepicker" required="true"/>';
    date_and_location_html += '             </div>';
    date_and_location_html += '         </div>';

    date_and_location_html += '         <div class="form-group">';
    date_and_location_html += '             <label class="control-label col-lg-2 col-sm-2" for="festival_location[]">Festival Location</label>';
    date_and_location_html += '             <div class="col-lg-10 col-sm-10">';
    date_and_location_html += '                 <input class="form-control" type="text" name="festival_location[]" id="autocomplete' + calc_num_autocomplete + '" onFocus="geolocate(' + calc_num_autocomplete + ')" placeholder="Type Festival Location">';
    date_and_location_html += '             </div>';
    date_and_location_html += '         </div>';

    date_and_location_html += '         <input type="hidden" name="lat_autocompletes[]" id="lat-autocomplete' + calc_num_autocomplete + '" value="">';
    date_and_location_html += '         <input type="hidden" name="lng_autocompletes[]" id="lng-autocomplete' + calc_num_autocomplete + '" value="">';
    date_and_location_html += '         <hr/>';

    date_and_location_html += '     </div>';
    date_and_location_html += ' </div>';

    $("#date_and_location").append(date_and_location_html);

    initialize_datepickers(calc_num_autocomplete);
    initialize_autocomplete_and_listener(calc_num_autocomplete);
}

function add_new_organizer() {

    var organizer_html;

    organizer_html  = '<div class="form-group">';
    organizer_html += '    <div class="col-lg-10 col-sm-10 col-lg-offset-2 col-sm-offset-2">';
    organizer_html += '        <div class="col-lg-11 col-sm-11" style="padding:0px">';
    organizer_html += '            <select class="form-control" required="true" name="organizers[]">';
    organizer_html += $(".select-users").html();
    organizer_html += '            </select>';
    organizer_html += '        </div>';

    organizer_html += '        <div class="col-lg-1 col-sm-1">';
    organizer_html += '            <div class="btn btn-xs btn-danger" onclick="jQuery(this).parent().parent().parent().remove();">';
    organizer_html += '                <i class="glyphicon glyphicon-remove"></i>';
    organizer_html += '            </div>';
    organizer_html += '        </div>';
    organizer_html += '    </div>';
    organizer_html += '</div>';

    $("#organizers").append(organizer_html);
}

function geolocate(num_autocomplete) {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
            array_autocompletes[num_autocomplete - 1].setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
        });
    }
}

function isValidVideoUrl(videoUrl){
	if(videoUrl.indexOf("vimeo") >= 0 || videoUrl.indexOf("youtube") >= 0 || videoUrl.indexOf("youtu.be") >= 0){
		return true;
	}
	else{
		return false;
	}
}

function validateVideoUrl(object){
	var videoUrl = object.value;
	if(!isValidVideoUrl(videoUrl) && videoUrl.length > 0){
		jQuery("#publish").prop("disabled", true);
		jQuery("#check-video-url").fadeIn();
	}
	else{
		jQuery("#publish").prop("disabled", false);
		jQuery("#check-video-url").fadeOut();
	}
}

function addNewContributor() {
    var count_contributors = $('#contributors').children().length + 1;
    var contributor_html ;

    contributor_html  = '<div class="panel panel-default">';
    contributor_html += '<div class="panel-heading clearfix">';
    contributor_html += '<div class="btn btn-danger btn-xs pull-left" onclick="jQuery(this).parent().parent().remove();">';
    contributor_html += '<i class="glyphicon glyphicon-remove"></i> Remove';
    contributor_html += '</div>';
    contributor_html += '</div>';

    contributor_html += '<div class="panel-body contributor-section">';
    contributor_html += '<div class="form-group">';
    contributor_html += '<label class="control-label col-lg-2 col-sm-2" for="authors">Author</label>';
    contributor_html += '<div class="col-lg-10 col-sm-10">';
    contributor_html += '<input class="form-control" type="text" name="authors[]" id="authors[]" placeholder="Type Author">';
    contributor_html += '</div>';
    contributor_html += '</div>';

    contributor_html += '<div class="form-group">';
    contributor_html += '<label class="control-label col-lg-2 col-sm-2" for="institution_name" >Institution Name</label>';
    contributor_html += '<div class="col-lg-10 col-sm-10">';
    contributor_html += '<input class="form-control" type="text" name="institution_name[]" id="institution_name[]" placeholder="Type Organization Name">';
    contributor_html += '</div>';
    contributor_html += '</div>';

    contributor_html += '<input type="hidden" name="festival_ids[]" value="">';
    contributor_html += '<input type="hidden" name="latitudes[]" value="">';
    contributor_html += '<input type="hidden" name="longitudes[]" value="">';
    contributor_html += '<input type="hidden" name="locations[]" value="">';
    contributor_html += '<input type="hidden" name="dates[]" value="">';

    contributor_html += '</div>';
    contributor_html += '</div>';

    $("#contributors").append(contributor_html);
    initialize_listener(count_contributors);
}

function deleteResourceFile(id){
	
	jQuery.ajax(
		{
            url: "/api/resources/delete_file",
            method: "POST",
            data: jQuery.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }
		).success(
        	function (data) {
        		jQuery("#downloaded-file").fadeOut();
        		jQuery("#deleted-file-alert").fadeIn();
        	}
        ).error(
        	function(data){
        		alert(data.message);
        	}
        );
}

jQuery(document).ready(function(){
	$("body").css("background-color", "transparent");
	$("#date").datepicker({
        dateFormat: 'mm-dd-yy',
        onClose: function( selectedDate ) {
            //jQuery("#date").datepicker( "option", "minDate", selectedDate );
        }
    });
});