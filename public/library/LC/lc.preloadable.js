/*
 * Smart Image
 *
 * Copyright (c) 2009 Lance Caraccioli
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 *
 * Depends:
 *	ui.core.js
 */
(function($) {
	$.widget("lc.preloadable", {
		isFullyLoaded:function(){
			return this._getData('fullsizeImageLoaded');
		},
		isThumbnailLoaded:function(){
			return this._getData('thumbnailImageLoaded');
		},
		_init:function(){
			this._setData('fullsizeImageLoaded', false);
			this._setData('thumbnailImageLoaded', false);
			var self = this;
			var element = this.element;
			element.addClass('lc-preloadable lc-preloadable-loading-fullsize lc-preloadable-loading-thumbnail');
			var image = element.find('img');
			image && $(image).load(function(){
				element.removeClass('lc-preloadable-loading-thumbnail').addClass('lc-preloadable-loaded-thumbnail');
				self._setData('thumbnailImageLoaded', true);
			});
			if (element.is('a')){
				fullsizeImage = new Image();
				//setup onLoad callback
				$(fullsizeImage).load(function(){
					element.removeClass('lc-preloadable-loading-fullsize').addClass('lc-preloadable-loaded-fullsize');
					self._setData('fullsizeImageLoaded', true);
					$(image).attr('src', $(this).attr('src'));//this == fullsizeImage
				});
				//start loading of large image
				fullsizeImage.src = element.attr('href');
				//fullsizeImage sent to garbage collection
			}
		}
	});
})(jQuery);
