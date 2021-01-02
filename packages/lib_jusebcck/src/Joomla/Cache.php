<?php
/**
 * @package        JUSebCCK\Joomla
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Joomla;

use JUSebCCK\Utils\Folder;

class Cache
{
	/**
	 * @param bool $all
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function clear($all = true)
	{
		if(is_dir(JPATH_ROOT . '/cache/'))
		{
			if($all === false)
			{
				if(is_dir(JPATH_ROOT . '/cache/com_modules/'))
				{
					Folder::remove(JPATH_ROOT . '/cache/com_modules/', true);
				}

				Folder::remove(JPATH_ROOT . '/cache/com_cck**', true);

				if(is_dir(JPATH_ROOT . '/cache/com_cck/'))
				{
					Folder::remove(JPATH_ROOT . '/cache/com_cck/', true);
				}

				if(is_dir(JPATH_ROOT . '/cache/com_home/'))
				{
					Folder::remove(JPATH_ROOT . '/cache/com_home/', true);
				}
			}
			else
			{
				Folder::remove(JPATH_ROOT . '/cache/');
			}

			return true;
		}

		return false;
	}
}