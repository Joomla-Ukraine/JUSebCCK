<?php
/**
 * @package     JUSebCCK\Utils
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
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
}