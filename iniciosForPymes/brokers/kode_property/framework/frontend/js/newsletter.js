jQuery(document).ready(function($){
	"use strict";
	
	// save admin menu
	 $('form#kode-submit-form').on('submit', function(e){
		$('form#kode-submit-form p.status').show().text(ajax_login_object.loadingmessage);
		var mailchimp_form = $(this);
	
		var ajax_url = mailchimp_form.attr('data-ajax');
		var nonce = mailchimp_form.attr('data-security');
		var action = mailchimp_form.attr('data-action');

		 $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: { 
                'action': action, 
                'email': $('form#kode-submit-form #email').val(),                 
			},
            success: function(data){			
                $('form#kode-submit-form p.status').text(data.message);
                if (data.success == true){
				
				}
            }
        });
      e.preventDefault();
	});		

});