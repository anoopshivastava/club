(function ($) {	   
	$('.slider_sec').slick({
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true,
		autoplay: true,
        autoplaySpeed: 5000,
	  });



     $(".menu  ul > li").click(function(e){
		 
		 $(this).siblings().find(".dropdown-menu").slideUp("slow");
		 $(this).find(".dropdown-menu").slideToggle("slow");
	 })
	 $(".menu  ul > li li").click(function(e) {
        e.stopPropagation();
     });
	 

	 $(".mobile_menu").click(function(){
		 $(".menu").slideToggle("slow")
	 })

	  
      
	  $(window).resize(function(){
		if (screen.width > 767){
			   $(".menu").show()
			}
			else{
				$(".menu").hide()
			}
	  })
	
})(jQuery);

