/*jslint browser: true*/
/*global jQuery*/
var i,
    arrayOne = ['banana', 'peacock', 'sandie'],
    searchTerm = 'Peacock',
    curItem;


function checkItem(txt) {
    'use strict';
    for (i = 0; arrayOne.length < i; i += 1) {
        jQuery('#test').append('Loop <br>');
        curItem = arrayOne[i];
        jQuery('#test').append(curItem + ' checked <br>');
        if (curItem.toLowerCase() === txt.toLowerCase()) {
            jQuery('#test').append(curItem + ' matches: ' + txt + '<br>');
        }
    }
}
jQuery('#test').append('Start <br>');
checkItem(searchTerm);