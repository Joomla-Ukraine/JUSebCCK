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

class Folder
{
	/**
	 * @param     $dir
	 * @param int $mode
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function create($dir, int $mode = 0777): bool
	{
		if(@mkdir($dir, $mode) || is_dir($dir))
		{
			return true;
		}

		if(!self::create(dirname($dir)))
		{
			return false;
		}

		return @mkdir($dir, $mode);
	}

	/**
	 * @param      $dir
	 * @param bool $deleteRootToo
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function remove($dir, bool $deleteRootToo = false): bool
	{
		$folders = glob($dir, GLOB_BRACE);

		foreach($folders as $folder)
		{
			if(!$dh = opendir($folder))
			{
				return false;
			}

			while(false !== ($obj = readdir($dh)))
			{
				if($obj === '.' || $obj === '..')
				{
					continue;
				}

				if(!unlink($folder . '/' . $obj))
				{
					self::remove($folder . '/' . $obj, true);
				}
			}

			closedir($dh);

			if($deleteRootToo === true)
			{
				rmdir($folder);
			}
		}

		return true;
	}
}