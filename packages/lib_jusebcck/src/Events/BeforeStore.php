<?php
/**
 * @package        JUSebCCK\Events
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
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
	public static function typo($config, $fields, $field, $tags = 1)
	{
		$result = HTML::typo($fields[ $field ]->value, $tags);

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
	public static function userID($config, $fields, $field)
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
	public static function bindDate($config, $fields, $created, $publish_up)
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
	public static function geoLocation($config, $fields, $provider, array $data = [])
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
	public static function checkVideo($config, $fields, $check_video, $video_source)
	{
		$check = Video::check($fields[ $video_source ]->value);

		Data::bind($check, $check_video, $config, $fields);

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
	public static function checkGallery($config, $fields, $field)
	{
		$check = Image::check($fields[ $field ]->value);

		Data::bind($check, $field, $config, $fields);

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
	public static function galleryImage($config, $fields, $field_img, $field_folder)
	{
		if($fields[ $field_img ]->value == '')
		{
			$image = Image::gallery($fields[ $field_img ]->value, $fields[ $field_folder ]->value);

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
	public static function YouTubeLink($config, $fields, $field)
	{
		if($url = $fields[ $field ]->value)
		{
			$url = Video::link($url);

			Data::bind($url, $field, $config, $fields);

			return true;
		}

		return false;
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
	public static function YouTubeFixLink($config, $fields, $field)
	{
		if($url = $fields[ $field ]->value)
		{
			$url = preg_replace("/http(s)?:\/\/youtu\.be\/([^\40\t\r\n\<]+)/i", 'https://www.youtube.com/watch?v=$2', $url);
			$url = preg_replace("/http(s)?:\/\/(w{3}\.)?youtube\.com\/watch\/?\?v=([^\40\t\r\n\<]+)/i", 'https://www.youtube.com/watch?v=$3', $url);

			parse_str(parse_url($url, PHP_URL_QUERY), $youtube_array);
			$url = 'https://www.youtube.com/watch?v=' . $youtube_array[ 'v' ];

			Data::bind($url, $field, $config, $fields);

			return true;
		}

		return false;
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
	public static function YouTubeCover($config, $fields, $field_img, $youtube)
	{
		$youtube_img = Video::video($youtube);

		Data::bind($youtube_img, $field_img, $config, $fields);

		return true;
	}
}