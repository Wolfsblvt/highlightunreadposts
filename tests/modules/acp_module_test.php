<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\tests\system;

class acp_module_test extends \wolfsblvt\highlightunreadposts\tests\testframework\test_case
{
	/** @var \wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module */
	protected $module;

	/** @var \Symfony\Component\DependencyInjection\Container */
	protected $container;

	/** @var wolfsblvt_mock_acpmagic */
	protected $acp_magic;

	/**
	 * {@inheritdoc}
	 */
	public function setUp()
	{
		parent::setUp();

		// Set up the module object
		$this->module = $this->getMockBuilder('\wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module')
			->setMethods(array('init')) // We don't want to use the official init method
			->getMock();

		$this->acp_magic = $this->getMockBuilder('\wolfsblvt\highlightunreadposts\tests\system\wolfsblvt_mock_acpmagic')
			->getMock();

		// We set acp_magic manually here. For the main method we don't want to use init()
		$this->reflector->setProperty($this->module, 'acp_magic', $this->acp_magic);

		// We need to overwrite global container object here :-/
		$GLOBALS['phpbb_container'] = $this->container = $this->getMockBuilder('\phpbb_mock_container_builder')
			->getMock();
	}

	/**
	 * Tests the initialization of acpmagic vendor extensio
	 */
	public function test_include_of_acpmagic()
	{
		// When testing init(), we need to have this active
		$this->module = $this->getMockBuilder('\wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module')
			->setMethods(null) // We need the init() method here
			->getMock();

		// Test if the container returns the correct acpmagic object
		$this->container->expects($this->once())
			->method('get')
			->with('wolfsblvt.acpmagic.controller')
			->willReturn($this->acp_magic);

		$this->module->init();

		$this->assertSame($this->acp_magic, $this->reflector->getProperty($this->module, 'acp_magic'));
	}

	/**
	 * Tests if function main() function exists
	 */
	public function test_main_function_exists()
	{
		// Test is function main() exists
		$this->assertTrue(
			method_exists($this->module, 'main'),
			'Class does not have method module()'
		);
	}

	/**
	 * Data set for assign_template_vars
	 *
	 * @return array<array<string,string|false>>
	 */
	public function test_acp_magic_call_data()
	{
		return array(
			array( // Should work
				1,
				'settings',
				true,
			),
			array( // Random id with existing mode
				1254,
				'settings',
				true,
			),
		);
	}

	/**
	 * Tests the constants for minimum version with the ones specified in the composer.json,
	 * they have to be the same.
	 *
	 * @param int $id The ID of this module
	 * @param string $mode Current Mode
	 *
	 * @dataProvider test_acp_magic_call_data
	 */
	public function test_acp_magic_call($id, $mode)
	{
		// TODO: Validate display_vars (in new test function please)
		// ......

		// Assert correct method call
		$this->acp_magic->expects($this->once())
			->method('do_magic')
			->with(
				self::identicalTo($this->module),
				self::equalTo($id),
				self::equalTo($mode),
				self::isType('array')
			)
			->willReturn($this->any());

		// Our method call
		$this->module->main($id, $mode);
	}
}

// TODO: Workaround, until official object exists.
class wolfsblvt_mock_acpmagic
{
	public function do_magic($_this, $id, $mode, $display_vars)
	{
		// This is just a mock. We don't do anything here
	}
}
