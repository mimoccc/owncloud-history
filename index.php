<?php

/**
 * ownCloud - history plugin
 *
 * @author Nico Kaiser
 * @copyright 2013 Nico Kaiser nico@kaiser.me
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

OCP\User::checkLoggedIn();
OCP\App::checkAppEnabled('files_history');
OCP\App::setActiveNavigationEntry('files_history');
OCP\Util::addStyle('files_history', 'files_history');

$history = array();
$user = OC_User::getUser();
$query = \OC_DB::prepare('SELECT `action`, `path`, `newpath`, `timestamp` FROM `*PREFIX*files_history` WHERE `uid` = ? ORDER BY `timestamp` DESC LIMIT 200');
$history = $query->execute(array($user))->fetchAll();

$list = new OCP\Template('files_history', 'part.list', '');
$list->assign('history', $history);

$tmpl = new OCP\Template('files_history', 'index', 'user');
$tmpl->assign('historyList', $list->fetchPage());
$tmpl->printPage();
