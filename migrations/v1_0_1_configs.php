<?php
/**
 * 
 * Highlight Unread Posts
 * 
 * @copyright (c) 2014 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\migrations;

class v1_0_1_configs extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('wolfsblvt.highlightunreadposts.color',	'#669933')),
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('wolfsblvt.highlightunreadposts.color')),
		);
	}
}
