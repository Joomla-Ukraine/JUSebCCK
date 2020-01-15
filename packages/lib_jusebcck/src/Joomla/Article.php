<?php
/**
 * @package        JUSebCCK\Joomla
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Joomla;

use Joomla\CMS\Factory;
use JUSebCCK\Utils\HTTP;

class Article
{
	/**
	 * @param $config
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function rating($config)
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);

		$id   = (int) $config[ 'pk' ];
		$rate = mt_rand(4, 5);

		$query->select([ '*' ]);
		$query->from('#__content_rating');
		$query->where($db->quoteName('content_id') . ' = ' . $db->quote($id));
		$db->setQuery($query);

		$rating = $db->loadObject();
		if(!$rating)
		{
			$rq      = $db->getQuery(true);
			$columns = [
				'content_id',
				'rating_sum',
				'rating_count',
				'lastip'
			];
			$values  = [
				$db->quote($id),
				$db->quote($rate),
				$db->quote('1'),
				$db->quote(HTTP::ip())
			];

			$rq->insert($db->quoteName('#__content_rating'))->columns($db->quoteName($columns))->values(implode(',', $values));
			$db->setQuery($rq);
			$db->execute();
		}

		return true;
	}
}