
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
				menuLeft = $('#menuLeft').clone().addClass("selectMenu");
				$('.sideBar').removeClass('.sideBar');
				$('.breadcrumb').after('<div id="selectMenu"><a href="#" class="menuLeftTriger">'+pageTitle+'</a></div>');
				$('.menuLeftTriger').after(menuLeft);
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

function get_form_factors() {
	var instrument = $("#selected_instrument").val();
	$.ajax({
    	type:'POST',
        url:'../database/ajax_data.php',
        data: {instrument_id2: instrument},
        success:function(html){
        	$('#form_factor_data').html(html);
        }

    });
}

function applicants_data_submit(id) {
	$('#niper_personnel_id').val(id);
	$('#applicants_data_form').submit();
}

function external_applicants_data_submit(id) {
	$('#external_applicant_id').val(id);
	$('#external-applicants_data_form').submit();
}

function send_mail_loader_load() {
	$('#send_mail_form').hide();
	$('#send_mail_loader').show();
}

function send_mail_loader_load_2() {
	$('#send_mail_form_2').hide();
	$('#send_mail_loader_2').show();
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

function submit_facility_avaibility_form(id) {
	
	var instrument_available = $('#'+id).is(':checked');
	var facility_id = id.split('_')[1];
	var new_status = (instrument_available)? 1 : 0;
	
	$.ajax({
    	type:'POST',
        url:'../database/ajax_data.php',
        data: {facility_status_change_id: facility_id, status: new_status },
        success:function(html){
        }

    });
}

function set_edit_facility_id(id) {
	$('#facility_edit_id').val(id);
}

function set_delete_facility_id(id) {
	$('#facility_delete_id').val(id);
	$( "#facility_delete_form" ).submit();
}