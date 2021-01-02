<?php
/**
 * @package        JUSebCCK\Tmpl
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
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
	 * @param       $modpos
	 * @param array $data
	 *
	 * @return string
	 *
	 * @since 1.0
	 */
	public static function render($modpos, array $data = [])
	{
		$contents = '';

		if($modules = ModuleHelper::getModules($modpos))
		{
			$renderer = Factory::getDocument()->loadRenderer('module');

			foreach($modules as $mod)
			{
				$params = json_decode($mod->params);

				if($data[ 'title' ])
				{
					$mod->title = $data[ 'title' ];
				}

				$header_class = $params->header_class;
				if($data[ 'header_class' ])
				{
					$header_class = $data[ 'header_class' ];
				}

				$header_tag = $params->header_tag;
				if($data[ 'header_tag' ])
				{
					$header_tag = $data[ 'header_tag' ];
				}

				$module_tag = $params->module_tag;
				if($data[ 'module_tag' ])
				{
					$module_tag = $data[ 'module_tag' ];
				}

				$showtitle = $mod->showtitle;
				if($data[ 'showtitle' ] === false)
				{
					$showtitle = 0;
				}

				if($showtitle == 1)
				{
					$contents .= '<' . $header_tag . ($header_class ? ' class="' . $header_class . '"' : '') . '>' . $mod->title . '</' . $header_tag . '>';
					if($data[ 'link' ])
					{
						$contents .= '<' . $header_tag . ($header_class ? ' class="' . $header_class . '"' : '') . '><a href="' . $data[ 'link' ] . '">' . $mod->title . '</a></' . $header_tag . '>';
					}
				}

				if($data[ 'module_class' ])
				{
					$contents .= '<' . $module_tag . ' class="' . $data[ 'module_class' ] . '">';
					$contents .= $renderer->render($mod, [
						'style' => ($data[ 'style' ] ? $data[ 'style' ] : 'raw')
					]);
					$contents .= '</' . $module_tag . '>';
				}
				else
				{
					$contents .= $renderer->render($mod, [
						'style' => ($data[ 'style' ] ? $data[ 'style' ] : 'raw')
					]);
				}
			}
		}

		return $contents;
	}
}