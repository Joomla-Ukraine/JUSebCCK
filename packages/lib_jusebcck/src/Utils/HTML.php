<?php
/**
 * @package     JUSebCCK\Utils
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace JUSebCCK\Utils;

use Emuravjev\Mdash\Typograph;

class HTML
{
	/**
	 * @param     $html
	 * @param int $type
	 *
	 * @return string|string[]|null
	 *
	 * @since 1.0
	 */
	public static function typo($html, $type = 1)
	{
		$html = self::clean($html);

		preg_match_all('!(\[socpost\].*?\[/socpost\])!si', $html, $pre);
		$html = preg_replace('!\[socpost\].*?\[/socpost\]!si', '#pre#', $html);

		$typograf = new Typograph();
		$typograf->set_text($html);
		$typograf->setup([
			'Text.paragraphs'                  => 'off',
			'Text.breakline'                   => 'off',
			'OptAlign.all'                     => 'off',
			'Nobr.spaces_nobr_in_surname_abbr' => 'off',
			'Etc.split_number_to_triads'       => 'off'
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