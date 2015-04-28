<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\tests\testframework;

abstract class functional_test_case extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return array('wolfsblvt/highlightunreadposts');
	}
}
