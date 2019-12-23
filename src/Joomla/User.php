<?php
/**
 * @package        JUSebCCK\Joomla
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Joomla;

use Joomla\CMS\Factory;

/*
 * @ToDo: Add function for Users manipulation
 */

class User
{
	/**
	 * @param null $id
	 *
	 * @return int
	 *
	 * @since 1.0
	 */
	public static function id($id = null)
	{
		return Factory::getUser($id)->id;
	}
}