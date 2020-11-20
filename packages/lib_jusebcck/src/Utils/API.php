<?php
/**
 * @package        JUSebCCK\Utils
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Utils;

class API
{
	/**
	 * @param       $url
	 * @param array $data
	 *
	 * @return array
	 *
	 * @since 1.0
	 */
	public static function get($url, array $data = [])
	{
		$resource = self::getAPI($url, $data);

		return self::getJSON($resource);
	}

	/**
	 * @param       $url
	 * @param array $data
	 *
	 * @return string
	 *
	 * @since 1.0
	 */
	private static function getAPI($url, array $data = [])
	{
		if(is_array($data) && !empty($data))
		{
			foreach($data as $param => $paramValue)
			{
				if(is_array($param[ 'address' ]))
				{
					$paramValue = implode(', ', $paramValue);
				}

				$url .= '&' . $param . '=' . urlencode($paramValue);
			}

			return $url;
		}

		return $url;
	}

	/**
	 * @param $url
	 *
	 * @return array
	 *
	 * @since 1.0
	 */
	private static function getJSON($url)
	{
		return get_object_vars(json_decode(@file_get_contents($url)));
	}
}