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

class info_test extends wolfsblvt_cur_ext\tests\testframework\test_case
{
	/**
	 * Tests the constants for minimum version with the ones specified in the composer.json,
	 * they have to be the same.
	 */
	public function test_highlightunreadposts_info()
	{
		// Set up the info object
		$info = new \wolfsblvt\highlightunreadposts\acp\highlightunreadposts_info();
		$data = $info->module();

		// Test is function module() exists
		$this->assertTrue(
			method_exists($info, 'module'),
			'Class does not have method module()'
		);

		// Test if needed kes exist
		$this->assertArrayHasKey('filename', $data);
		$this->assertArrayHasKey('title', $data);
		$this->assertArrayHasKey('modes', $data);

		// Test if attributes in modes are correct
		foreach($data['modes'] as $id => $mode_data)
		{
			// We need the auth key here
			$this->assertArrayHasKey('auth', $mode_data);

			// Test if auth string contains acp default and extension right
			$this->assertContains('acl_a_board', $mode_data['auth']);
			$this->assertContains('ext_' . self::DATA_EXT_NAME, $mode_data['auth']);
			
		}

		// Test if module file can be found
		$this->assertTrue(
			class_exists($data['filename']),
			'Corresponding class module not found'
		);
	}
}
