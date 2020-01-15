<?php
/**
 * @package        JUSebCCK\Utils
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2020 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Utils;

class Video
{
	/**
	 * @param $data
	 *
	 * @return bool
	 *
	 * @since 1.0
	 */
	public static function check($data)
	{
		$regex1 = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^>"&?/ ]{11})%i';
		$regex2 = '#(player.vimeo.com)/video/([\d]+)#i';

		if(preg_match($regex1, $data))
		{
			return true;
		}

		if(preg_match($regex2, $data))
		{
			return true;
		}

		return false;
	}

	/**
	 * @param $url
	 *
	 * @return bool|string
	 *
	 * @since 1.0
	 */
	public static function link($url)
	{
		$urls = parse_url($url);

		if($urls[ 'host' ] === 'youtu.be')
		{
			$yid = ltrim($urls[ 'path' ], '/');
		}
		elseif(strpos($urls[ 'path' ], 'embed') == 1)
		{
			$yend = explode('/', $urls[ 'path' ]);
			$yid  = end($yend);
		}
		elseif(strpos($url, '/') === false)
		{
			$yid = $url;
		}
		else
		{
			$feature = '';
			parse_str($urls[ 'query' ], $output);

			$yid = $output[ 'v' ];
			if(!empty($feature))
			{
				$yend = explode('v=', $urls[ 'query' ]);
				$yid  = end($yend);
				$arr  = explode('&', $yid);
				$yid  = $arr[ 0 ];
			}
		}

		if($yid)
		{
			return 'https://www.youtube.com/watch?v=' . $yid;
		}

		return true;
	}

	/**
	 * @param $url
	 *
	 * @return bool|string
	 *
	 * @since 1.0
	 */
	public static function video($url)
	{
		$urls = parse_url($url);
		$yid  = '';
		$vid  = '';

		if($urls[ 'host' ] === 'vimeo.com')
		{
			$vid = ltrim($urls[ 'path' ], '/');
		}
		elseif($urls[ 'host' ] === 'youtu.be')
		{
			$yid = ltrim($urls[ 'path' ], '/');
		}
		elseif(strpos($urls[ 'path' ], 'embed') == 1)
		{
			$yend = explode('/', $urls[ 'path' ]);
			$yid  = end($yend);
		}
		elseif(strpos($url, '/') === false)
		{
			$yid = $url;
		}
		else
		{
			$feature = '';

			parse_str($urls[ 'query' ], $output);
			$yid = $output[ 'v' ];
			if(!empty($feature))
			{
				$yend = explode('v=', $urls[ 'query' ]);
				$yid  = end($yend);
				$arr  = explode('&', $yid);
				$yid  = $arr[ 0 ];
			}
		}

		if($yid)
		{
			$ytpath = 'https://img.youtube.com/vi/' . $yid;

			if(HTTP::http($ytpath . '/maxresdefault.jpg') == '200')
			{
				$img = $ytpath . '/maxresdefault.jpg';
			}
			elseif(HTTP::http($ytpath . '/hqdefault.jpg') == '200')
			{
				$img = $ytpath . '/hqdefault.jpg';
			}
			elseif(HTTP::http($ytpath . '/mqdefault.jpg') == '200')
			{
				$img = $ytpath . '/mqdefault.jpg';
			}
			else
			{
				$img = $ytpath . '/default.jpg';
			}

			return $img;
		}

		if($vid)
		{
			$vimeoObject = json_decode(file_get_contents('https://vimeo.com/api/v2/video/' . $vid . '.json'));

			if(!empty($vimeoObject))
			{
				return $vimeoObject[ 0 ]->thumbnail_large;
			}
		}

		return true;
	}
}