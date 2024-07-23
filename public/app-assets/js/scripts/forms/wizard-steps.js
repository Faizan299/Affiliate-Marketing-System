/*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Wizard tabs with numbers setup
$(".number-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        // Serialize form data
        var formData = new FormData($('#stepForm')[0]);

        // Define checkedCheckboxes here
        var checkedCheckboxes = $('tbody input[type="checkbox"]:checked');
        var selectedStudentIds = [];

        // Collect selected student IDs
        checkedCheckboxes.each(function() {
            selectedStudentIds.push($(this).data('id'));
        });

        var selectedStudentIdsString = selectedStudentIds.join(',');

        formData.append('selected_students', selectedStudentIdsString);

        // Remove this block, as selected students are already appended above
        // Add checkbox data to formData
        // checkedCheckboxes.each(function() {
        //     formData.append('selected_students[]', $(this).data('id'));
        // });

        // Perform AJAX request
        $.ajax({
            url: $('#stepForm').attr('action'), // Form action URL
            type: $('#stepForm').attr('method'), // Form method (POST in this case)
            data: formData, // Form data
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            success: function(response) {
                // Handle success response
                Swal.fire(
                    'Success',
                    'Event Created Successfully',
                    'success'
                ).then(function () {
                    location.reload();
                })
                // Optionally, you can redirect to another page here
            },
            error: function(xhr, status, error) {
                // Handle error response
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errorMessage = "";
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += value + "\n";
                    });
                    Swal.fire(
                        'Error',
                        errorMessage,
                        'error'
                    );
                } else {
                    alert(error);
                }
            }
        });
        
    }
});







// Wizard tabs with icons setup


$(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Vertical tabs form wizard setup
$(".vertical-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    stepsOrientation: "vertical",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Validate steps wizard

// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        // Forbid next action on "Warning" step if the user is too young
        if (newIndex === 3 && Number($("#age-2").val()) < 18) {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        alert("Submitted!");
    }
});

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});


// Initialize plugins
// ------------------------------

// Date & Time Range
$('.datetime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'MM/DD/YYYY h:mm A'
    }
});