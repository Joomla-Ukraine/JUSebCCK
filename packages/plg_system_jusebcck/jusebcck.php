<?php
/**
 * @package        JUSebCCK plugin
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

use Joomla\CMS\Plugin\CMSPlugin;

defined('_JEXEC') or die;

/**
 * JUSebCCK plugin class.
 *
 * @package  JUSebCCK plugin
 *
 * @since 1.0
 */
class plgSystemJUSebCCK extends CMSPlugin
{
	/**
	 * @since 1.0
	 */
	public function onAfterInitialise()
	{
		require_once JPATH_LIBRARIES . '/jusebcck/vendor/autoload.php';
	}
}