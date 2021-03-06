<?php

/**
*
* @package phpBB Extension - Medals
* @copyright (c) 2016 Gabriel
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
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
// Some characters you may want to copy&paste:
// ’ » “ ” …
$lang = array_merge($lang, array(
		'ACP_MDLS'				=> 'Medals',
		'ACP_MDLS_SAVED'		=> 'User\'s Medals have been saved',
		'ACP_EDIT_MEDALS'		=> 'Manage user\'s medals',
		'ACP_EDIT_USER_MEDAL'	=> 'Manage %s\'s medals', // %s will be username
		'ACP_SELECT_USER'		=> 'Select a user',
		'ACP_CHANGE_MEDALS'		=> 'Change Medals',

		'ACP_NO_MEDAL'		=> 'No medals assigned',
		'ACP_MEDAL_ONE'		=> 'Medal one',
		'ACP_MEDAL_TWO'		=> 'Medal two',
		'ACP_MEDAL_THREE'	=> 'Medal three',
		'ACP_MEDAL_FOUR'	=> 'Medal four',
		'ACP_MEDAL_FIVE'	=> 'Medal five',
		'ACP_MEDAL_SIX'		=> 'Medal six',
		'ACP_MEDAL_SEVEN'	=> 'Medal seven',
		'ACP_MEDAL_EIGHT'	=> 'Medal eight',
		'ACP_MEDAL_NINE'	=> 'Medal nine',
		'ACP_MEDAL_TEN'		=> 'Medal ten',
));
