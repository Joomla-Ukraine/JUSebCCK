<?php
/**
 * @package        JUSebCCK\API
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\API;

use OpenCage;

class Geocode
{
	/**
	 * @param array $data
	 *
	 * @return mixed
	 *
	 * @throws \Exception
	 * @since 1.0
	 */
	public static function OpenCage(array $data = [])
	{
		if(empty($data[ 'address' ]) || empty($data[ 'api' ]))
		{
			return false;
		}

		$address = $data[ 'address' ];

		$options = [
			'language' => 'en'
		];

		if($data[ 'options' ])
		{
			$options = $data[ 'options' ];
		}

		if(is_array($address))
		{
			$address = implode(', ', $address);
		}

		$geocoder = new OpenCage\Geocoder\Geocoder($data[ 'api' ]);
		$results  = $geocoder->geocode($address, $options)[ 'results' ];

		if($type = $data[ 'type' ])
		{
			$data = [];
			if(count($type) > 0)
			{
				foreach($results as $result)
				{
					if(in_array($result[ 'components' ][ '_type' ], $type))
					{
						$data[] = $result;
					}
				}
			}

			$results = $data;
		}

		return $results;
	}
}