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

class Location
{
	/**
	 * @param        $address
	 * @param string $lang
	 * @param string $api
	 *
	 * @return object
	 *
	 * @since 1.0
	 */
	public static function Google($address, $lang = 'en', $api = '')
	{
		if(is_array($address))
		{
			$address = implode(', ', $address);
		}

		$api_key = '&sensor=false';
		if($api)
		{
			$api_key = '&key=' . $api;
		}

		$url     = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&language=' . $lang . $api_key;
		$lat_lng = get_object_vars(json_decode(@file_get_contents($url)));
		$results = $lat_lng[ 'results' ][ 0 ]->geometry->location;

		return (object) [
			'lat' => $results->lat,
			'lng' => $results->lng
		];
	}

	/**
	 * @param        $address
	 * @param string $api
	 * @param string $lang
	 *
	 * @return object
	 *
	 * @since 1.0
	 */
	public static function OpenCage($address, $lang = 'en', $api = '')
	{
		if(is_array($address))
		{
			$address = implode(', ', $address);
		}

		$url     = 'https://api.opencagedata.com/geocode/v1/json?q=' . urlencode($address) . '&key=' . $api . '&language=' . $lang . '&pretty=1&no_annotations=1';
		$lat_lng = get_object_vars(json_decode(@file_get_contents($url)));
		$results = $lat_lng[ 'results' ][ 0 ]->geometry;

		return (object) [
			'lat' => $results->lat,
			'lng' => $results->lng
		];
	}

	/**
	 * @param        $address
	 * @param string $lang
	 * @param string $api
	 *
	 * @return object
	 *
	 * @since 1.0
	 */
	public static function MapQuest($address, $lang = 'en', $api = '')
	{
		if(is_array($address))
		{
			$address = implode(', ', $address);
		}

		$url     = 'https://www.mapquestapi.com/geocoding/v1/address?key=' . $api . '&location=' . urlencode($address) . '&lang=' . $lang;
		$lat_lng = get_object_vars(json_decode(@file_get_contents($url)));
		$results = $lat_lng[ 'results' ][ 0 ]->locations[ 0 ]->latLng;

		return (object) [
			'lat' => $results->lat,
			'lng' => $results->lng
		];
	}
}