<?php
/**
 * @since          1.0
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @package        JUSebCCK\API
 */

defined('_JEXEC') or die;

class Pkg_JUSebCCKInstallerScript
{
	public function __construct()
	{

	}

	public function preflight($type, $parent)
	{

	}

	public function uninstall($parent)
	{

	}

	public function update($parent)
	{

	}

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

		foreach($files as $file)
		{
			if(file_exists($file))
			{
				unlink($file);
			}
		}

		foreach($folders as $folder)
		{
			if(is_dir($folder))
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
		if(!$dh = opendir($dir))
		{
			return;
		}

		while(false !== ($obj = readdir($dh)))
		{
			if($obj === '.' || $obj === '..')
			{
				continue;
			}

			if(!unlink($dir . '/' . $obj))
			{
				$this->unlinkRecursive($dir . '/' . $obj, true);
			}
		}

		closedir($dh);

		if($deleteRootToo)
		{
			rmdir($dir);
		}
	}
}