<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\acp;

class highlightunreadposts_module
{
	/** @var string name of template */
	public $tpl_name;

	/** @var string page title */
	public $page_title;

	/** @var \wolfsblvt\acpmagic\acp_magic_controller */
	public $acp_magic;

	/**
	 * Initialize needed service objects from container
	 * (This is cause dependency injection is not working in modules)
	 */
	public function init()
	{
		/**
		 * @ignore We still need the global here, otherwise we can't get Dependency Injection objects
		 */
		global $phpbb_container;

		$this->acp_magic = $phpbb_container->get('wolfsblvt.acpmagic.controller');
	}

	/**
	 * Main function when module is executed
	 * @param int $id The ID of this module
	 * @param string $mode Current Mode
	 */
	public function main($id, $mode)
	{
		$this->init();

		$display_vars = array(
			'settings' => array(
				'title' => 'HUP_TITLE_ACP',
				'vars'	=> array(
					'legend1'										=> 'HUP_SETTINGS',
					'wolfsblvt.highlightunreadposts.color'			=> array('lang' => 'HUP_COLOR',		'validate' => 'color',		'type' => 'text:7:15',		'explain' => true),
					'legend2'										=> 'ACP_SUBMIT_CHANGES'
				),
			),
		);

		// Do magic here
		$this->acp_magic->do_magic($this, $id, $mode, $display_vars);
	}
}
