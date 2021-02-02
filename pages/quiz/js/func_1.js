/*  Wizard */
jQuery(function($) {
    "use strict";
    $('form#wrapped').attr('action', 'success1.php');
    $("#wizard_container").wizard({
        stepsWrapper: "#wrapped",
        submit: ".submit",
        unidirectional: false,
        beforeSelect: function(event, state) {
            if ($('input#website').val().length != 0) {
                return false;
            }
            if (!state.isMovingForward)
                return true;
            var inputs = $(this).wizard('state').step.find(':input');
            return !inputs.length || !!inputs.valid();
        }
    }).validate({
        errorPlacement: function(error, element) {
            if (element.is(':radio') || element.is(':checkbox')){
                error.insertBefore(element.next());
            } else {
                error.insertAfter(element);
            }
        }
    });
    //  progress bar
    $("#progressbar").progressbar();
    $("#wizard_container").wizard({
        afterSelect: function(event, state) {
            $("#progressbar").progressbar("value", state.percentComplete);
            $("#location").text("Ð“Ð¾Ñ‚Ð¾Ð²Ð¾: " + state.stepsComplete + " Ð¸Ð· " + state.stepsPossible);
        }
    });

});

$("#wizard_container").wizard({
    transitions: {
        branchtype: function($step, action) {
            var branch = $step.find(":checked").val();
            if (!branch) {
                $("form").valid();
            }
            return branch;
        }
    }
});

