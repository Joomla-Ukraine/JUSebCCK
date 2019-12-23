<?php
/**
 * @package        JUSebCCK\API
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\API;

use OpenCage;

class Geocode
{
	/**
	 * @param        $address
	 * @param string $lang
	 * @param string $api
	 *
	 * @return mixed
	 *
	 * @throws \Exception
	 * @since 1.0
	 */
	public static function OpenCage($address, $lang = 'en', $api = '')
	{
		if(is_array($address))
		{
			$address = implode(', ', $address);
		}

		$geocoder = new OpenCage\Geocoder\Geocoder($api);

		return $geocoder->geocode($address, [
			'language' => $lang
		]);
	}
}