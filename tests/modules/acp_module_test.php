<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace phpbb\collapsiblecategories\tests\system;

// Makes our extension namespace easier usable
use wolfsblvt\highlightunreadposts as wolfsblvt_cur_ext;

class acp_module_test extends wolfsblvt_cur_ext\tests\testframework\test_case
{
	/**
	 * Tests the constants for minimum version with the ones specified in the composer.json,
	 * they have to be the same.
	 */
	public function test_highlightunreadposts_module()
	{
		// Set up the module object
		$module = $this->getMockBuilder('\wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module')
			->setMethods(array(
				'init'
			))
			->getMock();

		// Test is function main() exists
		$this->assertTrue(
			method_exists($module, 'main'),
			'Class does not have method module()'
		);

		// Do our init manually
		// TODO: Workaround, until official object exists.
		$module->acp_magic = $this->getMockBuilder('\stdClass')
			->setMethods(array(
				'do_magic'
			))
			->getMock();

		// Our method call
		$module->main(1, 'settings');
	}
}
