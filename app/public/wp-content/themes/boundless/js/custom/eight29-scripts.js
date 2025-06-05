const megaMenuImages = () => {
	let megaMenuImages = document.querySelectorAll('.megamenu_wrapper .img-title div.img');

    if (megaMenuImages.length > 0) {
        megaMenuImages.forEach(el => {
            el.style.backgroundImage = `url(${el.dataset.src})`;
            el.style.opacity = '1';
        });
    }
}

window.addEventListener('DOMContentLoaded', () => {
    megaMenuImages();
});

jQuery(document).on('gform_post_render', function(event, formId) {
    const formID            = 26;
    const emailFieldID      = 14;
    
    if (formId === formID) {    
        const emailField = jQuery(`#input_${formID}_${emailFieldID}`);
        let lastEmailValue = "";
        
        emailField.on('blur', function() {
            const emailValue = emailField.val().trim();
            
            if (emailValue !== "" && emailValue !== lastEmailValue) {
                lastEmailValue = emailValue;
                const additionalFields = [38];
                let fieldsData = {};
  
                additionalFields.forEach(function(fieldID) {
                    const fieldSelected = jQuery(`#input_${formID}_${fieldID}`);
                    const fieldLabel = fieldSelected.closest('.gfield').find('.gfield_label').text().trim().replace(/\*/g, '');
                    const fieldValue = fieldSelected.val();
                    fieldsData[fieldLabel] = fieldValue || 'N/A';
                });
                
                const firstName = jQuery(`#input_${formID}_8_3`).val();
                const lastName = jQuery(`#input_${formID}_8_6`).val();
                if (firstName && lastName) {
                    fieldsData['Name'] = firstName + ' ' + lastName
                }
                
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'send_email_on_field_fill',
                        email: emailValue,
                        fields: fieldsData
                    },
                    success: function(response) {
                        console.log('Email sent successfully:', response);
                    },
                    error: function(error) {
                        console.error('Error sending email:', error);
                    }
                });
            }
        });
    }

});

jQuery(document).ready(function ($) {
    var dateSelected = $('#input_26_47').find(':selected').val();
    $('#input_26_47').html('<option value="">Please Select</option>');
    var selectedOption = $('#input_26_38').find(':selected');
    var dataId = selectedOption.length ? selectedOption.data('id') : null;

    if (dataId) {
        getTripDates(dataId, dateSelected);
    }

    $('#input_26_38').change(function () {
        var tripID = $(this).find(':selected').data('id');
        getTripDates(tripID);
    });

    function getTripDates (tripID, dateSelected = null) {
        var $dateDropdown = $('#input_26_47');

        $dateDropdown.html('<option value="">Loading...</option>');
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'get_trip_start_dates',
                trip_id: tripID
            },
            success: function (response) {
                $dateDropdown.empty();
                $dateDropdown.append('<option value="">Please Select</option>');

                if (response.success) {
                    $.each(response.data.dates, function (index, date) {
                        $dateDropdown.append('<option value="' + date + '">' + date + '</option>');
                    });                   

                    if (dateSelected) {
                        $('#input_26_47').val(dateSelected).trigger('change');
                    }
                } else {
                    $dateDropdown.append('<option value="Please Call For Dates">Please Call For Dates</option>');
                }
            }
        });
    }
});