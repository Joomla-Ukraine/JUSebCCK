<?php
/**
 * @package        JUSebCCK\Utils
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Utils;

use Joomla\CMS\Factory;

class Schema
{
	/**
	 * @param array $data
	 *
	 * @return
	 *
	 * @since 1.0
	 */
	public static function insert(array $data = [])
	{
		$json = self::ldjson($data);

		return Factory::getDocument()->addCustomTag($json);
	}

	/**
	 * @param $json
	 *
	 * @return string
	 *
	 * @since 1.0
	 */
	private static function ldjson($json)
	{
		return '<script type="application/ld+json">' . json_encode(array_filter($json)) . '</script>';
	}
}