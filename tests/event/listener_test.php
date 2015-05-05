<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\tests\event;

class listener_test extends \wolfsblvt\highlightunreadposts\tests\testframework\test_case
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \wolfsblvt\highlightunreadposts\event\listener */
	protected $listener;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $template;

	/**
	 * {@inheritdoc}
	 */
	public function setUp()
	{
		parent::setUp();

		$this->config = new \phpbb\config\config(array());

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		// Create our event listener
		$this->listener = new \wolfsblvt\highlightunreadposts\event\listener(
			$this->config,
			$this->template
		);
	}

	/**
	 * Test the event listener is constructed correctly
	 */
	public function test_construct()
	{
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

	/**
	 * Test the event listener is subscribing events
	 */
	public function test_getSubscribedEvents()
	{
		$subscribed_events = array_keys(\wolfsblvt\highlightunreadposts\event\listener::getSubscribedEvents());

		// Test if events are ordered alphabetically
		$sorted_events = $subscribed_events;
		sort($sorted_events);
		$this->assertEquals($sorted_events, $subscribed_events, 'Events should be ordered alphabetically');

		// Test if all events are subscribed
		$this->assertEquals(array(
			'core.adm_page_header',
			'core.page_header',
		), $subscribed_events);
	}

	/**
	 * Data set for assign_template_vars
	 *
	 * @return array<array<string,string|false>>
	 */
	public function assign_template_vars_data()
	{
		return array(
			array( // Default value
				'#669933',
				false,
			),
			array( // Uppercase color with letters
				'#FFFFFF',
				'#FFFFFF',
			),
			array( // Lowercase color
				'#551a8b',
				'#551a8b',
			),
			array( // Shorthand notation color
				'#333',
				'#333',
			),
			array( // Invalid color has to be checked in ACP. So we should get the same string back here
				'blah',
				'blah',
			),
		);
	}

	/**
	 * Test test_assign_template_vars() is testing different possible config vars
	 * and pushing them to the template.
	 *
	 * @param string $color
	 * @param string|false $expected
	 *
	 * @dataProvider assign_template_vars_data
	 */
	public function test_assign_template_vars($color, $expected)
	{
		// Write our color in the config
		$this->config['wolfsblvt.highlightunreadposts.color'] = $color;

		// Get the first array key name (cat_row or forum_row)
		$this->template->expects($this->once())
			->method('assign_vars')
			->with(array(
				'HUP_COLOR'			=> $expected,
			));

		// Call the method
		$this->listener->assign_template_vars();
	}
}
