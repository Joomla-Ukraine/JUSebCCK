<?php
/**
 * @package        JUSebCCK\Joomla
 * @subpackage     Class
 *
 * @author         Denys D. Nosov (denys@joomla-ua.org)
 * @copyright (C)  2019-2021 by Denys D. Nosov (https://joomla-ua.org)
 * @license        GNU General Public License version 2 or later
 *
 * @since          1.0
 */

namespace JUSebCCK\Joomla;

use Joomla\CMS\Authentication\Authentication;
use Joomla\CMS\Authentication\AuthenticationResponse;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;

/*
 * @ToDo: Add function for Users manipulation
 */

class User
{
	/**
	 * @param null $id
	 *
	 * @return int|null
	 *
	 * @since 1.0
	 */
	public static function id($id = null)
	{
		return Factory::getUser($id)->id;
	}

	/**
	 * @param string $user_id
	 *
	 * @return bool
	 *
	 * @throws \Exception
	 * @since 1.0
	 */
	public static function login($user_id = '153')
	{
		if(!Factory::getApplication()->isClient('administrator') && Factory::getUser()->guest)
		{
			if($user_id = trim($user_id))
			{
				$user = Factory::getUser();
				$user->load($user_id);

				if($user->id)
				{
					$var             = [];
					$var[ 'action' ] = 'core.login.site';

					jimport('joomla.user.authentication');
					PluginHelper::importPlugin('authentication');
					PluginHelper::importPlugin('user');

					$authenticate = Authentication::getInstance();

					$userobj           = new AuthenticationResponse;
					$userobj->username = $user->username;
					$userobj->email    = $user->email;
					$userobj->password = $user->email;

					$authenticate->authorise($userobj, $var);

					Factory::getApplication()->triggerEvent('onUserLogin', [
						(array) $userobj,
						$var
					]);
				}
			}

			return true;
		}

		return false;
	}
}