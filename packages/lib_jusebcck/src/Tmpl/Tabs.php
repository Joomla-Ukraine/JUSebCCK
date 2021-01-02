<?php
/**
 * @package        JUSebCCK\Tmpl
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Tmpl;

use Joomla\CMS\Helper\ModuleHelper;

class Tabs
{
	public static function module($position, array $class = [])
	{
		if($mods = ModuleHelper::getModules($position))
		{
			$mod_tab = [];
			foreach($mods as $mod)
			{
				$mod_tab[] = [
					'panel'   => $mod->title,
					'title'   => $mod->title,
					'content' => ModuleHelper::renderModule($mod)
				];
			}

			return self::render($mod_tab, $class);
		}

		return false;
	}

	/**
	 * @param array $datum
	 * @param array $class
	 *
	 * @return string
	 *
	 * @since 1.0
	 */
	public static function render(array $datum = [], array $class = [])
	{
		$id   = uniqid('', false);
		$html = '<div id="tab' . $id . '"' . (isset($class[ 'container' ]) ? ' class="' . $class[ 'container' ] . '"' : '') . '>';
		$html .= '<ul' . (isset($class[ 'tab' ]) ? ' class="' . $class[ 'tab' ] . '"' : '') . ' uk-tab role="tablist" aria-controls="tab' . $id . '">';

		$i = 1;
		foreach($datum as $data)
		{
			$title = $data[ 'title' ];
			$panel = 'panel' . hash('crc32b', $title);
			$icon  = '';

			if(isset($data[ 'panel' ]))
			{
				$panel = 'panel' . hash('crc32b', $data[ 'panel' ]);
			}

			if(isset($data[ 'icon' ]))
			{
				$icon  = '<span uk-icon="icon: ' . $data[ 'icon' ] . '; rstio: .9" aria-hidden="true"></span>';
				$title = '<span class="uk-text-middle uk-margin-small-left">' . $data[ 'title' ] . '</span>';
			}

			$html .= '<li role="presentation"><a id="tab' . $id . '_' . $i . '" href="#' . $panel . '"' . (isset($class[ 'tab-item' ]) ? ' class="' . $class[ 'tab-item' ] . '"' : '') . ' tabindex="' . ($i == 1 ? '0' : '-1') . '" role="tab" aria-controls="' . $panel . '" aria-selected="' . ($i == 1 ? 'false' : 'true') . '">' . $icon . $title . '</a>	</li>';

			$i++;
		}

		$html .= '</ul>';
		$html .= '<ul id="tabpanel' . $id . '"' . (isset($class[ 'panel' ]) ? ' class="' . $class[ 'panel' ] . '"' : '') . ' aria-live="polite">';

		$i = 1;
		foreach($datum as $data)
		{
			$title = $data[ 'title' ];
			$panel = 'panel' . hash('crc32b', $title);

			if(isset($data[ 'panel' ]))
			{
				$panel = 'panel' . hash('crc32b', $data[ 'panel' ]);
			}

			if(is_array($data[ 'content' ]) && count($data[ 'content' ]) > 0)
			{
				if($mods = ModuleHelper::getModules($data[ 'content' ][ 'position' ]))
				{
					foreach($mods as $mod)
					{
						$content = ModuleHelper::renderModule($mod, [ 'style' => $data[ 'content' ][ 'style' ] ]);
					}
				}
			}
			else
			{
				$content = $data[ 'content' ];
			}

			if($class[ 'content' ])
			{
				$content = '<div class="' . $class[ 'content' ] . '">' . $content . '</div>';
			}

			$html .= '<li id="' . $panel . '" role="tabpanel" aria-labelledby="tab' . $id . '" aria-hidden="' . ($i == 1 ? 'false' : 'true') . '" tabindex="' . ($i == 1 ? '0' : '-1') . '">' . $content . '</li>';

			$i++;
		}

		$html .= '</ul>';
		$html .= '</div>';

		return $html;
	}
}