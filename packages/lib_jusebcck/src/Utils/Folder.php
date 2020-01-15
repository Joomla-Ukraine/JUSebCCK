<?php
/**
 * @package     JUSebCCK\Utils
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
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
	public static function create($dir, $mode = 0777)
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
	public static function remove($dir, $deleteRootToo = false)
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