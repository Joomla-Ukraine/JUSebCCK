<?php
/**
 * @since          1.0
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @package        JUSebCCK\Events
 */

namespace JUSebCCK\Events;

use Joomla\CMS\Factory;
use JUSebCCK\API\Location;
use JUSebCCK\Utils\Data;
use JUSebCCK\Utils\HTML;
use JUSebCCK\Utils\Image;
use JUSebCCK\Utils\Video;

class BeforeStore
{
	/**
	 * @param     $config
	 * @param     $fields
	 * @param     $field
	 * @param int $tags
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function typo($config, $fields, $field, int $tags = 1): bool
	{
		$result = HTML::typo($fields[ $field ]->value, $tags);

		return Data::bind($result, $field, $config, $fields);
	}

	/**
	 * @param     $config
	 * @param     $fields
	 * @param     $field
	 * @param     $class
	 * @param int $clean
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function table($config, $fields, $field, $class, int $clean = 1): bool
	{
		$result = HTML::table($fields[ $field ]->value, $class, $clean);

		return Data::bind($result, $field, $config, $fields);
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
	public static function userID($config, $fields, $field): bool
	{
		if($config[ 'isNew' ] == 1)
		{
			$user = Factory::getUser();

			Data::bind($user->id, $field, $config, $fields);
		}

		return true;
	}

	/**
	 * @param $config
	 * @param $fields
	 * @param $created
	 * @param $publish_up
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function bindDate($config, $fields, $created, $publish_up): bool
	{
		if($config[ 'isNew' ] == 1)
		{
			if($fields[ $created ]->value)
			{
				$date = $fields[ $created ]->value;
			}
			else
			{
				date_default_timezone_set('UTC');
				$date = date('Y-m-d H:i:s');
			}

			Data::bind($date, $publish_up, $config, $fields);
		}
		elseif($fields[ $created ]->value == '')
		{
			date_default_timezone_set('UTC');
			$datenow = date('Y-m-d H:i:s');

			Data::bind($datenow, $publish_up, $config, $fields);
			Data::bind($datenow, $created, $config, $fields);
		}

		return true;
	}

	/**
	 * @param       $config
	 * @param       $fields
	 * @param       $provider
	 * @param array $data
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function geoLocation($config, $fields, $provider, array $data = []): bool
	{
		$lat = $fields[ $data[ 'lat' ] ]->value;
		$lng = $fields[ $data[ 'lng' ] ]->value;

		if(!($lat || $lng))
		{
			$result = Location::{$provider}($data);

			Data::bind($result->lat, $data[ 'lat' ], $config, $fields);
			Data::bind($result->lng, $data[ 'lng' ], $config, $fields);
		}

		return true;
	}

	/**
	 * @param $config
	 * @param $fields
	 * @param $check_video
	 * @param $video_source
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function checkVideo($config, $fields, $check_video, $video_source): bool
	{
		Video::checkVideo($config, $fields, $check_video, $video_source);

		return true;
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
		Image::checkGallery($config, $fields, $field);

		return true;
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
		Image::galleryImage($config, $fields, $field_img, $field_folder);

		return true;
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
	public static function YouTubeLink($config, $fields, $field): bool
	{
		Video::YouTubeLink($config, $fields, $field);

		return true;
	}

	/**
	 * Fix YouTube URL for plugin YouTube
	 *
	 * @param $config
	 * @param $fields
	 * @param $field
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function YouTubeFixLink($config, $fields, $field): bool
	{
		Video::YouTubeFixLink($config, $fields, $field);

		return true;
	}

	/**
	 * @param $config
	 * @param $fields
	 * @param $field_img
	 * @param $youtube
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function YouTubeCover($config, $fields, $field_img, $youtube): bool
	{
		Video::YouTubeCover($config, $fields, $field_img, $youtube);

		return true;
	}

	/**
	 * @param $config
	 * @param $fields
	 * @param $field_img
	 * @param $youtube
	 * @param $path
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function YouTubeSaveCover($config, $fields, $field_img, $youtube, $path): bool
	{
		Video::YouTubeSaveCover($config, $fields, $field_img, $youtube, $path);

		return true;
	}
}