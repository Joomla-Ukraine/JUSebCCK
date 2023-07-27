<?php
/**
 * @since          1.0
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @package        JUSebCCK\Utils
 */

namespace JUSebCCK\Utils;

use JUTypo\JUTypo;

class HTML
{
	public static function table($html, $class, $clean = 1)
	{
		if($clean)
		{
			$html = preg_replace('#<table.*?>#is', '<table>', $html);
			$html = preg_replace('#<th.*align=".*?"#is', '<th', $html);
			$html = preg_replace('#<td.*align=".*?"#is', '<td', $html);
			$html = preg_replace('#<tr.*?height=".*?"#is', '<tr', $html);

			$pos = strpos($html, 'style="text-align: center;"');
			if($pos === false)
			{
				$html = preg_replace('# style=".*?"#is', '', $html);
			}
		}

		return str_replace('<table', '<table class="' . $class . '"', $html);
	}

	/**
	 * @param        $html
	 * @param   int  $type
	 *
	 * @return string|string[]|null
	 *
	 * @since 1.0
	 */
	public static function typo($html, int $type = 1)
	{
		$html = self::clean($html);

		preg_match_all('!(\[socpost\].*?\[/socpost\])!si', $html, $pre);
		$html = preg_replace('!\[socpost\].*?\[/socpost\]!si', '#pre#', $html);

		$html = str_replace([
			'\"',
			'\»',
			"\'",
			"\`",
		], [ '"', '»', "'", '`' ], $html);

		$typo = new JUTypo();
		$typo->enableRule('*');
		$result = $typo->apply($html);

		if($type == 0)
		{
			$result = html_entity_decode(strip_tags($result), ENT_NOQUOTES);
		}
		else
		{
			$result = str_replace([
				'<p></p>',
				'<p> </p>',
				'<p>&nbsp;</p>'
			], '', $result);

			if(!empty($pre[ 0 ]))
			{
				foreach($pre[ 0 ] as $tag)
				{
					$result = preg_replace('!#pre#!', $tag, $result, 1);
				}
			}
		}

		return $result;
	}

	/**
	 * @param $html
	 *
	 * @return string|string[]
	 *
	 * @since 1.0
	 */
	private static function clean($html)
	{
		return str_replace([
			'<p><br />',
			'<br /></p>',
			'<li>—',
			'<li>&mdash;',
			'<li>-',
			'&nbsp;'
		], [
			'<p>',
			'</p>',
			'<li>',
			'<li>',
			'<li>',
			' '
		], $html);
	}
}