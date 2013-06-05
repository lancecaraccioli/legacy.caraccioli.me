/*
 * Zoom Album
 *
 * Copyright (c) 2009 Lance Caraccioli
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 *
 * Depends:
 * ui.core.js
 */
(function($) {
	$.widget("lc.zoomable", {
		//public
		translation:{x:1.0, y:1.0},
		currentChild:null,
		next:function(){
			var currentChild = this.getCurrentChild();
			var nextChild = currentChild.next('.lc-zoomable-element');
			nextChild =  (nextChild.is('.lc-zoomable-element'))?nextChild:this.canvas.find('.lc-zoomable-element:first');
			this.setCurrentChild(nextChild);
			nextChild.click();
		},
		prev:function(){
			var currentChild = this.getCurrentChild();
			var prevChild = currentChild.prev('.lc-zoomable-element');
			prevChild = (prevChild.is('.lc-zoomable-element'))?prevChild:this.canvas.find('.lc-zoomable-element:last');
			this.setCurrentChild(prevChild);
			prevChild.click();
		},
		getCurrentChild:function(){
			return $(this.currentChild);
		},
		setCurrentChild:function(child){
			this.currentChild = $(child);
		},
		fixateChildren:function(children){
			var self = this;
			children.each(function(){
				self.calculatePosition(this);
				self.calculateDimension(this);
			})
			children.each(function(){
				self.setPosition(this);
				self.setDimension(this);
			})
		},
		calculatePosition:function(child){
			$(child).data('calculatedPosition',{
				position:'absolute',
				left:$(child).position().left/$(child).parent().width() *100+ '%',
				top:$(child).position().top/$(child).parent().height() *100+ '%'
			});
		},
		calculateDimension:function(child){
			$(child).data('calculatedDimension',{
				width:$(child).width()/$(child).parent().width() *100+ '%',
				height:$(child).height()/$(child).parent().height() *100+ '%'
			});
		},
		setPosition:function(child){
			$(child).css($(child).data('calculatedPosition'));
		},
		setDimension:function(child){
			$(child).css($(child).data('calculatedDimension'));
		},
		_init:function(){
			self = this;//private reference used by private funtions
			//TODO: reliably detect when the dom element and all it's children/styles have loaded... do we have to force this with $(window).load???
			//this.element.load(function(){
				this.element.addClass('lc-zoomable').css({position:'relative'});
				var children = this.element.children();
				children.addClass('lc-zoomable-element');
				this.fixateChildren(children);//must happen before next line due to jquery removing spaces from  raw html which removes white space after inline-block elements
				children.wrapAll('<div class="lc-zoomable-canvas">');
				this.canvas = this.element.find('div.lc-zoomable-canvas');
				this.element.addClass('lc-zoomable').css({overflow:'hidden'});//adding overflow hidden before positioning the children was causing weird glitches causing inline a tags to expand to the width of the full size image they contained
				this.canvas
					.css({position:'absolute', left:"0px", top:"0px"})
					.width(this.element.width())
					.height(this.element.height());
				children.click(leftClickHandler);
				this.element.bind('contextmenu', rightClickHandler);
				this.setCurrentChild(children[0]);
			//});
		}
	});
	//private
	var self;
	//executes in context of  selected child element
    var leftClickHandler=function(event){
			event.preventDefault();
            var canvas = self.canvas;
			var canvasWindow = canvas.parent();//this.element == canvas.parent()
			self.setCurrentChild($(this));
            /*to find the canvas positioning that centers the selected child element in the canvas
	            1.We need to translate the center on the child element to the window element coordinate space
	                a.  find the center of the child element in child element coordinates (child element width/2)
	                b.  find distance of center of child element from canvas left border (child element offset left + 1/2 child element width)
	                c.  translate that distance to relative canvas coordinates (distance to center of child element)/canvas width
	                d.  scroll left of canvas will be width of canvas * child element center relative location - (1/2 width of canvas)
	                
	        */ 
            var translationAdjustment = {x:0.0, y:0.0};
          
            //find the relative center mass x coordinate
	        var halfOfChildWidth = self.getCurrentChild().outerWidth()/2.0;//get width of child element including padding and border but not margin then divide it by two
	        var xDistanceFromLeftOfViewportToCenterOfChild = (self.getCurrentChild().position().left + halfOfChildWidth) ;
	        translationAdjustment.x = xDistanceFromLeftOfViewportToCenterOfChild/canvas.width();
	        //find the relative center mass y coordinate
	        var halfOfChildHeight = self.getCurrentChild().outerHeight()/2.0;
	        var yDistanceFromTopOfViewportToCenterOfChild = (self.getCurrentChild().position().top + halfOfChildHeight) ;
	        translationAdjustment.y = yDistanceFromTopOfViewportToCenterOfChild/canvas.height();
			//set the translation of the canvas
			self.translation=translationAdjustment;
            /*
				We want the current child element centered on the screen and taking as much realestate as possible
				the most realestate possible that stays within the canvas will be determined by the canvass dimensions
				we want the child elements height to be the height of the canvas, after animation. By taking the ratio of the child element height now
				over it's ideal height (which is the height of the canvas) we can determine the same scale ratio for the canvas 
			*/
			var scaleFactorY = canvasWindow.height()/self.getCurrentChild().height();
			var scaleFactorX = canvasWindow.width()/self.getCurrentChild().width();
			var scaleFactor = (scaleFactorX > scaleFactorY)?scaleFactorY:scaleFactorX;

            var expectedCanvasWidth = scaleFactor * canvas.width();
	        var expectedCanvasHeight = scaleFactor * canvas.height();
			var expectedFontSize = parseInt(canvas.css('font-size'))*scaleFactor;
	        var positionLeftTarget = canvasWindow.width()/2.0 - (expectedCanvasWidth * translationAdjustment.x);
	        var positionTopTarget = canvasWindow.height()/2.0 - (expectedCanvasHeight * translationAdjustment.y);
            canvas.stop();
	        canvas.animate({fontSize:expectedFontSize, height:expectedCanvasHeight, width:expectedCanvasWidth,left:positionLeftTarget, top:positionTopTarget}, {duration:1300});
			self.scale = {x:scaleFactor, y:scaleFactor};
     };
	 //executes in context of this widgets element
    rightClickHandler=function (event){
        event.preventDefault();//stop browser context menu from appearing
        var  canvas = self.canvas;
	    var  canvasWindow = canvas.parent();
	    var scaleFactorY = canvasWindow.height()/canvas.height();
	    var scaleFactorX = canvasWindow.width()/canvas.width();
	    var scaleFactor = (scaleFactorX > scaleFactorY)?scaleFactorY:scaleFactorX;
	    
		var expectedCanvasWidth = scaleFactor * canvas.width();
		var expectedCanvasHeight = scaleFactor * canvas.height();
		var expectedFontSize = parseInt(canvas.css('font-size'))*scaleFactor;
		//reposition  this to the top left of the canvas
		var translationAdjustment = {x:1.0, y:1.0};
		self.translation = translationAdjustment;
		var positionLeftTarget = 1;
		var positionTopTarget = 1;
        canvas.stop();				
		canvas.animate({fontSize:expectedFontSize, height:expectedCanvasHeight, width:expectedCanvasWidth,left:positionLeftTarget, top:positionTopTarget}, {duration:1300});
		self.scale = {x:scaleFactor, y:scaleFactor};	};
})(jQuery);
