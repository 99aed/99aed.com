/*
 * modelBox
 * https://github.com/rcbpro/jQuery-model-box/
 *
 * Copyright (c) 2012 rcbpro
 * Licensed under the FREE licenses.
 */

(function($) {

	var modelBox = {
		init: function(selector, fadeInFadeOutMap = null, config = null, cssClasses = null){
			this.sl = selector;
			this.maskId = this.sl + 'Mask';
			this.boxId = this.sl + 'Box';
			this.config = $.extend({}, $.modelBox.defaults);
			this.fadeInFadeOut = $.extend({}, $.modelBox.fadeInFadeOutDefault);			
			this.cssClasses = ((cssClasses != null) && (cssClasses != '')) ? cssClasses : this.config;
			this.classNotCssMap = ((cssClasses != null) && (cssClasses != '')) ? true : false;
			this.createOuterWrapperAndMapCss(this.cssClasses, this.classNotCssMap);
			this.createMaskWrapper(this.cssClasses, this.classNotCssMap);
			this.populateModelBoxToFront();
		},
		createOuterWrapperAndMapCss: function(cssMap, classNotCssMap){
			if (classNotCssMap){
				$('#' + this.sl).wrap('<div id="' + this.boxId + '" />').addClass(cssMap);
				$('#' + this.boxId).addClass(cssMap);
			}else{
				$('#' + this.sl).wrap('<div id="' + this.boxId + '" />').css(cssMap[1]);				
				$('#' + this.boxId).css(cssMap[0])
			}
			$('<a id="' + this.sl + 'Link" class="close"></a>').prependTo('#' + this.sl);
			$('#' + this.sl + 'Link').delegate(this, "click", function(){
				var orgMaskName, orgBoxName, orgInsideDivName;
				orgMaskName = $(this).attr('id').replace('Link', 'Mask');
				orgBoxName = $(this).attr('id').replace('Link', 'Box');	
				orgInsideDivName = $(this).attr('id').replace('Link', '');				
				$(this).remove();				
				$('#' + orgMaskName).remove();
				$('#' + orgInsideDivName).unwrap('#' + orgBoxName).removeAttr('style');
			});
			(!classNotCssMap) ? $('#' + this.sl + 'Link').css(cssMap[3]) : $('#' + this.sl + 'Link').addClass(cssMap);
		},
		createMaskWrapper: function(cssMap, classNotCssMap){
			$('<div id="' + this.maskId + '"></div>').appendTo('#' + this.boxId);
			$('#' + this.maskId).delegate(this, "click", function(){
				var orgBoxName, orgInsideDivName;
				orgBoxName = $(this).attr('id').replace('Mask', 'Box');	
				orgInsideDivName = $(this).attr('id').replace('Mask', '');			
				$('#' + $(this).attr('id').replace('Mask', 'Link')).remove();								
				$('#' + orgInsideDivName).unwrap('#' + orgBoxName).removeAttr('style');
				$(this).remove();
			});
			(!classNotCssMap) ? $('#' + this.maskId).css(cssMap[2]) : $('#' + this.maskId).addClass(cssMap);
		},
		populateModelBoxToFront: function(){
			var maskHeight, maskWidth, winH, winW;
			maskHeight = $(document).height();
			maskWidth = $(window).width();
			winH = $(window).height();
			winW = $(window).width();
			$('#' + this.boxId).fadeIn(this.fadeInFadeOut[0]);
        	$('#' + this.maskId).css({'width': maskWidth, 'height': maskHeight}).fadeIn(this.fadeInFadeOut[0]).fadeTo(this.fadeInFadeOut[1], 0.7);   
			$('#' + this.sl).css({'top':  winH / 2 - $('#' + this.sl).height() / 2, 'left' : winW / 2 - $('#' + this.sl).width() / 2}).fadeIn(this.fadeInFadeOut[0]);
		}
	};
	$.modelBox = function(selector, fadeInFadeOutMap, cssProperties, classes){
		var obj = Object.create(modelBox);
		obj.init(selector, fadeInFadeOutMap, cssProperties, classes);			  
	};
	
	$.modelBox.defaults = 
		[
		  { 
			  'position': 'absolute',
			  'left': '0',
			  'top':'0',
			  'z-index':'9999',
			  'background-color':'#000',
			  'display':'none'
		  },
		  { 
			  'position': 'fixed',
			  'left': '0',
			  'top':'0',
			  'z-index':'9998',
			  'padding':'20px',
			  'display':'none',
			  'width': '260px',
			  'border-radius': '2px',
			  'background':'url(images/titlebg.jpg) repeat-x top'
		  },
		  {
			  'position': 'absolute',
			  'left' :'0',
			  'top': '0',
			  'z-index': '9000',
			  'background-color': '#000',
			  'display': 'none'			
		  },
		  {
			  'background':'url("images/close.png") no-repeat scroll 0px -8px transparent', 
			  'float': 'right', 
			  'height': '32px', 
			  'width': '32px',
			  'cursor': 'pointer'
		  }		  
	  ];
	$.modelBox.fadeInFadeOutDefault = ['500', '500'];
}(jQuery));