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

namespace JUSebCCK\Translate;

use Stichoza\GoogleTranslate\GoogleTranslate;

class Google
{
	/**
	 * @param $from
	 * @param $to
	 * @param $text
	 *
	 * @return string|null
	 * @throws \ErrorException
	 * @since 1.0
	 */
	public static function get($from, $to, $text): ?string
	{
		$tr = new GoogleTranslate();
		$tr->setSource($from);
		$tr->setTarget($to);

		return $tr->translate($text);
	}
}