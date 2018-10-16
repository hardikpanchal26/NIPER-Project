
var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

(function($){
	$(document).ready( function(){
								
		$('.home .centerCols').after($('.home .leftCols').clone().addClass('mobileBlock'));			
		
		$('.goBack').click(function(){
			goBack();
			return false;
		})
		
		$('body').removeClass('noJS').addClass("hasJS");
		removeWobClass()
		
		if (isMobile == false) {
			$('body').addClass('dexpot');
		} else{
			$('body').removeClass('wob').addClass('mobile');
		};
		
		// Sticky Nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		if($("#mainNav").length){
			var stickyNavTop = $("#mainNav").offset().top; 
			var stickyNav = function(){  
				var scrollTop = $(window).scrollTop();  
				if (scrollTop > stickyNavTop) {   
					$("#mainNav").addClass('sticky'); 
				} else {  
					$("#mainNav").removeClass('sticky');   
				}  
			};
			stickyNav();  
			$(window).scroll(function() {  
				stickyNav();
			});
			
			var str=location.href.toLowerCase();
			$("#nav li a").each(function() {
				if (str.indexOf(this.href.toLowerCase()) > -1) {
					$("li.highlight").removeClass("highlight");
					$(this).parent().addClass("highlight");
				}
			});
			$("li.highlight").parents().each(function(){
				if ($(this).is("li")){
					$(this).addClass("highlight");
				}
			});
		}
		
		//Navigation ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
		if( $("#nav").length) {
			$(".toggleMenu").click(function(e) {
				e.preventDefault();
				$(this).toggleClass("active");
				$("#nav").slideToggle();
				$("#nav li").removeClass("resHover")
				$(".resIcon").removeClass("active")
				return false;
			});
			$("#nav li a").each(function() {
				if ($(this).next().length) {
					$(this).parent().addClass("parent");
				};
			})
			$("#nav li.parent").each(function () {
				if ($(this).has(".menuIcon").length <= 0) $(this).append('<i class="menuIcon">&nbsp;</i>')
			});
			dropdown('nav', 'hover', 1);
			adjustMenu();
		}
		
		// Back to Top function ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		if( $("#backtotop").length){
			$(window).scroll(function(){
				if ($(window).scrollTop()>120){
				$('#backtotop').fadeIn('250').css('display','block');}
				else {
				$('#backtotop').fadeOut('250');}
			});
			$('#backtotop').click(function(){
				$('html, body').animate({scrollTop:0}, '200');
				return false;
			});
		};
		
		//Calender -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		if($('.calender').length){
			$(function() {
				$(".calender" ).datepicker({dateFormat: 'dd/mm/yy'});
			})
		}
		
		if( $(".calendarValidto").length > 0){
		 $( ".calendarValidto" ).datepicker({changeMonth: true,changeYear: true, yearRange :"2014:2030"});
		 $( ".calendarValidto" ).datepicker( "option", "dateFormat", 'dd-mm-yy');
		}
	 
		//sideBar-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------		
		if( $(".sideBar").length > 0){
				$('.sideBar')
					.theiaStickySidebar({
						additionalMarginTop: 60
					});
		};
		
		if($("#menuLeft").length){
				pageTitle = $('.rightMenu .heading').text();
				menuLeft = $('#menuLeft').clone().addClass("selectMenu")
				$('.breadcrumb').after('<div id="selectMenu"><a href="#" class="menuLeftTriger">'+pageTitle+'</a></div>')
				$('.menuLeftTriger').after(menuLeft)
				$('.menuLeftTriger').click(function(){
					$(this).next().slideToggle("fast");
					return false;
				});
		}

		//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	});

	$(window).bind('resize orientationchange', function() {
		ww = document.body.clientWidth;
		adjustMenu();
		removeWobClass();
		
	});

	//remove Wob Class
	function removeWobClass(){
		if($('body.wob').length && $(window).width() < 1024){
			$('body.wob').removeClass('wob');
		}
	};

	//DataTables 

})(jQuery);

function goBack() {
    window.history.back();
}

function get_facility() {
	var instrument = $("#selected_instrument").val();

	$.ajax({
    	type:'POST',
        url:'../database/ajax_data.php',
        data: {instrument_id: instrument},
        success:function(html){
        	$('#facility').html(html);
        }

    });
}

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
	var email_test   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var contact_test = /^[0-9\s]+$/;
	
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


function validate_check_status() {
	var application_id  = $('#check_internal_status_form #application_id').val();
	var email           = $('#check_internal_status_form #email').val();
	
    $('#check_internal_status_form #show_status').blur();
	
	var application_id_test  = /^[0-9]+$/;
	var email_test   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	
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

function applicants_data_submit(id) {
	$('#niper_personnel_id').val(id);
	$('#applicants_data_form').submit();
}

function send_mail_loader_load() {
	$('#send_mail_form').hide();
	$('#send_mail_loader').show();
}

function passwords_not_match() {
	if ($('#new_password_1').val() != $('#new_password_2').val()) {
		alert("Passwords does not match");
		return false;
	}
	else {
		
	$('.loader-bg').show();
		return true;
	}
}

function passwords_match() {
	if ($('#new_password_1').val() != "" && $('#new_password_1').val() == $('#new_password_2').val()) {
		$('#passwords_confirmed').show();
	}
	else {
		$('#passwords_confirmed').hide();
	}
}