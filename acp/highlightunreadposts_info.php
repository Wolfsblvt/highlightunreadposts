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

class highlightunreadposts_info
{
	function module()
	{
		return array(
			'filename'	=> '\wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module',
			'title'		=> 'HUP_TITLE_ACP',
			'modes'		=> array(
				'settings'	=> array('title' => 'HUP_SETTINGS_ACP', 'auth' => 'ext_wolfsblvt/highlightunreadposts && acl_a_board', 'cat' => array('HUP_TITLE_ACP')),
			),
		);
	}
}
