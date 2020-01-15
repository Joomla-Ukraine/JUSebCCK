<?php
/**
 * @package        JUSebCCK\Joomla
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Joomla;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Nested;

class Menu
{
	/**
	 * @param       $config
	 * @param       $fields
	 * @param       $field
	 * @param array $attr
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function addMenuItem($config, $fields, $field, array $attr = [])
	{
		$item = $fields[ $field ]->value;
		if($item == 0)
		{
			$data = [
				'menutype'          => $attr[ 'menutype' ],
				'title'             => $attr[ 'title' ],
				'alias'             => $attr[ 'alias' ] ? $attr[ 'alias' ] : '',
				'link'              => $attr[ 'link' ],
				'type'              => 'component',
				'published'         => $attr[ 'published' ],
				'parent_id'         => $attr[ 'parent_id' ],
				'level'             => $attr[ 'level' ],
				'component_id'      => $attr[ 'component_id' ],
				'access'            => 1,
				'template_style_id' => 0,
				'params'            => '{"show_list_title":"","tag_list_title":"h1","class_list_title":"","display_list_title":"0","title_list_title":"","show_list_desc":"","list_desc":"","tag_list_desc":"div","show_form":"","show_list":"","auto_redirect":"","auto_redirect_vars":"","limit2":"0","pagination2":"","ordering":"","order_by":"","ordering2":"","show_items_number":"","show_items_number_label":"Results","class_items_number":"total","show_pages_number":"","show_pagination":"","class_pagination":"pagination","live":"' . $attr[ 'cat_id' ] . '","variation":"","search2":"","limit":"0","raw_rendering":"1","sef":"","display_form_title":"","title_form_title":"","urlvars":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_image_css":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}',
				'home'              => 0,
				'language'          => $attr[ 'lang' ],
				'client_id'         => 0
			];

			$table = Nested::getInstance('Menu');
			$table->setLocation($attr[ 'parent_id' ], 'last-child');

			if(!$table->save($data))
			{
				return false;
			}

			$db    = Factory::getDbo();
			$query = $db->getQuery(true);

			$query->select([ 'id' ]);
			$query->from('#__menu');
			$query->where($db->quoteName('menutype') . ' = ' . $db->quote($data[ 'menutype' ]));
			$query->where($db->quoteName('title') . ' = ' . $db->quote($data[ 'title' ]));

			if($data[ 'alias' ])
			{
				$query->where($db->quoteName('alias') . ' = ' . $db->quote($data[ 'alias' ]));
			}

			$query->where($db->quoteName('client_id') . ' = ' . $db->quote($data[ 'client_id' ]));
			$query->where($db->quoteName('link') . ' = ' . $db->quote($data[ 'link' ]));
			$query->where($db->quoteName('params') . ' LIKE ' . $db->quote('%' . $attr[ 'cat_id' ] . '%'));
			$query->where($db->quoteName('type') . ' = ' . $db->quote($data[ 'type' ]));
			$query->where($db->quoteName('parent_id') . ' = ' . $db->quote($data[ 'parent_id' ]));
			$query->where($db->quoteName('home') . ' = ' . $db->quote($data[ 'home' ]));

			$db->setQuery($query);

			if($result = $db->loadResult())
			{
				$object                                      = new stdClass();
				$object->id                                  = $config[ 'pk' ];
				$object->{$fields[ $field ]->storage_field} = $result;

				$db->updateObject($fields[ $field ]->storage_table, $object, 'id');
			}

			return true;
		}

		return false;
	}
}