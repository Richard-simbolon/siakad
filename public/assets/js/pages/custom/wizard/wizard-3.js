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
                url:url + '/validatewizard',
                data:formEl.serialize()+'&step='+wizardObj.currentStep+'&_token='+$('#csrf_').val(),
                success:function(result) {
                    var res = JSON.parse(result);
                    //console.log(result);
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
		});

		wizard.on('beforePrev', function(wizardObj) {
            var step = wizardObj.currentStep;
            $.ajax({
                type:'POST',
                url:url+'/validatewizard',
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
            //$(this).attr("disabled", true);
            e.preventDefault();
            Swal.fire({
                title: 'Tambah Mahasiswa',
                text: "Pastikan semua data telah benar.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0abb87',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan data!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'POST',
                        url: url+'/save',
                        data:$('.'+form).serialize()+'&_token='+$('#csrf_').val(),
                        success: function(result) {
                            var res = JSON.parse(result);
                            //console.log(res);
                            //$(this).attr("disabled", false);
                            KTApp.unprogress(btn);
                            //KTApp.unblock(formEl);
                            if(res.status == 'false'){
        
                                var text = '';
        
                                $.each(res.message, function( index, value ) {
        
                                    text += '<p class="error">'+ value[0]+'</p>';
                                });
                                swal.fire({
                                    "title": "",
                                    "html": text,
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary"
                                });
                                //$(this).attr("disabled", false);
                            }else{
                                //$(this).attr("disabled", false);
                                swal.fire({
                                    "title": "",
                                    "text": res.message,
                                    "type": res.status,
                                    "confirmButtonClass": "btn btn-secondary"
                                });
                            }
                        }
                    });
    
                }else{
                    //$(this).attr("disabled", false);
                }
            })
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
