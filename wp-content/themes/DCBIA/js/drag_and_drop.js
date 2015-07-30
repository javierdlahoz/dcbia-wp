
var options = {
    target: '#output', // target element(s) to be updated with server response 
    beforeSubmit: beforeSubmit, // pre-submit callback 
    success: afterSuccess, // post-submit callback 
    uploadProgress: OnProgress, //upload progress callback 
    resetForm: false        // reset the form after successful submit 
};

jQuery("#url").change(function(){
    var url = jQuery("#url").val();
    if(url.length > 0){
        jQuery("#resource_file").prop('disabled', true);
    }
});


function beforeSubmit() {
    //check whether client browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {

    }
    else
    {
        //Error for older unsupported browsers that doesn't support HTML5 File API
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
}

function OnProgress(percentComplete, filename)
{
    //Progress bar
    jQuery('#progressbox').show().css({
                "font-size":"200%",
                "margin-top":"-70px"
            });
    jQuery('#progressbar').width(Math.round(percentComplete) + '%') //update progressbar percent complete
    jQuery('#statustxt').html(Math.round(percentComplete) + '%'); //update status text
    if (percentComplete > 50)
    {
        jQuery('#statustxt').css('color', '#000'); //change status text to white after 50%
    }
    if(percentComplete == 100){
        jQuery('#statustxt').html(filename.name); //change status text to white after 50% 
    }


}

function afterSuccess() {
    jQuery('#drag-drop-text').text("");
    jQuery("#url").prop('disabled', true);
}

function getResourceType() {
    if (jQuery('#type_planning_tools').is(':checked') === true) {
        return "planning_tools";
    }
    else if (jQuery('#type_activities_and_programs').is(':checked') === true) {
        return "activities_and_programs";
    }
    else if (jQuery('#type_collaborators').is(':checked') === true) {
        return "collaborators";
    }
    else if (jQuery('#type_staff_and_human_resources').is(':checked') === true) {
        return "staff_and_human_resources";
    }
    else if (jQuery('#type_marketing').is(':checked') === true) {
        return "marketing";
    }
    else if (jQuery('#type_sponsorship').is(':checked') === true) {
        return "sponsorship";
    }
    else if (jQuery('#type_evaluation_and_reporting').is(':checked') === true) {
        return "evaluation_and_reporting";
    }
    else {
        return "uncategorized";
    }
}

jQuery('#resource_file').change(function () {
    var formData = new FormData();

    var xhrObj = new XMLHttpRequest();
    var filesToBeUploaded = document.getElementById("resource_file");
    var fileId = jQuery('#file_id').val();


    formData.append('resource_file', filesToBeUploaded.files[0]);
    formData.append('action_type', 'upload');
    formData.append('file_id', fileId);
    formData.append('resource_type', getResourceType());

    xhrObj.upload.addEventListener("progress", function (e) {
        OnProgress(e.loaded / e.total * 100, filesToBeUploaded.files[0]);
    });
    xhrObj.upload.addEventListener("load", afterSuccess, false);
    xhrObj.open("POST", "", true);

    xhrObj.send(formData);

    return false;
});

jQuery(function () {
    jQuery("#date").datepicker({dateFormat: 'mm-dd-yy'});
});