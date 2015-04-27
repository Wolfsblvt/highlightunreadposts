<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts;

class ext extends \phpbb\extension\base
{
	/** @var string Require phpBB 3.1.2 due to the use of new includecss syntax */
	const PHPBB_MIN_VERSION = '3.1.2';

	/** @var string Require PHP 5.3.3 */
	const PHP_MIN_VERSION = '5.3.3';

	/**
	 * Check whether or not the extension can be enabled.
	 * The current phpBB version should meet or exceed
	 * the minimum version required by this extension:
	 *
	 * @return bool
	 * @access public
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], self::PHPBB_MIN_VERSION, '>=')
			&& phpbb_version_compare(PHP_VERSION, self::PHP_MIN_VERSION, '>=');
	}
}
