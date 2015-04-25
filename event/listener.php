<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	protected $table_online_time;
	protected $table_online_time_days;

	/**
	 * Constructor of event listener
	 *
	 * @param \phpbb\config\config					$config			Config
	 * @param \phpbb\path_helper					$path_helper	phpBB path helper
	 * @param \phpbb\template\template				$template		Template object
	 * @param \phpbb\user							$user			User object
	 * @param string								$php_ext		phpEx
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->config = $config;
		$this->template = $template;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'				=> 'assign_template_vars',
			'core.adm_page_header'			=> 'assign_template_vars',
		);
	}

	/**
	 * Assigns template vars
	 *
	 * @param object $event The event object
	 * @return void
	 */
	public function assign_template_vars()
	{
		$color = ($this->config['wolfsblvt.highlightunreadposts.color'] != '#669933') ? $this->config['wolfsblvt.highlightunreadposts.color'] : false;

		$this->template->assign_vars(array(
			'HUP_COLOR'			=> $color,
		));
	}
}
