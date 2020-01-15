<?php
/**
 * @package        JUSebCCK
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2016-2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @package  JUSebCCK
 *
 * @since    1.0
 */
class JUSebCCKInstallerScript
{
	/**
	 * @param $type
	 * @param $parent
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function preflight($type, $parent)
	{

	}

	/**
	 * @param $parent
	 *
	 *
	 * @since    1.0
	 */
	public function uninstall($parent)
	{

	}

	/**
	 * @param $parent
	 *
	 *
	 * @since    1.0
	 */
	public function update($parent)
	{

	}

	/**
	 * @return bool
	 *
	 * @since    1.0
	 */
	public function postflight()
	{
		$path = JPATH_SITE . '/libraries/jusebcck/';

		$files = [
			$path . 'index.html'
		];

		$folders = [
			$path . 'classes',
			$path . 'vendor'
		];

		foreach( $files AS $file )
		{
			if( file_exists($file) )
			{
				unlink($file);
			}
		}

		foreach( $folders AS $folder )
		{
			if( is_dir($folder) )
			{
				$this->unlinkRecursive($folder, 1);
			}
		}

		return true;
	}

	/**
	 * @param $dir
	 * @param $deleteRootToo
	 *
	 * @since    1.0
	 */
	public function unlinkRecursive($dir, $deleteRootToo)
	{
		if( !$dh = @opendir($dir) )
		{
			return;
		}

		while( false !== ($obj = readdir($dh)) )
		{
			if( $obj === '.' || $obj === '..' )
			{
				continue;
			}

			if( !@unlink($dir . '/' . $obj) )
			{
				$this->unlinkRecursive($dir . '/' . $obj, true);
			}
		}

		closedir($dh);

		if( $deleteRootToo )
		{
			@rmdir($dir);
		}
	}
}