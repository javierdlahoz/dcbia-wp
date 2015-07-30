jQuery("#sub_options").change(function(){
	var sub_option = jQuery("#sub_options").val();
	if(isTabRepeated(sub_option) === false){
		jQuery("#tab_container_template #tab_template #tab_text").text(sub_option);
		jQuery("#tab_container_template #tab_template #sub_group").val(sub_option);

		jQuery("#tab_container").append(jQuery("#tab_container_template").html());
		jQuery("#sub_option_container").removeClass("hidden");
	}
});

function isTabRepeated(valToFind){
	var result = false;
	jQuery("#tab_container #sub_group").each(function(index, callback){
		if(jQuery(this).val() == valToFind){
			result = true;
			return true;
		}
	});
	return result;
}
