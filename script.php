<?php
/**
 * JURSSPublisher - Joomla RSS/XML Export System
 *
 * @version       4.x
 * @package       JURSSPublisher
 * @author        Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C) 2006-2018 by Denys D. Nosov (https://joomla-ua.org)
 * @license       license.txt
 *
 **/

defined('_JEXEC') or die;

require_once JPATH_SITE . '/libraries/evoapp/vendor/autoload.php';

use Joomla\Archive\Archive;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Version;

error_reporting(0);

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.archive');
jimport('joomla.filesystem.path');
jimport('joomla.error.error');

class Pkg_JUSebCCKInstallerScript
{
	protected $message;
	protected $status;
	protected $sourcePath;
	protected $dbSupport = [
		'mysql',
		'mysqli',
		'postgresql',
		'sqlsrv',
		'sqlazure'
	];

	/**
	 * Pkg_JURSSPublisherInstallerScript constructor.
	 * @throws \Exception
	 */
	public function __construct()
	{
		$this->app = Factory::getApplication();
		$this->db  = Factory::getDbo();
	}

	/**
	 * @param $type
	 * @param $parent
	 *
	 * @return bool
	 *
	 * @throws \Exception
	 * @since 3.0
	 */
	public function preflight($type, $parent)
	{
		if(version_compare(PHP_VERSION, '5.5', '<'))
		{
			$this->app->enqueueMessage(Text::_('PKG_JURSSPUBLISHER_ERROR_INSTALL_PHPVERSION'), 'error');

			return false;
		}

		if(version_compare(JVERSION, '3.8.0', '<'))
		{
			$this->app->enqueueMessage(Text::_('PKG_JURSSPUBLISHER_ERROR_INSTALL_J31'), 'error');

			return false;
		}

		return true;
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

		foreach($files AS $file)
		{
			if(file_exists($file))
			{
				unlink($file);
			}
		}

		foreach($folders AS $folder)
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
		if(!$dh = @opendir($dir))
		{
			return;
		}

		while(false !== ($obj = readdir($dh)))
		{
			if($obj === '.' || $obj === '..')
			{
				continue;
			}

			if(!@unlink($dir . '/' . $obj))
			{
				$this->unlinkRecursive($dir . '/' . $obj, true);
			}
		}

		closedir($dh);

		if($deleteRootToo)
		{
			@rmdir($dir);
		}
	}
}