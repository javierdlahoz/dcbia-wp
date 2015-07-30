jQuery('#existing_file').typeahead({
	
	   minLength: 3,
   },
   {
	   displayKey: 'file_name_s',
	   source:  function(queryParam, process){ 
		   	jQuery.ajax({
				  url: "/../wp-content/plugins/sf-resources-manager/modules/Resource/Request/Helper/RestHelper.php",
				  method: "POST",
				  data: jQuery.param({
					  action_type: "get_files",
					  query: queryParam
				  	}),
				  ContentType: 'application/x-www-form-urlencoded'
		   		})
				  .success(function(results) {
					  if(results.length == 1){
						  results = [results[0][0]];
					  }
					  return process(results);
				});
			 }
	   }
   
).
on('typeahead:selected', function(event, data){            
	jQuery('#file_id').val(data.id);        
});


jQuery('#resource_to_add').typeahead({
	
	   minLength: 3,
},
{
	   displayKey: 'resource_title',
	   source:  function(queryParam, process){ 
		   	jQuery.ajax({
				  url: "/../wp-content/plugins/sf-resources-manager/modules/Resource/Request/Helper/RestHelper.php",
				  method: "POST",
				  data: jQuery.param({
					  action_type: "get_resources",
					  query: queryParam
				  	}),
				  ContentType: 'application/x-www-form-urlencoded'
		   		})
				  .success(function(results) {
					  if(results.length == 1){
						  results = [results[0]];
					  }
					  
					  return process(results);
				});
			 }
	   }

).
on('typeahead:selected', function(event, data){            
	if(isRepeated(data.resource_id) === false){
		jQuery("#resource_template #resource_title_to_show").text(data.resource_title);
	 	jQuery("#resource_template #resource_to_add").val(data.resource_id);
	 	jQuery("#showcase_resources").append(jQuery("#resource_template").html());
	}
	jQuery("#resource_to_add").val("");
});

//this is for festivals search on resources
jQuery('.typeahead-input').typeahead(
{
	minLength: 3 
},
{
	displayKey: 'title',
  	source: typeahead_source
}
).on('typeahead:selected', typeahead_selected);

function typeahead_source(queryParam, process){
	jQuery.ajax({
	  	url: "/../wp-content/plugins/sf-festivals/modules/Festival/Handler/FestivalRestHandler.php",
	  	method: "POST",
	  	data: jQuery.param({
		   action_type: "getFestivals",
		   festival_expression: queryParam
	  	}),
	  	ContentType: 'application/x-www-form-urlencoded'
	})
	.success(function(results) {
		if(results.length == 1){
			results = [results[0]];
		}
	return process(results);
	});
}

function typeahead_selected(event, data){
	var contributor_section = jQuery(this).closest('.contributor-section');

	contributor_section.find("input[name*='festival_ids']").val(data.id);
	contributor_section.find("input[name*='latitudes']").val(data.latitude);
	contributor_section.find("input[name*='longitudes']").val(data.longitude);
	contributor_section.find("input[name*='locations']").val(data.location);
	contributor_section.find("input[name*='dates']").val(data.date);

	var authors = "";
	
	for(var i=0; i < data.organizers.length; i++){
		if(i == 0){
			authors += data.organizers[i].name;	
		}
		else{
			authors += "; " + data.organizers[i].name
		}
	}
	contributor_section.find("input[name*='authors']").val(authors);
}

function isRepeated(idToFind){
	var result = false;
	jQuery("#showcase_resources #resource_to_add").each(function(index, callback){
		if(jQuery(this).val() == idToFind){
			result = true;
			return true;
		}
	});
	return result;
}
