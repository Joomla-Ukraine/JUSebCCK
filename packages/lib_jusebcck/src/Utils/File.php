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

class File
{
	/**
	 * @param $url
	 * @param $saveto
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function save($url, $saveto)
	{
		if(is_writable(dirname($saveto)))
		{
			@file_put_contents($saveto, @file_get_contents($url));
		}
		else
		{
			exit('Failed to write to directory ' . $saveto);
		}

		return true;
	}

	/**
	 * @param $path
	 * @param $saveto
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function copy($path, $saveto)
	{
		if(is_writable(dirname($saveto)))
		{
			if(!copy($path, $saveto))
			{
				exit('Failed copy to directory ' . $saveto);
			}
		}
		else
		{
			exit('Failed to write to directory ' . $saveto);
		}

		return true;
	}
}