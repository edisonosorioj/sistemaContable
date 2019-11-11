jQuery(document).ready(function($) {
	
	"use strict";
	
	// Sign Up
    $('form.sign-up').on('submit', function(e){
		var myform = $(this);
		myform.find('p.msg-sign-up').show().text(ajax_signup_object.loadingmessage);
		myform.addClass('form-working');
		var selected_option = myform.find('#account-type').children('option:selected').attr('value');
		var redirect = myform.find('#redirect').attr('data-redirect');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_signup_object.ajaxurl,
            data: { 
                'action': 'ajaxsignup', //calls wp_ajax_nopriv_ajaxlogin
                'nickname': myform.find('#user_name').val(), 
				'user_email': myform.find('#user_email').val(), 
				'user_pass': myform.find('#user_password').val(), 
				'account_type': selected_option, 
                'security': myform.find('#security').val(),
				'g-recaptcha-response': myform.find('[name="g-recaptcha-response"]').val() 
			},
            success: function(data){
                myform.find('p.msg-sign-up').text(data.message);
				myform.addClass('form-working');
                if (data.signup == true){
                    document.location.href = redirect;
                }else{
					myform.find('p.msg-sign-up').text(data.message);
					grecaptcha.reset();
				}
            }
        });
        e.preventDefault();
    });

});
