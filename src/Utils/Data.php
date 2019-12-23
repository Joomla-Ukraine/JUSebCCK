<?php
/**
 * @package        JUSebCCK\Utils
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Utils;

class Data
{
	/**
	 * @param $result
	 * @param $field
	 * @param $config
	 * @param $fields
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function bind($result, $field, $config, $fields)
	{
		$name                                    = $fields[ $field ]->storage_field;
		$table                                   = $fields[ $field ]->storage_table;
		$config[ 'storages' ][ $table ][ $name ] = $result;

		return true;
	}
}