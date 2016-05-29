jQuery(document).ready(function(){

	jQuery('.easechat_chat_head').click(function(){
		jQuery('.easechat_chat_body').slideToggle('fast');
	});
	jQuery('.easechat_msg_head').click(function(){
		jQuery('.easechat_msg_wrap').slideToggle('fast');
	});

	jQuery('.easechat_close').click(function(){
		jQuery('.easechat_msg_box').hide();
	});

	jQuery('.easechat_user').click(function(){

		jQuery('.easechat_msg_wrap').show();
		jQuery('.easechat_msg_box').show();
	});

	jQuery('textarea').keypress(
    function(e){
        if (e.keyCode == 13) {
            var msg = jQuery(this).val();
			jQuery(this).val('');
			if(msg!=='')
			jQuery('<div class="easechat_msg_b">'+msg+'</div>').insertBefore('.easechat_msg_push');
			jQuery('.easechat_msg_body').scrollTop(jQuery('.easechat_msg_body')[0].scrollHeight);
        }
    });

});
