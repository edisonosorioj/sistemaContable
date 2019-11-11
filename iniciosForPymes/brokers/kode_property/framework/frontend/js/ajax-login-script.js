jQuery(document).ready(function($) {
	
	"use strict";
	
	// Perform AJAX login on form submit
    $('form.login').on('submit', function(e){
        var myform = $(this);
		myform.siblings('.kf_login_social_icon').find('p.msg').show().text(ajax_login_object.loadingmessage);
		var redirect = myform.find('.redirect').attr('data-redirect');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,			
			data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': myform.find('.username').val(), 
                'password': myform.find('.password').val(), 				
				'security': myform.find('#security').val()
                // 'g-recaptcha-response': $('form#login [name="g-recaptcha-response"]').val() 
			},
			success: function(data){
                myform.siblings('.kf_login_social_icon').find('p.msg').text(data.message);
                if (data.loggedin == true){
                    document.location.href = redirect;
                }else{
					myform.siblings('.kf_login_social_icon').find('p.msg').text(data.message);
				}
            }
        });
        e.preventDefault();
    });

});
