<?php
/**
 * @package        JUSebCCK\Utils
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Utils;

class Image
{
	/**
	 * @param $data
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function check($data): bool
	{
		$regex = '/{gallery\s+(.*?)}/i';

		if(preg_match($regex, $data))
		{
			return true;
		}

		return false;
	}

	/**
	 * @param $html
	 * @param $folder
	 *
	 * @return bool|string|string[]
	 *
	 * @since 1.0
	 */
	public static function gallery($html, $folder)
	{
		$regex = "/{gallery\s+(.*?)}/i";
		preg_match_all($regex, $html, $matches, PREG_SET_ORDER);

		if(is_array($matches) && count($matches))
		{
			$folder = $matches[ 0 ][ 1 ];
		}

		$root       = JPATH_ROOT . '/';
		$img_folder = $root . $folder;

		if(is_dir($img_folder))
		{
			$images = glob($img_folder . '/{*.[jJ][pP][gG],*.[jJ][pP][eE][gG],*.[gG][iI][fF],*.[pP][nN][gG],*.[bB][mM][pP],*.[tT][iI][fF],*.[tT][iI][fF][fF]}', GLOB_BRACE);

			return str_replace($root, '', $images);
		}

		return false;
	}

	/**
	 * @param $config
	 * @param $fields
	 * @param $field_img
	 * @param $field_folder
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function galleryImage($config, $fields, $field_img, $field_folder): bool
	{
		if($fields[ $field_img ]->value == '')
		{
			$image = self::gallery($fields[ $field_img ]->value, $fields[ $field_folder ]->value);

			Data::bind($image[ 0 ], $field_img, $config, $fields);

			return true;
		}

		return false;
	}

	/**
	 * @param $config
	 * @param $fields
	 * @param $field
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function checkGallery($config, $fields, $field): bool
	{
		$check = self::check($fields[ $field ]->value);

		Data::bind($check, $field, $config, $fields);

		return true;
	}
}