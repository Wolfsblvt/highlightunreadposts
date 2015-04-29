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

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';

class ext_test extends wolfsblvt_cur_ext\tests\testframework\test_case
{
	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $container;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $extension_finder;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $migrator;

	public function setUp()
	{
		parent::setUp();

		// Stub the container
		$this->container = $this->getMockBuilder('\Symfony\Component\DependencyInjection\ContainerInterface')
			->getMock();

		// Stub the ext finder and disable its constructor
		$this->extension_finder = $this->getMockBuilder('\phpbb\finder')
			->disableOriginalConstructor()
			->getMock();

		// Stub the migrator and disable its constructor
		$this->migrator = $this->getMockBuilder('\phpbb\db\migrator')
			->disableOriginalConstructor()
			->getMock();
	}

	/**
	 * Tests the constants for minimum version with the ones specified in the composer.json,
	 * they have to be the same.
	 */
	public function test_constants_to_composer()
	{
		// Get the composer.json data
		$json = json_decode(file_get_contents(dirname(__FILE__) . '/../../composer.json'), true);

		$phpbb_version = explode(',', $json['extra']['soft-require']['phpbb/phpbb']);
		$phpbb_version = $phpbb_version[0];
		$php_version = $json['require']['php'];

		$this->assertEquals($phpbb_version,
			'>=' . \wolfsblvt\highlightunreadposts\ext::PHPBB_MIN_VERSION);

		$this->assertEquals($php_version,
			'>=' . \wolfsblvt\highlightunreadposts\ext::PHP_MIN_VERSION);
	}

	/**
	 * Data set for is_enableable
	 *
	 * @return array<array<string,string,bool>>
	 */
	public function is_enableable_data()
	{
		// Array of requirement values we use to test
		$req = array(
			'phpbb'		=> array(
				'lower'		=> '3.1.1',
				'equal'		=> '3.1.2',
				'greater'	=> '3.1.3',
			),
			'php'		=> array(
				'lower'		=> '5.2',
				'equal'		=> '5.3.3',
				'greater'	=> '5.4',
			),
		);

		return array(
			// Both versions lower than requirement
			array($req['phpbb']['lower'], $req['php']['lower'], false),

			// One versions greater or equal than requirement, other lower
			array($req['phpbb']['greater'], $req['php']['lower'], false),
			array($req['phpbb']['lower'], $req['php']['greater'], false),

			// Both versions equal or greater
			array($req['phpbb']['equal'], $req['php']['equal'], true),
			array($req['phpbb']['equal'], $req['php']['greater'], true),
			array($req['phpbb']['greater'], $req['php']['equal'], true),
			array($req['phpbb']['greater'], $req['php']['greater'], true),
		);
	}

	/**
	 * Test the extension can only be enabled when the minimum
	 * phpBB version and PHP version requirement is satisfied.
	 *
	 * @param $version
	 * @param $expected
	 *
	 * @dataProvider is_enableable_data
	 */
	public function test_is_enableable($phpbb_version, $php_version, $expected)
	{
		// Instantiate config object and set config version
		$config = new \phpbb\config\config(array(
			'version' => $phpbb_version,
		));

		// Mocked container should return the config object
		// when encountering $this->container->get('config')
		$this->container->expects($this->any())
			->method('get')
			->with('config')
			->will($this->returnValue($config));

		/** @var \wolfsblvt\highlightunreadposts\ext */
		$ext_name = 'wolfsblvt/highlightunreadposts';
		$ext = new \wolfsblvt\highlightunreadposts\ext($this->container, $this->extension_finder, $this->migrator, $ext_name, '');

		// We need to replace the PHP version in that extension class
		$this->reflector->setProperty($ext, 'php_version', $php_version);

		$this->assertSame($expected, $ext->is_enableable());
	}
}
