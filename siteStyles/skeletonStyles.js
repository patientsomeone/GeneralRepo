/*jslint browser: true*/
/*global $, jQuery, alert, console, ContextManager, LazyLoader*/

var specCount = 1;
jQuery('#content > .flexible .cell section').each(function () {
    "use strict";
    var widgetType = jQuery(this).attr('class');
        
    if (widgetType.toLowerCase().indexOf('specials-widget') >= 0) {
        jQuery(this).addClass('modSpecialsWgt' + specCount);
        specCount += 1;
	}
                                                  
    
    jQuery(this).addClass('modStyleWgt');
});