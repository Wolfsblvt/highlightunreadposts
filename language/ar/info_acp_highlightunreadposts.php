<?php
/**
 * 
 * Highlight Unread Posts [Arabic]
 * 
 * Translated By : Bassel Taha Alhitary - www.alhitary.net
 *
 * @copyright (c) 2014 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'HUP_TITLE_ACP'					=> 'تلوين المشاركات الغير مقروءه',
	'HUP_SETTINGS_ACP'				=> 'الإعدادات',
	
	'HUP_TITLE'						=> 'تلوين المشاركات الغير مقروءه ',
	'HUP_TITLE_EXPLAIN'				=> 'تلوين المشاركات الغير مقروءه في الموضوع. يمكن تحديد اللون بكل سهولة.',
	'HUP_COPYRIGHT'					=> 'المبرمج : © 2014 Wolfsblvt (www.pinkes-forum.de) [<a href="http://pinkes-forum.de/dev/find.php">إضافات آخرى</a>]',
	
	'HUP_SETTINGS'					=> 'إعدادات تلوين المشاركات الغير مقروءه',
	
	'HUP_COLOR'						=> 'اللون ',
	'HUP_COLOR_EXPLAIN'				=> 'تستطيع من هنا تحديد اللون المناسب. إذا تم الضبط إلى الإفتراضي , فسيتم إعتماد اللون المُعرف في ملفات الإستايل لديك . ( اللون الإفتراضي : #669933 )',
));
