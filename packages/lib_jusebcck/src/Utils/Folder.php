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