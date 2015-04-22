<?php
/**
 * 
 * Highlight Unread Posts
 * 
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\migrations;

class v1_0_1_data_module extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return array('\wolfsblvt\highlightunreadposts\migrations\v1_0_1_configs');
	}
	
	public function update_data()
	{
		return array(
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'HUP_TITLE_ACP'
			)),
			array('module.add', array(
				'acp',
				'HUP_TITLE_ACP',
				array(
					'module_basename'	=> '\wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}

	public function revert_data()
	{
		return array(
			array('module.remove', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'HUP_TITLE_ACP'
			)),
			array('module.remove', array(
				'acp',
				'HUP_TITLE_ACP',
				array(
					'module_basename'	=> '\wolfsblvt\highlightunreadposts\acp\highlightunreadposts_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
