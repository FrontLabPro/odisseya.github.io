// JavaScript Document


[].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
  img.setAttribute('src', img.getAttribute('data-src'));
  img.onload = function() {
    img.removeAttribute('data-src');
  };
});




jQuery(document).ready(function(e) {
	jQuery(".main_menu .mob_menu").click(function(){
		if(jQuery(".main_menu").hasClass("open")){
			jQuery(".main_menu").removeClass("open");
			jQuery(".main_menu .menu").stop().fadeTo(300,0).slideUp(0);
		}else{
			jQuery(".main_menu").addClass("open");
			jQuery(".main_menu .menu").stop().slideDown(0).fadeTo(300,1);
		}
	});
	jQuery(".main_menu .menu a").click(function(){
		var obj = jQuery(this).attr("href");
		jQuery(".main_menu").removeClass("open");
		jQuery(".main_menu .menu").stop().fadeTo(300,0).slideUp(0);	
		jQuery("body, html").animate({"scrollTop":jQuery(obj).offset().top-jQuery("#head").outerHeight()},1000);
		return false;
	});
	
	function head_pos(){
		if(jQuery(window).scrollTop()>10){
			jQuery("#head").addClass("fixed");	
		}else{
			jQuery("#head").removeClass("fixed");		
		}
	}
	head_pos();
	jQuery(window).scroll(function(e) {
        head_pos();
		if(jQuery(window).scrollTop()>200){
			jQuery(".scroll_top").addClass("vis");	
		}else{
			jQuery(".scroll_top").removeClass("vis");		
		}
    });
	if(jQuery(window).scrollTop()>200){
			jQuery(".scroll_top").addClass("vis");	
	}else{
			jQuery(".scroll_top").removeClass("vis");		
	}
	jQuery(".scroll_top").click(function(e) {
        jQuery("html, body").animate({"scrollTop":0},1000);
		return false;
    });
	
	var today = new Date();
	if( today.getMonth() == 0){
		jQuery('.sect_action h2 .month').text("января");
	}else if( today.getMonth() == 1){
		jQuery('.sect_action h2 .month').text("февраля");
	}else if( today.getMonth() == 2){
		jQuery('.sect_action h2 .month').text("марта");
	}else if( today.getMonth() == 3){
		jQuery('.sect_action h2 .month').text("апреля");
	}else if( today.getMonth() == 4){
		jQuery('.sect_action h2 .month').text("мая");
	}else if( today.getMonth() == 5){
		jQuery('.sect_action h2 .month').text("июня");
	}else if( today.getMonth() == 6){
		jQuery('.sect_action h2 .month').text("июля");
	}else if( today.getMonth() == 7){
		jQuery('.sect_action h2 .month').text("августа");
	}else if( today.getMonth() == 8){
		jQuery('.sect_action h2 .month').text("сентября");
	}else if( today.getMonth() == 9){
		jQuery('.sect_action h2 .month').text("октября");
	}else if( today.getMonth() == 10){
		jQuery('.sect_action h2 .month').text("ноября");
	}else if( today.getMonth() == 11){
		jQuery('.sect_action h2 .month').text("декабря");
	}
	
	jQuery.fn.myTabs=function(tab_block){
		var tab = jQuery(this);
		tab.find("a").click(function(){
			var ind = jQuery(this).parent().index();
			tab.children(".act").removeClass("act");
			jQuery(this).parent("li").addClass("act");
			tab_block.children(".vis").removeClass("vis");
			tab_block.children("li").eq(ind).addClass("vis");
		});
	};
	jQuery(".view_tab").myTabs(jQuery(".view_tab_bl"));
	jQuery(".popup_view .view_tab_bl .img_sm a").click(function(){
		var ind = jQuery(this).parent().index();
		jQuery(this).parents(".img_sm").find(".act").removeClass("act");
		jQuery(this).parent("li").addClass("act");
		jQuery(this).parents(".img_bl").find(".img_big .vis").removeClass("vis");
		jQuery(this).parents(".img_bl").find(".img_big li").eq(ind).addClass("vis");
	});
	
	jQuery(".gallery_slider").slick({
		arrows:true,
		prevArrow:'<a class="slick-prev"><span></span></a>',
		nextArrow:'<a class="slick-next"><span></span></a>',
		dots:false,
		speed:300,
		rows:2,
		slidesPerRow:1,
		slidesToShow:4,
		slidesToScroll:1,
		responsive: [
			{
				breakpoint:992,
			  	settings: {
					slidesToShow: 3,
			  	}
			},
			{
				breakpoint:640,
			  	settings: {
					slidesToShow: 2,
			  	}
			},
			{
				breakpoint:480,
			  	settings: {
					slidesToShow: 1,
			  	}
			}
		]
	});
	
	jQuery("[data-fancybox]").fancybox({
		buttons:[
			'close'
		],
		loop:true
	});
	
	if(jQuery("#site").width()>991){
		jQuery(".pickup_parallax").parallax();
		jQuery(".save_parallax").parallax();
		jQuery(".cons_parallax").parallax();
	}
	
	jQuery(".comment_slider").slick({
		arrows:true,
		prevArrow:'<a class="slick-prev"><span></span></a>',
		nextArrow:'<a class="slick-next"><span></span></a>',
		dots:false,
		speed:300,
		fade:true,
	});
	jQuery(".comment_slider").on('beforeChange', function(event, slick, currentSlide, nextSlide){
  		jQuery(".comment_slider").find(".comment.open").each(function(index, element) {
            jQuery(this).removeClass("open");
			jQuery(this).find(".more_link").text("Читать отзыв");
			jQuery(this).find(".hide_bl").slideUp(0);
        });
		var video = jQuery(".comment_slider").find(".slick-current .video_bl").html();
		jQuery(".comment_slider").find(".slick-current .video_bl").html("");
		jQuery(".comment_slider").find(".slick-current .video_bl").html(video);
	});
	jQuery(".comment_slider .comment_in .more_link").click(function(){
		if(jQuery(this).parents(".comment").hasClass("open")){
			jQuery(this).parents(".comment").removeClass("open");
			jQuery(this).text("Читать отзыв");
			jQuery(this).parent(".comment").find(".hide_bl").slideUp(200);
		}else{
			jQuery(this).parents(".comment").addClass("open");
			jQuery(this).text("Скрыть отзыв");
			jQuery(this).parent(".comment").find(".hide_bl").slideDown(200);
		}
		return false;	
	});
	
	jQuery(".compare_slider").slick({
		arrows:true,
		prevArrow:'<a class="slick-prev"><span></span></a>',
		nextArrow:'<a class="slick-next"><span></span></a>',
		dots:false,
		speed:300,
		fade:true,
	});
	
	jQuery(".faq_slider").slick({
		arrows:false,
		prevArrow:'<a class="slick-prev"><span></span></a>',
		nextArrow:'<a class="slick-next"><span></span></a>',
		dots:false,
		speed:0,
		loop:false
	});
	jQuery(".faq_slider").on('beforeChange', function(event, slick, currentSlide, nextSlide){
  		jQuery(".faq_wrap .quest_list .act").removeClass("act");
		jQuery(".faq_wrap .quest_list>li").eq(nextSlide).addClass("act");
	});
	jQuery(".faq_wrap .quest_list a").click(function(e) {
        var ind = jQuery(this).parent().index();
		jQuery(".faq_wrap .quest_list .act").removeClass("act");
		jQuery(this).parent().addClass("act");
		jQuery(".faq_slider").slick('slickGoTo',ind);
		if(jQuery("#site").width()<991){
			jQuery("body, html").animate({"scrollTop":jQuery(".answer_bl").offset().top-70},500);	
		}
		return false;
    });
	
	jQuery(".scroll_to").click(function(e) {
        var obj = jQuery(this).attr("href");
		jQuery("html, body").animate({"scrollTop":jQuery(obj).offset().top-75},1200);
		return false;
    });
	
	jQuery(".popup_open").click(function(){
		var h = jQuery("#site").height();
		var obj = ".popup_wrapper>."+jQuery(this).attr("popup");
		jQuery(".popup_bg").css({"display":"block","height":h}).animate({opacity:1},200);
		jQuery(obj).css({"display":"block"});
		var ih = jQuery(window).innerHeight();
		var wh = jQuery(obj).outerHeight();
		var wt = (ih-wh)/2;
		var st = jQuery(document).scrollTop();
		if(wt<0){wt=0};
		wt = wt+st;
		jQuery(obj).css({"top":wt}).animate({opacity:1},200);
		if(jQuery(this).attr("popup") == "popup_view"){
			jQuery(".popup_view .view_tab li").eq(jQuery(this).data("ind")).children("a").click();	
		}
		return false;
	});
	jQuery(".popup_close").click(function(){
		jQuery(this).parents("li").animate({opacity:0},200).hide(0);
		jQuery(".popup_bg").animate({opacity:0},200).hide(0);
	});
	jQuery(".popup_bg").click(function(){
		jQuery(".popup_wrapper>li").animate({opacity:0},200).hide(0);
		jQuery(".popup_bg").animate({opacity:0},200).hide(0);
	});
	
	jQuery("input[type='text'],input[type='email'],input[type='tel'],input[type='password'], textarea").focusin(function(e) {
       jQuery(this).addClass("clean"); 
    });
	jQuery("input[type='text'],input[type='email'],input[type='tel'],input[type='password'], textarea").focusout(function(e) {
       jQuery(this).removeClass("clean"); 
    });
	jQuery("input[type='tel']").inputmask({
		alias: "phonemy",
    });
        
	jQuery("#popup_call_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#popup_prop_form").validate({
		rules: {
			name: "required",
			tel: "required",
			text: "required",
		}
	});
	jQuery("#popup_order_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#top_order_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#cons_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#calc_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#smaller_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#quest_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery("#one_click_form").validate({
		rules: {
			tel: "required",
		}
	});
	jQuery(".popup_view form").each(function(index, element) {
        jQuery(this).validate({
			rules: {
				tel: "required",
			}
		});
    });
	
	
	function form_send(form) {
		if(form.find("[name='some']").val() == "" && form.find("[name='text1']").val() == "" && form.find("[name='text2']").val() == ""){
			if(form.find("input[type='tel']").inputmask("getmetadata")["cd"] == "no" || !form.find("input[type='tel']").inputmask("isComplete")){
				form.find("input[type='tel']").val("");
				form.valid()
			}else if(form.valid()){
				var msg   = form.serialize();
				jQuery.ajax({
					type: 'POST',
					url: 'include/mail.php',
					data: msg,
					success: function(data) {
						jQuery(".popup_wrapper>li").animate({opacity:0},0).hide(0);
						var h = jQuery("#site").height();
						var obj = ".popup_wrapper>.popup_thanks";
						jQuery(".popup_bg").css({"display":"block","height":h}).animate({opacity:1},200);
						jQuery(obj).css({"display":"block"});
						var ih = jQuery(window).innerHeight();
						var wh = jQuery(obj).outerHeight();
						var wt = (ih-wh)/2;
						var st = jQuery(document).scrollTop();
						if(wt<0){wt=0};
						wt = wt+st;
						jQuery(obj).css({"top":wt}).animate({opacity:1},200);
					},
					error:  function(xhr, str){
						alert('Возникла ошибка: ' + xhr.responseCode);
					}
				});
			}
		}else{
			alert('Возникла ошибка при отправке. Повторите попозже.');	
		}
	}
	jQuery("[type='submit']").click(function(){
		form_send(jQuery(this).parents("form"));
		return false;
	});
	
	jQuery("img.ll").lazyload();
	
	
});