<?php
/**
 * @since          1.0
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @package        JUSebCCK\Joomla
 */

namespace JUSebCCK\Joomla;

use Joomla\CMS\Factory;

class DB
{
	/**
	 *
	 * @param        $table
	 * @param int    $type
	 * @param array  $select
	 * @param array  $where
	 *
	 * @param string $operator
	 *
	 * @return false|object
	 *
	 * @since 1.0
	 */
	public static function selectDB($table, int $type = 1, array $select = [ '*' ], array $where = [], string $operator = '=')
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($select);
		$query->from($table);

		foreach($where as $key => $value)
		{
			if($operator === 'IN')
			{
				$query->where($db->quoteName($key) . $operator . $value);
			}
			else
			{
				$query->where($db->quoteName($key) . $operator . $db->Quote($value));
			}
		}

		$db->setQuery($query);
		$db->execute();

		if($type == 2)
		{
			return (object) $db->loadObject();
		}

		if($type == 1)
		{
			return (object) $db->loadObjectList();
		}

		return false;
	}

	/**
	 * @param        $table
	 * @param array  $where
	 * @param string $operator
	 *
	 * @return int
	 *
	 * @since 1.0
	 */
	public static function check($table, array $where = [], $operator = '='): int
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select([ '*' ]);
		$query->from($db->quoteName($table));

		foreach($where as $key => $value)
		{
			$query->where($db->quoteName($key) . $operator . $db->Quote($value));
		}

		$db->setQuery($query);
		$db->execute();

		return $db->getNumRows();
	}
}