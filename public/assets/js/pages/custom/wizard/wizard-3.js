"use strict";

// Class definition
var KTWizard3 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v3', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
            var step = wizardObj.currentStep;
            $.ajax({
                type:'POST',
                url:'/data/mahasiswa/validatewizard',
                data:formEl.serialize()+'&step='+wizardObj.currentStep+'&_token='+$('#csrf_').val(),
                success:function(result) {
                    var res = JSON.parse(result);
                    if(res.status == 'false'){

                        var text = '';

                        $.each(res.message, function( index, value ) {

                            text += '<p class="error">'+ value[0]+'</p>';
                        });
                        wizard.goTo(step);

                        swal.fire({
                            "title": "",
                            "html": text,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });

                    }
                }
            });
            //KTUtil.scrollTop();
			/*if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}*/
		});

		wizard.on('beforePrev', function(wizardObj) {
            var step = wizardObj.currentStep;
            $.ajax({
                type:'POST',
                url:'/data/mahasiswa/validatewizard',
                data:formEl.serialize()+'&step='+wizardObj.currentStep+'&_token='+$('#csrf_').val(),
                success:function(result) {
                    var res = JSON.parse(result);
                    if(res.status == 'false'){

                        var text = '';

                        $.each(res.message, function( index, value ) {

                            text += '<p class="error">'+ value[0]+'</p>';
                        });
                        wizard.goTo(step);

                        swal.fire({
                            "title": "",
                            "html": text,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });

                    }
                }
            });
            /*if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}*/
		});

		// Change event
		wizard.on('change', function(wizard) {
			//KTUtil.scrollTop();
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				//= Step 1
				name: {
					required: true
				},
				nama_ibu: {
					required: true
				},
				tempat_lahir: {
					required: true
				},
				tanggal_lahir: {
					required: true
				},
				country: {
					required: true
				},

				//= Step 2
				package: {
					required: true
				},
				weight: {
					required: true
				},
				width: {
					required: true
				},
				height: {
					required: true
				},
				length: {
					required: true
				},

				//= Step 3
				delivery: {
					required: true
				},
				packaging: {
					required: true
				},
				preferreddelivery: {
					required: true
				},

				//= Step 4
				locaddress1: {
					required: true
				},
				locpostcode: {
					required: true
				},
				loccity: {
					required: true
				},
				locstate: {
					required: true
				},
				loccountry: {
					required: true
				},
            },

            messages :{
                name: {
					required: 'Nama harus di isi.'
				},
				nama_ibu: {
					required: 'Nama Ibu harus di isi.'
				},
				tempat_lahir: {
					required: 'Tempat lahir harus di isi.'
				},
				tanggal_lahir: {
					required: 'Tanggal lahir harus di isi.'
				},
				country: {
					required: true
				}
            },

			// Display error
			invalidHandler: function(event, validator) {
				//KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "There are some errors in your submission. Please correct them.",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			},

			// Submit valid form
			submitHandler: function (form) {
                    
			}
		});
	}

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');
		btn.on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:'/data/mahasiswa/save',
                data:$('.form-mahasiswa').serialize()+'&_token='+$('#csrf_').val(),
                success: function() {
                    KTApp.unprogress(btn);
                    //KTApp.unblock(formEl);
                    swal.fire({
                        "title": "",
                        "text": "The application has been successfully submitted!",
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v3');
			formEl = $('#kt_form');

			initWizard();
			//initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard3.init();
});
