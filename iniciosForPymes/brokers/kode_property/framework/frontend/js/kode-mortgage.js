jQuery(document).ready(function($){
	"use strict";
	
	
	/* ==============================================================
	Ajax Submission
	============================================================== */
   jQuery('.kode-custom-mortgage-form').each(function(){
		var mortgage_form = jQuery(this);
		var currentForm = mortgage_form.attr('class');
		$('.kode-custom-mortgage-form').trigger("reset");
		jQuery(this).find('.calculator-button').click(function(){
			
			/*  Progress bar */
			var mprogresso = new Mprogress({
				//start: true,  // start it now
				parent: '.' + currentForm + ' .progresso',
				template: 3
			});
			mprogresso.start();
			
			// $('.kode-custom-mortgage-form p.kode-msg-list').show().text(ajax_mort_object.loadingmessage);
			// $('.kode-custom-mortgage-form').addClass('form-working');
			var action = $('.kode-custom-mortgage-form #data_action').val();
			// var property_status = "";
			// $("input[name='property-status']:checkbox").each(function () {
				// var ischecked = $(this).is(":checked");
				// if (ischecked) {
					// property_status += $(this).val() + ",";
				// }
			// });
			// var property_features = "";
			// $("input[name='property-features']:checkbox").each(function () {
				// var ischecked = $(this).is(":checked");
				// if (ischecked) {
					// property_features += $(this).val() + ",";
				// }
			// });
			// tinyMCE.triggerSave();
			
			var email_address = 'noone@nowhere.com';
			if ( mortgage_form.find('#send-email-to-user').is(':checked')) {
				var sendemail = 'true';
				email_address = mortgage_form.find('#user-email-id').val();
			}else{
				var sendemail = 'false';
			}
			var termcycle = 'years';
			if ( mortgage_form.find('#term-months').is(':checked')) {
				termcycle = 'months';
			}
			
			
			var amount   = mortgage_form.find('#mortgage-amount').val();
			var interest = mortgage_form.find('#mortgage-interest-rate').val();
			var downpay  = mortgage_form.find('#mortgage-down-payment').val();
			var term     = mortgage_form.find('#term-duration').val();
			var security     = mortgage_form.data('security');			
			

			// Overrides
			var override = {};
			override.enableinsurance        = mortgage_form.data('enableinsurance');
			override.insuranceamountpercent = mortgage_form.data('insuranceamountpercent');
			override.monthlyinsurance       = mortgage_form.data('monthlyinsurance');
			override.enablepmi              = mortgage_form.data('enablepmi');
			override.monthlypmi             = mortgage_form.data('monthlypmi');
			override.enabletaxes            = mortgage_form.data('enabletaxes');
			override.taxesperthou           = mortgage_form.data('taxesperthou');
			override.disclaimer             = mortgage_form.data('disclaimer');
			override.currencysymbol         = mortgage_form.data('currencysymbol');
			override.currencyside           = mortgage_form.data('currencyside');
			override.currencyformat         = mortgage_form.data('currencyformat');
			override.downpaytype            = mortgage_form.data('downpaytype');
			override.bccemail               = mortgage_form.data('bccemail');
			override.fromemail              = mortgage_form.data('fromemail');
			override.emailsubject           = mortgage_form.data('emailsubject');
			override.emailcontent           = mortgage_form.data('emailcontent');
			override.pdfcolor               = mortgage_form.data('pdfcolor');
			override.pdflogo                = mortgage_form.data('pdflogo');
			override.pdfheader              = mortgage_form.data('pdfheader');
			
			
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_mort_object.ajaxurl,			
				data: { 
					'action': action, //calls wp_ajax_nopriv_ajaxlogin					
					'mortgageNonce' :security,
					'process'    : 'true',
					'sendemail'  : sendemail,					
					'mailaddress': email_address,
					'amount'     : amount,
					'interest'   : interest,
					'downpay'    : downpay,
					'termcycle'  : termcycle,
					'term'       : term,
					'override'   : override
				},
				success: function(response){
					// $('body').addClass(response.sendout);
					// $('.kode-custom-mortgage-form p.kode-msg-list').text(response.message);
					// $('.kode-custom-mortgage-form').addClass('form-working');
					mprogresso.end();
					
					if (response.error == '1') {      // Handle Errors
						if (response.error_field == 'amount') {
							$('.' + currentForm).find('#mortgage-amount').addClass('error-field');
							$('.' + currentForm).find('#mortgage-amount').closest('.kode-calculator-input').find('.err-msg').show();
							$('.' + currentForm).find('#mortgage-amount').closest('.kode-calculator-input').find('.err-msg').text(response.message);
							$('.' + currentForm).trigger("reset");
						} else if (response.error_field == 'interest') {
							$('.' + currentForm).find('#mortgage-interest-rate').addClass('error-field');
							$('.' + currentForm).find('#mortgage-interest-rate').closest('.kode-calculator-input').find('.err-msg').css('display','block');
							$('.' + currentForm).find('#mortgage-interest-rate').closest('.kode-calculator-input').find('.err-msg').text(response.message);
							$('.' + currentForm).trigger("reset");
						} else if (response.error_field == 'down') {
							$('.' + currentForm).find('#mortgage-down-payment').addClass('error-field');
							$('.' + currentForm).find('#mortgage-down-payment').closest('.kode-calculator-input').find('.err-msg').css('display','block');
							$('.' + currentForm).find('#mortgage-down-payment').closest('.kode-calculator-input').find('.err-msg').text(response.message);
							$('.' + currentForm).trigger("reset");
						} else if (response.error_field == 'term') {
							$('.' + currentForm).find('#term-duration').addClass('error-field');
							$('.' + currentForm).find('#term-duration').closest('.kode-calculator-input').find('.err-msg').css('display','block');
							$('.' + currentForm).find('#term-duration').closest('.kode-calculator-input').find('.err-msg').text(response.message);
							$('.' + currentForm).trigger("reset");
						} else if (response.error_field == 'email') {
							$('.' + currentForm).find('#user-email-id').addClass('error-field');
							$('.' + currentForm).find('#user-email-id').closest('.kode-calculator-input').find('.err-msg').show();
							$('.' + currentForm).find('#user-email-id').closest('.kode-calculator-input').find('.err-msg').text(response.message);
							$('.' + currentForm).trigger("reset");
						}
					} else { 
						// $('.' + currentForm).addClass('success');
						// $('.' + currentForm).find('.kode-calculator-button').find('.calculator-button').prop('disabled', true);
						process_request(response.payment, response.headers, response.vals, response.details, currentForm);
					}
				}
			});
			
		});
		
		
		
	});
	
	/* Term selection Years & Months */
	$('#term-months').prop('checked', true);
	$('#term-years').prop('checked', false);
	
	var checked = $('#send-email-to-user:checked');
	if(checked.length){
		checked.addClass('enable');
		checked.parent().parent().find('input[type="text"]#user-email-id').removeAttr('disabled');	
	}
	
	$('input[type="checkbox"]#send-email-to-user').click(function(){
		if( $(this).hasClass('enable') ){
			$(this).removeClass('enable');
			$(this).removeAttr('checked');
			$(this).parent().parent().find('input[type="text"]#user-email-id').prop('disabled', true);
			$(this).parent().parent().find('input[type="text"]#user-email-id').slideUp();
			$(this).parent().parent().find('.err-msg').slideUp();
		}else{
			$(this).addClass('enable');
			$(this).attr('checked','checked');			
			$(this).parent().parent().find('input[type="text"]#user-email-id').slideDown();
			$(this).parent().parent().find('input[type="text"]#user-email-id').removeAttr('disabled');
		}
	});	
	// $("#send-email-to-user:checkbox").()
	// if ($(this).is(':checked')) {
			// $(this).closest('.shmac-form').find('.shmac-email').slideDown('fast');
		// } else {
			// $(this).closest('.shmac-form').find('.shmac-email').slideUp('fast');
		// }
	
	
	//Process Request if everything is okey
	function process_request(payment, headers, vals, details, currentForm) {
		
		var detailsTable = '<h3 class="kode-header">' + headers.loan_text + '</h3>'
					+ '<ul class="kode-table detail-table" data-kf-borders="true">'
                    + '<li>' + details.original + ': <br /><strong>' + vals.price2 + '</strong></li>'
                    + '<li>' + details.down_payment + ': <br /><strong>' + vals.down + ' %</strong></li>'
                    + '<li>' + details.interest + ': <br /><strong>' + vals.interest + ' %</strong></li>'
                    + '<li>' + details.term + ': <br /><strong>' + vals.term + ' ' + vals.cycle_text + '</strong></li>'
                    + '<li>' + details.loan_after_down + ': <br /><strong>' + vals.mortgage2
                    + '</strong></li>'
                    + '<li>' + details.down_payment_amount + ': <br /><strong>' + vals.moneydown2
                    + '</strong></li>'
                    + '<li>' + details.monthly_payment + ': <br /><strong>' + vals.monthly_payment2
                    + '</strong></li>'
                    + '<li>' + details.total_payments + ': <br /><strong>' + vals.total_payments
                    + '</strong></li>' 
                    + '</ul>';

			
		// Taxes Insurance & PMI (TIP)
		var tip = '';
		if (vals.enable_insurance == 'yes'
			|| vals.enable_pmi == 'yes'
			|| vals.enable_taxes == 'yes'
		) {
			tip += '<p>' + vals.otherfactors + '</p>'
                + '<ul class="kode-ul">';
			// check for pmi enabled
            if (vals.enable_pmi == 'yes') {
                tip += '<li><i class="fa fa-info"></i> ' + vals.pmi_text + '</li>';
            }
            // check for taxes enabled
            if (vals.enable_taxes == 'yes') {
				tip += '<li><i class="fa fa-info"></i> ' + vals.tax_text + '</li>';
            }
            // check for insurance enabled
            if (vals.enable_insurance == 'yes') {
				tip += '<li><i class="fa fa-info"></i> ' + vals.insurance_text + '</li>';
            }
            tip += '</ul>'
                 + '<p class="border-p">' + vals.total_monthlies + '</p>'
                 + '<p></p>';
        } else {
            tip += '<p></p>';
        }	

		// Schedule
		var schedule = '<h3 class="kode-header">' + headers.schedule_text + '</h3>'
					 + '<ul class="kode-table schedule-table" data-kode-borders="true">'					 
		             + '<li class="schedule-head">' + headers.payment + '</li><li class="kode-payment_amount">' + headers.payment_amount 
					 + '</li><li class="kode-principal">' + headers.principal 
			         + '</li><li>' + headers.interest + '</li><li class="kode-total_interest">' + headers.total_interest + '</li><li class="kode-balance">'
				     + headers.balance + '</li></ul>';
		schedule += '<ul class="kode-table-sec">';
		$.each( payment, function( k, v) {
			schedule += '<li class="kode-balance-val">' + v.value 
				     + '</li><li class="' + headers.payment_amount + '">' + vals.monthly_payment2 
					 + '</li><li class="' + headers.principal + '">' + v.principal 
			         + '</li><li class="' + headers.interest + '">' + v.interest 
					 + '</li><li class="' + headers.total_interest + '">' + v.total_interest 
					 + '</li><li class="' + headers.balance + '"><strong>' + v.newMortgage + '</strong></li>';
		});
		schedule += '</ul>';

		// Disclaimer
		var disclaimerDiv = '<div class="disclaimer">' + details.disclaimer + '</div>';

    	var show_html = document.createElement('div');
		$(detailsTable).appendTo(show_html);
		$(schedule).appendTo(show_html);
		$(tip).appendTo(show_html);
		$(disclaimerDiv).appendTo(show_html);
		
		$('#showcontent').html(show_html);
  	}

});