<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\tests;

/**
 * A data collection wich can be re-used in all tests.
 * (Implemented by default in my own testcases)
 * 
 * It makes sharing data through all testcases easier.
 */
interface test_data_collection
{
	/** Extension name as "vendor/extensionname" */
	const DATA_EXT_NAME = 'wolfsblvt/highlightunreadposts';
}
