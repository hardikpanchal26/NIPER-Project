function validate_niper_personnel() {
	var name          = $('#niper_personnel_form #name').val();
	var id_num        = $('#niper_personnel_form #enroll_no').val();
	var email         = $('#niper_personnel_form #email').val();
	var contact       = $('#niper_personnel_form #contact').val();
	var instrument    = $('#niper_personnel_form #selected_instrument').val();
	var facility      = $('#niper_personnel_form #facility').val();
	var message       = $('#niper_personnel_form #message').val();
	var no_of_samples = $('#niper_personnel_form #no_of_samples').val();
    
    $('#niper_personnel_form #niper_personnel').blur();
	//alert(name + " " + id_num + " " + email + " " + contact + " " + instrument + " " + facility + " " + message + " " + no_of_samples);
	
	var name_test    = /^[A-Za-z\s]+$/;
	var id_num_test  = /^[A-Za-z0-9]+$/;
	var email_test   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.){1,2}([a-zA-Z0-9]{2,4})+$/;
	var contact_test = /^[0-9\s]{7,12}$/;
	
	if (!name_test.test(name)) {
		alert("Please Enter your Full Name Correctly");
		$('#niper_personnel_form #name').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #name").offset().top - 300
        }, 400);
		return false;
	}

	if (!id_num_test.test(id_num)) {
		alert("Please Enter ID Number Correctly");
		$('#niper_personnel_form #enroll_no').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #enroll_no").offset().top - 300
        }, 400);
		return false;
	}

	if (!email_test.test(email)) {
		alert("Please Enter E-mail Correctly");
		$('#niper_personnel_form #email').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #email").offset().top - 300
        }, 400);	
		return false;
	}


	if (!contact_test.test(contact)) {
		alert("Please Enter Contact Number Correctly");
		$('#niper_personnel_form #contact').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #contact").offset().top - 300
        }, 400);
		return false;
	}

	if (instrument == '-- Select Instrument --') {
		alert("Please Select an Instrument");
		$('#niper_personnel_form #selected_instrument').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #selected_instrument").offset().top - 300
        }, 400);
		return false;
	}

	if (facility == '-- Select Facility --') {
		alert("Please Select a Facility");
		$('#niper_personnel_form #facility').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #facility").offset().top - 300
        }, 400);
		return false;
	}

	if(no_of_samples == "" ||  ( no_of_samples < 1 || no_of_samples > 50 ) ) {
		alert("Please Enter Number of Samples between 1 and 50")
		$('#niper_personnel_form #no_of_samples').focus();
		$('html, body').animate({
            scrollTop: $("#niper_personnel_form #no_of_samples").offset().top - 300
        }, 400);
		return false;
	}
	$('.loader-bg').show();
	return true;
}


function validate_external_applicants() {
	//var institute	  = $('#external_applicants_form #name')
	var type 		  = $('#institute').is(':checked') || $('#industry').is(':checked');
	var organization  = $('#external_applicants_form #organization').val();
	var address       = $('#external_applicants_form #address').val(); 
	var name          = $('#external_applicants_form #name').val();
	var designation   = $('#external_applicants_form #designation').val();
	var email         = $('#external_applicants_form #email').val();
	var contact       = $('#external_applicants_form #contact').val();
	var instrument    = $('#external_applicants_form #selected_instrument').val();
	var facility      = $('#external_applicants_form #facility').val();
	var message       = $('#external_applicants_form #message').val();
	var no_of_samples = $('#external_applicants_form #nos').val();
    
    $('#external_applicants_form #external_applicants').blur();
	//alert(type + " " + organization + " " + address + " " + name + " " + designation + " " + email + " " + contact + " " + instrument + " " + facility + " " + message + " " + no_of_samples);
	
	var name_test    = /^[A-Za-z\s]+$/;
	var email_test   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.){1,2}([a-zA-Z0-9]{2,4})+$/;
	var contact_test = /^[0-9\s]{7,12}$/;
	
	if(type == false) {
		alert("Please Select Organization Type");
		$('html, body').animate({
            scrollTop: $("#external_applicants_form").offset().top - 300
        }, 400);
		return false;
	}

	if (organization == "") {
		alert("Please Enter Organization Name");
		$('#external_applicants_form #organization').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #organization").offset().top - 300
        }, 400);
		return false;
	}

	if (address == "") {
		alert("Please Enter Address");
		$('#external_applicants_form #address').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #address").offset().top - 300
        }, 400);
		return false;
	}

	if (!name_test.test(name)) {
		alert("Please Enter your Full Name Correctly");
		$('#external_applicants_form #name').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #name").offset().top - 300
        }, 400);
		return false;
	}

	if (designation == "") {
		alert("Please Enter Designation");
		$('#external_applicants_form #designation').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #designation").offset().top - 300
        }, 400);
		return false;
	}

	if (!email_test.test(email)) {
		alert("Please Enter E-mail Correctly");
		$('#external_applicants_form #email').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #email").offset().top - 300
        }, 400);	
		return false;
	}


	if (!contact_test.test(contact)) {
		alert("Please Enter Contact Number Correctly");
		$('#external_applicants_form #contact').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #contact").offset().top - 300
        }, 400);
		return false;
	}

	if (instrument == '-- Select Instrument --') {
		alert("Please Select an Instrument");
		$('#external_applicants_form #selected_instrument').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #selected_instrument").offset().top - 300
        }, 400);
		return false;
	}

	if (facility == '-- Select Facility --') {
		alert("Please Select a Facility");
		$('#external_applicants_form #facility').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #facility").offset().top - 300
        }, 400);
		return false;
	}

	if(no_of_samples == "" ||  ( no_of_samples < 1 || no_of_samples > 50 ) ) {
		alert("Please Enter Number of Samples between 1 and 50")
		$('#external_applicants_form #nos').focus();
		$('html, body').animate({
            scrollTop: $("#external_applicants_form #nos").offset().top - 300
        }, 400);
		return false;
	}
	$('.loader-bg').show();
	return true;
	
}


function validate_check_status() {
	var application_id  = $('#check_internal_status_form #application_id').val();
	var email           = $('#check_internal_status_form #email').val();
	
    $('#check_internal_status_form #show_status').blur();
	
	var application_id_test  = /^(EXT)?[0-9]+$/;
	var email_test   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.){1,2}([a-zA-Z0-9]{2,4})+$/;
	
	
	if (!email_test.test(email)) {
		alert("Please Enter E-mail Correctly");
		$('#check_internal_status_form #email').focus();
		$('html, body').animate({
            scrollTop: $("#check_internal_status_form #email").offset().top - 300
        }, 400);	
		return false;
	}

	if (!application_id_test.test(application_id)) {
		alert("Please Enter Valid Application ID");
		$('#check_internal_status_form #application_id').focus();
		$('html, body').animate({
            scrollTop: $("#check_internal_status_form #application_id").offset().top - 300
        }, 400);
		return false;
	}

	$('.loader-bg').show();
	return true;
}

function validate_add_instrument_form() {
	var instrument = $('#add_instrument_form #instrument').val();
	var supervisor = $('#add_instrument_form #supervisor').val();
	
    $('#add_instrument_form #add_instrument').blur();
	//alert(instrument + " " + supervisor);
	
	var instrument_test    = /^.+$/;
	var supervisor_test  = '-- Select Supervisor --';
	
	if (!instrument_test.test(instrument)) {
		alert("Please Enter An Instrument");
		$('#add_instrument_form #instrument').focus();
		$('html, body').animate({
            scrollTop: $("#add_instrument_form #instrument").offset().top - 300
        }, 400);	
		return false;
	}

	if (supervisor == supervisor_test) {
		alert("Please Select a Supervisor");
		$('#add_instrument_form #supervisor').focus();
		$('html, body').animate({
            scrollTop: $("#add_instrument_form #supervisor").offset().top - 300
        }, 400);	
		return false;
	}

	$('.loader-bg').show();
	return true;
}

function validate_add_facility_form() {
	var selected_instrument = $('#add_facility_form #selected_instrument').val();
	var facility = $('#add_facility_form #facility').val();
	var charge_for_industry = $('#add_facility_form #charge_for_industry').val();
	var charge_for_institute = $('#add_facility_form #charge_for_institute').val();
	var remarks = $('#add_facility_form #remarks').val();
	
    $('#add_facility_form #add_facility').blur();
	//alert(selected_instrument + " " + facility + " " + charge_for_industry + " " + charge_for_institute + " " + remarks);
	
	var selected_instrument_test  = '-- Select Instrument --';
	var facility_test             = /^.+$/;
	var charge_for_industry_test  = /^[0-9]+$/;
	var charge_for_institute_test = /^[0-9]+$/;
	var remarks_test              = /^.+$/;

	if (selected_instrument == selected_instrument_test) {
		alert("Please Select an Instrument");
		$('#add_facility_form #selected_instrument').focus();
		$('html, body').animate({
            scrollTop: $('#add_facility_form #selected_instrument').offset().top - 300
        }, 400);	
		return false;
	}

	if (!facility_test.test(facility)) {
		alert("Please Enter a Facility");
		$('#add_facility_form #facility').focus();
		$('html, body').animate({
            scrollTop: $("#add_facility_form #facility").offset().top - 300
        }, 400);	
		return false;
	}

	if (!charge_for_industry_test.test(charge_for_industry)) {
		alert("Please Enter Valid Charge for Industry");
		$('#add_facility_form #charge_for_industry').focus();
		$('html, body').animate({
            scrollTop: $("#add_facility_form #charge_for_industry").offset().top - 300
        }, 400);	
		return false;
	}

	if (!charge_for_institute_test.test(charge_for_institute)) {
		alert("Please Enter Valid Charge for Institute");
		$('#add_facility_form #charge_for_institute').focus();
		$('html, body').animate({
            scrollTop: $("#add_facility_form #charge_for_institute").offset().top - 300
        }, 400);	
		return false;
	}

	if (!remarks_test.test(remarks)) {
		alert("Remarks should not be empty");
		$('#add_facility_form #remarks').focus();
		$('html, body').animate({
            scrollTop: $("#add_facility_form #remarks").offset().top - 300
        }, 400);	
		return false;
	}

	$('.loader-bg').show();
	return true;
}