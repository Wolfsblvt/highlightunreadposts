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

abstract class database_test_case extends \phpbb_database_test_case implements \wolfsblvt\highlightunreadposts\tests\test_data_collection
{
	/** @var \wolfsblvt\highlightunreadposts\tests\testframework\reflector_helper */
	public $reflector;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\db\tools */
	protected $db_tools;

	/**
	 * {@inheritdoc}
	 */
	protected static function setup_extensions()
	{
		return array(self::DATA_EXT_NAME);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setUp()
	{
		parent::setUp();

		// Set up our reflector helper
		$this->reflector = new reflector_helper();

		// Set up db stuff
		$this->db = $this->new_dbal();
		$this->db_tools = new \phpbb\db\tools($this->db);
	}
}
