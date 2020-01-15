<?php
/**
 * @package        JUSebCCK\Tmpl
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          4.0
 */

namespace JUSebCCK\Tmpl;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

class Module
{
	/**
	 * @param      $modpos
	 * @param null $class_head
	 * @param null $links
	 * @param null $class
	 * @param null $title
	 *
	 * @return string
	 *
	 * @since 1.0
	 */
	public static function render($modpos, $class_head = null, $links = null, $class = null, $title = null)
	{
		$contents = '';
		$renderer = Factory::getDocument()->loadRenderer('module');

		if($modules = ModuleHelper::getModules($modpos))
		{
			foreach($modules as $mod)
			{
				if($title)
				{
					$mod->title = $title;
				}

				if($mod->showtitle)
				{
					if($links)
					{
						$contents .= '<h2' . ($class_head ? ' class="' . $class_head . '"' : '') . '><a href="' . $links . '">' . $mod->title . '</a></h2>';
					}
					else
					{
						$contents .= '<h2' . ($class_head ? ' class="' . $class_head . '"' : '') . '>' . $mod->title . '</h2>';
					}
				}

				if($class)
				{
					$contents .= '<div class="' . $class . '">';
					$contents .= $renderer->render($mod);
					$contents .= '</div>';
				}
				else
				{
					$contents .= $renderer->render($mod);
				}
			}
		}

		return $contents;
	}
}