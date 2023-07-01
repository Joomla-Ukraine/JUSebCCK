<?php
/**
 * @since          1.0
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @package        JUSebCCK\Joomla
 */

namespace JUSebCCK\Joomla;

use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;
use JUSebCCK\Translate\Google;

class Alias
{
	/**
	 * @param       $lang
	 * @param       $field
	 * @param       $cck
	 * @param false $translate
	 * @param null  $from
	 * @param null  $to
	 *
	 * @return string
	 * @throws \ErrorException
	 * @since 1.0
	 */
	public static function uniq($lang, $field, $cck, $translate = false, $from = null, $to = null)
	{
		if($translate === true)
		{
			$field = Google::get($from, $to, trim($field));
		}

		$alias = OutputFilter::stringURLSafe(trim($field));

		$db    = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select([ 'cck', 'alias_' . $lang ]);
		$query->from('#__cck_store_item_content');
		$query->where($db->quoteName('alias_' . $lang) . '=' . $db->Quote($alias));
		$query->where($db->quoteName('cck') . '=' . $db->Quote($cck));
		$db->setQuery($query);
		$db->execute();

		return $alias . ($db->getNumRows() == 0 ? '' : '-' . ($db->getNumRows() + 1));
	}
}