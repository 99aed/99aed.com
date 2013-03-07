/* Main js file */
$(document).ready(function(){
	$("#subscriptionEmailLabel").inFieldLabels();
	/* count down for the deal date */
	var newYear = new Date(),
		i = 0,
		n = 0; 
	newYear = new Date(newYear.getFullYear() + 1, 1 - 1, 1); 
	$('#timer').countdown({until: newYear});
	/* for the very first time the page get loaded the vertical slider should be filled up with some data */
	$('#featuredDealSliderWrapper #featureDealsLoadingIndicator').attr('src', 'http://localhost/99aed.com/public/images/ajax-loader.gif');
	$.getJSON('http://localhost/99aed.com/ajaxFunctions.php?action=grabInitialDeals', 			
		function(data) {
			if ((data != "") && (data != null)){
				// This is belongs to left panel deals loading 
				$('#featuredDealSliderWrapper #featureDealsLoadingIndicator').hide();
				$('#featuredDealSliderWrapper').html(data.initialDealsHtml);
				// This is belongs to middle panel deal information loading
				$('#randomDealSlider').fadeIn(1000, function(){ 
					$('#randomDealSlider').html(data.initalMainImageDetails);
				});
				// This is belongs to the fineprint and other benefits information
				$('#benefitsAndFinePrintDetailsWrapper div:first article').html(data.otherDetails.benefits);
				$('#benefitsAndFinePrintDetailsWrapper div:last article').html(data.otherDetails.finePrint);				
				// This is belongs to right panel deal information loading
				$('#priceExtraDetails').fadeIn(1000, function(){ 
					$('#priceExtraDetails').html(data.priceDetailsHtml);
				});
			}
	});					
    /* slider for the vertical content */ 
	setInterval(function() {
		i++;
		$.getJSON('http://localhost/99aed.com/ajaxFunctions.php?action=checkData&current=' + i, 			
			function(data) {
				if (data.dataAvailablity == "yes"){
					// This is for left panel update
					$("div.featuredDeal:first").animate({'margin-top': '-115px'}, 1000).fadeOut(300, function(){ 
						$(this).remove();
					});
					$.ajax({  
						type: "GET",
						url: "http://localhost/99aed.com/ajaxFunctions.php?action=grabDeal&initial=" + 5 + "&next=" + i, 
						success: function(response){			
							if (response){
								$('.featuredDeal:last').after(response);
							}
						} 
					});					
					// This is for middle panel update
					$("#randomDealSlider div:first").animate({'margin-left': '-300px'}, 1500).remove();
					$('#randomDealSlider').hide();
					$.getJSON('http://localhost/99aed.com/ajaxFunctions.php?action=grabDealInfo&initial=' + 1 + "&next=" + i, 			
						function(data) {
							if ((data != "") && (data != null)){
								$('#randomDealSlider').fadeIn(1000).append(data.dealMainImageDetails);
							}
					});
					// This is for right panel update
					$("div.priceDetailNodes:first").animate({'margin-top': '-500px'}, 1500);
					$.ajax({  
						type: "POST",
						url: "http://localhost/99aed.com/ajaxFunctions.php?action=grabDealPriceInfo", 
						data: "somedat",
						success: function(response){			
							if (response){
								$(response).hide().fadeIn(1800).insertAfter('#randomDealSlider');
							}
						} 
					});
					$('div.priceDetailNodes:last').fadeOut(300, function(){ $(this).remove(); });
				}else{
					n++;
					if (n <= data.totalRecords){
						$("div.featuredDeal:first").animate({'margin-top': '-125px'}, 1000).fadeOut(300, function(){ 
							$(this).remove();
						});
						$.ajax({  
							type: "GET",
							url: "http://localhost/99aed.com/ajaxFunctions.php?action=grabDeal&initial=" + 0 + "&next=" + n, 
							success: function(response){			
								if (response){
									$('.featuredDeal:last').after(response);
								}
							} 
						});
						// This is for middle panel update
						$("#randomDealSlider div:first").animate({'margin-left': '-300px'}, 1500).remove();
						$('#randomDealSlider').hide();
						$.getJSON('http://localhost/99aed.com/ajaxFunctions.php?action=grabDealInfo&initial=' + 0 + "&next=" + n, 			
							function(data) {
								if ((data != "") && (data != null)){
									$('#randomDealSlider').fadeIn(1000).append(data.dealMainImageDetails);
								}
						});
						// This is for right panel update
						$("div.priceDetailNodes:first").animate({'margin-top': '-500px'}, 1500);
						$.ajax({  
							type: "POST",
							url: "http://localhost/99aed.com/ajaxFunctions.php?action=grabDealPriceInfo", 
							data: "somedat",
							success: function(response){			
								if (response){
									$(response).hide().fadeIn(1800).insertAfter('#randomDealSlider');
								}
							} 
						});
						$('div.priceDetailNodes:last').fadeOut(300, function(){ $(this).remove(); });
					}else{
						n = 0;
					}
				}
		});					
		
		
				//}
			//} 
		//});
	}, 5000);
	// This is for the Jquery login box
    $('#loginLink').click(function() {
		var id = "",
        	maskHeight = "",
            maskWidth = "",
            winH = "",
            winW  = "";
    	$("#login_boxes").css({"display" : "block"});
        id = $("#login_dialog");
        maskHeight = $(document).height();
        maskWidth = $(window).width();
        $('#login_mask').css({'width':maskWidth,'height':maskHeight}).fadeIn(1000).fadeTo("slow",0.8); 
        winH = $(window).height();
        winW = $(window).width();
        $(id).css('top',  winH/2-$(id).height()/2).css('left', winW/2-$(id).width()/2).fadeIn(2000);
    });
    $('.login_window .close').click(function (e) {
        e.preventDefault();
        $('#login_mask, .login_window').hide();
    });    
    $('#login_mask').click(function () {
        $(this).hide();
        $('.login_window').hide();
    });        
	$('#directLoginSubmit').click(function(){
		$('#login_mask').trigger('click');
	});	

	// This is for the Jquery register box
    $('#registrationLink').click(function() {
		var id = "",
        	maskHeight = "",
            maskWidth = "",
            winH = "",
            winW  = "";
    	$("#register_boxes").css({"display" : "block"});
        id = $("#register_dialog");
        maskHeight = $(document).height();
        maskWidth = $(window).width();
        $('#register_mask').css({'width':maskWidth,'height':maskHeight}).fadeIn(1000).fadeTo("slow",0.8); 
        winH = $(window).height();
        winW = $(window).width();
        $(id).css('top',  winH/2-$(id).height()/2).css('left', winW/2-$(id).width()/2).fadeIn(2000);
    });
    $('.register_window .close').click(function (e) {
        e.preventDefault();
        $('#register_mask, .register_window').hide();
    });    
    $('#register_mask').click(function () {
        $(this).hide();
        $('.register_window').hide();
    });
	$('#registerSubmit').click(function(){
		$('#register_mask').trigger('click');	
	});
	        
});