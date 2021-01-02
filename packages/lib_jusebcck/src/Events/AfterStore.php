<?php
/**
 * @package        JUSebCCK\Events
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Events;

use JUSebCCK\Joomla\Article;
use JUSebCCK\Joomla\Menu;

class AfterStore
{
	/**
	 * @param       $config
	 * @param       $fields
	 * @param       $field
	 * @param array $attr
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function addMenuItem($config, $fields, $field, array $attr = [])
	{
		return Menu::addMenuItem($config, $fields, $field, $attr);
	}

	/**
	 * @param $config
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function rating($config)
	{
		return Article::rating($config);
	}
}