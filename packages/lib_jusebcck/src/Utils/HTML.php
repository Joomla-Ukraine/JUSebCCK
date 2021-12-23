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

use Emuravjev\Mdash\Typograph;

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
	 * @param     $html
	 * @param int $type
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

		$typograf = new Typograph();
		$typograf->set_text($html);
		$typograf->setup([
			'Text.paragraphs'                   => 'off',
			'Text.breakline'                    => 'off',
			'Text.no_repeat_words'              => 'off',
			'OptAlign.all'                      => 'off',
			'OptAlign.layout'                   => 'off',
			'Nobr.super_nbsp'                   => 'off',
			'Nobr.spaces_nobr_in_surname_abbr'  => 'off',
			'Nobr.nbsp_in_the_end'              => 'off',
			'Nobr.phone_builder'                => 'off',
			'Nobr.phone_builder_v2'             => 'off',
			'Nobr.ip_address'                   => 'off',
			'Nobr.dots_for_surname_abbr'        => 'off',
			'Nobr.nbsp_celcius'                 => 'off',
			'Nobr.hyphen_nowrap_in_small_words' => 'off',
			'Nobr.hyphen_nowrap'                => 'off',
			'Punctmark.fix_pmarks'              => 'off',
			'Punctmark.fix_excl_quest_marks'    => 'off',
			'Punctmark.dot_on_end'              => 'off',
			'Space.bracket_fix'                 => 'off',
			'Abbr.nobr_vtch_itd_itp'            => 'off',
			'Abbr.nobr_sm_im'                   => 'off',
			'Abbr.nobr_acronym'                 => 'off',
			'Abbr.nobr_locations'               => 'off',
			'Abbr.nobr_abbreviation'            => 'off',
			'Abbr.ps_pps'                       => 'off',
			'Abbr.nbsp_org_abbr'                => 'off',
			'Abbr.nobr_gost'                    => 'off',
			'Abbr.nobr_before_unit_volt'        => 'off',
			'Abbr.nbsp_before_unit'             => 'off',
			'Etc.unicode_convert'               => 'off'
		]);

		$result = $typograf->apply();

		if($type == 0)
		{
			$result = html_entity_decode(strip_tags($result));
		}
		else
		{
			$result = str_replace('<p></p>', '', $result);

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
	 * @param $count
	 *
	 * @return object
	 *
	 * @since 1.0
	 */
	public static function breakdown($html, $count = 100)
	{
		$intro = '';
		if(preg_match('#^.{' . $count . '}.*?[.!?]#is', $html, $matches))
		{
			$intro = $matches[ 0 ];
		}

		$full = str_replace([ strip_tags($intro), $intro, '</p>' ], '', $html);

		return (object) [
			'intro' => $intro,
			'full'  => $full
		];
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