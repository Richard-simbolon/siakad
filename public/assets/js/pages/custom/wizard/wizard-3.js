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

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');
		btn.on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:'/data/mahasiswa/save',
                data:$('.form-mahasiswa').serialize()+'&_token='+$('#csrf_').val(),
                success: function(result) {
					var res = JSON.parse(result);
                    KTApp.unprogress(btn);
                    //KTApp.unblock(formEl);
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });
		});
	}

	return {
		
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v3');
			formEl = $('#kt_form');
			initWizard();
			initSubmit();
		}
	};
}();

var DosenKT = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new DosenKT('kt_wizard_v3', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
            var step = wizardObj.currentStep;
            $.ajax({
                type:'POST',
                url:'/data/dosen/validatewizard',
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

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');
		btn.on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:'/data/mahasiswa/save',
                data:$('.form-mahasiswa').serialize()+'&_token='+$('#csrf_').val(),
                success: function(result) {
					var res = JSON.parse(result);
                    KTApp.unprogress(btn);
                    //KTApp.unblock(formEl);
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });
		});
	}

	return {
		
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v3');
			formEl = $('#kt_form');
			initWizard();
			initSubmit();
		}
	};
}();


jQuery(document).ready(function() {
	KTWizard3.init();
	//DosenKT.init();
});
