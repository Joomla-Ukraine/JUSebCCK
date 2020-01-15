<?php
/**
 * @package        JUSebCCK\API
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\API;

use JUSebCCK\Utils;

class Location
{
	/**
	 * @param array $data
	 *
	 * @return bool|object
	 *
	 * @since 1.0
	 */
	public static function Google(array $data = [])
	{
		if(empty($data[ 'address' ]) || empty($data[ 'api' ]))
		{
			return false;
		}

		$lat_lng = Utils\API::get('https://maps.googleapis.com/maps/api/geocode/json?', $data);
		$results = $lat_lng[ 'results' ][ 0 ]->geometry->location;

		return (object) [
			'lat' => $results->lat,
			'lng' => $results->lng
		];
	}

	/**
	 * @param array $data
	 *
	 * @return bool|object
	 *
	 * @since 1.0
	 */
	public static function OpenCage(array $data = [])
	{
		if(empty($data[ 'address' ]) || empty($data[ 'api' ]))
		{
			return false;
		}

		$lat_lng = Utils\API::get('https://api.opencagedata.com/geocode/v1/json?', $data);
		$results = $lat_lng[ 'results' ][ 0 ]->geometry;

		return (object) [
			'lat' => $results->lat,
			'lng' => $results->lng
		];
	}

	/**
	 * @param array $data
	 *
	 * @return bool|object
	 *
	 * @since 1.0
	 */
	public static function MapQuestOpenCage(array $data = [])
	{
		if(empty($data[ 'address' ]) || empty($data[ 'api' ]))
		{
			return false;
		}

		$lat_lng = Utils\API::get('https://www.mapquestapi.com/geocoding/v1/address?', $data);
		$results = $lat_lng[ 'results' ][ 0 ]->locations[ 0 ]->latLng;

		return (object) [
			'lat' => $results->lat,
			'lng' => $results->lng
		];
	}
}