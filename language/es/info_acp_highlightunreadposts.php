<?php
/**
 *
 * Highlight Unread Posts [Spanish]
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
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
	'HUP_TITLE_ACP'					=> 'Resaltado de mensajes no leídos',
	'HUP_SETTINGS_ACP'				=> 'Ajustes',

	'HUP_TITLE'						=> 'Resalte Mensajes no leídos',
	'HUP_TITLE_EXPLAIN'				=> 'Resalta todos los mensajes no leídos en un tema. El color puede ser elegido libremente.',
	'HUP_COPYRIGHT'					=> '© 2015 Wolfsblvt (www.pinkes-forum.de) [<a href="http://pinkes-forum.de/dev/find.php">Más Extensiones de Wolfsblvt</a>]',

	'HUP_SETTINGS'					=> 'Ajustes del resaltado de mensajes no leídos',

	'HUP_COLOR'						=> 'Color del resaltado',
	'HUP_COLOR_EXPLAIN'				=> 'Establece el color de resaltado. Si se establece como predeterminado, el color definido en la hoja de estilo de su estilo estará cargado. (Por defecto: #669933)',
));
