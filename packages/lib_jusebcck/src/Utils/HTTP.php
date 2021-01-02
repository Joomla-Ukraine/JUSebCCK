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

class HTTP
{
	/**
	 *
	 * @return string
	 *
	 * @since 1.0
	 */
	public static function ip()
	{
		if(!empty(getenv('HTTP_CLIENT_IP')))
		{
			$ipaddress = getenv('HTTP_CLIENT_IP');
		}
		elseif(!empty(getenv('HTTP_X_FORWARDED_FOR')))
		{
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif(!empty(getenv('HTTP_X_FORWARDED')))
		{
			$ipaddress = getenv('HTTP_X_FORWARDED');
		}
		elseif(!empty(getenv('HTTP_FORWARDED_FOR')))
		{
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		}
		elseif(!empty(getenv('HTTP_FORWARDED')))
		{
			$ipaddress = getenv('HTTP_FORWARDED');
		}
		elseif(!empty(getenv('REMOTE_ADDR')))
		{
			$ipaddress = getenv('REMOTE_ADDR');
		}
		else
		{
			$ipaddress = 'UNKNOWN';
		}
		$ips = explode(',', $ipaddress);

		return trim($ips[ 0 ]);
	}

	/**
	 * @param $url
	 *
	 * @return bool|string
	 *
	 * @since 1.0
	 */
	public static function http($url)
	{
		$header = get_headers($url);

		return substr($header[ 0 ], 9, 3);
	}

	/**
	 * @param $url
	 *
	 * @return mixed
	 *
	 * @since 1.0
	 */
	public static function cURL($url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		return curl_exec($ch);
	}
}