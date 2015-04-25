
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

(function($) { // Avoid conflicts with other libraries
	'use strict';

	var field = $("#wolfsblvt\\.highlightunreadposts\\.color")[0];

	// prevent minicolors from being cut of cause by overflow:hidden
	$(".row, fieldset dl").css("overflow", "visible");

	if (field != undefined) {
		$(field).minicolors({
			position: 'top left',
			letterCase: 'uppercase',
		});
	}

})(jQuery); // Avoid conflicts with other libraries
